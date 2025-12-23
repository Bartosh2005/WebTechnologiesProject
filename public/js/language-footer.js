document.addEventListener('DOMContentLoaded', function() {
    var locales = window.__available_locales || {};
    var current = window.__current_locale || 'en';
    var footer = document.querySelector('footer');
    if (!footer) return;

    // Create container (full-width, aligned to the right)
    var container = document.createElement('div');
    container.style.display = 'flex';
    container.style.width = '100%';
    container.style.justifyContent = 'flex-end';
    container.style.alignItems = 'center';
    container.style.gap = '8px';
    container.style.marginTop = '8px';

    // Accessible sr-only label (kept for screen readers)
    var label = document.createElement('label');
    label.setAttribute('for', 'footer-locale-select');
    label.className = 'sr-only';
    label.textContent = (window.__labels && window.__labels.choose_language) ? window.__labels.choose_language : 'Language';

    var select = document.createElement('select');
    select.id = 'footer-locale-select';
    select.setAttribute('aria-label', 'Choose language');
    select.style.padding = '6px 10px';
    select.style.borderRadius = '4px';

    Object.keys(locales).forEach(function(code){
        var opt = document.createElement('option');
        opt.value = code;
        opt.textContent = locales[code];
        if (code === current) opt.selected = true;
        select.appendChild(opt);
    });

    container.appendChild(label);
    container.appendChild(select);

    // Append to footer (centered)
    footer.appendChild(container);

    function buildLocalizedPath(locale) {
        var path = window.location.pathname; // e.g. '/en/welcome' or '/welcome' or '/'
        var parts = path.split('/').filter(Boolean); // ['en','welcome'] or ['welcome'] or []
        var codes = Object.keys(locales);

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

    select.addEventListener('change', function() {
        var locale = select.value || 'en';
        document.cookie = 'locale=' + encodeURIComponent(locale) + ';path=/;max-age=' + (60*60*24*365);
        try { localStorage.setItem('languageChosen', '1'); } catch(e){}
        // Redirect to localized URL
        window.location.href = buildLocalizedPath(locale);
    });
});