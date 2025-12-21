function externalSearch(query){
    console.log("extewrnal search started!");

    var spinner = `
        <div id="grid-spinner" class="loader"></div>
        <h2>Loading data from external libraries...</h2>
        <style>
            .loader {
                border: 16px solid #f3f3f3; /* Light grey */
                border-top: 16px solid #3498db; /* Blue */
                border-radius: 50%;
                width: 120px;
                height: 120px;
                animation: spin 2s linear infinite;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
        `;

    if($('#loaderhere').is(':empty')){
        $('#loaderhere').append(spinner);
    }
    $.ajax({
        url: `/getDataFromIGDB/${query}`,
        type: 'GET',
        //data: { q: query },
        success: function (res) {
            //$('#girdlibrary').html(/*$('#girdlibrary').html()+*/res);
            var games = $('#girdlibrary').html();

            var external = '';

            $.each(res, function(index, ele){
                external+=`
                <div class="sub-article" style="background-image: url('${ele.coverurl}')">
                    <div class="overlay">
                        <p class="game">${ele.name}</p>
                        <p>${ele.summary}</p>
                        <svg class="pull-left mar-sm-right" height="35px" space="preserve" style="" version="1.1" viewBox="0 0 419.3 482.7" width="40px" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                            <g>
                            <path class="cls-1" d="M86.85,200.25H107v91.49H86.85Z"></path>
                            <path class="cls-1" d="M131,246.26V246c0-26,20.25-47.31,48-47.31,16.47,0,26.4,4.44,35.94,12.54l-12.67,15.3c-7.06-5.89-13.33-9.28-23.92-9.28-14.64,0-26.27,12.93-26.27,28.49V246c0,16.73,11.5,29,27.71,29,7.32,0,13.85-1.83,18.95-5.48V256.46H178.47V239.07H218.2V278.8a59.35,59.35,0,0,1-39.08,14.51C150.63,293.31,131,273.32,131,246.26Z"></path>
                            <path class="cls-1" d="M242.78,200.25h35.68c28.75,0,48.62,19.74,48.62,45.49V246c0,25.75-19.87,45.74-48.62,45.74H242.78Zm20.12,18.17v55.16h15.56c16.46,0,27.57-11.11,27.57-27.32V246c0-16.21-11.11-27.58-27.57-27.58Z"></path>
                            <path class="cls-1" d="M350.21,200.25h42.48c10.46,0,18.69,2.88,23.92,8.11a21,21,0,0,1,6.27,15.55v.26c0,10.33-5.49,16.08-12,19.74C421.44,248,428,254.1,428,266.39v.26c0,16.73-13.59,25.09-34.24,25.09H350.21Zm52.67,27.06c0-6-4.7-9.41-13.2-9.41H369.82v19.34h18.56c8.88,0,14.5-2.87,14.5-9.67ZM393.08,254H369.82V274.1h23.92c8.88,0,14.24-3.14,14.24-9.93v-.26C408,257.76,403.41,254,393.08,254Z"></path>
                            <path class="cls-1" d="M476.9,364.09l-7.48-1.19a1353.31,1353.31,0,0,0-424,0l-7.47,1.19V152.93h439ZM257.41,333.26A1366.39,1366.39,0,0,1,464,349V165.86H50.86V349A1366.26,1366.26,0,0,1,257.41,333.26Z"></path>
                            </g>
                        </svg>
                        <button 
                            class="add-button ${ ele.owned ? 'remove-from-library-btn' : 'add-to-library-btn' }" 
                            data-game-id="${ele.id}" 
                            style="${ ele.owned ? 'background-color: #515151; color: #fff;' : '' }">
                            ${ ele.owned ? 'Remove from MyCollection' : 'Add to MyCollection' }
                        </button>
                    </div>
                </div>`;
            });

            $('#girdlibrary').append(external);
            $('#girdlibrary').parent().append("<center><h3 style='color:white;'>Some of the games are provided via <a href='https://www.igdb.com/'>IGDB</a>, a public game info library</h3></center>");
            console.log(res);
            $('#loaderhere').empty();

        },
        error: function () {
            console.error('External library search failed.');
        }
    });
    
}


// Debounce function
function debounce(func, delay) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            func.apply(this, args);
        }, delay);
    };
}

const debauncedExternalSearch = debounce(externalSearch, 500);


$(document).ready(function () {
    $('#search-bar-library').on('keyup', function () {
        let query = $(this).val();
        let searchExternalLibrariesBool = document.getElementById("search_external_libraries").checked;
        console.log("search external:"+searchExternalLibrariesBool);
        if(searchExternalLibrariesBool){
            debauncedExternalSearch(query);
        }
        

        $.ajax({
            url: '/library',       
            type: 'GET',
            data: { q: query },
            success: function (res) {
                $('#girdlibrary').html(res);
                // console.log(res);
            },
            error: function () {
                console.error('Library search failed.');
            }
        });
        
        
    });
    $('#search_external_libraries').click(function(){
        let searchExternalLibrariesBool = document.getElementById("search_external_libraries").checked;
        console.log("search external:"+searchExternalLibrariesBool);
        if(searchExternalLibrariesBool){
            debauncedExternalSearch($('#search-bar-library').val());
        }
    });
});