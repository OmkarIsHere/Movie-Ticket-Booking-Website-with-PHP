<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Initialize the session.
    // If you are using session_name("something"), don't forget it now!
    session_start();

    // Unset all of the session variables.
    // $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    // if (ini_get("session.use_cookies")) {
    //     $params = session_get_cookie_params();
    //     setcookie(session_name(), '', time() - 42000,
    //         $params["path"], $params["domain"],
    //         $params["secure"], $params["httponly"]
    //     );
    // }

    // Finally, destroy the session.
    // if (isset($_SESSION['GOOGLE_ID'])) {
    //     echo '<script>google_logout();</script>';
    // }

    //session_unset();
    // unset($_SESSION['email']);
    // unset($_SESSION['password']);
    session_destroy();
    //unset($_SESSION['Switch_button']);

    header('Location: ../index.php');
    exit();
    ?>
    <!--<script src="../js/google.js"></script>-->
</body>

</html>