<?php

include('db.php');

if(isset($_POST["moviename"])){
    $movie = $_POST["moviename"];
    
    $query1 = "select  * from movies where MovieName='". $movie."'";
    $res = mysqli_query($conn, $query1) or die("sql query failed");
    
    $result = array();
    
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
        		array_push($result, array(
                    'movie_id' => $row["MovieId"],
                    'movie_name' => $row["MovieName"],
        		    'movie_genre' => $row["MovieGenre"],
                    'movie_duration' => $row["MovieLength"],
                    'movie_ytlink' => $row["YoutubeLink"],
                    'movie_release' => $row["ReleaseDate"],
                    'movie_languages' => $row["MovieLanguages"],
                    'movie_quality' => $row["Quality"],
                    'movie_about' => $row["About"],
                    'movieVerticalImage' =>$row["VerticalimagePath"],
                    'movie_image' => $row["SmallimagePath"]));
        	}
            echo json_encode($result);
        }
        else{ 
         echo "no record found";
        }
    }
mysqli_close($conn);
?>