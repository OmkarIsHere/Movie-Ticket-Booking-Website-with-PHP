
<?php
session_start();
$servername = "localhost";
        $username = "id20121598_root";
        $password = "Movietime@123";
        $dbname = "id20121598_movietime";
$UserId = "";
$Name = "";
$Phone = "";
$Email = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Settings</title>
</head>
<body>
    
</body>
</html>

<?php

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql1 = "SELECT UserId, Name, Phone, Email FROM uLogin WHERE Email='$_SESSION[email]'";
if(mysqli_query($conn, $sql1)){
    $result1 = mysqli_query($conn, $sql1);
    $count_of_unique_id = mysqli_num_rows($result1);
}else{
    header('Location: index.php');
}

if (mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
        $UserId = $row["UserId"];
        $Name = $row["Name"];
        $Phone = $row["Phone"];
        $Email = $row["Email"];
    }
}else{
    header('Location: index.php');
}

if(isset($_POST['change'])){

if(isset($_POST['validPassword'])){

if($_POST['validPassword'] === $_SESSION['password']){
        
    if(!($Name == $_SESSION['EnteredName'])){
        $sqlNameUpdate = "UPDATE uLogin SET Name='$_SESSION[EnteredName]' WHERE Email='$_SESSION[email]'";
        mysqli_query($conn, $sqlNameUpdate);
    }
    if(!($Email == $_SESSION['EnteredEmail'])){
        $sqlEmailUpdate = "UPDATE uLogin SET Email='$_SESSION[EnteredEmail]' WHERE Email='$_SESSION[email]'";
        $_SESSION['email'] = $_SESSION['EnteredEmail'];
        mysqli_query($conn, $sqlEmailUpdate);
    }
    if(!($Phone == $_SESSION['EnteredPhone'])){
        $sqlPhoneUpdate = "UPDATE uLogin SET Phone='$_SESSION[EnteredPhone]' WHERE Email='$_SESSION[email]'";
        mysqli_query($conn, $sqlPhoneUpdate);
    }
    
    if(isset($_SESSION['EnteredPassword'])){
        $_SESSION['password'] = $_SESSION['EnteredPassword'];
        $password = $_SESSION['EnteredPassword'];
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        
        $sqlPassword = "UPDATE `uLogin` SET `Password` = '$encpass', `Code` = '$code' WHERE `Email` = '$_SESSION[email]'";
        mysqli_query($conn, $sqlPassword);
    }
    if($_SESSION['DeleteData'] == 1){
        $sqlDataDelete = "UPDATE `bookings` SET `NoOfTickets`='NULL',`SeatNo`='NULL',`SeatType`='NULL',`Status`='Inactive',`UniqueId`=0 WHERE `UserId` = '$_SESSION[userid]'";
        mysqli_query($conn, $sqlDataDelete);
    }
    if($_SESSION['DeleteAccount'] == 1){
        $sqlDataDelete = "UPDATE `uLogin` SET `Name` = NULL, `Email` = NULL, `Phone` = NULL, `Password` = NULL WHERE `Email` = '$_SESSION[email]'";
        mysqli_query($conn, $sqlDataDelete);
        session_destroy();
        exit();
    }
}}
header('Location: index.php');
}
?>