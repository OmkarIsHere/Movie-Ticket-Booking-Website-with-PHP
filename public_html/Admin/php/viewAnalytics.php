<?php
include('Connection.php');
session_start();
 $username=$_SESSION['username'];
 if($username==""){
   header('Location:AdminLogin.php');
 }
 $theaterId=$_GET['theaterid'];
$query = "SELECT  BookingDate ,COUNT(BookingId)
FROM bookings 
INNER JOIN shows on bookings.ShowId=shows.ShowId
INNER JOIN theaters on shows.TheaterId=theaters.TheaterId
 where theaters.TheaterId='". $theaterId."' GROUP BY BookingDate;";
$result = mysqli_query($connect, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{

  $chart_data .= "{ date:'".$row["BookingDate"]."', bookings:".$row["COUNT(BookingId)"]."}, ";
}
 $chart_data = substr($chart_data, 0, -2);
//---------------------------------------------------------------------------------------
 $query2 = "SELECT  payment.Time ,Sum(Amount)
 FROM payment 
 INNER JOIN bookings on payment.BookingId=bookings.BookingId
 INNER JOIN shows on bookings.ShowId=shows.ShowId
 INNER JOIN theaters on shows.TheaterId=theaters.TheaterId
 where theaters.TheaterId='". $theaterId."' GROUP BY payment.Time ";
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
    <link rel="stylesheet" href="../Css/viewAnalytics.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
2 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
3 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
4 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>

<body>
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
            <li class="opt" onclick="window.location.href='AdminDashboard.php'"><i class="fa-solid fa-bars"></i>Dashboard</li>
                <li class="opt" onclick="window.location.href='AdminMovies.php'"><i class="fa-solid fa-film"></i>Movies</li>
                <li class="opt active" onclick="window.location.href='theaters.php'">
                    </i><i class="fa-solid fa-building"></i>Theaters</li>
                <li class="opt"  onclick="window.location.href='Review.php'"><i class="fa-regular fa-star"></i>Reviews</li>
                <li class="opt" onclick="window.location.href='CheckBooking.php'"><i class="fa-solid fa-ticket"></i>Bookings</li>
                <li class="opt" onclick="window.location.href='giftCard.php'"><i class="fa-solid fa-gifts"></i>Gift Cards</li>
                <li class="opt" onclick="window.location.href='User.php'"><i class="fa-solid fa-users"></i>User</li>
            </ul>
        </div>
        <div class="Websitedetails">
            <div class="Sitedetails">
                <div class="theaterName">
                    <?php
                    $theaterId=$_GET['theaterid'];
                    $query="Select TheaterName from theaters where TheaterId='".$theaterId."' ";
                     $result=mysqli_query($connect,$query);
                 if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                     echo" <h3>".$row['TheaterName']."</h3>";
                    }
                 }

                    ?>
                   
                </div>
                <div class="rows">
                    <div class="panel1">
                        <h3>Movies</h3>
                        </br>
                        <?php
                        $x=0;
                        $theaterId=$_GET['theaterid'];
                        $query="SELECT COUNT(shows.ShowId) from shows
                        where shows.TheaterId='".$theaterId."';";
                        $result=mysqli_query($connect,$query);
                        if(mysqli_num_rows($result)){
                            while($row=mysqli_fetch_array($result)){
                                $x=$row['COUNT(shows.ShowId)'];
                            }
                            
                        }
                        echo "<h4>".$x."</h4>";
                        ?>
                    </div>
                    <div class="panel2">
                        <h3>No.Screen</h3>
                        </br>
                        <?php
                        $x=0;
                        $theaterId=$_GET['theaterid'];
                        $query="SELECT NoOfScreens from theaters
                        where theaters.TheaterId='".$theaterId."';";
                        $result=mysqli_query($connect,$query);
                        if(mysqli_num_rows($result)){
                            while($row=mysqli_fetch_array($result)){
                                $x=$row['NoOfScreens'];
                            }
                            
                        }
                        echo "<h4>".$x."</h4>";
                        ?>
                    </div>
                    <div class="panel3">
                        <h3>Bookings</h3>
                        </br>
                        <?php
                        $x=0;
                        $theaterId=$_GET['theaterid'];
                        $query="SELECT COUNT(bookings.BookingId) from bookings
                        INNER JOIN shows on bookings.ShowId=shows.ShowId
                        where shows.TheaterId='".$theaterId."' and bookings.status!='Canceled';";
                        $result=mysqli_query($connect,$query);
                        if(mysqli_num_rows($result)){
                            while($row=mysqli_fetch_array($result)){
                                $x=$row['COUNT(bookings.BookingId)'];
                            }
                            
                        }
                        echo "<h4>".$x."</h4>";
                        ?>
                    </div>
                    <div class="panel4">
                        <h3>Cancel</h3>
                        </br>
                        <?php
                        $x=0;
                        $theaterId=$_GET['theaterid'];
                        $query="SELECT COUNT(bookings.BookingId) from bookings
                        INNER JOIN shows on bookings.ShowId=shows.ShowId
                        where shows.TheaterId='".$theaterId."' and bookings.status='Canceled';";
                        $result=mysqli_query($connect,$query);
                        if(mysqli_num_rows($result)){
                            while($row=mysqli_fetch_array($result)){
                                $x=$row['COUNT(bookings.BookingId)'];
                            }
                            
                        }
                        echo "<h4>".$x."</h4>";
                        ?>
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