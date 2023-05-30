<?php
session_start();
// $login_status = false;
$city_name = "Select";
if (isset($_SESSION["location"])) {
    $city_name = $_SESSION["location"];
}

$conn = mysqli_connect("localhost","id20121598_root","Movietime@123","id20121598_movietime") or die("Connection failed");

// if (isset($_POST["login"])) {
//     if ($login_status == false) {
//         echo 0;
//     }
// }

if (isset($_POST["date"])) {


    $movie_name = $_POST["moviename"];
    $movie_id = $_POST["movieid"];
    $dat = date_create($_POST["date"]);
    $date = date_format($dat, "Y-m-d");
    // $query = "select  b.theatrename, b.show1, b.show2, b.show3 from moviesavailableintheatre as a inner join theatre_city as b on b.theatreid=a.theatreid where a.moviename= '" . $movie_name . "' and a.city= '" . $city_name . "' and b.date= '" . $date . "' ";
    // $query = "select a.TheaterName,  b.TheaterId, b.showid, b.Time, b.Date from theaters as a inner join shows as b on b.theaterid=a.theaterid where b.movieid='" . $movie_id . "' and a.city LIKE   '" . $city_name . "' and b.date= '" . $date . "'";
    $query = "SELECT  theaters.TheaterName,  shows.TheaterId, shows.showid, shows.Time, shows.Date from shows
    INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
    where shows.MovieId='" . $movie_id . "' and theaters.City='" . $city_name . "' and shows.Date='" . $date . "'";
    $result = mysqli_query($conn, $query) or die("sql query failed");
    $output = "";

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            $output .= "<div id='theatre-name'>
                        <p class='theatre'>{$row["TheaterName"]}</p>
                        </div>
                        <div id='show-times'>
                        <a href='./seatbook/seat.php?theatername={$row["TheaterName"]}&theaterid={$row["TheaterId"]}&movieid=" . $movie_id . "&movie=" . $movie_name . "&city=" . $city_name . "&date={$row["Date"]}&time={$row["Time"]}&showid={$row["showid"]}&date={$row["Date"]}' class='show-time' >{$row["Time"]}</a>
                        </div>
                        <hr style='margin:2vh 0 0 0;' unshade>";
            // <a href='./seatbook/tempseat.php?theatre={$row["theatrename"]}&movieid=" . $movie_id . "&movie=" . $movie_name . "&city=" . $city_name . "&date=" . $date . "&time={$row["show2"]}' class='show-time' >{$row["show2"]}</a>
            // <a href='./seatbook/tempseat.php?theatre={$row["theatrename"]}&movieid=" . $movie_id . "&movie=" . $movie_name . "&city=" . $city_name . "&date=" . $date . "&time={$row["show3"]}' class='show-time' >{$row["show3"]}</a>
        }
        echo $output;
    } else {
        if ($city_name == "Select") {
            echo "<div style='height:auto;' class='no-record'><p style='margin-top:10vh; margin-bottom:10vh;'>Please select city and click on a specific date</p></div>";
        } else {
            echo "<div style='height:auto;' class='no-record'><p style='margin-top:10vh; margin-bottom:10vh;'>This movie's show isn't available on this day in $city_name</p></div>";
        }
    }
}
mysqli_close($conn);
