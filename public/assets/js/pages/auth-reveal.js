(function () {
    'use strict';

    if (window.__authRevealInitialized) {
        return;
    }

    function initAuthReveal() {
        if (typeof ScrollReveal === 'undefined') {
            return;
        }

        var authPage = document.querySelector('.auth-page');
        if (!authPage) {
            return;
        }

        window.__authRevealInitialized = true;
        window.__authScrollReveal = window.__authScrollReveal || ScrollReveal({
            distance: '40px',
            duration: 800,
            easing: 'ease-out',
            reset: false,
            viewFactor: 0.18
        });

        window.__authScrollReveal.reveal('.reveal-auth-brand', {
            origin: 'left'
        });

        window.__authScrollReveal.reveal('.reveal-auth-feature', {
            origin: 'left',
            interval: 120,
            delay: 120
        });

        window.__authScrollReveal.reveal('.reveal-auth-card', {
            origin: 'right',
            delay: 80
        });

        window.__authScrollReveal.reveal('.reveal-auth-footer-link, .reveal-auth-page-footer', {
            origin: 'bottom',
            interval: 100,
            delay: 160
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAuthReveal, { once: true });
        return;
    }

    initAuthReveal();
})();
