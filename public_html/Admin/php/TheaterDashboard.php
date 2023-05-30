<?php
session_start();
 include 'Connection.php';
 $username=$_SESSION['Thusername'];
 if($username==""){
    header('Location:TheaterLogin.php');
  }

  $query2="Select TheaterID from theaterCredentials where Theatername='".$username."'";
 $result2 = mysqli_query($connect, $query2);
 $MyTheaterId=0;
 while($row = mysqli_fetch_array($result2))
{
 $MyTheaterId=$row["TheaterID"];
}
echo"<script>console.log($MyTheaterId)</script>";
$query = "SELECT  BookingDate ,COUNT(BookingId)
FROM bookings 
INNER JOIN shows on bookings.ShowId=shows.ShowId
INNER JOIN theaters on shows.TheaterId=theaters.TheaterId
 where theaters.TheaterId='". $MyTheaterId."' GROUP BY BookingDate;";
$result = mysqli_query($connect, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{

  $chart_data .= "{ date:'".$row["BookingDate"]."', bookings:".$row["COUNT(BookingId)"]."}, ";
}
 $chart_data = substr($chart_data, 0, -2);
 //-------------------------------------------------------------------------------
 $query2 = "SELECT  payment.Time ,Sum(Amount)
 FROM payment 
 INNER JOIN bookings on payment.BookingId=bookings.BookingId
 INNER JOIN shows on bookings.ShowId=shows.ShowId
 INNER JOIN theaters on shows.TheaterId=theaters.TheaterId
 where theaters.TheaterId='".$MyTheaterId."' GROUP BY payment.Time ";
$result2 = mysqli_query($connect, $query2);
$mychart_data = '';
while($row = mysqli_fetch_array($result2))
{ $mychart_data.= "{ date:'".$row['Time']."', revenue:".$row["Sum(Amount)"]."}, ";
}
 $mychart_data = substr($mychart_data, 0, -2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieTime</title>
    <link rel="stylesheet" href="../Css/TheaterDashboard.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
2 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
3 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
4 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
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
          unset( $_SESSION['Thusername']);
        header('Location:TheaterLogin.php');
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
                <span class="slideLine"></span>
                <li class="opt" id="active"><i class="fa-solid fa-bars"></i>Dashboard</li>
                <li class="opt" onclick="window.location.href='TheaterMovies.php'"><i class="fa-solid fa-film"></i>Movies</li>
                <li class="opt" onclick="window.location.href='scan.php'"><i class="fa-solid fa-qrcode"></i>Scan</li>
                <!-- <li class="opt" onclick="window.location.href=''"><i class="fa-solid fa-arrow-up-right-dots"></i>Statistics</li> -->
                <div class="theaterImage">
                <?php
                $TheaterName="";
                $TheatreAddress="";
                $city="";
                $NoOfScreen="";
                $screenTypes="";
                $seatTypes="";
                    $query="Select * from theaters where TheaterId='".$MyTheaterId."'";
                        $result=mysqli_query($connect,$query);
                            if(mysqli_num_rows($result)>0){
                            while($row=mysqli_fetch_array($result)){
                                $TheaterName=$row["TheaterName"];
                                $TheatreAddress=$row["TheaterAddress"];
                                $city=$row["City"];
                                $NoOfScreen=$row["NoOfScreens"];
                                $screenTypes=$row["ScreenTypes"];
                                $seatTypes=$row["SeatTypes"];

                            echo '<img src="data:image/jpg;base64,'.($row['TheaterImages']).'" alt="TheaterImage">';
            }
            }
            ?>
                </div>
            </ul>
        </div>
        <div class="Websitedetails">
            <div class="Sitedetails">
                <div class="rows heading">
                 <div class="items"><h3>Name : <?php echo strtoupper($TheaterName)?></h3></div>
                 <div class="items"><h3>Address : <?php echo strtoupper($TheatreAddress)?></h3></div>
                 <div class="items"><h3>City : <?php echo strtoupper($city)?></h3></div>
                </div>
                <div class="rows">
                    <div class="panel4">
                        <h3><i class="fa-solid fa-masks-theater"></i>No of Screens</h3>
                        </br>
                        <h4><?php echo $NoOfScreen?></h4>
                    </div>
                    <div class="panel5">
                        <h3><i class="fa-solid fa-users-rectangle"></i>Screen Types</h3>
                        </br>
                        <h4><?php echo str_replace(",","•",$screenTypes)?></h4>
                    </div>
                    <div class="panel6">
                        <h3><i class="fa-solid fa-couch"></i>Seat Types</h3>
                        </br>
                        <h4><?php echo str_replace(",","•",$seatTypes)?></h4>
                    </div>
                </div>
                <div class="rows">
                    <div class="panel7">
                        <h3><i class="fa-solid fa-indian-rupee-sign"></i>Revenue</h3>
                        </br>
                        <?php
                        $x=0;
                        $query="SELECT   Sum(Amount) FROM payment
                        INNER JOIN  bookings on payment.BookingId=bookings.BookingId
                        INNER JOIN shows on bookings.ShowId=shows.ShowId
                        INNER JOIN theaters on shows.TheaterId=theaters.TheaterId
                        where theaters.TheaterId=".$MyTheaterId."";
                        $result=mysqli_query($connect,$query);
                        if(mysqli_num_rows($result)){
                            while($row=mysqli_fetch_array($result)){
                                $x=$row['Sum(Amount)'];
                            }
                            
                        }
                        echo "<h4>".$x."</h4>";
                        ?>
                    </div>
                    <div class="panel8">
                        <h3><i class="fa-solid fa-ticket"></i>Booking</h3>
                        </br>
                        <?php
                        $x=0;
                        $query="SELECT   COUNT(bookings.BookingId) FROM bookings
                        INNER JOIN shows on bookings.ShowId=shows.ShowId
                        INNER JOIN theaters on shows.TheaterId=theaters.TheaterId
                        where theaters.TheaterId=".$MyTheaterId." and bookings.status='Active'";
                        $result=mysqli_query($connect,$query);
                        if(mysqli_num_rows($result)){
                            while($row=mysqli_fetch_array($result)){
                                $x=$row['COUNT(bookings.BookingId)'];
                            }
                            
                        }
                        echo "<h4>".$x."</h4>";
                        ?>
                    </div>
                    <div class="panel9">
                        <h3>Languages</h3>
                        </br>
                        <h4>15</h4>
                    </div>
                </div>
            </div>
            <div class="graphs">
                <div class="datechooserContainer">
                   <h3 style="color:white; margin-left:20px; font-size:20px">Statistics</h3>
                </div>
                <div class="graphscontainer">
                    <div class="graphdiagram">
                    <div class="Bookingsheading">
                            <h6>Revenue</h6>
                        </div>
                        <div class="bookingsGraph">
                            <div id="chart"></div>
                        </div>
                    </div>
                    <div class="graphdiagram">
                        <div class="Bookingsheading">
                            <h6>Bookings</h6>
                        </div>
                        <div class="bookingsGraph">
                            <div id="chart2"></div>
                        </div>
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
   Morris.Line({
    element: 'chart',
    data:  [<?php echo $mychart_data; ?>],
	xkey: 'date',
    xLabel:'day',
	ykeys: ['revenue'],
	labels: ['Revenue'],
    
});
Morris.Line({
    element: 'chart2',
    data:  [<?php echo $chart_data; ?>],
	xkey: 'date',
    xLabel:'day',
	ykeys: ['bookings'],
	labels: ['Bookings'],
    
});
</script>