$(document).ready(function () {
    $('#search-bar-library').on('keyup', function () {
        let query = $(this).val();

        $.ajax({
            url: '/library',       // route for the library page
            type: 'GET',
            data: { q: query },
            success: function (res) {
                // Replace the container with filtered games
                $('#girdlibrary').html(res);
            },
            error: function () {
                console.error('Library search failed.');
            }
        });
    });
});