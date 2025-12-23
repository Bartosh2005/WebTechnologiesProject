$(document).ready(function() {
    // Set CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Helper to determine a locale prefix for URLs
    function localePrefix() {
        if (window.__current_locale) return '/' + window.__current_locale;
        // fallback: if the first path segment matches known locales use it
        var seg = location.pathname.split('/').filter(Boolean)[0];
        var available = (window.__available_locales || []).map(l => l.toString());
        if (available.includes(seg)) return '/' + seg;
        return '';
    }

    // Handle both add and remove
    $(document).on('click', '.add-to-library-btn, .remove-from-library-btn', function() {
        let button = $(this);
        let gameId = button.data('game-id');
        if (!gameId) return console.warn('No game-id on button');

        let isOwned = button.hasClass('remove-from-library-btn'); // true if owned
        let url = localePrefix() + (isOwned ? '/collection/remove/' + gameId : '/collection/add/' + gameId);

        console.debug('Collection action', { url, isOwned, gameId });

        $.post(url, {}, function(response) {
            // Only treat as success when server returns JSON {success: true}
            if (typeof response !== 'object' || !response.success) {
                // likely a redirect to login (HTML) or an error; redirect user to localized login
                var loginUrl = localePrefix() + '/login';
                window.location = loginUrl;
                return;
            }

            if(isOwned){
                // Game removed
                button.removeClass('remove-from-library-btn').addClass('add-to-library-btn');
                var addLabel = (window.__labels && window.__labels.add_to_collection) ? window.__labels.add_to_collection : 'Add to MyCollection';
                button.text(addLabel);
                button.css({'background-color':'','color':''}); 
            } else {
                // Game added
                button.removeClass('add-to-library-btn').addClass('remove-from-library-btn');
                var removeLabel = (window.__labels && window.__labels.remove_from_collection) ? window.__labels.remove_from_collection : 'Remove from MyCollection';
                button.text(removeLabel);
                button.css({'background-color':'#515151','color':'#fff'}); 
            }
        }).fail(function (xhr, status, err) {
            console.error('Failed collection request', status, err);
            alert('Could not update collection. Please try again.');
        });
    });
});