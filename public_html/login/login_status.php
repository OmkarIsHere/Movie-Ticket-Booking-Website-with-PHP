<?php
require './other/config_mysqli.php';
// if(isset($_SESSION['login_id'])) {
//     $id = $_SESSION['login_id'];
//     $get_user = mysqli_query($conn, "SELECT * FROM `uLogin` WHERE `Google_ID`='$id'");

//     if(mysqli_num_rows($get_user) > 0){
//         $user = mysqli_fetch_assoc($get_user);
//         $_SESSION['profile'] = ProfilePicFromName($user['Name']);
//     }
// }

if (isset($_SESSION['FB_ID'])) {
    $id = $_SESSION['FB_ID'];
    $get_user = mysqli_query($conn, "SELECT * FROM uLogin WHERE `FacebookId`='$id'");

    if (mysqli_num_rows($get_user) > 0) {
        $user = mysqli_fetch_assoc($get_user);
        
        $_SESSION['profile'] = ProfilePicFromName($user['Name']);
        $_SESSION['userid'] = $user["UserId"];
    }
}

if (isset($_SESSION['GOOGLE_ID'])) {
    $id = $_SESSION['GOOGLE_ID'];
    $get_user = mysqli_query($conn, "SELECT * FROM uLogin WHERE `GoogleId`='$id'");

    if (mysqli_num_rows($get_user) > 0) {
        $user = mysqli_fetch_assoc($get_user);
        $_SESSION['profile'] = ProfilePicFromName($user['Name']);
        $_SESSION['userid'] = $user["UserId"];
    }
}

if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];

    if ($email != false && $password != false) {
        $sql = "SELECT * FROM uLogin WHERE Email = '$email'";
        $run_Sql = mysqli_query($conn, $sql);
        if ($run_Sql) {
            $fetch_info = mysqli_fetch_assoc($run_Sql);
            $_SESSION['profile'] = ProfilePicFromName($fetch_info['Name']);
            $_SESSION['userid'] = $fetch_info["UserId"];
        }
    }
}

if (isset($_SESSION['logged_in'])) {
    if ($_SESSION['logged_in'] == 'FG_verify') {
        header('Location: ./login/login.php');
    }
}

function ProfilePicFromName($fullName)
{
    $fullNameArr = explode(" ", $fullName);
    $firstWord = current($fullNameArr);
    $firstCharacter = substr($firstWord, 0, 1);
    return $firstCharacter;
}

?>