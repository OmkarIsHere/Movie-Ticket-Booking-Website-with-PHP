<?php
require("./login/login_status.php");
include('./header.php');
// $login = true;
$email = "abc";
$gid = "abc";
$fbid = "abc";
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}
if (isset($_SESSION["GOOGLE_ID"])) {
    $gid = $_SESSION["GOOGLE_ID"];
}
if (isset($_SESSION["FB_ID"])) {
    $fbid = $_SESSION["FB_ID"];
}
$movieid = $_GET["movieid"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="stylesheet" href="./css/review.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="./js/review.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

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
        <div id="success-message"></div>
        <div id="error-message"></div>
        <div class="movietitle">
            <?php
            $conn = mysqli_connect("localhost","id20121598_root","Movietime@123","id20121598_movietime") or die("Connection failed");
            $query = "select MovieName from movies where `movieid`='" . $movieid . "'";
            $result = mysqli_query($conn, $query) or die("sql query failed");
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<h1 id='moviename' class='moviename'>{$row["MovieName"]}</h1>";
                }
            } else {
                // echo "<div class='no-record'><p>Movie Name not found in our database</p></div> ";
                echo "<script> location.href=' https://inundated-lenders.000webhostapp.com/other/404page.php'; </script>";
                exit;
            }
            mysqli_close($conn);
            ?>

        </div>
        <div class="all-data">
            <div class="section1">
                <div class="upper">
                    <p class="avarage-ratings" id="average-stars-num">0</p>
                    <p class="avarage-ratings">/5</p>
                </div>
                <div class="middle">
                    <i class='fas fa-star mainstar greystar'></i>
                    <i class='fas fa-star mainstar greystar'></i>
                    <i class='fas fa-star mainstar greystar'></i>
                    <i class='fas fa-star mainstar greystar'></i>
                    <i class='fas fa-star mainstar greystar'></i>
                </div>
                <div class="lower">
                    <p class="total-reviews" id="totalreviews">0</p>
                    <p class="total-reviews">&nbsp;Reviews</p>
                </div>
            </div>
            <div class="section2">

                <div class="progressbar-data">
                    <div class="progress-label-left">
                        <p>5</p> <i class="fas fa-star goldstar"></i>
                    </div>
                    <div class="progress">
                        <div class="progress-bar goldstar" id="five_star_progress"></div>
                    </div>
                    <div class="progress-label-right">(<span class="total-review-num" id="total_five_star_review"></span>)
                    </div>
                </div>

                <div class="progressbar-data">
                    <div class="progress-label-left">
                        <p>4</p> <i class="fas fa-star goldstar"></i>
                    </div>
                    <div class="progress">
                        <div class="progress-bar goldstar" id="four_star_progress"></div>
                    </div>
                    <div class="progress-label-right">(<span class="total-review-num" id="total_four_star_review"></span>)
                    </div>
                </div>

                <div class="progressbar-data">
                    <div class="progress-label-left">
                        <p>3</p> <i class="fas fa-star goldstar"></i>
                    </div>
                    <div class="progress">
                        <div class="progress-bar goldstar" id="three_star_progress"></div>
                    </div>
                    <div class="progress-label-right">(<span class="total-review-num" id="total_three_star_review"></span>)
                    </div>
                </div>

                <div class="progressbar-data">
                    <div class="progress-label-left">
                        <p>2</p> <i class="fas fa-star goldstar"></i>
                    </div>
                    <div class="progress">
                        <div class="progress-bar goldstar" id="two_star_progress"></div>
                    </div>
                    <div class="progress-label-right">(<span class="total-review-num" id="total_two_star_review"></span>)
                    </div>
                </div>

                <div class="progressbar-data">
                    <div class="progress-label-left">
                        <p>1</p> <i class="fas fa-star goldstar"></i>
                    </div>
                    <div class="progress">
                        <div class="progress-bar goldstar" id="one_star_progress"></div>
                    </div>
                    <div class="progress-label-right">(<span class="total-review-num" id="total_one_star_review"></span>)
                    </div>
                </div>

            </div>
            <div class="section3">
                <p class="writereview">Write your review here</p>
                <?php if (isset($_SESSION["logged_in"])) { //isset($_SESSION["logged_in"])
                    echo '<button class="review-add-btn" id="add_review">Add Review</button>';
                } else {
                    echo '<a class="review-login-btn" href="./login/login.php">Login First</a>';
                }
                ?>
            </div>
        </div>

        <!-- =========================== -->

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="reviewform">
                    <div class="write-review-user-info">
                        <?php
                        $conn = mysqli_connect("localhost","id20121598_root","Movietime@123","id20121598_movietime") or die("Connection failed");
                        $q = "select Name from uLogin where `Email`='" . $email . "' or `GoogleId`='" . $gid . "' or `FacebookId`='" . $fbid . "' and `OtpVerified`='verified'"; //<---also add googleid and facebookid and verifiedcode
                        $r = mysqli_query($conn, $q) or die("sql query failed");
                        if (mysqli_num_rows($r) > 0) {
                            while ($row = mysqli_fetch_assoc($r)) {
                                $uname = $row["Name"];
                                $uimg = substr($uname, 0, 1);
                                $colors = array("#F7C8E0", "#DFFFD8", "#B4E4FF", "#95BDFF", "#A7727D", "#EA8FEA", "#B5F1CC", "#C9F4AA", "#F6E6C2", "#6096B4");
                                shuffle($colors);
                                echo "<div style=' background-color: $colors[0] ' id='reviewer-img'> $uimg </div>";
                                echo "<p id='username'>{$row["Name"]}</p>";
                                echo "<script> console.log(" .  $row["Name"] . ")</script>";
                            }
                        } else {
                            echo "<script> console.log('query not run or failed')</script>";
                        }
                        ?>
                        <!-- <img src="img/user-icon-50x50.ico" id="userimg" alt="userimage"> -->
                        <!-- <p id="username">John Walker</p> -->
                    </div>

                    <div class="user-stars-submit">
                        <i class="submitstar fas fa-star greystar" id="submitstar_1" data-rating="1"></i>
                        <i class="submitstar fas fa-star greystar" id="submitstar_2" data-rating="2"></i>
                        <i class="submitstar fas fa-star greystar" id="submitstar_3" data-rating="3"></i>
                        <i class="submitstar fas fa-star greystar" id="submitstar_4" data-rating="4"></i>
                        <i class="submitstar fas fa-star greystar" id="submitstar_5" data-rating="5"></i>
                    </div>
                    <div class="input-review-info">
                        <textarea id="review-input" required placeholder="How was your movie experience?" wrap="hard" cols="25" size="1000" rows="100"></textarea>
                        <button class="review-submit-btn" id="save_review">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- =============================== -->

        <div class="all-reviewdata">

        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="./js/review.js"></script>
        <?php mysqli_close($conn); ?>
    </section>
</body>

</html>


<?php include('./footer.php') ?>