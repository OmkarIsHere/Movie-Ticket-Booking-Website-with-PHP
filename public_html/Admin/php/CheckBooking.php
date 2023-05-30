<?php
ob_start();
session_start();
include 'Connection.php';
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
    <link rel="stylesheet" href="../Css/checkBookings.css">
    <script src="../Javascript/navbar.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
    <form action="" method="post">
    <header id="header">
        <img src="../image/MOVIEtime_white.png" alt="logo" class="logo" />

        <button class="visitwebsite" name="website">visit Website</button>
        <button class="visitwebsite">Android App Link </button>
        <input type="Submit" value="Logout" class="visitwebsite" name="logout">
        <?php
        if(isset($_POST["logout"])){
          unset( $_SESSION['username']);
        header('Location: AdminLogin.php');
        }
        if(isset($_POST["website"])){
            unset( $_SESSION['username']);
          header('Location: /movietime/index.php');
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
                <li class="opt active" onclick="window.location.href='CheckBooking.php'"><i class="fa-solid fa-ticket"></i>Bookings</li>
                <li class="opt" onclick="window.location.href='giftCard.php'"><i class="fa-solid fa-gifts"></i>Gift Cards</li>
                <li class="opt" onclick="window.location.href='User.php'"><i class="fa-solid fa-users"></i>User</li>
            </ul>
        </div>
        <div class="Theaterdetails">
           
           <div class="theaterHeading">
            <h3>Bookings</h3>
           </div>
           <div class="TheaterOptions">
          
            <div class="ThSearch">
             <h3 onclick="myActive() ">Active</h3>
              <h3 onclick="mycancel()">Canceled</h3>
              <h3 onclick="myhistory()">History</h3>
            </div>
            <div class="myline"></div>
           </div>
           <div class="theatersTable">
           <div class="Bookinghistory">
           <div class="bkoptions">
                <div class="part1">
                <input type="text" name="search" class="search" placeholder="Search" id='search_history'>
                </div>
                <div class="part2">
                    <input type="date" name="date" class="date" id="date_history">
                    <select name="Payment" class="Paymenttype" id="Paymenttype_history">
                    <option value="PaymentType">Payment Type</option>
                     <option value="Upi">UPI</option>
                     <option value="Online">Online</option>
                     <option value="Credit">Credit card</option>
                     <option value="Debit">Debit card</option>
                     <option value="Bank">Bank Account</option>
                 </select>
                 <button class="btn"><i class="fa-solid fa-arrows-rotate"></i>Refresh</button>
                </div>
             
            </div>
            <div class="bookingslides" id="bookingslideshistory">
            <?php
                 $query="SELECT bookings.BookingId,bookings.SeatNo,bookings.SeatType,bookings.BookingDate,shows.Time,movies.MovieName,
                 shows.Language,shows.Date,shows.ScreenNo,shows.Date,shows.ScreenType,theaters.TheaterName,payment.PaymentId,
                 payment.PaymentMethod,uLogin.Name FROM bookings
                 INNER JOIN shows ON bookings.ShowId=shows.ShowId
                 INNER JOIN movies ON shows.MovieId=movies.MovieId
                 INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
                 INNER JOIN payment ON bookings.BookingId=payment.BookingId
                 INNER JOIN uLogin ON bookings.UserId=uLogin.UserId
                 where bookings.Status='Inactive'";
                 $result=mysqli_query($connect,$query);
                 if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                       echo'<div class="card">';
                       echo'<div class="part1">';
                       echo'<div class="booking">';
                       echo'<div class="bookingId">';
                       echo'<label>Booking Id: '.$row['BookingId'].'</label></div>';
                       echo'<div class="bookingDate">Booking Date: '.$row['BookingDate'].'</div>';
                       echo'</div>';
                       echo'<div class="PaymentDetail">';
                       echo'<div class="username">';
                       echo'<i class="fa-solid fa-user"></i><label>'.$row['Name'].'</label>';
                       echo'</div>';
                       echo'<div class="PamentMethod">';
                       echo'<label>Payment: '.$row['PaymentMethod'].'</label>';
                       echo'</div>';
                       echo'</div>';
                       echo'</div>';
                       echo'<span><label>Movie: '.$row['MovieName'].'&nbsp&nbsp'.$row['ScreenType'].'</label></span>';
                       echo'<span><label>Show on: '.$row['Date'].' at '.$row['Time'].'</label></span>';
                       echo'<span><label>Seat No: '.$row['SeatNo'].'&nbsp&nbsp'.$row['SeatType'].'</label></span>';
                       echo'<span><label>Language : '.$row['Language'].'</label></span>';
                       echo'<span><label>Theater: '.$row['TheaterName'].'</label></span>';
                       echo'<span><label>Screen No : '.$row['ScreenNo'].'</label></span>';
                       echo'</div>';
                    }
                 }
                ?>
              
              
            </div>
            </div>
           <div class="BookingCanceled">
           <div class="bkoptions">
                <div class="part1">
                <input type="text" name="search" class="search" id="searchCancel"placeholder="Search">
                </div>
                <div class="part2">
                    <input type="date" name="date" class="date" id="dateCancel">
                    <select name="Payment" class="Paymenttype" id="PaymentCancel">
                    <option value="PaymentType">Payment Type</option>
                     <option value="Upi">UPI</option>
                     <option value="Online">Online</option>
                     <option value="Credit">Credit card</option>
                     <option value="Debit">Debit card</option>
                     <option value="Bank">Bank Account</option>
                 </select>
                 <button class="btn" id="refresh"><i class="fa-solid fa-arrows-rotate"></i>Refresh</button>
                </div>
             
            </div>
            <div class="bookingslides" id="bookingslidescancel">
            <?php
                 $query="SELECT bookings.BookingId,bookings.SeatNo,bookings.SeatType,bookings.BookingDate,shows.Time,movies.MovieName,
                 shows.Language,shows.Date,shows.ScreenNo,shows.Date,shows.ScreenType,theaters.TheaterName,payment.PaymentId,
                 payment.PaymentMethod,uLogin.Name FROM bookings
                 INNER JOIN shows ON bookings.ShowId=shows.ShowId
                 INNER JOIN movies ON shows.MovieId=movies.MovieId
                 INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
                 INNER JOIN payment ON bookings.BookingId=payment.BookingId
                 INNER JOIN uLogin ON bookings.UserId=uLogin.UserId
                 where bookings.Status='Canceled'";
                 $result=mysqli_query($connect,$query);
                 if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                       echo'<div class="card">';
                       echo'<div class="part1">';
                       echo'<div class="booking">';
                       echo'<div class="bookingId">';
                       echo'<label>Booking Id: '.$row['BookingId'].'</label></div>';
                       echo'<div class="bookingDate">Booking Date: '.$row['BookingDate'].'</div>';
                       echo'</div>';
                       echo'<div class="PaymentDetail">';
                       echo'<div class="username">';
                       echo'<i class="fa-solid fa-user"></i><label>'.$row['Name'].'</label>';
                       echo'</div>';
                       echo'<div class="PamentMethod">';
                       echo'<label>Payment: '.$row['PaymentMethod'].'</label>';
                       echo'</div>';
                       echo'</div>';
                       echo'</div>';
                       echo'<span><label>Movie: '.$row['MovieName'].'&nbsp&nbsp'.$row['ScreenType'].'</label></span>';
                       echo'<span><label>Show on: '.$row['Date'].' at '.$row['Time'].'</label></span>';
                       echo'<span><label>Seat No: '.$row['SeatNo'].'&nbsp&nbsp'.$row['SeatType'].'</label></span>';
                       echo'<span><label>Language : '.$row['Language'].'</label></span>';
                       echo'<span><label>Theater: '.$row['TheaterName'].'</label></span>';
                       echo'<span><label>Screen No : '.$row['ScreenNo'].'</label></span>';
                       echo'</div>';
                    }
                 }
                ?>
            </div>
            </div>
            <div class="ActiveBookings">
            <div class="bkoptions">
                <div class="part1">
                <input type="text" name="search" class="search" placeholder="Search" id="SearchActive">
                </div>
                <div class="part2">
                    <input type="date" name="date" class="date" id="dateInput">
                    <select name="Payment" class="Paymenttype" id='payment'>
                    <option value="PaymentType">Payment Type</option>
                     <option value="Upi">UPI</option>
                     <option value="Online">Online</option>
                     <option value="Credit card">Credit card</option>
                     <option value="Debit card">Debit card</option>
                     <option value="Bank Account">Bank Account</option>
                 </select>
                 <button class="btn" id="ActiveRefresh"><i class="fa-solid fa-arrows-rotate"></i>Refresh</button>
                </div>
             
            </div>
            <div class="bookingslides" id="bookingslidesActive">
                <?php
                 $query="SELECT bookings.BookingId,bookings.SeatNo,bookings.SeatType,bookings.BookingDate,shows.Time,movies.MovieName,
                 shows.Language,shows.Date,shows.ScreenNo,shows.Date,shows.ScreenType,theaters.TheaterName,payment.PaymentId,
                 payment.PaymentMethod,uLogin.Name FROM bookings
                 INNER JOIN shows ON bookings.ShowId=shows.ShowId
                 INNER JOIN movies ON shows.MovieId=movies.MovieId
                 INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
                 INNER JOIN payment ON bookings.BookingId=payment.BookingId
                 INNER JOIN uLogin ON bookings.UserId=uLogin.UserId
                 where bookings.Status='Active'";
                 $result=mysqli_query($connect,$query);
                 if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                       echo'<div class="card">';
                       echo'<div class="part1">';
                       echo'<div class="booking">';
                       echo'<div class="bookingId">';
                       echo'<label>Booking Id: '.$row['BookingId'].'</label></div>';
                       echo'<div class="bookingDate">Booking Date: '.$row['BookingDate'].'</div>';
                       echo'</div>';
                       echo'<div class="PaymentDetail">';
                       echo'<div class="username">';
                       echo'<i class="fa-solid fa-user"></i><label>'.$row['Name'].'</label>';
                       echo'</div>';
                       echo'<div class="PamentMethod">';
                       echo'<label>Payment: '.$row['PaymentMethod'].'</label>';
                       echo'</div>';
                       echo'</div>';
                       echo'</div>';
                       echo'<span><label>Movie: '.$row['MovieName'].'&nbsp&nbsp'.$row['ScreenType'].'</label></span>';
                       echo'<span><label>Show on: '.$row['Date'].' at '.$row['Time'].'</label></span>';
                       echo'<span><label>Seat No: '.$row['SeatNo'].'&nbsp&nbsp'.$row['SeatType'].'</label></span>';
                       echo'<span><label>Language : '.$row['Language'].'</label></span>';
                       echo'<span><label>Theater: '.$row['TheaterName'].'</label></span>';
                       echo'<span><label>Screen No : '.$row['ScreenNo'].'</label></span>';
                       echo'</div>';
                    }
                 }
                ?> 
            </div>
            </div>
           </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
    </form>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#SearchActive').keyup(function(){
         var query=$(this).val();
        if(query!=''){
            $.ajax({
              url:"getBookings.php",
              method:"POST",
              data:{query:query},
              success:function(data){
                $('#bookingslidesActive').html(data);
               // console.log(data);
              } ,
              error: function(xhr, status, error) {
         console.log(status);
   }
            });
        }else{
            location.reload(true)  
        }
    });

    $('#ActiveRefresh').click(function(){
        location.reload(true)
    });
    $(".date").change(function(){
          var date = $('#dateInput').val();
          $.ajax({
              type: "POST",
              url: "getBookings.php",
              data: { date : date } ,
              success:function(data){
                 $('#bookingslidesActive').html(data);
                  //console.log(data); 
              } ,
              error: function(xhr, status, error) {
         console.log(status);
            }
        });
      }); 
      $("select#payment").change(function(){
          var Paymenttype= $("#payment option:selected").val();
          console.log(Paymenttype); 
          $.ajax({
              type: "POST",
              url: "getBookings.php",
              data: { Paymenttype: Paymenttype } ,
              success:function(data){
                $('#bookingslidesActive').html(data);
                  console.log(data); 
              } ,
              error: function(xhr, status, error) {
         console.log(status);
            }
        });
      });
      //-----------------History-------------
      $('#search_history').keyup(function(){
         var query=$(this).val();
        if(query!=''){
            $.ajax({
              url:"getBookings.php",
              method:"POST",
              data:{queryhistory:query},
              success:function(data){
                $('#bookingslideshistory').html(data);
               // console.log(data);
              } ,
              error: function(xhr, status, error) {
         console.log(status);
   }
            });
        }else{
            location.reload(true)  
        }
    });
    $("#date_history").change(function(){
          var date = $('#date_history').val();
          $.ajax({
              type: "POST",
              url: "getBookings.php",
              data: { datehistory : date } ,
              success:function(data){
                 $('#bookingslideshistory').html(data);
                  //console.log(data); 
              } ,
              error: function(xhr, status, error) {
         console.log(status);
            }
        });
      }); 
      $("select#Paymenttype_history").change(function(){
          var Paymenttype= $("#Paymenttype_history option:selected").val();
          console.log(Paymenttype); 
          $.ajax({
              type: "POST",
              url: "getBookings.php",
              data: { Paymenttypehistory: Paymenttype } ,
              success:function(data){
                $('#bookingslideshistory').html(data);
                  console.log(data); 
              } ,
              error: function(xhr, status, error) {
         console.log(status);
            }
        });
    });
    //-------------------------History End--------------------------
      //-----------------Cancel-------------
      $('#searchCancel').keyup(function(){
         var query=$(this).val();
        if(query!=''){
            $.ajax({
              url:"getBookings.php",
              method:"POST",
              data:{querycancel:query},
              success:function(data){
                $('#bookingslidescancel').html(data);
               // console.log(data);
              } ,
              error: function(xhr, status, error) {
         console.log(status);
   }
            });
        }else{
            location.reload(true)  
        }
    });
    $("#dateCancel").change(function(){
          var date = $('#dateCancel').val();
          $.ajax({
              type: "POST",
              url: "getBookings.php",
              data: { dateCancel : date } ,
              success:function(data){
                 $('#bookingslidescancel').html(data);
                  //console.log(data); 
              } ,
              error: function(xhr, status, error) {
         console.log(status);
            }
        });
      }); 
      $("select#PaymentCancel").change(function(){
          var Paymenttype= $("#PaymentCancel option:selected").val();
          console.log(Paymenttype); 
          $.ajax({
              type: "POST",
              url: "getBookings.php",
              data: { PaymenttypeCancel: Paymenttype } ,
              success:function(data){
                $('#bookingslidescancel').html(data);
                  console.log(data); 
              } ,
              error: function(xhr, status, error) {
         console.log(status);
            }
        });
    });
    //-------------------------Cancel End--------------------------
});
</script>