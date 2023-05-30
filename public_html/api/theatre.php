<?php

include('db.php');

if(isset($_POST["movieid"])){
    $movieid = $_POST["movieid"];
    $cityname = $_POST["city"];
    $date= $_POST["date"];
    // $movieid = "" . 14;
    // $cityname = "Mumbai";
    // $date= "2023-05-28";
    
    $query1 = "SELECT  theaters.TheaterName,  shows.TheaterId, shows.showid,shows.Language, shows.ScreenType, shows.Time, shows.Date from shows INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
    where shows.MovieId='" . $movieid . "' and theaters.City='" . $cityname . "' and shows.Date='" . $date . "'";
    $res = mysqli_query($conn, $query1) or die("sql query failed");
    
    $result = array();
    
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
        		array_push($result, array(
                    'theatre_name' => $row["TheaterName"],
                    'show_id' => $row["showid"],
        		    'show_language' => $row["Language"],
        		    'screen_type' => $row["ScreenType"],
        		    'show_date' => $row["Date"],
        		    'theatre_id' => $row["TheaterId"],
        		    'show_time' => $row["Time"])
        		    );
        	}
        	
            echo json_encode($result);
        }
        else{ 
         echo "no";
        }
 }
mysqli_close($conn);
?>