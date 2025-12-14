$(document).ready(function() {
    // Set CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Handle both add and remove
    $(document).on('click', '.add-to-library-btn, .remove-from-library-btn', function() {
        let button = $(this);
        let gameId = button.data('game-id');
        let isOwned = button.hasClass('remove-from-library-btn'); // true if owned
        let url = isOwned ? '/collection/remove/' + gameId : '/collection/add/' + gameId;

        $.post(url, {}, function(response) {
            if(isOwned){
                // Game removed
                button.removeClass('remove-from-library-btn').addClass('add-to-library-btn');
                button.text('Add to MyCollection');
                button.css({'background-color':'','color':''}); 
            } else {
                // Game added
                button.removeClass('add-to-library-btn').addClass('remove-from-library-btn');
                button.text('Remove from MyCollection');
                button.css({'background-color':'#515151','color':'#fff'}); 
            }
        });
    });

    $(document).on('click', '.add-to-library-btn, .remove-from-library-btn', function() {
        let button = $(this);
        let gameId = button.data('game-id');
        let isOwned = button.hasClass('remove-from-library-btn'); // true if owned
        let url = isOwned ? '/collection/removeEx/' + gameId : '/collection/addEx/' + gameId;

        $.post(url, {}, function(response) {
            if(isOwned){
                // Game removed
                button.removeClass('remove-from-library-btn ex').addClass('add-to-library-btn ex');
                button.text('Add to MyCollection');
                button.css({'background-color':'','color':''}); 
            } else {
                // Game added
                button.removeClass('add-to-library-btn ex').addClass('remove-from-library-btn ex');
                button.text('Remove from MyCollection');
                button.css({'background-color':'#515151','color':'#fff'}); 
            }
        });
    });
});