<?php
include('Connection.php');
session_start();
 $username=$_SESSION['username'];
 if($username==""){
   header('Location:AdminLogin.php');
 }
if(isset($_GET['deleteId'])){
  $query="Delete from review where ReviewId='".$_GET['deleteId']."'";
  mysqli_query($connect,$query);
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieTime</title>
    <link rel="stylesheet" href="../Css/Review.css">
    <script src="../Javascript/navbar.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
</head>
<body>
  <form method="post" action="">
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
            <li class="opt"><i class="fa-solid fa-bars"></i>Dashboard</li>
                <li class="opt" onclick="window.location.href='AdminMovies.php'"><i class="fa-solid fa-film"></i>Movies</li>
                <li class="opt" onclick="window.location.href='theaters.php'">
                    </i><i class="fa-solid fa-building"></i>Theaters</li>
                <li class="opt active"  onclick="window.location.href='Review.php'"><i class="fa-regular fa-star"></i>Reviews</li>
                <li class="opt" onclick="window.location.href='CheckBooking.php'"><i class="fa-solid fa-ticket"></i>Bookings</li>
                <li class="opt" onclick="window.location.href='giftCard.php'"><i class="fa-solid fa-gifts"></i>Gift Cards</li>
                <li class="opt" onclick="window.location.href='User.php'"><i class="fa-solid fa-users"></i>User</li>
            </ul>
        </div>
        <div class="Theaterdetails">
           
           <div class="theaterHeading">
            <h3>Reviews</h3>
           </div>
           <div class="TheaterOptions">
          
            <div class="ThSearch">
              <h3 onclick="moveleft()">Movie Rating</h3>
              <h3 onclick="moveright()">Theater Rating</h3>
            </div>
            <div class="line"></div>
           
           </div>
           <div class="theatersTable">
           <div class="TheaterReview">
           <table class="table">
  <tr>
    <th>ID</th>
    <th>User Name</th>
    <th>Theater Name</th>
    <th>Date</th>
    <th>Rating</th>
    <th>Experience</th>
    <th>Screen No</th>
    <th>Review</th>
    <th>Activity</th>
  </tr>
  <tr>
    <td>01</td>
    <td>Vineet</td>
    <td>Balaji Theaters</td>
    <td>1/01/2023</td>
    <td>5</td>
    <td>Good</td>
    <td>1</td>
    <td>I loved it</td>
    <td><button class="btn btn-primary btn-sm">Delete</button>

    </td>
  </tr>
  
</table>
     
 </div>
    <div class="MovieReview">
        <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Movie</th>
                    <th>User Name</th>
                    <th>Date</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Activity</th>
                  </tr>
                  
                    <?php 
                    $query="Select ReviewId,review,Rating,Date,uLogin.Name,movies.MovieName
                    FROM review 
                         INNER JOIN uLogin on review.UserId=uLogin.UserId 
                        INNER JOIN movies on review.MovieId=movies.MovieId;";
                    $result = mysqli_query($connect,$query);
                    if(mysqli_num_rows($result)>0){
                     while($row=mysqli_fetch_array($result)){
                     echo"<tr>";
                     echo"<td>".$row['ReviewId']."</td>";
                     echo"<td>".$row['MovieName']."</td>";
                     echo"<td>".$row['Name']."</td>";
                     echo"<td>".$row['Date']."</td>";
                     echo"<td>".$row['Rating']."</td>";
                     echo"<td>".$row['review']."</td>";
                     echo"<td ><a type='buttton' href='Review.php?deleteId=".$row['ReviewId']."'class='btn btn-primary btn-sm'>Delete</a>";
                     echo"</tr>";
                     }
                    }
                    
                    ?>
                      
                 
                     
                
  
            </table>
     
      </div>
   </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
    </form>
</body>
</html>