function updateOwnedButtons() {
    $.get('/collection/status', function(response) {
        response.owned.forEach(function(gameId) {
            $('[data-game-id="' + gameId + '"]')
                .removeClass('add-to-library-btn')
                .addClass('remove-from-library-btn')
                .text('Remove from MyCollection')
                .css({'background-color':'#515151','color':'#fff'});
        });

        // Optionally, reset buttons for games not owned
        $('[data-game-id]').each(function() {
            let gameId = $(this).data('game-id');
            if (!response.owned.includes(gameId)) {
                $(this)
                    .removeClass('remove-from-library-btn')
                    .addClass('add-to-library-btn')
                    .text('Add to MyCollection')
                    .css({'background-color':'','color':''});
            }
        });
    });
}

$(document).ready(function() {
    // Set CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Update buttons on page load
    updateOwnedButtons();

    // Handle add/remove clicks
    $(document).on('click', '.add-to-library-btn, .remove-from-library-btn', function() {
        let clickedButton = $(this);
        let gameId = clickedButton.data('game-id');
        let isOwned = clickedButton.hasClass('remove-from-library-btn');
        let url = isOwned ? '/collection/remove/' + gameId : '/collection/add/' + gameId;

        $.post(url, {}, function(response) {
            updateOwnedButtons();
        });
    });
});

// Handle page restore from bfcache (back button)
window.addEventListener('pageshow', function(event) {
    if (event.persisted) {
        updateOwnedButtons();
    }
});
