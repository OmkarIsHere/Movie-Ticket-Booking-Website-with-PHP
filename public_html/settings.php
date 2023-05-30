<?php
require("./login/login_status.php");
// session_start();
// $login_status = false;
$city_name = "Select";
if (isset($_SESSION["location"])) {
    $city_name = $_SESSION["location"];
}
if(!(isset($_SESSION['email']))){
        header('Location: index.php');
}
include("./header.php");


$servername = "localhost";
        $username = "id20121598_root";
        $password = "Movietime@123";
        $dbname = "id20121598_movietime";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql1 = "SELECT Name, Phone FROM uLogin WHERE Email='$_SESSION[email]'";
if(mysqli_query($conn, $sql1)){
    $result1 = mysqli_query($conn, $sql1);
    $count_of_unique_id = mysqli_num_rows($result1);
}else{
    header('Location: index.php');
}

if (mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
        $name = $row["Name"];
        $phone = $row["Phone"];
    }
}else{
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="settings.css">
    <link rel="stylesheet" href="settingLite.css"> -->
    <?php
    if(isset($_COOKIE['theme'])){
    if($_COOKIE['theme'] == "lite"){
    echo "<link rel='stylesheet' href='settingsLite.css'>";
    }else{
        echo "<link rel='stylesheet' href='settings.css'>";
    }} 

?>
    <title>Setting</title>
</head>

<body>
    <form action="settingsSession.php" method="POST" enctype="multipart/form-data" onSubmit = "return checkPassword(this)">
        <section id="settings">
            <h1 id="settings-txt">Settings</h1>
            <section id="profile">
                <h2 id="profile-txt">Profile</h2>
                <section class="divide" id="name-container">
                    <label for="name">Name</label>
                    <br>
                    <input class="input-tags" type="text" name="name" id="name" value="<?php echo $name;?>">
                    <p class="meta">Your name may appear around movietime where you review or rate a movie.</p>
                </section>
                <section class="divide" id="email-container">
                    <label for="email">Email</label>
                    <br>
                    <input class="input-tags" type="email" name="email" id="email" value="<?php echo $_SESSION['email'];?>">
                    <p class="meta">Your email is private, other users can't see it.</p>
                </section>
                <section class="divide" id="phone-container">
                    <label for="phone">Phone Number</label>
                    <br>
                    <input class="input-tags" type="tel" name="phone" id="phone" pattern="[0-9]{10}" value="<?php echo $phone;?>">
                    <p class="meta">Your phone number is private, other users can't see it.</p>
                </section>
                <section class="divide" id="password-container">
                    <label for="password">New Passowrd</label>
                    <br>
                    <input class="input-tags" type="password" name="password1" id="password">
                    <p class="password-text"><input class = "showPass" type="checkbox" onclick="myFunction1()">Show Password</p>
                    <br>
                    <label for="confirmpassword">Confirm Passowrd</label>
                    <br>
                    <input class="input-tags" type="password" name="confirmpassword" id="confirmpassword">
                    <p class="password-text"><input class = "showPass" type="checkbox" onclick="myFunction2()">Show Password</p>
                </section>
                <input type="submit" value="submit" id="submit">
            </section>
            <section id="theme-container">
                <h3 id="theme-txt">Appearance</h3>
                <span>Theme preferences</span>
                <select name="theme" id="theme">
                    <option value="default">Default</option>
                    <option value="lite">Lite</option>
                    <option value="dark">Dark</option>
                </select>
                <p class="meta">Choose how movietime looks to you. Select a single theme, or sync with your system.</p>
                <button name="themechange" id="changethemebtn" type="submit" value="themechange">Change Theme</button>
            </section>
            <section id="account">
                <h3 id="account-txt">Account</h3>
                <section id="deletedata-container">
                    <input class="input-tags" type="submit" value="DeleteData" id="deletedata" name="DeleteData">
                    <p class="meta">Once you delete your data, there is no going back. Please be certain.</p>
                </section>
                <section id="deleteaccount-container">
                    <input class="input-tags" type="submit" value="DeleteAccount" id="deleteaccount" name="DeleteAccount">
                    <p class="meta">Once you delete your account, there is no going back. Please be certain.</p>
                </section>
            </section>
        </section>
    </form>

    <script src="settings.js"></script>
</body>

</html>