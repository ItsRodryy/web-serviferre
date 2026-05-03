<?php
require_once(__DIR__ . '/../helpers/security.php');

serviferre_send_security_headers();
serviferre_start_private_session(__DIR__ . '/../../storage/sessions');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: contacto.php");
    exit();
}

$postedToken = $_POST['csrf_token'] ?? '';
$sessionToken = $_SESSION['contact_csrf'] ?? '';
unset($_SESSION['contact_csrf']);

if (!is_string($postedToken) || !is_string($sessionToken) || $postedToken === '' || !hash_equals($sessionToken, $postedToken)) {
    header("Location: contacto.php?error=seguridad");
    exit();
}

$subject = contact_single_line(trim($_POST['subject'] ?? ''));
$nombre = contact_single_line(trim($_POST['nombre'] ?? ''));
$apellidos = contact_single_line(trim($_POST['apellidos'] ?? ''));
$email = contact_single_line(trim($_POST['email'] ?? ''));
$mensaje = trim($_POST['mensaje'] ?? '');
$honeypot = trim($_POST['empresa_web'] ?? '');
$privacyAccepted = ($_POST['privacidad'] ?? '') === '1';

if ($honeypot !== '') {
    header("Location: contacto.php?enviado=true");
    exit();
}

if ($nombre === '' || $apellidos === '' || $email === '' || $mensaje === '' || !$privacyAccepted) {
    header("Location: contacto.php?error=campos");
    exit();
}

if (
    contact_text_length($subject) > 120
    || contact_text_length($nombre) > 80
    || contact_text_length($apellidos) > 120
    || contact_text_length($email) > 160
    || contact_text_length($mensaje) > 3000
) {
    header("Location: contacto.php?error=longitud");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: contacto.php?error=email");
    exit();
}

$configPath = __DIR__ . '/../../config/mail.php';
$mailConfig = is_file($configPath) ? require $configPath : [];

if (!contact_config_is_complete($mailConfig)) {
    header("Location: contacto.php?error=mail_config");
    exit();
}

$rateLimitSeconds = (int)($mailConfig['rate_limit_seconds'] ?? 600);

if (contact_is_rate_limited($email, $rateLimitSeconds)) {
    header("Location: contacto.php?error=limite");
    exit();
}

$sent = send_web3forms_submission($mailConfig, [
    'name' => $nombre . ' ' . $apellidos,
    'email' => $email,
    'message' => $mensaje,
    'subject' => $subject !== '' ? 'Nueva consulta: ' . $subject : ($mailConfig['subject'] ?? 'Nueva consulta desde la web de Servi-Ferre'),
    'user_subject' => $subject,
    'from_name' => $mailConfig['from_name'] ?? 'Servi-Ferre Web',
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'desconocida',
    'submitted_at' => date('Y-m-d H:i:s'),
]);

if (!$sent) {
    header("Location: contacto.php?error=mail_envio");
    exit();
}

contact_touch_rate_limit($email);

header("Location: contacto.php?enviado=true");
exit();

function contact_config_is_complete(array $config): bool
{
    return !empty($config['enabled'])
        && ($config['provider'] ?? '') === 'web3forms'
        && !empty($config['access_key']);
}

function send_web3forms_submission(array $config, array $data): bool
{
    if (!function_exists('curl_init')) {
        return false;
    }

    $payload = [
        'access_key' => $config['access_key'],
        'subject' => $data['subject'],
        'from_name' => $data['from_name'],
        'name' => $data['name'],
        'email' => $data['email'],
        'replyto' => $data['email'],
        'message' => implode("\n", [
            'Asunto: ' . ($data['user_subject'] !== '' ? $data['user_subject'] : 'Sin asunto indicado'),
            'Nombre: ' . $data['name'],
            'Email: ' . $data['email'],
            'IP: ' . $data['ip'],
            'Fecha: ' . $data['submitted_at'],
            '',
            'Mensaje:',
            $data['message'],
        ]),
    ];

    if (!empty($config['cc_email'])) {
        $payload['ccemail'] = $config['cc_email'];
    }

    $ch = curl_init('https://api.web3forms.com/submit');

    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($payload),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded'],
    ]);

    $response = curl_exec($ch);
    $statusCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($response === false || $error !== '' || $statusCode < 200 || $statusCode >= 300) {
        return false;
    }

    $decoded = json_decode($response, true);

    return !is_array($decoded) || !array_key_exists('success', $decoded) || $decoded['success'] === true;
}

function contact_rate_file(): string
{
    return __DIR__ . '/../../storage/contact-rate-limit.json';
}

function contact_single_line(string $value): string
{
    return trim(str_replace(["\r", "\n"], ' ', $value));
}

function contact_text_length(string $value): int
{
    return function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
}

function contact_rate_keys(string $email): array
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

    return [
        'ip:' . hash('sha256', $ip),
        'email:' . hash('sha256', strtolower($email)),
    ];
}

function contact_read_rate_data(): array
{
    $file = contact_rate_file();

    if (!is_file($file)) {
        return [];
    }

    $data = json_decode(file_get_contents($file) ?: '{}', true);

    return is_array($data) ? $data : [];
}

function contact_write_rate_data(array $data): void
{
    $file = contact_rate_file();
    $dir = dirname($file);

    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);
}

function contact_is_rate_limited(string $email, int $limitSeconds): bool
{
    $now = time();
    $data = contact_read_rate_data();

    foreach (contact_rate_keys($email) as $key) {
        if (isset($data[$key]) && ($now - (int)$data[$key]) < $limitSeconds) {
            return true;
        }
    }

    return false;
}

function contact_touch_rate_limit(string $email): void
{
    $now = time();
    $data = contact_read_rate_data();

    foreach ($data as $key => $timestamp) {
        if (($now - (int)$timestamp) > 86400) {
            unset($data[$key]);
        }
    }

    foreach (contact_rate_keys($email) as $key) {
        $data[$key] = $now;
    }

    contact_write_rate_data($data);
}
