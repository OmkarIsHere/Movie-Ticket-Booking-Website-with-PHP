<?php 
    // $db_connection = mysqli_connect("localhost","root","","movietime");
    // // CHECK DATABASE CONNECTION
    // if(mysqli_connect_errno()){
    //     echo "Connection Failed".mysqli_connect_error();
    //     exit;
    // }
    session_start();
    $conn = mysqli_connect("localhost","id20121598_root","Movietime@123","id20121598_movietime");
    // CHECK DATABASE CONNECTION
    if(mysqli_connect_errno()){
        echo "Connection Failed".mysqli_connect_error();
        exit;
    }
?>