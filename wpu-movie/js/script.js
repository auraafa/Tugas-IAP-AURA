function searchMovie() {
    $('#movie-list').html('');
    

    $.ajax({
        url: 'http://omdbapi.com',
        type: 'GET',
        dataType: 'json',
        data: {
            'apikey' : '96478c19',
            's': $('#search-input').val()
        },
        success: function (result) {
            if ( result.Response == "True" ) {
                let movies =result.Search;
                
                $.each(movies, function (i, data) {
                $('#movie-list').append(`
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img src="`+ data.Poster +`" class="card-img-top" alt="`+ data.Title +`">
                            <div class="card-body">
                                <h5 class="card-title">`+ data.Title +`</h5>
                                <h6 class="card-subtitle mb-2 text-muted">`+ data.Year +`</h6>
                                <a href="#" class="card-link see-detail" data-toggle="modal" data-target="#exampleModal" data-id="`+ data.imdbID +`">See Detail</a>
                            </div>
                        </div>
                    </div>
                `);
            });


                $('#search-input').val('');

            }else {
                $('#movie-list').html(`
                    <div class="col">
                        <h1 class="text-center">`+ result.Error +`</h1>
                    </div>
                `)
            }
        }
    });
}

$('#search-button').on('click', function () {
    searchMovie();
});


$('#search-input').on('keyup', function (e) {
    if (e.keyCode === 13) {
        searchMovie();
    }
});

$('#movie-list').on('click', '.see-detail', function () {
    
    $.ajax({
        url: 'http://omdbapi.com',
        dataType: 'json',
        type: 'GET',
        data: {
            'apikey' : '96478c19',
            'i': $(this).data('id')
        },
        success: function (movie) {
            if( movie.Response === "True" ) {

                $('.modal-body').html(`
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="`+movie.Poster+`" class="img-fluid rounded shadow" alt="`+movie.Title+`">
                            </div>

                            <div class="col-md-8">
                                <h3 class="mb-3">`+movie.Title+`</h3>
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Released:</strong> `+movie.Released+`</li>
                                    <li class="list-group-item"><strong>Genre:</strong> `+movie.Genre+`</li>
                                    <li class="list-group-item"><strong>Director:</strong> `+movie.Director+`</li>
                                    <li class="list-group-item"><strong>Actors:</strong> `+movie.Actors+`</li>
                                    <li class="list-group-item"><strong>Plot:</strong> `+movie.Plot+`</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                `);

            }
        }
    });
});