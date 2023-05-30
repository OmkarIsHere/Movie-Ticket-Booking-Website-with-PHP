<?php
 session_start();


 $username=$_SESSION['username'];
 if($username==""){
   header('Location:AdminLogin.php');
 }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieTime</title>
    <link rel="stylesheet" href="../Css/AdminMovies.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <form action="AddMovies.php" method="post"> 
    <header id="header">
        <img src="../image/MOVIEtime_white.png" alt="logo" class="logo" />

        <button class="visitwebsite">visit Website</button>
        <button class="visitwebsite">Android App Link </button>
        <input type="Submit" value="Logout" class="visitwebsite" name="logout">
        <?php
        if(isset($_POST["logout"])){
          unset( $_SESSION['username']);
        header('Location: AdminLogin.php');
        }

        ?>
    </header>
    <!-- onclick="window.location.href='AdminDashboard.html'" -->
    <div id="parentContainer">
        <div class="AdminOptions">
            <ul class="optionList">
            <li class="opt"  onclick="window.location.href='AdminDashboard.php'"><i class="fa-solid fa-bars"></i>Dashboard</li>
                <li class="opt active" onclick="window.location.href='AdminMovies.php'"><i class="fa-solid fa-film"></i>Movies</li>
                <li class="opt" onclick="window.location.href='theaters.php'">
                    </i><i class="fa-solid fa-building"></i>Theaters</li>
                <li class="opt"  onclick="window.location.href='Review.php'"><i class="fa-regular fa-star"></i>Reviews</li>
                <li class="opt" onclick="window.location.href='CheckBooking.php'"><i class="fa-solid fa-ticket"></i>Bookings</li>
                <li class="opt" onclick="window.location.href='giftCard.php'"><i class="fa-solid fa-gifts"></i>Gift Cards</li>
                <li class="opt" onclick="window.location.href='User.php'"><i class="fa-solid fa-users"></i>User</li>
            </ul>
        </div>
        <div class="Moviedetails">
            <div class="MoviesContainer">
                <div class="heading">
                    <h3>Now Showing Movies</h3>
                    <button class="add" name="NWMovies" type="submit" >+</button>
                </div>
                <div class="content">
                    <ul id="NowShowingMovie">
                       
                    </ul>
                </div>
            </div>
            <div class="MoviesContainer">
                <div class="heading">
                    <h3>Up Comming Movies</h3>
                    <input class="add" name="UpMovies" value="+" type="submit">
                </div>
                <div class="content">
                    <ul id="UpCommingMovies">
                  
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
    </form>
    <?php
    $servername = "localhost";
    $username = "id20121598_root";
    $password = "Movietime@123";
    $Database = "id20121598_movietime";
    
    $connect=mysqli_connect($servername,$username,$password,$Database);
    if(isset($_GET['name'])){
        $name=$_GET['name'];
        
   $delete=mysqli_query($connect,"Delete from movies where MovieName='".$name."'");
}
if(isset($_GET['addMovie'])){
 $moviename=$_GET['addMovie'];
 $addmovie=mysqli_query($connect,"Update movies set Status='NOW SHOWING MOVIE' where MovieName='". $moviename."'");
}

?>
</body>

</html>
<script>
    $(document).ready(function(){
        var query="Now showing movie";
        $.ajax({
              url:"getMovies.php",
              method:"POST",
              data:{query:query},
              success:function(data){
                $('#NowShowingMovie').html(data);
                //console.log(data);
              } ,
              error: function(xhr, status, error) {
         console.log(status);
            }
        });
    });
    $(document).ready(function(){
        var query="Up comming movie";
        $.ajax({
              url:"getMovies.php",
              method:"POST",
              data:{query:query},
              success:function(data){
                $('#UpCommingMovies').html(data);
                console.log(data);
              } ,
              error: function(xhr, status, error) {
         console.log(status);
            }
        });
    });

</script>