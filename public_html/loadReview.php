<?php
require("./login/login_status.php");
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

$conn = mysqli_connect("localhost","id20121598_root","Movietime@123","id20121598_movietime") or die("Connection failed");

if (isset($_REQUEST["login"])) {
    $movieID = $_POST["movieid"];
    // echo "<script> console.log(" . $_SESSION['location'] . ")</script>";
    $q = "SELECT UserId FROM uLogin where `Email`='" . $email . "' or `GoogleId`='" . $gid . "' or `FacebookId`='" . $fbid . "' and `OtpVerified`='verified'";
    $r = mysqli_query($conn, $q) or die("1st Query failed");;
    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_assoc($r)) {
            $user_id = $row["UserId"];
        }
    }

    $que = "select UserId from review where `movieid` = '" . $movieID . "' and `UserId`='" . $user_id . "' "; //`email`='" . $email . "' or `google_id`='" . $gid . "' or `facebook_id`='" . $fbid . "' and `otpverified`='verfied'
    $res = mysqli_query($conn, $que) or die("2nd Query failed");
    if (mysqli_num_rows($res) > 0) {
        echo "0";
    } else {
        echo "1";
    }
}


if (isset($_REQUEST["ratingdata"])) {

    $q = "SELECT UserId FROM uLogin where `Email`='" . $email . "' or `GoogleId`='" . $gid . "' or `FacebookId`='" . $fbid . "' and `OtpVerified`='verified'";
    $r = mysqli_query($conn, $q) or die("Query failed");;
    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_assoc($r)) {
            $userid = $row["UserId"];
        }
    }


    $movieID = $_POST["movieid"];
    // $moviename = $_POST["moviename"];
    $rating_data = $_POST["ratingdata"];
    // $user_name = $_POST["uname"];
    $user_review = $_POST["userreview"];
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d M Y H:i:s', time());
    $query1 = "insert into review (`movieid`, `rating`,  `review`, `date`,`userid`) values ('" . $movieID . "', '" . $rating_data . "', '" . $user_review . "', '" . $date . "','" . $userid . "') ;";
    if (mysqli_query($conn, $query1)) {
        echo "1";
    } else {
        echo "0";
    }
}


if (isset($_REQUEST["action"])) {

    $movieID = $_POST["movieid"];

    echo "<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lato'>";
    echo "<link rel='stylesheet' href='./css/review.css'/>";

    // $query2 = "select * from review where movieid='" . $movieID . "' ORDER BY review_id DESC;";
    $query2 = "select review.Rating, review.Review, review.Date, uLogin.Name from review INNER JOIN uLogin on review.UserId=uLogin.UserId where movieid='" . $movieID . "' ORDER BY review.ReviewId DESC;";
    $result2 = mysqli_query($conn, $query2) or die("sql query failed");
    $output = "";

    if (mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $uname = $row["Name"];
            $uimg = substr($uname, 0, 1);
            $colors = array("#F7C8E0", "#DFFFD8", "#B4E4FF", "#95BDFF", "#A7727D", "#EA8FEA", "#B5F1CC", "#C9F4AA", "#F6E6C2", "#6096B4");
            shuffle($colors);
            $output .= "<div class='reviewdata'>
                        <div class='upper-part'>
                        <div style=' background-color: $colors[0] ' id='reviewer-img'> $uimg </div>
                        <div class='middle-part'>
                        <p id='reviewer-name'>{$row["Name"]}</p>
                        <p id='submited-date'>{$row["Date"]}</p>
                        </div>
                        </div>
                        <div class='lower-part'>
                        <p id='submited-star'>{$row["Rating"]} &nbsp;<i class='goldstar fas fa-star'></i></p>
                        <p id='submited-review'>{$row["Review"]}</p>
                        </div>
                        </div>";
        }
        echo $output;
    } else {
        echo "<h4 style='position: relative; color:white;font-weight:500; text-align:center; font-size:2rem'><center>You are the first to review!</center></h4> ";
    }
}


if (isset($_REQUEST["alldata"])) {

    $movieID = $_POST["movieid"];

    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $data = array();

    $query3 = "select * from review where movieid='" . $movieID . "';";
    $result3 = mysqli_query($conn, $query3) or die("sql query failed");

    $data = [
        'average_rating'    =>    number_format($average_rating, 1),
        'total_review'        =>    $total_review,
        'five_star_review'    =>    $five_star_review,
        'four_star_review'    =>    $four_star_review,
        'three_star_review'    =>    $three_star_review,
        'two_star_review'    =>    $two_star_review,
        'one_star_review'    =>    $one_star_review
    ];


    if (mysqli_num_rows($result3) > 0) {
        foreach ($result3 as $row) {

            if ($row["Rating"] == '5') {
                $five_star_review++;
            }

            if ($row["Rating"] == '4') {
                $four_star_review++;
            }

            if ($row["Rating"] == '3') {
                $three_star_review++;
            }

            if ($row["Rating"] == '2') {
                $two_star_review++;
            }

            if ($row["Rating"] == '1') {
                $one_star_review++;
            }

            $total_review++;

            $total_user_rating = $total_user_rating + $row["Rating"];
        }
        if ($total_review != 0) {
            $average_rating = $total_user_rating / $total_review;
        }

        $ave_rating = number_format($average_rating, 0);

        $data = [
            'average_rating'    =>    number_format($average_rating, 1),
            'total_review'        =>    $total_review,
            'five_star_review'    =>    $five_star_review,
            'four_star_review'    =>    $four_star_review,
            'three_star_review'    =>    $three_star_review,
            'two_star_review'    =>    $two_star_review,
            'one_star_review'    =>    $one_star_review
            //  'review_data'        =>    $review_content
        ];

        // $data = array(number_format($average_rating, 1),  $total_review, $five_star_review, $four_star_review, $three_star_review, $two_star_review, $one_star_review);
    }
    echo json_encode($data);
}

mysqli_close($conn);
