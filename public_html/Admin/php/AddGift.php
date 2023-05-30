<?php
include('Connection.php');
ob_start();
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
    <link rel="stylesheet" href="../Css/AddGift.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
</head>
<body>
    <form action='' method='post' enctype="multipart/form-data">
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
            <li class="opt" onclick="window.location.href='AdminDashboard.php'"><i class="fa-solid fa-bars"></i>Dashboard</li>
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
            <h3>Add Gift Cards</h3>
           </div>
           <div class="theatersTable">
            <div class="container">
         <div>
            <label for="giftName" class="giftname">Card Name:</label>
          <input type="text" name="giftname" placeholder="Name" class="cardname" required></input>
        </div>
     
       <div> 
        <label for="giftimage">Gift Image: </label>
        <input type=file name="GiftImageFile" class="file" accept="image/png , image/jpg , image/jpeg" required > </input>
    </div>
        <button class="submit" type='submit' name='submit'>Sumbit</button>
           </div>
           </div>
        </div>
    </div>
    <?php
    if(isset($_POST['submit'])){
        $GiftImage=base64_encode(file_get_contents($_FILES["GiftImageFile"]["tmp_name"]));
         $query="Insert into giftcard (GiftName,GiftImage) values('".$_POST['giftname']."','$GiftImage ')";
         mysqli_query($connect,$query);
         header('Location:giftCard.php');
    }
    ?>
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
    </form>
</body>
</html>