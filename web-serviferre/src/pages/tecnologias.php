<?php
include(__DIR__ . '/../layout/header.php');
require_once(__DIR__ . '/../helpers/icons.php');

$technologies = [
    [
        'icon' => 'bolt',
        'tag' => 'Electricidad',
        'title' => 'Cableado eléctrico',
        'text' => 'Trazados limpios, protecciones adecuadas y cableado preparado para un uso seguro y estable.',
    ],
    [
        'icon' => 'home',
        'tag' => 'Hogar conectado',
        'title' => 'Domótica',
        'text' => 'Automatización para mejorar comodidad, eficiencia y control de los sistemas de la vivienda.',
    ],
    [
        'icon' => 'bulb',
        'tag' => 'Iluminación',
        'title' => 'LED eficiente',
        'text' => 'Soluciones LED para reducir consumo y crear ambientes mejor iluminados.',
    ],
    [
        'icon' => 'panel',
        'tag' => 'Control',
        'title' => 'Interruptores y paneles',
        'text' => 'Mecanismos, cuadros y controles instalados con criterio técnico y acabado cuidado.',
    ],
    [
        'icon' => 'plug',
        'tag' => 'Red',
        'title' => 'Cables y conectores',
        'text' => 'Conectividad estable con cableado, terminaciones y conectores de calidad.',
    ],
    [
        'icon' => 'network',
        'tag' => 'Conectividad',
        'title' => 'Switches y routers',
        'text' => 'Equipos de red configurados para mejorar cobertura, velocidad y estabilidad.',
    ],
    [
        'icon' => 'camera',
        'tag' => 'Seguridad',
        'title' => 'Cámaras IP',
        'text' => 'Videovigilancia conectada para control local o remoto según las necesidades del espacio.',
    ],
    [
        'icon' => 'shield',
        'tag' => 'Protección',
        'title' => 'Sistemas de alarma',
        'text' => 'Sensores, detectores y avisos para reforzar la seguridad de viviendas y negocios.',
    ],
    [
        'icon' => 'key',
        'tag' => 'Accesos',
        'title' => 'Control de accesos',
        'text' => 'Soluciones para gestionar entradas, zonas restringidas y puntos de paso.',
    ],
    [
        'icon' => 'sun',
        'tag' => 'Energía',
        'title' => 'Placas solares',
        'text' => 'Instalaciones enfocadas al ahorro energético y a un consumo más eficiente.',
    ],
    [
        'icon' => 'snow',
        'tag' => 'Clima',
        'title' => 'Aire acondicionado',
        'text' => 'Equipos de climatización instalados y mantenidos para ofrecer confort todo el año.',
    ],
    [
        'icon' => 'wifi',
        'tag' => 'WiFi',
        'title' => 'Redes inalámbricas',
        'text' => 'Cobertura WiFi pensada para evitar zonas muertas y mantener una conexión estable.',
    ],
];
?>

<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Tecnologías</span>
        <h1>Herramientas y sistemas con los que trabajamos</h1>
        <p>
            Seleccionamos cada tecnología según el espacio, el uso previsto y el nivel de seguridad,
            eficiencia o conectividad que necesita el cliente.
        </p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($technologies as $technology): ?>
                <div class="col-md-6 col-lg-4">
                    <article class="technology-card">
                        <?= serviferre_chip($technology['icon'], $technology['tag']); ?>
                        <h3><?= htmlspecialchars($technology['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p><?= htmlspecialchars($technology['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-muted">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="section-header text-start mx-0 mb-0">
                    <span class="eyebrow">Método de trabajo</span>
                    <h2>Primero entendemos el problema, después instalamos la solución</h2>
                    <p>Una buena instalación empieza con una revisión honesta del espacio y termina con un sistema fácil de usar.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="process-list">
                    <li>
                        <span class="process-step">1</span>
                        <span>Revisamos necesidades, ubicación de equipos y posibles limitaciones técnicas.</span>
                    </li>
                    <li>
                        <span class="process-step">2</span>
                        <span>Proponemos materiales, distribución y alcance del trabajo con claridad.</span>
                    </li>
                    <li>
                        <span class="process-step">3</span>
                        <span>Instalamos, comprobamos y dejamos el sistema preparado para el uso diario.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php include(__DIR__ . '/../layout/footer.php'); ?>
