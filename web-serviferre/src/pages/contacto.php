<?php
require_once(__DIR__ . '/../helpers/security.php');

serviferre_start_private_session(__DIR__ . '/../../storage/sessions');

if (empty($_SESSION['contact_csrf'])) {
    $_SESSION['contact_csrf'] = bin2hex(random_bytes(32));
}

include(__DIR__ . '/../layout/header.php');

$mailConfigPath = __DIR__ . '/../../config/mail.php';
$mailConfig = is_file($mailConfigPath) ? require $mailConfigPath : [];
$contactFormReady = !empty($mailConfig['enabled'])
    && ($mailConfig['provider'] ?? '') === 'web3forms'
    && !empty($mailConfig['access_key']);

$contactErrors = [
    'campos' => 'Revisa los campos del formulario antes de enviarlo.',
    'email' => 'Introduce un correo electrónico válido.',
    'mail_config' => 'Falta configurar la clave del formulario.',
    'mail_envio' => 'No hemos podido enviar el correo. Inténtalo de nuevo más tarde.',
    'limite' => 'Ya se ha enviado una consulta recientemente. Espera 10 minutos antes de volver a intentarlo.',
    'seguridad' => 'No hemos podido validar el formulario. Recarga la página e inténtalo de nuevo.',
    'longitud' => 'Revisa la longitud de los campos antes de enviar el formulario.',
];

$errorKey = $_GET['error'] ?? null;
$errorMessage = $contactErrors[$errorKey] ?? null;
?>

<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Contacto</span>
        <h1>Cuéntanos qué necesitas</h1>
        <p>
            Describe la instalación o mejora que tienes en mente y te responderemos con una orientación clara.
        </p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="contact-grid">
            <div class="form-panel">
                <div class="mb-4">
                    <span class="badge-soft">Formulario</span>
                    <h2 class="h3 fw-bold mb-2">Solicitar información</h2>
                    <p class="text-muted mb-0">Completa tus datos y el equipo de Servi-Ferre revisará tu consulta.</p>
                </div>

                <?php if ($errorMessage): ?>
                    <div class="alert alert-danger" id="contactFormError" role="alert">
                        <?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php endif; ?>

                <?php if (!$contactFormReady): ?>
                    <div class="alert alert-danger" role="alert">
                        Falta configurar la clave del formulario.
                    </div>
                <?php endif; ?>

                <form id="contactForm" method="POST" action="/procesar_contacto.php">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['contact_csrf'], ENT_QUOTES, 'UTF-8'); ?>">

                    <div class="honeypot-field" aria-hidden="true">
                        <label for="empresa_web">Empresa</label>
                        <input type="text" id="empresa_web" name="empresa_web" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="asunto" class="form-label">Asunto</label>
                            <input type="text" class="form-control" id="asunto" name="subject"
                                   placeholder="Ejemplo: Presupuesto para instalación eléctrica" maxlength="120" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" autocomplete="given-name" maxlength="80" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" autocomplete="family-name" maxlength="120" required>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" autocomplete="email" maxlength="160" required>
                        </div>
                        <div class="col-12">
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="6" maxlength="3000" required
                                      placeholder="Ejemplo: necesito instalar cámaras, revisar una instalación eléctrica o pedir presupuesto para placas solares."></textarea>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="privacidad" name="privacidad" required>
                                <label class="form-check-label" for="privacidad">
                                    He leído y acepto la <a href="/privacidad.php">política de privacidad</a>.
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-brand btn-lg w-100 mt-4"<?= $contactFormReady ? '' : ' disabled'; ?>>Enviar consulta</button>
                </form>
            </div>

            <aside class="info-panel">
                <span class="badge-soft">Atención directa</span>
                <h2 class="h4 fw-bold mt-2">Hablemos de tu proyecto</h2>
                <p>
                    Puedes escribirnos por el formulario o contactar directamente para una consulta rápida.
                </p>

                <ul class="contact-list">
                    <li>
                        <span>Teléfono</span>
                        <a href="tel:+34655606926">+34 655 606 926</a>
                    </li>
                    <li>
                        <span>Email</span>
                        <a href="mailto:servi-ferre@hotmail.com">servi-ferre@hotmail.com</a>
                    </li>
                    <li>
                        <span>Servicios habituales</span>
                        <strong>Electricidad, cámaras, alarmas, redes, antenas, solar y clima.</strong>
                    </li>
                </ul>
            </aside>
        </div>
    </div>
</section>

<section class="image-band" style="background-image: url('../img/optimized/carousel/iluminacion-led-terraza.jpg');">
    <div class="container">
        <div class="image-band-content">
            <span class="eyebrow">Respuesta cercana</span>
            <h2>Revisamos tu consulta y te orientamos con claridad</h2>
            <p>Cuanto mejor nos cuentes lo que necesitas, más fácil será preparar una solución ajustada al espacio.</p>
        </div>
    </div>
</section>

<div class="modal fade" id="enviadoModal" tabindex="-1" aria-labelledby="enviadoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enviadoModalLabel">Mensaje enviado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                Hemos recibido tu consulta correctamente. Te responderemos lo antes posible.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-brand" data-bs-dismiss="modal">Entendido</button>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_GET['enviado']) && $_GET['enviado'] === 'true'): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var enviadoModal = new bootstrap.Modal(document.getElementById('enviadoModal'));
            enviadoModal.show();
        });
    </script>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('contactForm');

        if (!form) {
            return;
        }

        form.addEventListener('submit', function () {
            var button = form.querySelector('button[type="submit"]');

            if (button) {
                button.disabled = true;
                button.textContent = 'Enviando...';
            }
        });
    });
</script>

<?php include(__DIR__ . '/../layout/footer.php'); ?>
