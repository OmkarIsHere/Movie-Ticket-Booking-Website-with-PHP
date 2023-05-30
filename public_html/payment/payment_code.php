<?php
if (!isset($_SESSION['logged_in'])) {
    header('Location: ../login/login.php');
}
?>
