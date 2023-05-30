<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="settingsSession.css">
    <title>Settings</title>
</head>
<body>
<?php
if(isset($_POST['themechange'])){
    if($_POST['theme'] == "lite"){
        setcookie("theme", "lite", time() + (86400 * 30), "/");
    }
    if($_POST['theme'] == "dark"){
        setcookie("theme", "dark", time() + (86400 * 30), "/");
    }
    if($_POST['theme'] == "default"){
        setcookie("theme", "default", time() + (86400 * 30), "/");
    }
    header('Location: settings.php');
}

if(isset($_POST['email'])){
    $_SESSION['EnteredEmail'] = $_POST['email'];
}
if(isset($_POST['phone'])){
    $_SESSION['EnteredPhone'] = $_POST['phone'];
}
if(isset($_POST['name'])){
    $_SESSION['EnteredName'] = $_POST['name'];
}
if(isset($_POST['password1'])){
    $_SESSION['EnteredPassword'] = $_POST['password1'];
}
if(isset($_POST['confirmpassword'])){
    $_SESSION['EnteredConPassword'] = $_POST['confirmpassword'];
}
if(isset($_POST['DeleteData'])){

    $_SESSION['DeleteData'] = 1;
}
if(isset($_POST['DeleteAccount'])){
    $_SESSION['DeleteAccount'] = 1;
}
?>
    <section id="password-container">
        <form method="post" action="settingsChange.php">
            <h1 id="main-heading">Enter Password</h1>
            <label for="validPassword">password</label>
            <br>
            <input type="password" name="validPassword" id="validPassword" required>
            <input type="submit" name="change" value="Change" onclick="warn()">
        </form>
    </section>

    <script>
        function warn(){
            alert("Are you sure?");
        }
    </script>
</body>
</html>