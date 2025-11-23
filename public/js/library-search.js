$(document).ready(function () {
    $('#search-bar-library').on('keyup', function () {
        let query = $(this).val();

        $.ajax({
            url: '/library',       
            type: 'GET',
            data: { q: query },
            success: function (res) {
                $('#girdlibrary').html(res);
            },
            error: function () {
                console.error('Library search failed.');
            }
        });
    });
});