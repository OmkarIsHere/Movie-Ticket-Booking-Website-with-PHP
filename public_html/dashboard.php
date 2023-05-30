<?php

require("./login/login_status.php");

//session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login/login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
    <title>Dashboard</title>
</head>

<body>
    <a id="topbtn"></a>
<?php
    include("header.php");
?>
<div id="dashboard-container">
        <div id="dashboard-header">
            <h1>Dashboard</h1>
        </div>
        <?php
        $servername = "localhost";
        $username = "id20121598_root";
        $password = "Movietime@123";
        $dbname = "id20121598_movietime";
        $seatName = "";
        $uniqueId = array();
        $ShowId = "";
        $MovieId = "";
        $BookingDate = "";
        $userId="";
                $Status = "";


        /* $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "movietime";
        $seatName = "";
        $uniqueId = array();
        $ShowId = "";
        $MovieId = "";
        $BookingDate = ""; */


        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        if(isset($_SESSION['userid'])){
        $userId = $_SESSION['userid'];
        }
        $sql1 = "SELECT DISTINCT UniqueId FROM bookings WHERE UserId='$userId'";
        $result1 = mysqli_query($conn, $sql1);
        $count_of_unique_id = mysqli_num_rows($result1);
        if (mysqli_num_rows($result1) > 0) {
            $j = 0;
            while ($row = mysqli_fetch_assoc($result1)) {
                $uniqueId[$j] = $row["UniqueId"];
                $j++;
            }
        }


        if ($count_of_unique_id >= 1) {
            for ($i = 0; $i < $count_of_unique_id; $i++) {
                /* code for seat name */
                $sql2 = "SELECT SeatNo FROM bookings WHERE UniqueId='$uniqueId[$i]'";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    $j = 0;
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $seatName .= " " . $row["SeatNo"];
                        $j++;
                    }
                }

                /* code for show id */
                 $sql2 = "SELECT ShowId, BookingDate, BookingId, Status FROM bookings WHERE UniqueId='$uniqueId[$i]'";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    // $row = mysqli_fetch_assoc($result2);
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $ShowId = $row["ShowId"];
                        $BookingDate = $row["BookingDate"];
                        $BookingId = $row["BookingId"];
                         $Status = $row["Status"];
                    }
                }
                if($Status == "Inactive"){
                    continue;
                }
                /* code to fetch movieId from shows table using showId which we have fetched above */
                $sql2 = "SELECT MovieId FROM shows WHERE ShowId='$ShowId'";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    $row = mysqli_fetch_assoc($result2);
                    $MovieId = $row["MovieId"];
                }

                /* code to fetch payment from payment table using BookingId which we have fetched above */
                $sql2 = "SELECT Amount FROM payment WHERE BookingId='$BookingId'";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    $row = mysqli_fetch_assoc($result2);
                    $Amount = $row["Amount"];
                }


                /* code to fetch MovieName from movies table using MovieId which we have fetched above */
                $sql2 = "SELECT MovieName, MovieGenre, MovieLength, ReleaseDate, MovieLanguages, MoviePoster, Quality FROM movies WHERE MovieId='$MovieId'";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    $row = mysqli_fetch_assoc($result2);
                }


                echo "<div id='dashboard'>";
                echo "<div id='all-info'>";
                echo '<img id="img1" src="data:image/jpg;base64,' . base64_encode($row['MoviePoster']) . '"/>';
                echo "<div id='info-container'>";
                echo "<div id='movie-info-container'>";
                echo "<div id='movie-info'>";
                echo "<div class='div1'>";
                echo "<img id='movieImg' src='https://img.icons8.com/3d-fluency/94/null/documentary.png'/>";
                echo "Movie Information</div>";
                echo "<div id='movie-name'>$row[MovieName]</div>";
                echo "<div id='release-date'>Release Date: $row[ReleaseDate]</div>";
                echo "<div id='movie-length'>Run Time: $row[MovieLength]</div>";
                echo "<div id='quality'>Quality: $row[Quality]</div>";
                echo "</div>";
                echo "</div>";
                echo "<div id='ticket-info-container'>";
                echo "<div class='div1'>";
                echo "<img id='ticketImg' src='https://img.icons8.com/3d-fluency/94/null/starred-ticket.png'/>";
                echo "Ticket Information";
                echo "</div>";
                echo "<div id='ticket-info'>";
                echo "<div id='tickets'>";
                echo "<span class='span1'>Tickets:</span>";
                echo "<span>$seatName</span>";
                echo "</div>";
                echo "<div id='amt-info'>";
                echo "Total Amount:";
                echo "<span id='amt'> ₹$Amount</span>";
                echo "</div>";
                echo "<div id='booking-info'>";
                echo "Booking Date:";
                echo "<span id='amt'> $BookingDate</span>";
                echo "</div>";
                echo "</div>";
                echo "<form action='ticket-dashboard.php' method='POST'>";
                echo "<input type='hidden' id='uid' name='UniqueId' value='$uniqueId[$i]'>";
                echo "<input class='ticketdash' type='submit' value='View Ticket'>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

                $seatName = "";
            }
        } else {
            echo "<div id='nothing'>You have not booked anything yet.</div>";
        }

    ?>
<script>
    var btn = $('#topbtn');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});
</script>
</body>

</html>