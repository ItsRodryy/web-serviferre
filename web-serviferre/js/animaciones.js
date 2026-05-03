(function () {
    var prefersReducedMotion = false;
    var animatedSelectors = [
        '.hero-content',
        '.page-hero .container',
        '.stat-item',
        '.section-header',
        '.feature-card',
        '.service-card',
        '.technology-card',
        '.team-card',
        '.carousel-shell',
        '.cta-band',
        '.contact-grid > *',
        '.process-list li',
        '.image-band-content',
        '.form-panel',
        '.info-panel'
    ];

    document.documentElement.classList.add('motion-ok');

    if (!prefersReducedMotion) {
        setupScrollReveal();
    } else {
        document.body.classList.add('animations-ready');
        Array.prototype.forEach.call(document.querySelectorAll(animatedSelectors.join(',')), function (item) {
            item.classList.add('is-visible');
        });
    }

    function setupScrollReveal() {
        var items = Array.prototype.slice.call(document.querySelectorAll(animatedSelectors.join(',')));
        var variants = ['reveal-up', 'reveal-left', 'reveal-right'];

        if (!items.length) {
            return;
        }

        document.body.classList.add('animations-ready');

        items.forEach(function (item, index) {
            item.classList.add('reveal-on-scroll');
            item.classList.add(variants[index % variants.length]);
            item.style.setProperty('--reveal-delay', Math.min(index % 4, 3) * 55 + 'ms');
        });

        if (!('IntersectionObserver' in window)) {
            items.forEach(function (item) {
                item.classList.add('is-visible');
            });
            return;
        }

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                entry.target.classList.toggle('is-visible', entry.isIntersecting);
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -6% 0px'
        });

        items.forEach(function (item) {
            observer.observe(item);
        });
    }
})();
