$(document).ready(function () {
    // Include the CSRF token with every AJAX request
    //Also, this button is specific to the personal library
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.remove-from-library-btn', function (e) {
        e.preventDefault();

        let button = $(this);
        let gameId = button.data('game-id');

        if (!gameId) return console.warn('No game id to remove');

        // compute locale prefix like addbutton.js
        function localePrefix() {
            if (window.__current_locale) return '/' + window.__current_locale;
            var seg = location.pathname.split('/').filter(Boolean)[0];
            var available = (window.__available_locales || []).map(l => l.toString());
            if (available.includes(seg)) return '/' + seg;
            return '';
        }

        var url = localePrefix() + '/collection/remove/' + gameId;
        console.debug('Removing from collection', { url, gameId });

        // POST request to remove the selected game from the collection - specific to the collection
        $.post(url, {}, function (response) {
            if (typeof response !== 'object' || !response.success) {
                var loginUrl = localePrefix() + '/login';
                window.location = loginUrl;
                return;
            }

            // cleansmooth fade out and remove the game card from the page - again, for the collection
            button.closest('.game').fadeOut(300, function () {
                $(this).remove();
            });
        }).fail(function (xhr, status, error) {
            console.error('Error removing game:', status, error);
            alert('Could not remove the game. Please try again.');
        });
    });
});