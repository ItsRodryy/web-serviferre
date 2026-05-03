<?php
$currentPage = basename($_SERVER['SCRIPT_NAME']);

if (!function_exists('nav_active')) {
    function nav_active(string $file, string $currentPage): string
    {
        return $currentPage === $file ? ' active' : '';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servi-Ferre | Soluciones eléctricas y tecnológicas</title>
    <meta name="description" content="Servi-Ferre ofrece instalaciones eléctricas, seguridad, redes, energía solar, iluminación y climatización para viviendas, comunidades y negocios.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/estilos.css?v=20260504-10">
</head>
<body>
    <header class="site-header">
        <nav class="navbar navbar-expand-lg navbar-dark site-nav" aria-label="Navegación principal">
            <div class="container">
                <a class="navbar-brand site-brand" href="/" aria-label="Servi-Ferre Inicio">
                    <img src="/img/logo-serviferre-horizontal.png" alt="Servi-Ferre" class="brand-wordmark">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                        aria-controls="mainNav" aria-expanded="false" aria-label="Abrir menú">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav nav-main">
                        <li class="nav-item">
                            <a class="nav-link<?= nav_active('index.php', $currentPage); ?>" href="/">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= nav_active('servicios.php', $currentPage); ?>" href="/servicios.php">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= nav_active('tecnologias.php', $currentPage); ?>" href="/tecnologias.php">Tecnologías</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= nav_active('empleados.php', $currentPage); ?>" href="/empleados.php">Equipo</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav nav-contact ms-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link<?= nav_active('contacto.php', $currentPage); ?>" href="/contacto.php">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="site-main">
