<?php
require './login/login_status.php';
include('./header.php');
// include('conn.php');
// session_start();
// $city_name = $_SESSION["location"];
$movieId = $_GET["movieid"];
$conn = mysqli_connect("localhost","id20121598_root","Movietime@123","id20121598_movietime") or die("Connection failed");

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
$url .= $_SERVER['HTTP_HOST'];
$url .= $_SERVER['REQUEST_URI'];
?>


<!DOCTYPE html>
<html lang="en">

<?php
$query1 = "select  * from movies where `MovieId`= '" . $movieId . "'";
$res = mysqli_query($conn, $query1) or die("sql query failed");

if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {

?>

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $row["MovieName"]; ?></title>
            <link rel="stylesheet" href="./css/moviedetails.css" />
            <script src="./js/jquery.js"></script>
            <script src="./js/moviedetails.js"></script>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

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

                <div class="main">
                    <div class="background">
                        <?php echo  '<img src="data:image/jpeg;base64,' . base64_encode($row['MoviePoster']) . '" alt="image"/>'; ?>
                    </div>
                    <div class="container">
                        <div class="poster">
                            <div class="share-btn" id="share-btn">
                                <div class="share-btn-logo">
                                    <i class="fa fa-share-alt"></i>
                                </div>
                                <div class="share-btn-components" id="social-media-icon">
                                    <a href="https://facebook.com/share.php?text=Heyy, This movie <?php echo $row["MovieName"]; ?> is showing in the theatre.&u=<?php echo "<br/>" . $url; ?>" style="margin: 0;" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                                    <a href="https://twitter.com/share?text=Heyy, This movie <?php echo $row["MovieName"]; ?> is showing in the theatre.&url=<?php echo "<br/>" . $url; ?>" style="margin: 0;" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                                    <a href="https://api.whatsapp.com/send?text=Heyy, This *<?php echo $row["MovieName"]; ?>* movie is showing in the theatre. <?php echo  $url; ?>" style="margin: 0;" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                                </div>
                            </div>
                            <div class="m-poster">
                                <?php echo ' <img src="data:image;base64,' . $row['MovieVerticalImage'] . '" />'; ?>
                                <a target="_blank" href="<?php echo $row["YoutubeLink"]; ?>" class="trailerbtn">Watch Trailer
                                    <span><i style="font-size: 14px;" class="fa fa-play"></i></span></a>
                            </div>
                        </div>
                        <div class="banner-details">
                            <h1 class="movie-title"><?php echo $row["MovieName"]; ?></h1>
                            <p class="quality"><?php echo $row["Quality"]; ?></p>
                            <p class="languages"><?php echo $row["MovieLanguages"]; ?></p>
                            <p class="category"><?php echo $row["MovieGenre"]; ?></p>
                            <p class="released">Released:&nbsp;<span id="released-date"><?php echo $row["ReleaseDate"]; ?></span></p>
                            <p class="duration">Duration:&nbsp;<span id="durationmin"><?php echo $row["MovieLength"]; ?></span></p>
                            <a href="#showtimes-session" id="book-btn" class="book-btn">Book Ticket</a>
                        </div>
                    </div>
                </div>
        <?php
        }
    } else {
        // echo "<div class='no-record'><p>Movie details is not available</p></div>";
        echo "<script> location.href='https://inundated-lenders.000webhostapp.com/other/404page.php'; </script>";
        exit;
    }
        ?>
        <!-- <hr unshade class="mainHr lightHr" /> -->
        <!-- =============================================== -->

        <div class="separator" id="separator">
            <p class="showtimes-session" id="showtimes-session">Show Times</p>
            <p class="synopsis-session" id="synopsis-session"> Synopsis</p>
        </div>

        <!-- ===================================================== -->
        <div class="showtimes-section">
            <div id="alldates">
                <div class="days active">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
                <div class="days">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
                <div class="days">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
                <div class="days">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
                <div class="days">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
                <div class="days">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
                <div class="days">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
                <div class="days">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
                <div class="days">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
                <div class="days">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
                <div class="days">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
                <div class="days">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
                <div class="days">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
                <div class="days">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
                <div class="days">
                    <h2 class="vaar"></h2>
                    <p class="date"></p>
                </div>
            </div>

            <div id="available-theatres">

            </div>
        </div>

        <!-- ======================================================-->
        <div class="synopsis-section">
            <?php
            $q = "select About from movies where `movieid`= '" . $movieId . "'";
            $r = mysqli_query($conn, $q) or die("sql query failed");

            if (mysqli_num_rows($r) > 0) {
                while ($row = mysqli_fetch_assoc($r)) {

            ?>
                    <div class="movie-about">
                        <div class="movie-info">
                            <div class="about-title">
                                <h2>About</h2>
                            </div>
                            <div class="about">
                                <p><?php echo $row["About"]; ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<div class='no-record'><p>Movie details not available</p></div>";
            }
            ?>
            <hr unshade />
            <!-- ======================================================== -->

            <div class="offer">
                <div class="offer-title">
                    <h2>Applicable Offers</h2>
                </div>
                <div class="offer-slider">
                    <img class="coupon coupon1" src="./img/offer1.png" alt="coupon">
                    <img class="coupon coupon2" src="./img/offer2.png" alt="coupon">
                    <img class="coupon coupon3" src="./img/offer3.png" alt="coupon">
                    <img class="coupon coupon4" src="./img/offer4.png" alt="coupon">
                    <img class="coupon coupon5" src="./img/offer5.png" alt="coupon">
                </div>
            </div>
            <hr unshade />

            <!-- ================================================================ -->

            <div class="cast">
                <div class="cast-heading">
                    <h2>Cast</h2>
                </div>
                <div class="cast-slider">

                    <?php
                    $query2 = "select  * from cast_details where `movieid`= '" . $movieId . "' ";
                    $result2 = mysqli_query($conn, $query2) or die("sql query failed");
                    $cast = '';   //'<img src="data:image/jpeg;base64,' . base64_encode($row['MovieVerticalImage']) . '" alt="image"/>';
                    if (mysqli_num_rows($result2) > 0) {
                        while ($castrow = mysqli_fetch_assoc($result2)) {
                            $temp1 = 'data:image/jpeg;base64,' . base64_encode($castrow['cast_img']) . '';
                            $cast .= "<div class='cast-slide'>
                                    <div class='cast-img'>
                                    <img src='$temp1' alt='image'/>  
                                    </div>
                                    <div class='cast-details'>
                                    <div class='cast-name'>
                                    <p>{$castrow["cast_name"]}</p>
                                    </div>
                                    <div class='role-name'>
                                    <p>{$castrow["cast_role"]}</p>
                                    </div>
                                    </div>
                                    </div>";
                        }
                        echo $cast;
                    } else {
                        echo "<div class='no-record'><p>Cast details not available</p></div> ";
                    }
                    ?>
                </div>
            </div>
            <hr unshade>

            <!-- =========================================== -->

            <div class="crew">
                <div class="crew-heading">
                    <h2>Crew</h2>
                </div>
                <div class="crew-slider">

                    <?php
                    $query3 = "select  * from crew_details where `movieid`= '" . $movieId . "' ";
                    $result3 = mysqli_query($conn, $query3) or die("sql query failed");
                    $crew = "";  //
                    if (mysqli_num_rows($result3) > 0) {
                        while ($crewrow = mysqli_fetch_assoc($result3)) {
                            $temp2 = 'data:image/jpeg;base64,' . base64_encode($crewrow['crew_img']) . '';
                            $crew .= "<div class='crew-slide'>
                                    <div class='crew-img'>
                                    <img src='$temp2' alt='image'/> 
                                    </div>
                                    <div class='crew-details'>
                                    <div class='crew-name'>
                                    <p>{$crewrow["crew_name"]}</p>
                                    </div>
                                    <div class='crew-role'>
                                    <p>{$crewrow["crew_role"]}</p>
                                    </div>
                                    </div>
                                    </div>";
                        }
                        echo $crew;
                    } else {
                        echo "<div class='no-record'><p>Crew details not available </p></div>";
                    }
                    ?>
                </div>

            </div>
            <hr unshade>
            <!-- ===================================== -->
            <div class="review-section">
                <div class="review-heading">
                    <h2>Recent Reviews</h2>
                    <a target="blank" href="./review.php?movieid=<?php echo $movieId ?>">view all</a>
                </div>
                <div class="review-slider">
                    <?php
                    // $query4 = "select  * from review where `movieid`='" . $movieId . "'   order by review_id DESC LIMIT 10";
                    $query4 = "select review.Rating, review.Review, uLogin.Name from review INNER JOIN uLogin on review.UserId=uLogin.UserId where movieid='" . $movieId . "' ORDER BY review.ReviewId DESC LIMIT 10;";
                    $result4 = mysqli_query($conn, $query4) or die("sql query failed");
                    $review = "";
                    if (mysqli_num_rows($result4) > 0) {
                        while ($rrow = mysqli_fetch_assoc($result4)) {
                            $uname = $rrow["Name"];
                            $uimg = substr($uname, 0, 1);
                            $colors = array("#F7C8E0", "#DFFFD8", "#B4E4FF", "#95BDFF", "#A7727D", "#EA8FEA", "#B5F1CC", "#C9F4AA", "#F6E6C2", "#6096B4");
                            shuffle($colors);


                            $review .= "<div class='review-slide'>
                                        <div class='user-part'>
                                        <div class='part1'>
                                        <div style=' background-color: $colors[0] ' class='userimg'> $uimg </div>
                                        <p class='userinfo'>{$rrow["Name"]}</p>
                                        </div>
                                        <div class='part2'>
                                        <i class='fas fa-quote-right'></i>
                                        </div>
                                        </div>
                                        <div class='review-part'>
                                        <p class='rating'>{$rrow["Rating"]}&nbsp;<i class='fas fa-star'></i></p>
                                        <p class='review'>{$rrow["Review"]}</p>
                                        </div>
                                        </div>";
                        }
                        echo $review;
                    } else {
                        echo "<div class='no-record'><p >You're the first to write review</p><a target='blank' href='./review.php?movieid=$movieId' class='redirect-review'>ADD REVIEW</a></div> ";
                    }

                    //<img class='userimg' src='./img/user-icon-50x50.ico' alt='userimg'>
                    ?>
                </div>
            </div>

            <hr unshade>

            <!-- ==================================================================================== -->

            <div class="recommendation-section">
                <div class="recommendation-heading">
                    <h2>You might like</h2>
                </div>
                <div class="recommend-slider">

                    <?php
                    $query5 = "select * from movies where not `movieid`='" . $movieId . "' and status='NOW SHOWING MOVIE'  order by rand() LIMIT 10";
                    $result5 = mysqli_query($conn, $query5) or die("sql query failed");
                    $recommend = "";
                    if (mysqli_num_rows($result5) > 0) {
                        while ($rrow = mysqli_fetch_assoc($result5)) {
                            $temp3 = 'data:image;base64,' . $rrow['MovieVerticalImage'] . '';
                            $recommend .= "<div class='recommend-poster'>
                                        <div class='movie-img'>
                                        <img src='$temp3' alt='image'>
                                        <div class='overlay'>
                                        <a target='blank' class='recommend-book' href='./moviedetails.php?movieid={$rrow['MovieId']}'>Book Now</a>
                                        </div>
                                        </div>
                                        <div class='movie-information'>
                                        <a target='_blank' href='./moviedetails.php?movieid={$rrow['MovieId']}' class='movie-name'>{$rrow['MovieName']}</a>
                                        <p class='movie-genre'>{$rrow['MovieGenre']}</p>
                                        </div>
                                        </div>";
                        }
                        echo $recommend;
                    } else {
                        echo "<div class='no-record'><p>No movies available according to your choice preference</p></div> ";
                    }
                    ?>
                </div>

            </div>


        </div> <!-- synopsis section end tag -->
        <?php mysqli_close($conn); ?>
        <script src="./js/moviedetails.js"></script>

    </section>
    </body>

</html>
<?php include('./footer.php'); ?>