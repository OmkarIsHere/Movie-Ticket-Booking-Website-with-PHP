<?php

include('db.php');

if(isset($_POST["movieid"])){
    $movieid = $_POST["movieid"];
    
    $query1 = "select  * from crew_details where MovieId='". $movieid."'";
    $res = mysqli_query($conn, $query1) or die("sql query failed");
    
    $result = array();
    
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
        		array_push($result, array(
                    'crew_img' => $row["imagePath"],
                    'crew_name' => $row["crew_name"],
        		    'crew_role' => $row["crew_role"],
                )
                );
        	}
            echo json_encode($result);
        }
        else{ 
         echo "no record found";
        }
    }
mysqli_close($conn);
?>