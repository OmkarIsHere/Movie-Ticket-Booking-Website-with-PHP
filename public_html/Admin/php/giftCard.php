<?php
include("Connection.php");
session_start();
 $username=$_SESSION['username'];
 if($username==""){
   header('Location:AdminLogin.php');
 }
if(isset($_GET['deleteId'])){
    $id=$_GET['deleteId'];
   
    $myquery="Delete from giftcard where GiftCardId='$id'";
    mysqli_query($connect,$myquery);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieTime</title>
    <link rel="stylesheet" href="../Css/giftcard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
    <form action="AddGift.php" method="post">
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
    <div id="parentContainer">
        <div class="AdminOptions">
            <ul class="optionList">
            <li class="opt"onclick="window.location.href='AdminDashboard.php'"><i class="fa-solid fa-bars"></i>Dashboard</li>
                <li class="opt" onclick="window.location.href='AdminMovies.php'"><i class="fa-solid fa-film"></i>Movies</li>
                <li class="opt" onclick="window.location.href='theaters.php'">
                    </i><i class="fa-solid fa-building"></i>Theaters</li>
                <li class="opt"  onclick="window.location.href='Review.php'"><i class="fa-regular fa-star"></i>Reviews</li>
                <li class="opt" onclick="window.location.href='CheckBooking.php'"><i class="fa-solid fa-ticket"></i>Bookings</li>
                <li class="opt active" onclick="window.location.href='giftCard.php'"><i class="fa-solid fa-gifts"></i>Gift Cards</li>
                <li class="opt" onclick="window.location.href='User.php'"><i class="fa-solid fa-users"></i>User</li>
            </ul>
        </div>
        <div class="Theaterdetails">
           <div class="theaterHeading">
            <h3>Gift Cards</h3>
           </div>
           <div class="TheaterOptions">
            <div class="ThSearch">
               
            </div>
            <div class="ThAddtheaters">
                <button class="btn" id="refresh" name="refresh" type="button"><i class="fa-solid fa-arrows-rotate"></i>Refresh</button>
                <input class="btn" type="submit" this.form.action='AddGift.php'  this.form.submit() value="Add Gift Card"></input>
            </div>
           </div>
           <div class="theatersTable">
            <?php
            $query="Select * from giftcard";
            $result=mysqli_query($connect,$query);
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_array($result)){
             echo  ' <div class="card">';
             echo '<img src="data:image/jpg;base64,'.($row['GiftImage']).'" alt="giftcard">'.
           ' <a href="giftCard.php?deleteId='.$row['GiftCardId'].'" class="btn btn-danger">Delete</a>'.
             '</div>';
            }
            }
            ?>
           
        </div>
    </div>
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
    </form>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#refresh').click(function(){
        location.reload(true)
    });
    });
</script>