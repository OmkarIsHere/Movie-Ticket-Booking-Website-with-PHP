<?php

require("./login/login_status.php");
require("./other/config_pdo.php");
setcookie("theme", "dark", time() + (86400 * 30), "/");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <script src="./js/jquery.js"></script>
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
</head>

<body>
<a id="topbtn"></a>
    <section id="pre-loader">
        <div class="dots">
          <span style="--i:1;"></span>
          <span style="--i:2;"></span>
          <span style="--i:3;"></span>
          <span style="--i:4;"></span>
          <span style="--i:5;"></span>
          <span style="--i:6;"></span>
          <span style="--i:7;"></span>
          <span style="--i:8;"></span>
          <span style="--i:9;"></span>
          <span style="--i:10;"></span>
          <span style="--i:11;"></span>
          <span style="--i:12;"></span>
          <span style="--i:13;"></span>
          <span style="--i:14;"></span>
          <span style="--i:15;"></span>
        </div>
        <div class="loader-text">
            <h4>Please Wait...</h4>
        </div>
    </section>

    <section id="load-html">
        <?php
            include("header.php");
        ?>

        <section id="carousel-slider">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./img/image-1.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./img/image-3.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./img/image-4.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <section id="movie-cards">

            <div class="movie-tabs">
                <ul class="movie-tabs-ul">
                    <li class="movie-tab-item"><a href="javascript:void(0)" onclick="showNowShowingMovies()"
                            class="movie-tab-a now-showing-active" id="now-showing-active">Now Showing</a></li>
                    <li class="movie-tab-item"><a href="javascript:void(0)" onclick="showUpComingMovies()"
                            class="movie-tab-a-two" id="coming-soon-active">Coming Soon</li></a>
                </ul>
            </div>

            <div class="slider-container" id="slider-now-showing">
                <div class="movie-content">
                    <div class="movie-card-heading">
                        <h3>NOW SHOWING</h3>
                    </div>
                    <div class="movie-card-view-all">
                        <a href="movietime.php">See All</a>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>
                <div class="movie-card-container">
                    <div class="movie-card-row">
                        <?php
                            // include "php/config_pdo.php";

                            $query = "SELECT * FROM `movies` where Status = 'NOW SHOWING MOVIE' ORDER BY MovieId DESC LIMIT 8";

                            foreach ($dbo->query($query) as $row) {
                                if($row['MovieId'] == 102) {
                                    echo '<div class="movie-card-col">';
                                    echo '<div class="movie-card-image">';
                                    echo '<img src="data:image/jpg;base64,' . base64_encode($row['MovieImage']) . '"/>';
                                    echo "</div>";
                                    echo '<div class="movie-content-desc adjust-top">';
                                    echo '<div class="movie-name">';
                                    echo "<span>" . $row['MovieName'] . "</span>";
                                    echo '</div>';
                                    echo '<div class="movie-genres">';
                                    echo "<span>" . $row['MovieGenre'] . "</span>";
                                    echo '</div>';
                                    echo '<div class="card-buttons">';
                                    echo '<a href="./moviedetails.php?movieid=' . $row['MovieId'] . '" class="book-ticket">BOOK TICKETS</a>';
                                    echo '<a href="' . $row['YoutubeLink'] . '" class="play-trailer">PLAY TRAILER</a>';
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                else {
                                    echo '<div class="movie-card-col">';
                                    echo '<div class="movie-card-image">';
                                    echo '<img src="data:image/jpg;base64,' . base64_encode($row['MovieImage']) . '"/>';
                                    echo "</div>";
                                    echo '<div class="movie-content-desc">';
                                    echo '<div class="movie-name">';
                                    echo "<span>" . $row['MovieName'] . "</span>";
                                    echo '</div>';
                                    echo '<div class="movie-genres">';
                                    echo "<span>" . $row['MovieGenre'] . "</span>";
                                    echo '</div>';
                                    echo '<div class="card-buttons">';
                                    echo '<a href="./moviedetails.php?movieid=' . $row['MovieId'] . '" class="book-ticket">BOOK TICKETS</a>';
                                    echo '<a href="' . $row['YoutubeLink'] . '" class="play-trailer">PLAY TRAILER</a>';
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            }
                            ?>
                    </div>
                </div>
            </div>

            <div class="slider-container" id="slider-coming-soon">
                <div class="movie-content">
                    <div class="movie-card-heading">
                        <h3>COMING SOON</h3>
                    </div>
                    <div class="movie-card-view-all">
                        <a href="movietime.php">See All</a>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>
                <div class="movie-card-container">
                    <div class="movie-card-row">
                        <?php
                            // include "php/config_pdo.php";

                            $query = "SELECT * FROM `movies` where Status = 'UP COMMING MOVIE' ORDER BY MovieId DESC LIMIT 8";

                            foreach ($dbo->query($query) as $row) {
                                if($row['MovieId'] == 113) {
                                    echo '<div class="movie-card-col">';
                                    echo '<div class="movie-card-image">';
                                    echo '<img src="data:image/jpg;base64,' . base64_encode($row['MovieImage']) . '"/>';
                                    echo "</div>";
                                    echo '<div class="movie-content-desc adjust-top">';
                                    echo '<div class="movie-name">';
                                    echo "<span>" . $row['MovieName'] . "</span>";
                                    echo '</div>';
                                    echo '<div class="movie-genres">';
                                    echo "<span>" . $row['MovieGenre'] . "</span>";
                                    echo '</div>';
                                    echo '<div class="card-buttons">';
                                    echo '<a href="./moviedetails.php?movieid=' . $row['MovieId'] . '" class="book-ticket">SHOW INFO</a>';
                                    echo '<a href="' . $row['YoutubeLink'] . '" class="play-trailer">PLAY TRAILER</a>';
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }

                                else {
                                    echo '<div class="movie-card-col">';
                                    echo '<div class="movie-card-image">';
                                    echo '<img src="data:image/jpg;base64,' . base64_encode($row['MovieImage']) . '"/>';
                                    echo "</div>";
                                    echo '<div class="movie-content-desc">';
                                    echo '<div class="movie-name">';
                                    echo "<span>" . $row['MovieName'] . "</span>";
                                    echo '</div>';
                                    echo '<div class="movie-genres">';
                                    echo "<span>" . $row['MovieGenre'] . "</span>";
                                    echo '</div>';
                                    echo '<div class="card-buttons">';
                                    echo '<a href="./Moviedetails.php?movieid=' . $row['MovieId'] . '" class="book-ticket">SHOW INFO</a>';
                                    echo '<a href="' . $row['YoutubeLink'] . '" class="play-trailer">PLAY TRAILER</a>';
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            }
                            ?>
                    </div>
                </div>
            </div>
        </section>

        <?php
            include './footer.php';
        ?>
    </section>
    
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
    <script src="./js/navbar.js"></script>
    <script src="./js/home.js"></script>
    <?php mysqli_close($conn); ?>
</body>

</html>