<?php
require("./login/login_status.php");
//session_start();
// $login_status = false;
$city_name = "Select";
if (isset($_SESSION["location"])) {
    $city_name = $_SESSION["location"];
}

include("./header.php");
$servername = "localhost";
$username = "id20121598_root";
$password = "Movietime@123";
$Database="id20121598_movietime";
$connect=mysqli_connect($servername,$username,$password,$Database);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/movietime.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
</head>

<body>

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
      <form method="post">
          <div class="container">
              <div class="part1">
                  <div class="filter">
                      <b>Filter</b>
                  </div>
                  <div class="box">
                      <div class="accordion-item">
                          <button class="btn" type="button" data-toggle="collapse" data-target="#fbox">Language</button>
                          <div id="fbox" class="collapse">
                              <button class="click-btn language" type='button' value='Hindi' id="btn-1">Hindi</button>
                              <button class="click-btn language" type='button' value='marathi' id="btn-2">Marathi</button>
                              <button class="click-btn language" type='button' value='English' id="btn-3">English</button>
                              <button class="click-btn language" type='button' value='Tamil' id="btn-4">Tamil</button>
                              <button class="click-btn language" type='button' value='Gujrati' id="btn-3">Gujrati</button>
                              <button class="click-btn language" type='button' value='Telugu' id="btn-5">Telugu</button>
                              <button class="click-btn language" type='button' value='Kannada' id="btn-6">Kannada</button>
                              <button class="click-btn language" type='button' value='Malyalam'
                                  id="btn-7">Malyalam</button>
                              <button class="click-btn language" type='button' value='Punjabi' id="btn-7">Punjabi</button>

                          </div>
                          <div class="accordion-item">
                              <button class="btn" type='button' data-toggle="collapse" data-target="#sbox">Genres</button>
                              <div id="sbox" class="collapse">
                                  <button class="click-btn genres" type='button' value='Drama' id="click-8">Drama</button>
                                  <button class="click-btn genres" type='button' value='Thriller'
                                      id="click-9">Thriller</button>
                                  <button class="click-btn genres" type='button' value='Action'
                                      id="click-10">Action</button>
                                  <button class="click-btn genres" type='button' value='Adventure'
                                      id="click-11">Adventure</button>
                                  <button class="click-btn genres" type='button' value='Comedy'
                                      id="click-12">Comedy</button>
                                  <button class="click-btn genres" type='button' value='Mystery'
                                      id="click-13">Mystery</button>
                                  <button class="click-btn genres" type='button' value='Horror'
                                      id="click-14">Horror</button>
                                  <button class="click-btn genres" type='button' value='Musical'
                                      id="click-15">Musical</button>
                                  <button class="click-btn genres" type='button' value='Rommantic'
                                      id="click-16">Romantic</button>
                                  <button class="click-btn genres" type='button' value='Animation'
                                      id="click-17">Animation</button>
                                  <button class="click-btn genres" type='button' value='Crime'
                                      id="click-18">Crime</button>
                                  <button class="click-btn genres" type='button' value='Family'
                                      id="click-19">Family</button>
                                  <button class="click-btn genres" type='button' value='Fantasy'
                                      id="click-29">Fantasy</button>
                                  <button class="click-btn genres" type='button' value='Sci-Fi'
                                      id="click-21">Sci-Fi</button>
                              </div>
                          </div>
                          <div class="accordion-item">
                              <button class="btn" type='button' data-toggle="collapse" data-target="#tbox">Format</button>
                              <div id="tbox" class="collapse">

                                  <button class="click-btn format" type='button' value='2D' id="click-22">2D</button>
                                  <button class="click-btn format" type='button' value='3D' id="click-23">3D</button>
                                  <button class="click-btn format" type='button' value='3D' id="click-23">3D</button>
                                  <button class="click-btn format" type='button' value='MX4D 3D' id="click-24">MX4D
                                      3D</button>
                                  <button class="click-btn format" type='button' value='4DX' id="click-25">4DX</button>
                                  <button class="click-btn format" type='button' value='IMAX 2D' id="click-26">IMAX
                                      2D</button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="part2">
                  <div class="commingsoon">
                      <h3>COMMING-SOON</h3>
                      <h3 class="up" style="margin-right:10px;"><a href="#">
                              Explore Upcoming Movies > </a>
                      </h3>
                  </div>
                  <div class="content" id="content">
                      <?php
      $query="Select * from movies ";
      $result=mysqli_query($connect,$query);
      if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
          echo '<a href="./moviedetails.php?movieid=' . $row['MovieId'] . '" class="book-ticket">';
          echo '<div class="card">';
          echo '<img src="data:image/jpg;base64,'.($row['MovieVerticalImage']).'" class="movieImage" alt="movieImage" >';
          echo'</div> ';
          echo '</a>';
        }
      }
      
      ?>


                  </div>
              </div>
          </div>
      </form>

      <?php
        include './footer.php';
      ?>
    </section>
    
</body>

</html>
<script>
    $(document).ready(function () {
        $('.language').click(function () {
            var lang = $(this).val()
            $.ajax({
                type: "POST",
                url: "AllMovies/getMoviesByLanguage.php",
                data: { language: lang },
                success: function (data) {
                    $('#content').html(data);
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    console.log(status);
                }
            });

        });



        $('.genres').click(function () {
            var genr = $(this).val()

            $.ajax({
                type: "POST",
                url: "AllMovies/getMoviesByLanguage.php",
                data: { Genre: genr },
                success: function (data) {
                    $('#content').html(data);
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    console.log(status);
                }
            });

        });
        $('.format').click(function () {
            var form = $(this).val()

            $.ajax({
                type: "POST",
                url: "AllMovies/getMoviesByLanguage.php",
                data: { format: form },
                success: function (data) {
                    $('#content').html(data);
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    console.log(status);
                }
            });

        });
    });
</script>