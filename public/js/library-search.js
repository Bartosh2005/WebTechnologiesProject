$(document).ready(function () {
    $('#search-bar-library').on('keyup', function () {
        let query = $(this).val();

        $.ajax({
            url: '/library',       
            type: 'GET',
            data: { q: query },
            success: function (res) {
                $('#girdlibrary').html(res);
                if (typeof fadeInLibraryCards === 'function') fadeInLibraryCards();
            },
            error: function () {
                console.error('Library search failed.');
            }
        });
    });
});