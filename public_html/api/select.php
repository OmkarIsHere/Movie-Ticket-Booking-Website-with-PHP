<?php

include('db.php');
header('Content-Type:application/json');

// ======================= HOMEPAGE ======================

if (isset($_POST['homepage_now_showing'])) {
    $q1 = "select * from movies where status ='NOW SHOWING MOVIE'";
    $r1 =  mysqli_query($conn, $q1) or die("sql query failed");

    if (mysqli_num_rows($r1) > 0) {
        while ($row = mysqli_fetch_assoc($r1)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
        // echo json_encode($arr);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['homepage_upcoming'])) {
    $q2 = "select * from movies where status='UP COMMING MOVIE'";
    $r2 = mysqli_query($conn, $q2) or die("sql query failed");

    if (mysqli_num_rows($r2) > 0) {
        while ($row = mysqli_fetch_assoc($r2)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

// =========================== MOVIEDETAILS ===================


if (isset($_POST['moviedetail'])) {
    $t3 = $_POST['moviedetail'];
    $q3 = "select * from movies where movieid='" . $t3 . "'";
    $r3 = mysqli_query($conn, $q3) or die("sql query failed");

    if (mysqli_num_rows($r3) > 0) {
        while ($row = mysqli_fetch_assoc($r3)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['cast_details'])) {
    $t4 = $_POST['cast_details'];
    $q4 = "select * from cast_details where movieid='" . $t4 . "'";
    $r4 = mysqli_query($conn, $q4) or die("sql query failed");

    if (mysqli_num_rows($r4) > 0) {
        while ($row = mysqli_fetch_assoc($r4)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['crew_details'])) {
    $t5 = $_POST['crew_details'];
    $q5 = "select * from crew_details where movieid='" . $t5 . "'";
    $r5 = mysqli_query($conn, $q5) or die("sql query failed");

    if (mysqli_num_rows($r5) > 0) {
        while ($row = mysqli_fetch_assoc($r5)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['review'])) {
    $t6 = $_POST['review'];
    $q6 = "select * from review where movieid='" . $t6 . "'";
    $r6 = mysqli_query($conn, $q6) or die("sql query failed");

    if (mysqli_num_rows($r6) > 0) {
        while ($row = mysqli_fetch_assoc($r6)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['shows'])) {
    $t7 = $_POST['shows'];
    $t7movie_id = $_POST["movieid"];
    $t7date = $_POST["date"];
    $q7 = "SELECT  theaters.TheaterName,  shows.TheaterId, shows.showid, shows.Time, shows.Date from shows
    INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
    where shows.MovieId='" . $t7movie_id . "' and theaters.City='" . $t7 . "' and shows.Date='" . $t7date . "'";
    $r7 = mysqli_query($conn, $q7) or die("sql query failed");

    if (mysqli_num_rows($r7) > 0) {
        while ($row = mysqli_fetch_assoc($r7)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

// =============== DASHBOARD ============================

if (isset($_POST['dashboard_uniqueid'])) {
    $t8user_id = $_POST["dashboard_uniqueid"];
    $q8 = "SELECT DISTINCT UniqueId FROM bookings WHERE UserId='$t8user_id'";
    $r8 = mysqli_query($conn, $q8) or die("sql query failed");

    if (mysqli_num_rows($r8) > 0) {
        while ($row = mysqli_fetch_assoc($r8)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['dashboard_bookings'])) {
    $t9uniqueid = $_POST["dashboard_bookings"];
    $q9 = "SELECT * FROM bookings WHERE UniqueId='$t9uniqueid'";
    $r9 = mysqli_query($conn, $q9) or die("sql query failed");

    if (mysqli_num_rows($r9) > 0) {
        while ($row = mysqli_fetch_assoc($r9)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['dashboard_movieid'])) {
    $t10showid = $_POST["dashboard_movieid"];
    $q10 = "SELECT MovieId FROM shows WHERE ShowId='$t10showid'";
    $r10 = mysqli_query($conn, $q10) or die("sql query failed");

    if (mysqli_num_rows($r10) > 0) {
        while ($row = mysqli_fetch_assoc($r10)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['dashboard_bookingid'])) {
    $t11bookingid = $_POST["dashboard_bookingid"];
    $q11 = "SELECT Amount FROM payment WHERE BookingId='$t11bookingid'";
    $r11 = mysqli_query($conn, $q11) or die("sql query failed");

    if (mysqli_num_rows($r11) > 0) {
        while ($row = mysqli_fetch_assoc($r11)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['dashboard_movies'])) {
    $t12movieid = $_POST["dashboard_movies"];
    $q12 = "SELECT * FROM movies WHERE MovieId='$t12movieid'";
    $r12 = mysqli_query($conn, $q12) or die("sql query failed");

    if (mysqli_num_rows($r12) > 0) {
        while ($row = mysqli_fetch_assoc($r12)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}


// ================ REVIEW ====================


if (isset($_POST['review_movies'])) {
    $t13movieid = $_POST["review_movies"];
    $q13 = "select * from movies where `movieid`='" . $t13movieid . "'";
    $r13 = mysqli_query($conn, $q13) or die("sql query failed");

    if (mysqli_num_rows($r13) > 0) {
        while ($row = mysqli_fetch_assoc($r13)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['review_ulogin'])) {
    $t14email = $_POST["review_ulogin"];
    $t14gid = $_POST["review_gid"];
    $t14fid = $_POST["review_fid"];
    $q14 = "select * from uLogin where `Email`='" . $t14email . "' or `GoogleId`='" . $t14gid . "' or `FacebookId`='" . $t14fbid . "' and `OtpVerified`='verified'";
    $r14 = mysqli_query($conn, $q14) or die("sql query failed");

    if (mysqli_num_rows($r14) > 0) {
        while ($row = mysqli_fetch_assoc($r14)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['review_allreviews'])) {
    $t15movieid = $_POST["review_allreviews"];
    $q15 = "select review.Rating, review.Review, review.Date, uLogin.Name from review INNER JOIN uLogin on review.UserId=uLogin.UserId where movieid='" . $t15movieid . "' ORDER BY review.ReviewId DESC";
    $r15 = mysqli_query($conn, $q15) or die("sql query failed");

    if (mysqli_num_rows($r15) > 0) {
        while ($row = mysqli_fetch_assoc($r15)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['review_overview'])) {
    $t16movieid = $_POST["review_overview"];
    $q16 = "select * from review where movieid='" . $t16movieid . "'";
    $r16 = mysqli_query($conn, $q16) or die("sql query failed");

    if (mysqli_num_rows($r16) > 0) {
        while ($row = mysqli_fetch_assoc($r16)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

// ============== SEARCH ===================

if (isset($_POST['search_movie'])) {
    $t17query = $_POST["search_movie"];
    $q17 = "Select * from movies where MovieName like '%" . $t17query . "%'";
    $r17 = mysqli_query($conn, $q17) or die("sql query failed");

    if (mysqli_num_rows($r17) > 0) {
        while ($row = mysqli_fetch_assoc($r17)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}
if (isset($_POST['search_theater'])) {
    $t18query = $_POST["search_theater"];
    $q18 = "Select * from movies where MovieName like '%" . $t18query . "%'";
    $r18 = mysqli_query($conn, $q18) or die("sql query failed");

    if (mysqli_num_rows($r18) > 0) {
        while ($row = mysqli_fetch_assoc($r18)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

// =============== ALL MOVIES =======================

if (isset($_POST['allmovies_language'])) {
    $t19lang = $_POST["allmovies_language"];
    $q19 = "SELECT * FROM `movies` WHERE movies.MovieLanguages like '%" . $t19lang . "%'";
    $r19 = mysqli_query($conn, $q19) or die("sql query failed");

    if (mysqli_num_rows($r19) > 0) {
        while ($row = mysqli_fetch_assoc($r19)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['allmovies_genre'])) {
    $t20genre = $_POST["allmovies_genre"];
    $q20 = "SELECT * FROM `movies` WHERE movies.MovieGenre like '%" . $t20genre . "%'";
    $r20 = mysqli_query($conn, $q20) or die("sql query failed");

    if (mysqli_num_rows($r20) > 0) {
        while ($row = mysqli_fetch_assoc($r20)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['allmovies_format'])) {
    $t21format = $_POST["allmovies_format"];
    $q21 = "SELECT * FROM `movies` WHERE movies.Quality like '%" . $t21format . "%'";
    $r21 = mysqli_query($conn, $q21) or die("sql query failed");

    if (mysqli_num_rows($r21) > 0) {
        while ($row = mysqli_fetch_assoc($r21)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

// ============== PAYMENT ==================

if (isset($_POST['payment_status_uniqueid'])) {
    $q22 = "SELECT UniqueId FROM bookings ORDER BY UniqueId DESC LIMIT 1";
    $r22 = mysqli_query($conn, $q22) or die("sql query failed");

    if (mysqli_num_rows($r22) > 0) {
        while ($row = mysqli_fetch_assoc($r22)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['payment_status_theaterid'])) {
    $t23theaterid = $_POST['payment_status_theaterid'];
    $q23 = "SELECT * FROM theaters WHERE TheaterId = '$t23theaterid'";
    $r23 = mysqli_query($conn, $q23) or die("sql query failed");

    if (mysqli_num_rows($r23) > 0) {
        while ($row = mysqli_fetch_assoc($r23)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['payment_status_bookingid'])) {
    $q24 = "SELECT BookingId FROM bookings ORDER BY BookingId DESC LIMIT 1";
    $r24 = mysqli_query($conn, $q24) or die("sql query failed");

    if (mysqli_num_rows($r24) > 0) {
        while ($row = mysqli_fetch_assoc($r24)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}


// ============= LOGIN/SIGN UP ===============


if (isset($_POST['login_email'])) {
    $t25email = $_POST['login_email'];
    $q25 = "SELECT * FROM uLogin WHERE Email = '$t25email'";
    $r25 = mysqli_query($conn, $q25) or die("sql query failed");

    if (mysqli_num_rows($r25) > 0) {
        while ($row = mysqli_fetch_assoc($r25)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}


if (isset($_POST['login_fbid'])) {
    $t26fbid = $_POST['login_fbid'];
    $q26 = "SELECT * FROM uLogin WHERE `FacebookId` = '$t26fbid'";
    $r26 = mysqli_query($conn, $q26) or die("sql query failed");

    if (mysqli_num_rows($r26) > 0) {
        while ($row = mysqli_fetch_assoc($r26)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['login_gid'])) {
    $t27gid = $_POST['login_gid'];
    $q27 = "SELECT * FROM uLogin WHERE `GoogleId`= '$t27gid'";
    $r27 = mysqli_query($conn, $q27) or die("sql query failed");

    if (mysqli_num_rows($r27) > 0) {
        while ($row = mysqli_fetch_assoc($r27)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

if (isset($_POST['login_otp'])) {
    $t28otp = $_POST['login_otp'];
    $q28 = "SELECT * FROM uLogin WHERE Code = $t28otp";
    $r28 = mysqli_query($conn, $q28) or die("sql query failed");

    if (mysqli_num_rows($r28) > 0) {
        while ($row = mysqli_fetch_assoc($r28)) {
            $arr[] = $row;
        }
        echo json_encode(['status' => true, 'data' => $arr]);
    } else {
        echo json_encode(['status' => true, 'data' => "no data found"]);
    }
}

?>