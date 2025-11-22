$(document).ready(function() {
    $('#search-bar').on('keyup', function() {
        let query = $(this).val();

        $.ajax({
            url: '/collection',       
            type: 'GET',
            data: { q: query },
            success: function(res) {
                $('#gamesCollection').html(res);
            },
            error: function() {
                console.error('Search failed.');
            }
        });
    });
});