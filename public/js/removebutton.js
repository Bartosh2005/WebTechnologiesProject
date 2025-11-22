$(document).ready(function () {
    // Include the CSRF token with every AJAX request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.remove-from-library-btn', function (e) {
        e.preventDefault();

        let button = $(this);
        let gameId = button.data('game-id');

        if (!gameId) return;

        // POST request to remove the selected game from the collection
        $.post('/collection/remove/' + gameId, {}, function (response) {
            // Smooth fade out and remove the game card from the page
            button.closest('.game').fadeOut(300, function () {
                $(this).remove();
            });
        }).fail(function (xhr, status, error) {
            console.error('Error removing game:', status, error);
            alert('Could not remove the game. Please try again.');
        });
    });
});