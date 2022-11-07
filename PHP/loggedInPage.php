<?php include("./server.php");
if (!isset($_SESSION['id'])) {
    die("Please login");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../bootstrap-5.2.2/scss/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
    "></script>
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Movies App</title>
</head>

<body>

    <nav class="navbar bg-dark mb-5">
        <div class="container-fluid ">
            <a class="navbar-brand text-light" href="#">Movies app</a>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add movie</button>
        </div>
    </nav>


    <!-- If user logged in -->
    <section class="ifLoggedIn">
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add movie</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="search" id="movieSearch" class="form-control" placeholder="Search" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="addBtn" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="card">
        
    </section>
        <ul id="movie-list"></ul>

    <script>

        const movies = [];  

        $("#addBtn").click(() => {

            $movieName = $("#movieSearch").val();

            const settings = {
                "async": true,
                "crossDomain": true,
                "url": `https://imdb8.p.rapidapi.com/auto-complete?q=${$movieName}`,
                "method": "GET",
                "headers": {
                    "X-RapidAPI-Key": "2475796bfcmsh7df08af62f0b49bp1a8ebajsn1a9509f886ef",
                    "X-RapidAPI-Host": "imdb8.p.rapidapi.com"
                }
            };
            $.ajax(settings).done(function(response) {
                movies.push(response);
                addMovieHandler();

            });

        })
        const addMovieHandler = () => {
                const titleValue = movies[0].d[0].l;
                const imageUrlValue = movies[0].d[0].i.imageUrl;
                const ratingValue = movies[0].d[0].rank;

                const newMovie = {
                    title: titleValue,
                    image: imageUrlValue,
                    rating: ratingValue
                };

                renderNewMovieElement(
                    newMovie.title,
                    newMovie.image,
                    newMovie.rating
                );
            };

            const renderNewMovieElement = (title, imageUrl, rating) => {
                const newMovieElement = document.createElement("li");
                newMovieElement.className = "movie-element";
                newMovieElement.innerHTML = `
      <div class="movie-element__image">
        <img src="${imageUrl}" alt="${title}">
      </div>
      <div class="movie-element__info">
        <h2>${title}</h2>
        <p>${rating}/5 stars</p>
      </div>
    `;
                const listRoot = document.getElementById("movie-list");
                listRoot.append(newMovieElement);
            };

    </script>

</body>

</html>