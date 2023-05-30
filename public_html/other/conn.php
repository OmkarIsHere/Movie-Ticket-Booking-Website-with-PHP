<?php

$conn = mysqli_connect("localhost","id20121598_root","Movietime@123","id20121598_movietime");

if(mysqli_connect_errno()){
    echo "Connection Failed".mysqli_connect_error();
    exit;
}

