(function () {
    'use strict';

    var STORAGE_KEY = 'data-bs-theme';

    function getStoredTheme() {
        try {
            return localStorage.getItem(STORAGE_KEY) || sessionStorage.getItem(STORAGE_KEY);
        } catch (e) {
            return null;
        }
    }

    function saveTheme(theme) {
        try {
            localStorage.setItem(STORAGE_KEY, theme);
            sessionStorage.setItem(STORAGE_KEY, theme);
        } catch (e) {}
    }

    function animateThemeChange() {
        document.documentElement.classList.add('theme-animating');
        document.body && document.body.classList.add('theme-animating');

        document.querySelectorAll('.light-dark-mode').forEach(function (btn) {
            btn.classList.add('is-switching-theme');
        });

        window.clearTimeout(window.__themeAnimationTimer);
        window.__themeAnimationTimer = window.setTimeout(function () {
            document.documentElement.classList.remove('theme-animating');
            document.body && document.body.classList.remove('theme-animating');

            document.querySelectorAll('.light-dark-mode').forEach(function (btn) {
                btn.classList.remove('is-switching-theme');
            });
        }, 420);
    }

    function applyTheme(theme, options) {
        if (theme === 'dark' || theme === 'light') {
            if (options && options.animate) {
                animateThemeChange();
            }
            document.documentElement.setAttribute(STORAGE_KEY, theme);
            saveTheme(theme);
        }
    }

    function updateToggleIcon(theme) {
        document.querySelectorAll('.light-dark-mode i').forEach(function (icon) {
            if (theme === 'dark') {
                icon.classList.remove('bx-moon');
                icon.classList.add('bx-sun');
            } else {
                icon.classList.remove('bx-sun');
                icon.classList.add('bx-moon');
            }
        });
    }

    function initTheme() {
        var stored = getStoredTheme();
        var current = document.documentElement.getAttribute(STORAGE_KEY);

        if (stored === 'dark' || stored === 'light') {
            if (current !== stored) {
                document.documentElement.setAttribute(STORAGE_KEY, stored);
            }
            saveTheme(stored);
            updateToggleIcon(stored);
            return;
        }

        if (current === 'dark' || current === 'light') {
            saveTheme(current);
            updateToggleIcon(current);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        initTheme();

        document.querySelectorAll('.light-dark-mode').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                var nextTheme = document.documentElement.getAttribute(STORAGE_KEY) === 'dark' ? 'light' : 'dark';
                applyTheme(nextTheme, { animate: true });
                updateToggleIcon(nextTheme);
                window.dispatchEvent(new Event('resize'));
                e.stopImmediatePropagation();
            }, true);
        });
    });

    // Re-apply after Velzon app.js may reset layout preferences
    window.addEventListener('load', function () {
        setTimeout(initTheme, 100);
    });
})();
