<?php
ob_start();
include('Connection.php');
session_start();
 $username=$_SESSION['username'];
 if($username==""){
   header('Location:AdminLogin.php');
 }
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if(isset($_GET['theaterid'])){
    $TheaterId=$_GET['theaterid'];
    $query4="Delete from theaters where Theaterid='$TheaterId'";
    mysqli_multi_query($connect,$query4);
    $query5="Delete from theaterlogin where TheaterID='$TheaterId'";
     $delete=mysqli_query($connect,$query5);
    
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieTime</title>
    <link rel="stylesheet" href="../Css/Theaters.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
    <form action="AddTheaters.php" method="post">
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
            <li class="opt"  onclick="window.location.href='AdminDashboard.php'"><i class="fa-solid fa-bars"></i>Dashboard</li>
                <li class="opt" onclick="window.location.href='AdminMovies.php'"><i class="fa-solid fa-film"></i>Movies</li>
                <li class="opt active" onclick="window.location.href='theaters.php'">
                    </i><i class="fa-solid fa-building"></i>Theaters</li>
                <li class="opt"  onclick="window.location.href='Review.php'"><i class="fa-regular fa-star"></i>Reviews</li>
                <li class="opt" onclick="window.location.href='CheckBooking.php'"><i class="fa-solid fa-ticket"></i>Bookings</li>
                <li class="opt" onclick="window.location.href='giftCard.php'"><i class="fa-solid fa-gifts"></i>Gift Cards</li>
                <li class="opt" onclick="window.location.href='User.php'"><i class="fa-solid fa-users"></i>User</li>
            </ul>
        </div>
        <div class="Theaterdetails">
           <div class="theaterHeading">
            <h3>Theaters</h3>
           </div>
           <div class="TheaterOptions">
            <div class="ThSearch">
                <input type="text"  id="searchtheater" placeholder="Search">
            </div>
            <div class="ThAddtheaters">
                <button class="btn" type="button" id="refresh"><i class="fa-solid fa-arrows-rotate"></i>Refresh</button>
                <button class="btn" onclick="window.location.href='AddTheaters.php'">Add Theater</button>
            </div>
           </div>
           <div class="theatersTable" id="theatersTable">
        <table class="table" id='tablecontainer'>
            <thead>
             <tr>
                    <th>Image</th>
                    <th>ID</th>
                    <th>Theater Name</th>
                    <th>Address</th>
                    <th>Phone no.</th>
                    <th>Email</th>
                    <th>Revenue</th>
                    <th>Status</th>
                    <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                 <?php
                 $query="Select * from theaters";
                 $result = mysqli_query($connect,$query);
                 if(mysqli_num_rows($result)>0){
                  while($row=mysqli_fetch_array($result)){
                    echo"<tr>";
                    echo '<td><img class="thimage" src="data:image/jpg;base64,'.($row['TheaterImages']).'" alt="TheaterImage"></td>';
                    echo"<td>".$row['TheaterId']."</td>";
                    echo"<td>".$row['TheaterName']."</td>";
                    echo"<td>".$row['TheaterAddress']."</td>";
                    echo"<td>".$row['PhoneNo']."</td>";
                    echo"<td>".$row['Email']."</td>";
                    echo"<td><i class='fa-solid fa-indian-rupee-sign' style='margin-right:5px'></i>".$row['Revenue']."</td>";
                    if($row['Status']=="YES"){
                        echo"<td><div class='form-check form-switch'><input class='form-check-input' type='checkbox' role='switch' name='status' id='flexSwitchCheckChecked' value=".$row['TheaterId']." checked></div></td>";  
                    }else{
                    echo"<td><div class='form-check form-switch'><input class='form-check-input' type='checkbox' role='switch' value=".$row['TheaterId']." name='status'id='flexSwitchCheckChecked' ></div></td>";
                    }
                    echo"<td><a class='btn btn-primary btn-sm' href='viewAnalytics.php?theaterid=".$row['TheaterId']."'>view Analytics</a><a class='btn btn-primary btn-sm delete'  href='theaters.php?theaterid=".$row['TheaterId']."' >Delete</a></td>";
                    echo"</tr>";
 
                  }
                 }
                

                 ?>
               </tbody>
        </table>
           </div>
        </div>
    </div>
    <?php
    
      
    ?>
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
    </form>
</body>
</html>
<script>
 $(document).ready(function(){
  $('#flexSwitchCheckChecked').click(function(){
     var query=$(this).val();
     if(query!=""){
        $.ajax({
            url:"UpdateStatus.php",
            method:"POST",
            data:{query:query},
            success:function(data){
                // console.log(data)
            },
            error: function(xhr, status, error) {
         console.log(status);
   }
        });
     }
  });
 
  $('#searchtheater').keyup(function(){
         var query=$(this).val();
        if(query!=''){
           
            $.ajax({
              url:"SearchTheaters.php",
              method:"POST",
              data:{query:query},
              success:function(data){
               
                $('#theatersTable').fadeIn();
                $('#theatersTable').html(data);
               
                console.log(data);
              } ,
              error: function(xhr, status, error) {
         console.log(status);
   }

            });
        }else{
            location.reload(true)  
        }
    });
    $('#refresh').click(function(){
        location.reload(true)
    });
 });
 </script>