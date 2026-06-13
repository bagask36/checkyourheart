(function () {
    'use strict';

    if (window.__landingRevealInitialized) {
        return;
    }

    function initLandingReveal() {
        if (typeof ScrollReveal === 'undefined') {
            return;
        }

        window.__landingRevealInitialized = true;
        window.__landingScrollReveal = window.__landingScrollReveal || ScrollReveal({
            distance: '48px',
            duration: 900,
            easing: 'ease-out',
            reset: false,
            viewFactor: 0.2
        });

        window.__landingScrollReveal.reveal('.reveal-hero', {
            origin: 'top'
        });

        window.__landingScrollReveal.reveal('.reveal-stats .landing-stat-card', {
            origin: 'bottom',
            interval: 150
        });

        window.__landingScrollReveal.reveal('.reveal-title', {
            origin: 'bottom',
            delay: 100
        });

        window.__landingScrollReveal.reveal('.landing-feature-card, .landing-step-card', {
            origin: 'bottom',
            interval: 150
        });

        window.__landingScrollReveal.reveal('.reveal-cta', {
            origin: 'bottom',
            delay: 150
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLandingReveal, { once: true });
        return;
    }

    initLandingReveal();
})();
