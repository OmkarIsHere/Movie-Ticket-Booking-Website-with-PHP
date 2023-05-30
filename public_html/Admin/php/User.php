<?php
include('Connection.php');
// if ($conn->connect_error) {
//   die("Connection failed: " . $connect->connect_error);
// }

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
    <link rel="stylesheet" href="../Css/user.css ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
    <form action="" method="post">
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
                <li class="opt" onclick="window.location.href='giftCard.php'"><i class="fa-solid fa-gifts"></i>Gift Cards</li>
                <li class="opt active" onclick="window.location.href='User.php'"><i class="fa-solid fa-users"></i>User</li>
            </ul>
        </div>
        <div class="Theaterdetails">
           <div class="theaterHeading">
            <h3>User Info</h3>
           </div>
           <div class="TheaterOptions">
            <div class="ThSearch">
                <input type="text" name="search"id="Search"placeholder="Search">
            </div>
            <div class="ThAddtheaters">
                <button class="btn"><i class="fa-solid fa-arrows-rotate"></i>Refresh</button>
               
            </div>
           </div>
           <div class="theatersTable" id="theatersTable">
           <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Phone no.</th>
                            <th>Email</th>
                            <th>Facebook Id</th>
                            <th>Google Id</th>
                            <th>Otp Verified</th>
                            <th>Joined On</th>
                            <th>Block</th>
                        </tr>
                        
                         <?php
                          $query="select * from uLogin";
                          $result=mysqli_query($connect,$query);
                          if(mysqli_num_rows($result)>0){
                           while($row=mysqli_fetch_array($result)){
                            echo"<tr>";
                            echo'<td>'.$row['UserId'].'</td>';
                            echo'<td>'.$row['Name'].'</td>';
                            echo'<td>'.$row['Phone'].'</td>';
                            echo'<td>'.$row['Email'].'</td>';
                            echo'<td>'.$row['FacebookId'].'</td>';
                            echo'<td>'.$row['GoogleId'].'</td>';
                            echo'<td>'.$row['OtpVerified'].'</td>';
                            echo'<td>'.$row['JoinedOn'].'</td>';
                            if($row['Block']=="YES"){
                               echo '<td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" value='.$row['UserId'].' id="form-check-input" checked></div></td>';
                            }else{
                                echo '<td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" value="'.$row['UserId'].'" id="form-check-input"></div></td>';
                            }
                            echo"</tr>"; 

                           }
                       }
                         ?>
                            
                            
  
</table>
           </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
</form>
</body>
</html>
<script>
    $(document).ready(function(){
     $('#Search').keyup(function(){
       var query=$(this).val();
       if(query!=""){
        $.ajax({
           url:"SearchUser.php",
           method:"POST",
           data:{query:query},
           success:function(data){
          console.log(data);
                $('#theatersTable').fadeIn();
                $('#theatersTable').html(data);
           },
           error: function(xhr, status, error) {
         console.log(status);
   }
        });
       }else{
            location.reload(true);
       }
     });
     $('.form-check-input').click(function(e){
      
     var query=$(this).val();
     if(query!=""){
        $.ajax({
            url:"UpdateBlock.php",
            method:"POST",
            data:{query:query},
            success:function(data){
                 console.log(data)
            },
            error: function(xhr, status, error) {
         console.log(status);
                }
        });
     }else{
        console.log(query)
     }
  });
    });
</script>