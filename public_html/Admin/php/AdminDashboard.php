<?php
session_start();
ob_start();
 $username=$_SESSION['username'];
 if($username==""){
   header('Location:AdminLogin.php');
 }
include "Connection.php";
$query = "SELECT  BookingDate ,COUNT(BookingId)
FROM bookings GROUP BY BookingDate";
$result = mysqli_query($connect, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{ $chart_data .= "{ date:'".$row["BookingDate"]."', bookings:".$row["COUNT(BookingId)"]."}, ";
}
 $chart_data = substr($chart_data, 0, -2);
 
 $query2 = "SELECT  payment.Time ,Sum(Amount)
 FROM payment GROUP BY payment.Time";
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
    <link rel="stylesheet" href="../Css/AdminDashboard.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
2 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
3 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
4 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>

<body>
    <form method="post" action="">
    <header id="header">
        <img src="../image/MOVIEtime_white.png" alt="logo" class="logo" />
       
        <button class="visitwebsite" name="website"  >visit Website</button>
        <button class="visitwebsite">Android App Link </button>
        <input type="Submit" value="Logout" class="visitwebsite" name="logout">
        <?php
        if(isset($_POST["logout"])){
          unset( $_SESSION['username']);
        header('Location: AdminLogin.php');
        }
        if(isset($_POST["website"])){
            unset( $_SESSION['username']);
          header('Location: ../../index.php');
          }
   
        ?>
    </header>
    <div id="parentContainer">
        <div class="AdminOptions">
            <ul class="optionList">
                <li class="opt" onclick="window.location.href='AdminDashboard.php'" id="active"><i class="fa-solid fa-bars"></i>Dashboard</li>
                <li class="opt" onclick="window.location.href='AdminMovies.php'"><i class="fa-solid fa-film"></i>Movies</li>
                <li class="opt" onclick="window.location.href='theaters.php'">
                    </i><i class="fa-solid fa-building"></i>Theaters</li>
                <li class="opt"  onclick="window.location.href='Review.php'"><i class="fa-regular fa-star"></i>Reviews</li>
                <li class="opt" onclick="window.location.href='CheckBooking.php'"><i class="fa-solid fa-ticket"></i>Bookings</li>
                <li class="opt" onclick="window.location.href='giftCard.php'"><i class="fa-solid fa-gifts"></i>Gift Cards</li>
                <li class="opt" onclick="window.location.href='User.php'"><i class="fa-solid fa-users"></i>User</li>
            </ul>
        </div>
        <div class="Websitedetails">
            <div class="Sitedetails">
                <div class="rows">
                    <div class="panel1">
                        <h3>Now Showing Movies</h3>
                        </br>
                        <?php
                        $x=0;
                        $query="select COUNT(movies.MovieId) from movies where status='NOW SHOWING MOVIE'";
                        $result=mysqli_query($connect,$query);
                        if(mysqli_num_rows($result)){
                            while($row=mysqli_fetch_array($result)){
                                $x=$row['COUNT(movies.MovieId)'];
                            }
                            
                        }
                        echo "<h4>".$x."</h4>";
                        ?>
                        
                    </div>
                    <div class="panel2">
                        <h3>Theaters</h3>
                        </br>
                        <?php
                        $x=0;
                        $query="select COUNT(theaters.TheaterId) from theaters ";
                        $result=mysqli_query($connect,$query);
                        if(mysqli_num_rows($result)){
                            while($row=mysqli_fetch_array($result)){
                                $x=$row['COUNT(theaters.TheaterId)'];
                            }
                            
                        }
                        echo "<h4>".$x."</h4>";
                        ?>
                    </div>
                    <div class="panel3">
                        <h3>Upcomming Movies</h3>
                        </br>
                        <?php
                        $x=0;
                        $query="select COUNT(movies.MovieId) from movies where status='Up comming Movie'";
                        $result=mysqli_query($connect,$query);
                        if(mysqli_num_rows($result)){
                            while($row=mysqli_fetch_array($result)){
                                $x=$row['COUNT(movies.MovieId)'];
                            }
                            
                        }
                        echo "<h4>".$x."</h4>";
                        ?>
                    </div>
                </div>
                <div class="rows">
                    <div class="panel4">
                        <h3>Movie Genre</h3>
                        </br>
                        <h4>25</h4>
                    </div>
                    <div class="panel5">
                        <h3>Theater Type</h3>
                        </br>
                        <h4>4</h4>
                    </div>
                    <div class="panel6">
                        <h3>Promotions</h3>
                        </br>
                        <h4>5</h4>
                    </div>
                </div>
                <div class="rows">
                    <div class="panel7">
                        <h3>Booking Canceled</h3>
                        </br>
                        <?php
                        $x=0;
                        $query="select COUNT(bookings.BookingId) from bookings where status='Canceled'";
                        $result=mysqli_query($connect,$query);
                        if(mysqli_num_rows($result)){
                            while($row=mysqli_fetch_array($result)){
                                $x=$row['COUNT(bookings.BookingId)'];
                            }
                            
                        }
                        echo "<h4>".$x."</h4>";
                        ?>
                    </div>
                    <div class="panel8">
                        <h3>Cities</h3>
                        </br>
                        <?php
                        $x=0;
                        $query="select COUNT(DISTINCT theaters.city) from theaters";
                        $result=mysqli_query($connect,$query);
                        if(mysqli_num_rows($result)){
                            while($row=mysqli_fetch_array($result)){
                                $x=$row['COUNT(DISTINCT theaters.city)'];
                            }
                            
                        }
                        echo "<h4>".$x."</h4>";
                        ?>
                    </div>
                    <div class="panel9">
                        <h3>Revenue</h3>
                        </br>
                        <?php
                        $x=0;
                        $query="SELECT   Sum(Amount) FROM payment;";
                        $result=mysqli_query($connect,$query);
                        if(mysqli_num_rows($result)){
                            while($row=mysqli_fetch_array($result)){
                                $x=$row['Sum(Amount)'];
                            }
                            
                        }
                        echo "<h4>₹ ".$x."</h4>";
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