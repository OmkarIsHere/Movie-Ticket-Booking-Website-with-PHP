<?php
include 'Connection.php';
if(isset($_POST["query"])){
   $output="";
    $query="SELECT bookings.BookingId,bookings.SeatNo,bookings.SeatType,bookings.BookingDate,shows.Time,movies.MovieName,
    shows.Language,shows.Date,shows.ScreenNo,shows.Date,shows.ScreenType,theaters.TheaterName,payment.PaymentId,
    payment.PaymentMethod,uLogin.Name FROM bookings
    INNER JOIN shows ON bookings.ShowId=shows.ShowId
    INNER JOIN movies ON shows.MovieId=movies.MovieId
    INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
    INNER JOIN payment ON bookings.BookingId=payment.BookingId
    INNER JOIN uLogin ON bookings.UserId=uLogin.UserId
    where bookings.Status='Active' and uLogin.Name LIKE '%".$_POST["query"]."%' " ;
    $result=mysqli_query($connect,$query);
    if(mysqli_num_rows($result)>0){
       while($row=mysqli_fetch_array($result)){
        $output.='<div class="card">';
        $output.='<div class="part1">';
        $output.='<div class="booking">';
        $output.='<div class="bookingId">';
        $output.='<label>Booking Id: '.$row['BookingId'].'</label></div>';
        $output.='<div class="bookingDate">Booking Date: '.$row['BookingDate'].'</div>';
        $output.='</div>';
        $output.='<div class="PaymentDetail">';
        $output.='<div class="username">';
        $output.='<i class="fa-solid fa-user"></i><label>'.$row['Name'].'</label>';
        $output.='</div>';
        $output.='<div class="PamentMethod">';
        $output.='<label>Payment: '.$row['PaymentMethod'].'</label>';
        $output.='</div>';
        $output.='</div>';
        $output.='</div>';
        $output.='<span><label>Movie: '.$row['MovieName'].'&nbsp&nbsp'.$row['ScreenType'].'</label></span>';
        $output.='<span><label>Show on: '.$row['Date'].' at '.$row['Time'].'</label></span>';
        $output.='<span><label>Seat No: '.$row['SeatNo'].'&nbsp&nbsp'.$row['SeatType'].'</label></span>';
        $output.='<span><label>Language : '.$row['Language'].'</label></span>';
        $output.='<span><label>Theater: '.$row['TheaterName'].'</label></span>';
        $output.='<span><label>Screen No : '.$row['ScreenNo'].'</label></span>';
        $output.='</div>';
       }
    }
echo $output;
}
if(isset($_POST["date"])){
    $output="";
     $query="SELECT bookings.BookingId,bookings.SeatNo,bookings.SeatType,bookings.BookingDate,shows.Time,movies.MovieName,
     shows.Language,shows.Date,shows.ScreenNo,shows.Date,shows.ScreenType,theaters.TheaterName,payment.PaymentId,
     payment.PaymentMethod,uLogin.Name FROM bookings
     INNER JOIN shows ON bookings.ShowId=shows.ShowId
     INNER JOIN movies ON shows.MovieId=movies.MovieId
     INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
     INNER JOIN payment ON bookings.BookingId=payment.BookingId
     INNER JOIN uLogin ON bookings.UserId=uLogin.UserId
     where bookings.Status='Active' and bookings.BookingDate='".$_POST["date"]."'" ;
     $result=mysqli_query($connect,$query);
     if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
         $output.='<div class="card">';
         $output.='<div class="part1">';
         $output.='<div class="booking">';
         $output.='<div class="bookingId">';
         $output.='<label>Booking Id: '.$row['BookingId'].'</label></div>';
         $output.='<div class="bookingDate">Booking Date: '.$row['BookingDate'].'</div>';
         $output.='</div>';
         $output.='<div class="PaymentDetail">';
         $output.='<div class="username">';
         $output.='<i class="fa-solid fa-user"></i><label>'.$row['Name'].'</label>';
         $output.='</div>';
         $output.='<div class="PamentMethod">';
         $output.='<label>Payment: '.$row['PaymentMethod'].'</label>';
         $output.='</div>';
         $output.='</div>';
         $output.='</div>';
         $output.='<span><label>Movie: '.$row['MovieName'].'&nbsp&nbsp'.$row['ScreenType'].'</label></span>';
         $output.='<span><label>Show on: '.$row['Date'].' at '.$row['Time'].'</label></span>';
         $output.='<span><label>Seat No: '.$row['SeatNo'].'&nbsp&nbsp'.$row['SeatType'].'</label></span>';
         $output.='<span><label>Language : '.$row['Language'].'</label></span>';
         $output.='<span><label>Theater: '.$row['TheaterName'].'</label></span>';
         $output.='<span><label>Screen No : '.$row['ScreenNo'].'</label></span>';
         $output.='</div>';
        }
     }
 echo $output;
 }
 if(isset($_POST["Paymenttype"])){
    $output="";
     $query="SELECT bookings.BookingId,bookings.SeatNo,bookings.SeatType,bookings.BookingDate,shows.Time,movies.MovieName,
     shows.Language,shows.Date,shows.ScreenNo,shows.Date,shows.ScreenType,theaters.TheaterName,payment.PaymentId,
     payment.PaymentMethod,uLogin.Name FROM bookings
     INNER JOIN shows ON bookings.ShowId=shows.ShowId
     INNER JOIN movies ON shows.MovieId=movies.MovieId
     INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
     INNER JOIN payment ON bookings.BookingId=payment.BookingId
     INNER JOIN uLogin ON bookings.UserId=uLogin.UserId
     where bookings.Status='Active' and payment.PaymentMethod='".$_POST["Paymenttype"]."'" ;
     $result=mysqli_query($connect,$query);
     if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
         $output.='<div class="card">';
         $output.='<div class="part1">';
         $output.='<div class="booking">';
         $output.='<div class="bookingId">';
         $output.='<label>Booking Id: '.$row['BookingId'].'</label></div>';
         $output.='<div class="bookingDate">Booking Date: '.$row['BookingDate'].'</div>';
         $output.='</div>';
         $output.='<div class="PaymentDetail">';
         $output.='<div class="username">';
         $output.='<i class="fa-solid fa-user"></i><label>'.$row['Name'].'</label>';
         $output.='</div>';
         $output.='<div class="PamentMethod">';
         $output.='<label>Payment: '.$row['PaymentMethod'].'</label>';
         $output.='</div>';
         $output.='</div>';
         $output.='</div>';
         $output.='<span><label>Movie: '.$row['MovieName'].'&nbsp&nbsp'.$row['ScreenType'].'</label></span>';
         $output.='<span><label>Show on: '.$row['Date'].' at '.$row['Time'].'</label></span>';
         $output.='<span><label>Seat No: '.$row['SeatNo'].'&nbsp&nbsp'.$row['SeatType'].'</label></span>';
         $output.='<span><label>Language : '.$row['Language'].'</label></span>';
         $output.='<span><label>Theater: '.$row['TheaterName'].'</label></span>';
         $output.='<span><label>Screen No : '.$row['ScreenNo'].'</label></span>';
         $output.='</div>';
        }
     }
 echo $output;
 }
 if(isset($_POST["queryhistory"])){
   $output="";
    $query="SELECT bookings.BookingId,bookings.SeatNo,bookings.SeatType,bookings.BookingDate,shows.Time,movies.MovieName,
    shows.Language,shows.Date,shows.ScreenNo,shows.Date,shows.ScreenType,theaters.TheaterName,payment.PaymentId,
    payment.PaymentMethod,uLogin.Name FROM bookings
    INNER JOIN shows ON bookings.ShowId=shows.ShowId
    INNER JOIN movies ON shows.MovieId=movies.MovieId
    INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
    INNER JOIN payment ON bookings.BookingId=payment.BookingId
    INNER JOIN uLogin ON bookings.UserId=uLogin.UserId
    where bookings.Status='Inactive' and uLogin.Name LIKE '%".$_POST["queryhistory"]."%' " ;
    $result=mysqli_query($connect,$query);
    if(mysqli_num_rows($result)>0){
       while($row=mysqli_fetch_array($result)){
        $output.='<div class="card">';
        $output.='<div class="part1">';
        $output.='<div class="booking">';
        $output.='<div class="bookingId">';
        $output.='<label>Booking Id: '.$row['BookingId'].'</label></div>';
        $output.='<div class="bookingDate">Booking Date: '.$row['BookingDate'].'</div>';
        $output.='</div>';
        $output.='<div class="PaymentDetail">';
        $output.='<div class="username">';
        $output.='<i class="fa-solid fa-user"></i><label>'.$row['Name'].'</label>';
        $output.='</div>';
        $output.='<div class="PamentMethod">';
        $output.='<label>Payment: '.$row['PaymentMethod'].'</label>';
        $output.='</div>';
        $output.='</div>';
        $output.='</div>';
        $output.='<span><label>Movie: '.$row['MovieName'].'&nbsp&nbsp'.$row['ScreenType'].'</label></span>';
        $output.='<span><label>Show on: '.$row['Date'].' at '.$row['Time'].'</label></span>';
        $output.='<span><label>Seat No: '.$row['SeatNo'].'&nbsp&nbsp'.$row['SeatType'].'</label></span>';
        $output.='<span><label>Language : '.$row['Language'].'</label></span>';
        $output.='<span><label>Theater: '.$row['TheaterName'].'</label></span>';
        $output.='<span><label>Screen No : '.$row['ScreenNo'].'</label></span>';
        $output.='</div>';
       }
    }
echo $output;
}
if(isset($_POST["datehistory"])){
   $output="";
    $query="SELECT bookings.BookingId,bookings.SeatNo,bookings.SeatType,bookings.BookingDate,shows.Time,movies.MovieName,
    shows.Language,shows.Date,shows.ScreenNo,shows.Date,shows.ScreenType,theaters.TheaterName,payment.PaymentId,
    payment.PaymentMethod,uLogin.Name FROM bookings
    INNER JOIN shows ON bookings.ShowId=shows.ShowId
    INNER JOIN movies ON shows.MovieId=movies.MovieId
    INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
    INNER JOIN payment ON bookings.BookingId=payment.BookingId
    INNER JOIN uLogin ON bookings.UserId=uLogin.UserId
    where bookings.Status='Inactive' and bookings.BookingDate='".$_POST["datehistory"]."'" ;
    $result=mysqli_query($connect,$query);
    if(mysqli_num_rows($result)>0){
       while($row=mysqli_fetch_array($result)){
        $output.='<div class="card">';
        $output.='<div class="part1">';
        $output.='<div class="booking">';
        $output.='<div class="bookingId">';
        $output.='<label>Booking Id: '.$row['BookingId'].'</label></div>';
        $output.='<div class="bookingDate">Booking Date: '.$row['BookingDate'].'</div>';
        $output.='</div>';
        $output.='<div class="PaymentDetail">';
        $output.='<div class="username">';
        $output.='<i class="fa-solid fa-user"></i><label>'.$row['Name'].'</label>';
        $output.='</div>';
        $output.='<div class="PamentMethod">';
        $output.='<label>Payment: '.$row['PaymentMethod'].'</label>';
        $output.='</div>';
        $output.='</div>';
        $output.='</div>';
        $output.='<span><label>Movie: '.$row['MovieName'].'&nbsp&nbsp'.$row['ScreenType'].'</label></span>';
        $output.='<span><label>Show on: '.$row['Date'].' at '.$row['Time'].'</label></span>';
        $output.='<span><label>Seat No: '.$row['SeatNo'].'&nbsp&nbsp'.$row['SeatType'].'</label></span>';
        $output.='<span><label>Language : '.$row['Language'].'</label></span>';
        $output.='<span><label>Theater: '.$row['TheaterName'].'</label></span>';
        $output.='<span><label>Screen No : '.$row['ScreenNo'].'</label></span>';
        $output.='</div>';
       }
    }
echo $output;
}
if(isset($_POST["Paymenttypehistory"])){
   $output="";
    $query="SELECT bookings.BookingId,bookings.SeatNo,bookings.SeatType,bookings.BookingDate,shows.Time,movies.MovieName,
    shows.Language,shows.Date,shows.ScreenNo,shows.Date,shows.ScreenType,theaters.TheaterName,payment.PaymentId,
    payment.PaymentMethod,uLogin.Name FROM bookings
    INNER JOIN shows ON bookings.ShowId=shows.ShowId
    INNER JOIN movies ON shows.MovieId=movies.MovieId
    INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
    INNER JOIN payment ON bookings.BookingId=payment.BookingId
    INNER JOIN uLogin ON bookings.UserId=uLogin.UserId
    where bookings.Status='Inactive' and payment.PaymentMethod='".$_POST["Paymenttypehistory"]."'" ;
    $result=mysqli_query($connect,$query);
    if(mysqli_num_rows($result)>0){
       while($row=mysqli_fetch_array($result)){
        $output.='<div class="card">';
        $output.='<div class="part1">';
        $output.='<div class="booking">';
        $output.='<div class="bookingId">';
        $output.='<label>Booking Id: '.$row['BookingId'].'</label></div>';
        $output.='<div class="bookingDate">Booking Date: '.$row['BookingDate'].'</div>';
        $output.='</div>';
        $output.='<div class="PaymentDetail">';
        $output.='<div class="username">';
        $output.='<i class="fa-solid fa-user"></i><label>'.$row['Name'].'</label>';
        $output.='</div>';
        $output.='<div class="PamentMethod">';
        $output.='<label>Payment: '.$row['PaymentMethod'].'</label>';
        $output.='</div>';
        $output.='</div>';
        $output.='</div>';
        $output.='<span><label>Movie: '.$row['MovieName'].'&nbsp&nbsp'.$row['ScreenType'].'</label></span>';
        $output.='<span><label>Show on: '.$row['Date'].' at '.$row['Time'].'</label></span>';
        $output.='<span><label>Seat No: '.$row['SeatNo'].'&nbsp&nbsp'.$row['SeatType'].'</label></span>';
        $output.='<span><label>Language : '.$row['Language'].'</label></span>';
        $output.='<span><label>Theater: '.$row['TheaterName'].'</label></span>';
        $output.='<span><label>Screen No : '.$row['ScreenNo'].'</label></span>';
        $output.='</div>';
       }
    }
echo $output;
}
if(isset($_POST["querycancel"])){
   $output="";
    $query="SELECT bookings.BookingId,bookings.SeatNo,bookings.SeatType,bookings.BookingDate,shows.Time,movies.MovieName,
    shows.Language,shows.Date,shows.ScreenNo,shows.Date,shows.ScreenType,theaters.TheaterName,payment.PaymentId,
    payment.PaymentMethod,uLogin.Name FROM bookings
    INNER JOIN shows ON bookings.ShowId=shows.ShowId
    INNER JOIN movies ON shows.MovieId=movies.MovieId
    INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
    INNER JOIN payment ON bookings.BookingId=payment.BookingId
    INNER JOIN uLogin ON bookings.UserId=uLogin.UserId
    where bookings.Status='Canceled' and uLogin.Name LIKE '%".$_POST["querycancel"]."%' " ;
    $result=mysqli_query($connect,$query);
    if(mysqli_num_rows($result)>0){
       while($row=mysqli_fetch_array($result)){
        $output.='<div class="card">';
        $output.='<div class="part1">';
        $output.='<div class="booking">';
        $output.='<div class="bookingId">';
        $output.='<label>Booking Id: '.$row['BookingId'].'</label></div>';
        $output.='<div class="bookingDate">Booking Date: '.$row['BookingDate'].'</div>';
        $output.='</div>';
        $output.='<div class="PaymentDetail">';
        $output.='<div class="username">';
        $output.='<i class="fa-solid fa-user"></i><label>'.$row['Name'].'</label>';
        $output.='</div>';
        $output.='<div class="PamentMethod">';
        $output.='<label>Payment: '.$row['PaymentMethod'].'</label>';
        $output.='</div>';
        $output.='</div>';
        $output.='</div>';
        $output.='<span><label>Movie: '.$row['MovieName'].'&nbsp&nbsp'.$row['ScreenType'].'</label></span>';
        $output.='<span><label>Show on: '.$row['Date'].' at '.$row['Time'].'</label></span>';
        $output.='<span><label>Seat No: '.$row['SeatNo'].'&nbsp&nbsp'.$row['SeatType'].'</label></span>';
        $output.='<span><label>Language : '.$row['Language'].'</label></span>';
        $output.='<span><label>Theater: '.$row['TheaterName'].'</label></span>';
        $output.='<span><label>Screen No : '.$row['ScreenNo'].'</label></span>';
        $output.='</div>';
       }
    }
echo $output;
}
if(isset($_POST["dateCancel"])){
   $output="";
    $query="SELECT bookings.BookingId,bookings.SeatNo,bookings.SeatType,bookings.BookingDate,shows.Time,movies.MovieName,
    shows.Language,shows.Date,shows.ScreenNo,shows.Date,shows.ScreenType,theaters.TheaterName,payment.PaymentId,
    payment.PaymentMethod,uLogin.Name FROM bookings
    INNER JOIN shows ON bookings.ShowId=shows.ShowId
    INNER JOIN movies ON shows.MovieId=movies.MovieId
    INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
    INNER JOIN payment ON bookings.BookingId=payment.BookingId
    INNER JOIN uLogin ON bookings.UserId=uLogin.UserId
    where bookings.Status='Canceled' and bookings.BookingDate='".$_POST["dateCancel"]."'" ;
    $result=mysqli_query($connect,$query);
    if(mysqli_num_rows($result)>0){
       while($row=mysqli_fetch_array($result)){
        $output.='<div class="card">';
        $output.='<div class="part1">';
        $output.='<div class="booking">';
        $output.='<div class="bookingId">';
        $output.='<label>Booking Id: '.$row['BookingId'].'</label></div>';
        $output.='<div class="bookingDate">Booking Date: '.$row['BookingDate'].'</div>';
        $output.='</div>';
        $output.='<div class="PaymentDetail">';
        $output.='<div class="username">';
        $output.='<i class="fa-solid fa-user"></i><label>'.$row['Name'].'</label>';
        $output.='</div>';
        $output.='<div class="PamentMethod">';
        $output.='<label>Payment: '.$row['PaymentMethod'].'</label>';
        $output.='</div>';
        $output.='</div>';
        $output.='</div>';
        $output.='<span><label>Movie: '.$row['MovieName'].'&nbsp&nbsp'.$row['ScreenType'].'</label></span>';
        $output.='<span><label>Show on: '.$row['Date'].' at '.$row['Time'].'</label></span>';
        $output.='<span><label>Seat No: '.$row['SeatNo'].'&nbsp&nbsp'.$row['SeatType'].'</label></span>';
        $output.='<span><label>Language : '.$row['Language'].'</label></span>';
        $output.='<span><label>Theater: '.$row['TheaterName'].'</label></span>';
        $output.='<span><label>Screen No : '.$row['ScreenNo'].'</label></span>';
        $output.='</div>';
       }
    }
echo $output;
}
if(isset($_POST["PaymenttypeCancel"])){
   $output="";
    $query="SELECT bookings.BookingId,bookings.SeatNo,bookings.SeatType,bookings.BookingDate,shows.Time,movies.MovieName,
    shows.Language,shows.Date,shows.ScreenNo,shows.Date,shows.ScreenType,theaters.TheaterName,payment.PaymentId,
    payment.PaymentMethod,uLogin.Name FROM bookings
    INNER JOIN shows ON bookings.ShowId=shows.ShowId
    INNER JOIN movies ON shows.MovieId=movies.MovieId
    INNER JOIN theaters ON shows.TheaterId=theaters.TheaterId
    INNER JOIN payment ON bookings.BookingId=payment.BookingId
    INNER JOIN uLogin ON bookings.UserId=uLogin.UserId
    where bookings.Status='Canceled' and payment.PaymentMethod='".$_POST["PaymenttypeCancel"]."'" ;
    $result=mysqli_query($connect,$query);
    if(mysqli_num_rows($result)>0){
       while($row=mysqli_fetch_array($result)){
        $output.='<div class="card">';
        $output.='<div class="part1">';
        $output.='<div class="booking">';
        $output.='<div class="bookingId">';
        $output.='<label>Booking Id: '.$row['BookingId'].'</label></div>';
        $output.='<div class="bookingDate">Booking Date: '.$row['BookingDate'].'</div>';
        $output.='</div>';
        $output.='<div class="PaymentDetail">';
        $output.='<div class="username">';
        $output.='<i class="fa-solid fa-user"></i><label>'.$row['Name'].'</label>';
        $output.='</div>';
        $output.='<div class="PamentMethod">';
        $output.='<label>Payment: '.$row['PaymentMethod'].'</label>';
        $output.='</div>';
        $output.='</div>';
        $output.='</div>';
        $output.='<span><label>Movie: '.$row['MovieName'].'&nbsp&nbsp'.$row['ScreenType'].'</label></span>';
        $output.='<span><label>Show on: '.$row['Date'].' at '.$row['Time'].'</label></span>';
        $output.='<span><label>Seat No: '.$row['SeatNo'].'&nbsp&nbsp'.$row['SeatType'].'</label></span>';
        $output.='<span><label>Language : '.$row['Language'].'</label></span>';
        $output.='<span><label>Theater: '.$row['TheaterName'].'</label></span>';
        $output.='<span><label>Screen No : '.$row['ScreenNo'].'</label></span>';
        $output.='</div>';
       }
    }
echo $output;
}
?>