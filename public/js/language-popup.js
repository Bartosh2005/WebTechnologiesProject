document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('language-modal');
    if (!modal) return;

    var chosen = localStorage.getItem('languageChosen');
    // If cookie already exists, avoid showing the modal; also write the flag so it won't reappear
    if (chosen || window.__locale_cookie) {
        if (window.__locale_cookie && !chosen) {
            localStorage.setItem('languageChosen', '1');
        }
        return;
    }

    // If the server already determined a non-default locale via route or cookie, consider language chosen
    if (window.__current_locale && window.__current_locale !== 'en') {
        localStorage.setItem('languageChosen', '1');
        return;
    }

    modal.style.display = 'flex';
    modal.setAttribute('aria-hidden', 'false');

    // Build available locales map from modal data if present
    var availableLocales = {};
    try {
        availableLocales = JSON.parse(modal.getAttribute('data-locales') || '{}') || {};
    } catch (e) { availableLocales = {}; }

    function buildLocalizedPath(locale) {
        var path = window.location.pathname; // e.g. '/en/welcome' or '/welcome' or '/'
        var parts = path.split('/').filter(Boolean); // ['en','welcome'] or ['welcome'] or []
        var codes = Object.keys(availableLocales);

        if (parts.length && codes.indexOf(parts[0]) !== -1) {
            // replace existing locale prefix
            parts[0] = locale;
        } else {
            // add locale prefix
            parts.unshift(locale);
        }

        var newPath = '/' + parts.join('/');
        var search = window.location.search || '';
        var hash = window.location.hash || '';
        return newPath + search + hash;
    }

    document.querySelectorAll('.lang-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var locale = btn.getAttribute('data-locale') || 'en';
            // Set cookie for 1 year
            document.cookie = 'locale=' + encodeURIComponent(locale) + ';path=/;max-age=' + (60*60*24*365);
            localStorage.setItem('languageChosen', '1');
            modal.style.display = 'none';
            // Redirect to localized path (preserves query/hash)
            window.location.href = buildLocalizedPath(locale);
        });
    });

    document.getElementById('language-modal-skip').addEventListener('click', function() {
        // Default to English
        var locale = 'en';
        document.cookie = 'locale=' + locale + ';path=/;max-age=' + (60*60*24*365);
        localStorage.setItem('languageChosen', '1');
        modal.style.display = 'none';
        window.location.href = buildLocalizedPath(locale);
    });
});