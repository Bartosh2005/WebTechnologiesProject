$(document).ready(function() {
    $('#search-bar').on('keyup', function() {
        let query = $(this).val();

        $.ajax({
            url: '/collection',       // your route
            type: 'GET',
            data: { q: query },
            success: function(res) {
                // Replace the game container with filtered games
                $('#gamesCollection').html(res);
            },
            error: function() {
                console.error('Search failed.');
            }
        });
    });
});