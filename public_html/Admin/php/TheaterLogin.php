<?php
include("Connection.php");
session_start();
$err="";
if(isset($_POST['Submit'])){
  error_reporting(E_ALL);
ini_set('display_errors', 1);
  $username=$_POST['username'];
  $password=$_POST['Password'];

 $query="Select * from theaterCredentials where Theatername='$username' and Password='$password'";

    $result=mysqli_query($connect,$query);
 
 if(mysqli_num_rows($result)){
 
  $_SESSION['Thusername']=$username;
  if(isset($_SESSION['Thusername'])){
 header('Location:TheaterDashboard.php'); 
  }
 }else{
  $err="Invalid Login Credentials";
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/TheaterLogin.css">
    <title>MovieTime</title>
</head>
<body>
  <div class="container">
    <div class="part1"></div>
    <div class="part2">
        <form action="" method="post">
          <div class="row1">
            <img src="../image/MOVIEtime_black.png" alt="logo">
          </div>
          <div class="row2">
            <div class="heading">
                <h3>We are The MovieTime<br>Team</h3>
            </div>
            <div class="content">
                <h3>Sign into your account.</h3>
                <div class="controls">
                <input type="text" placeholder="Username" name="username"></input>
                <input type="password" placeholder="Password" name="Password" id="password"></input>
                <input type="submit" value="Submit" name="Submit" class="btn">
                <div class="password"><h4>Forget password ?</h4><div class="strong"><input class="checkbox" type="checkbox" value="Show Password" onclick="Toggle()"/> <strong>Show Password</strong></div></div>
                <p style="color:red"><?php echo $err?></p>
                <h4 class="terms">Terms of use. Privacy policy</h4>
            </div>
               
            </div>
          </div>  
        </form>
    </div>
  </div> 
  <script>

    function Toggle(){
      var pass=document.getElementById("password");
      if(pass.type=="password"){
        pass.type="text";
      }else{
        pass.type="password";
      }
    }
  </script> 
</body>
</html>