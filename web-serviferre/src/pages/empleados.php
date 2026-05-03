<?php
include(__DIR__ . '/../layout/header.php');

$employees = [
    [
        'name' => 'Manuel Jesús',
        'role' => 'Dirección y coordinación',
        'text' => 'Responsable de planificar trabajos, coordinar al equipo y asegurar que cada instalación quede bien rematada.',
        'image' => '../img/optimized/team/manuel-jesus.jpg',
    ],
    [
        'name' => 'Alejandro González',
        'role' => 'Seguridad e iluminación',
        'text' => 'Especialista en montaje de cámaras, sistemas LED y trabajos técnicos de precisión.',
        'image' => '../img/optimized/team/alejandro-gonzalez.jpg',
    ],
    [
        'name' => 'Juan Manuel',
        'role' => 'Electricidad en viviendas',
        'text' => 'Experto en instalaciones eléctricas residenciales, reformas y mantenimiento.',
        'image' => '../img/optimized/team/juan-manuel.jpg',
    ],
];
?>

<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Equipo</span>
        <h1>Equipo de Servi-Ferre</h1>
        <p>Profesionales preparados para ejecutar instalaciones cuidadas y resolver cada proyecto con criterio técnico.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($employees as $employee): ?>
                <div class="col-md-6 col-lg-4">
                    <article class="team-card">
                        <img src="<?= htmlspecialchars($employee['image'], ENT_QUOTES, 'UTF-8'); ?>"
                             alt="<?= htmlspecialchars($employee['name'], ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="team-card-body">
                            <span class="service-tag"><?= htmlspecialchars($employee['role'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <h3><?= htmlspecialchars($employee['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?= htmlspecialchars($employee['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="image-band" style="background-image: url('../img/optimized/carousel/tecnico-instalacion-electrica.jpg');">
    <div class="container">
        <div class="image-band-content">
            <span class="eyebrow">Trabajo en obra</span>
            <h2>Instalaciones hechas con oficio y atención al detalle</h2>
            <p>El equipo combina experiencia práctica, criterio técnico y una ejecución limpia en cada proyecto.</p>
        </div>
    </div>
</section>

<?php include(__DIR__ . '/../layout/footer.php'); ?>
