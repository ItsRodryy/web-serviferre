<?php
include(__DIR__ . '/../layout/header.php');
require_once(__DIR__ . '/../helpers/icons.php');
?>

<section class="hero-home" style="background-image: url('../img/optimized/hero-furgonetas-serviferre.jpg');">
    <div class="container">
        <div class="hero-content">
            <span class="hero-eyebrow">Instalaciones eléctricas y tecnología</span>
            <h1 class="hero-title">Servi-Ferre</h1>
            <p class="hero-lead">
                Soluciones profesionales para viviendas, comunidades y negocios: electricidad, seguridad,
                redes, iluminación, energía solar y climatización.
            </p>
            <div class="hero-actions">
                <a href="/servicios.php" class="btn btn-light">Ver servicios</a>
                <a href="/contacto.php" class="btn btn-outline-light">Solicitar presupuesto</a>
            </div>
            <div class="hero-proof" aria-label="Puntos fuertes">
                <span>Atención cercana</span>
                <span>Trabajo limpio</span>
                <span>Soluciones a medida</span>
            </div>
        </div>
    </div>
</section>

<section class="stat-bar">
    <div class="container">
        <div class="stat-grid">
            <div class="stat-item">
                <span class="stat-value">20+</span>
                <span class="stat-label">años de experiencia</span>
            </div>
            <div class="stat-item">
                <span class="stat-value">24h</span>
                <span class="stat-label">respuesta ágil</span>
            </div>
            <div class="stat-item">
                <span class="stat-value">100%</span>
                <span class="stat-label">instalaciones cuidadas</span>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="eyebrow">Por qué elegirnos</span>
            <h2>Un equipo preparado para resolver de principio a fin</h2>
            <p>Combinamos oficio eléctrico, tecnología y criterio práctico para que cada instalación quede segura, ordenada y lista para usar.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <article class="feature-card">
                    <div class="card-accent"></div>
                    <h3>Calidad técnica</h3>
                    <p>Trabajamos con materiales fiables, montaje cuidado y una ejecución pensada para durar.</p>
                </article>
            </div>
            <div class="col-md-4">
                <article class="feature-card">
                    <div class="card-accent"></div>
                    <h3>Rapidez con orden</h3>
                    <p>Planificamos cada trabajo para reducir esperas, imprevistos y molestias durante la instalación.</p>
                </article>
            </div>
            <div class="col-md-4">
                <article class="feature-card">
                    <div class="card-accent"></div>
                    <h3>Trato directo</h3>
                    <p>Te explicamos las opciones con claridad y ajustamos la solución a tus necesidades reales.</p>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="section section-muted">
    <div class="container">
        <div class="section-header">
            <span class="eyebrow">Servicios principales</span>
            <h2>Instalaciones para hogares y negocios</h2>
            <p>Desde la electricidad base hasta sistemas conectados de seguridad, red y confort.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <article class="service-card">
                    <?= serviferre_chip('bolt', 'Electricidad'); ?>
                    <h3>Viviendas y reformas</h3>
                    <p>Instalaciones completas, ampliaciones, cuadros, cableado y mejoras de seguridad.</p>
                </article>
            </div>
            <div class="col-md-6 col-lg-3">
                <article class="service-card">
                    <?= serviferre_chip('shield', 'Seguridad'); ?>
                    <h3>Cámaras y alarmas</h3>
                    <p>Sistemas de vigilancia, volumétricos y protección para viviendas o empresas.</p>
                </article>
            </div>
            <div class="col-md-6 col-lg-3">
                <article class="service-card">
                    <?= serviferre_chip('network', 'Conectividad'); ?>
                    <h3>Redes y antenas</h3>
                    <p>Cableado de datos, routers, switches, antenas y parabólicas con acabado profesional.</p>
                </article>
            </div>
            <div class="col-md-6 col-lg-3">
                <article class="service-card">
                    <?= serviferre_chip('sun', 'Eficiencia'); ?>
                    <h3>Solar y clima</h3>
                    <p>Placas solares, iluminación LED RGB y aire acondicionado para mejorar consumo y confort.</p>
                </article>
            </div>
        </div>

        <div class="cta-band mt-5 d-flex flex-column flex-lg-row gap-3 align-items-lg-center justify-content-between">
            <div>
                <h2 class="h4 mb-2">Cuéntanos qué necesitas instalar o mejorar</h2>
                <p>Te orientamos con una propuesta clara y adaptada al espacio.</p>
            </div>
            <a href="/contacto.php" class="btn btn-light">Contactar ahora</a>
        </div>
    </div>
</section>

<?php include(__DIR__ . '/../layout/footer.php'); ?>
