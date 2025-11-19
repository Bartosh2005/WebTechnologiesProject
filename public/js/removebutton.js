$(document).ready(function () {
    // Set CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Delegated handler for remove buttons
    $(document).on('click', '.remove-from-library-btn', function (e) {
        e.preventDefault();

        let button = $(this);
        let gameId = button.data('game-id');

        if (!gameId) return;

        // AJAX POST request to remove the game
        $.post('/collection/remove/' + gameId, {}, function (response) {
            // Fade out and remove the card
            button.closest('.game').fadeOut(300, function () {
                $(this).remove();
            });
        }).fail(function (xhr, status, error) {
            console.error('Error removing game:', status, error);
            alert('Could not remove the game. Please try again.');
        });
    });
});