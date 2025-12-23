document.addEventListener('DOMContentLoaded', function() {
    var locales = window.__available_locales || {};
    var preferred = null;

    // Get preferred locale from cookie or global
    var cookieMatch = document.cookie.split(';').map(function(c){return c.trim();}).find(function(c){ return c.indexOf('locale=')===0; });
    if (cookieMatch) {
        preferred = decodeURIComponent(cookieMatch.split('=')[1]);
    }
    if (!preferred && window.__current_locale) {
        preferred = window.__current_locale;
    }
    if (!preferred) preferred = Object.keys(locales)[0] || 'en';

    var codes = Object.keys(locales);

    function localizedPathFor(path, locale) {
        if (!path) return path;
        // Ignore absolute URLs to other domains
        if (path.indexOf('://') !== -1 && path.indexOf(window.location.origin) !== 0) return path;

        var u = new URL(path, window.location.origin);
        var parts = u.pathname.split('/').filter(Boolean);

        if (parts.length && codes.indexOf(parts[0]) !== -1) {
            parts[0] = locale;
        } else {
            if (u.pathname === '/') {
                parts = [locale];
            } else {
                parts.unshift(locale);
            }
        }

        u.pathname = '/' + parts.join('/');
        return u.toString();
    }

    // Update header anchors
    var header = document.querySelector('header');
    if (!header) return;
    var anchors = header.querySelectorAll('a');
    anchors.forEach(function(a){
        try {
            var href = a.getAttribute('href');
            if (!href) return;
            // skip links to assets, mailto, tel, anchors
            if (/^#|^mailto:|^tel:|^\/\//.test(href) || href.match(/\.(png|jpg|jpeg|gif|svg|ico|css|js)$/i)) return;
            // compute localized URL and set
            var newUrl = localizedPathFor(href, preferred);
            if (newUrl) {
                // keep relative hrefs where possible
                var origin = window.location.origin;
                if (newUrl.indexOf(origin) === 0) {
                    a.href = newUrl.substring(origin.length);
                } else {
                    a.href = newUrl;
                }
            }
        } catch (e) {
            // ignore
        }
    });
});