<?php
include(__DIR__ . '/../layout/header.php');
require_once(__DIR__ . '/../helpers/icons.php');

$carouselDir = __DIR__ . '/../../img/optimized/carousel/';
$carouselUrl = '/img/optimized/carousel/';
$validExtensions = ['png', 'jpg', 'jpeg'];
$images = [];

if (is_dir($carouselDir)) {
    $images = array_filter(scandir($carouselDir), function ($file) use ($carouselDir, $validExtensions) {
        $filePath = $carouselDir . $file;
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        return is_file($filePath) && in_array($extension, $validExtensions, true);
    });
    $images = array_values($images);
}

$services = [
    [
        'icon' => 'bolt',
        'tag' => 'Electricidad',
        'title' => 'Instalación en viviendas',
        'text' => 'Instalaciones completas, reformas eléctricas, cuadros, mecanismos y cableado seguro para el día a día.',
    ],
    [
        'icon' => 'network',
        'tag' => 'Redes',
        'title' => 'Redes de datos',
        'text' => 'Cableado estructurado, puntos de red, switches y configuraciones para una conexión estable.',
    ],
    [
        'icon' => 'camera',
        'tag' => 'Seguridad',
        'title' => 'Cámaras de seguridad',
        'text' => 'Videovigilancia para viviendas, oficinas y negocios con sistemas pensados para cada espacio.',
    ],
    [
        'icon' => 'shield',
        'tag' => 'Protección',
        'title' => 'Alarmas y volumétricos',
        'text' => 'Soluciones de detección y aviso para reforzar la seguridad de entradas, interiores y zonas sensibles.',
    ],
    [
        'icon' => 'antenna',
        'tag' => 'Señal',
        'title' => 'Antenas y parabólicas',
        'text' => 'Instalación, ajuste y mantenimiento de antenas terrestres y parabólicas.',
    ],
    [
        'icon' => 'bulb',
        'tag' => 'Iluminación',
        'title' => 'Iluminación LED y RGB',
        'text' => 'Iluminación eficiente, decorativa y personalizada para interior, exterior o zonas comerciales.',
    ],
    [
        'icon' => 'sun',
        'tag' => 'Energía',
        'title' => 'Placas solares',
        'text' => 'Instalaciones solares orientadas al ahorro energético y al uso responsable de la energía.',
    ],
    [
        'icon' => 'snow',
        'tag' => 'Confort',
        'title' => 'Aire acondicionado',
        'text' => 'Instalación y mantenimiento de climatización para viviendas y pequeños negocios.',
    ],
];
?>

<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Servicios</span>
        <h1>Soluciones técnicas para instalaciones completas</h1>
        <p>
            Cubrimos las necesidades eléctricas y tecnológicas más habituales con trabajos ordenados,
            materiales fiables y una comunicación clara desde el primer contacto.
        </p>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if (count($images) > 0): ?>
            <div id="servicesCarousel" class="carousel slide carousel-shell" data-bs-ride="carousel" data-bs-interval="3500">
                <div class="carousel-indicators">
                    <?php foreach ($images as $index => $image): ?>
                        <button type="button" data-bs-target="#servicesCarousel" data-bs-slide-to="<?= $index; ?>"
                                class="<?= $index === 0 ? 'active' : ''; ?>"
                                aria-label="Imagen <?= $index + 1; ?>"></button>
                    <?php endforeach; ?>
                </div>

                <div class="carousel-inner">
                    <?php foreach ($images as $index => $image): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>">
                            <img src="<?= htmlspecialchars($carouselUrl . $image, ENT_QUOTES, 'UTF-8'); ?>"
                                 class="d-block w-100"
                                 alt="Trabajo de Servi-Ferre <?= $index + 1; ?>">
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#servicesCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#servicesCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="section-header mt-5">
            <span class="eyebrow">Qué hacemos</span>
            <h2>Servicios pensados para resolver, no solo instalar</h2>
            <p>Analizamos el espacio, proponemos la opción adecuada y dejamos cada sistema preparado para funcionar con confianza.</p>
        </div>

        <div class="row g-4">
            <?php foreach ($services as $service): ?>
                <div class="col-md-6 col-lg-3">
                    <article class="service-card">
                        <?= serviferre_chip($service['icon'], $service['tag']); ?>
                        <h3><?= htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p><?= htmlspecialchars($service['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-compact">
    <div class="container">
        <div class="cta-band d-flex flex-column flex-lg-row gap-3 align-items-lg-center justify-content-between">
            <div>
                <h2 class="h4 mb-2">¿Necesitas una instalación concreta?</h2>
                <p>Envíanos los detalles y revisamos la mejor forma de hacerlo.</p>
            </div>
            <a href="/contacto.php" class="btn btn-light">Pedir presupuesto</a>
        </div>
    </div>
</section>

<?php include(__DIR__ . '/../layout/footer.php'); ?>
