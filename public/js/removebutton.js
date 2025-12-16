$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // --- 1. Sync collection on load and back/forward navigation ---
    function syncCollection() {
        $.get('/collection/status', function(response) {
            $('.game-wrapper').each(function() {
                let gameId = $(this).find('[data-game-id]').data('game-id');
                if (gameId && !response.owned.includes(gameId)) {
                    $(this).fadeOut(300, function() { $(this).remove(); });
                }
            });
        });
    }

    // Initial sync
    syncCollection();

    // Handle back/forward navigation
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            syncCollection();
        }
    });

    // --- 2. Remove game when button clicked ---
    $(document).on('click', '.remove-from-library-btn', function (e) {
        e.preventDefault();
        let button = $(this);
        let gameId = button.data('game-id');
        if (!gameId) return;

        $.post('/collection/remove/' + gameId, {}, function (response) {
            button.closest('.game-wrapper').fadeOut(300, function () { $(this).remove(); });
        }).fail(function (xhr, status, error) {
            console.error('Error removing game:', status, error);
            alert('Could not remove the game. Please try again.');
        });
    });
});
