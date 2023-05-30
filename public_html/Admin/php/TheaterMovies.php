<?php
ob_start();
session_start();
 $username=$_SESSION['Thusername'];
 if($username==""){
    header('Location:TheaterLogin.php');
  }
$connect = mysqli_connect("localhost","id20121598_root","Movietime@123","id20121598_movietime");
$query = "SELECT  BookingDate ,COUNT(BookingId)
FROM bookings GROUP BY BookingDate";
$result = mysqli_query($connect, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{

  $chart_data .= "{ date:'".$row["BookingDate"]."', bookings:".$row["COUNT(BookingId)"]."}, ";
}
 $chart_data = substr($chart_data, 0, -2);
 $query2="Select TheaterID from theaterCredentials where Theatername='".$username."'";
 $result2 = mysqli_query($connect, $query2);
 $MyTheaterId=0;
 while($row = mysqli_fetch_array($result2))
{
 $MyTheaterId=$row["TheaterID"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieTime</title>
    <link rel="stylesheet" href="../Css/TheaterMovies.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
2 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
3 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
4 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
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
          unset( $_SESSION['Thusername']);
        header('Location:TheaterLogin.php');
        }
        ?>
    </header>
    <div id="parentContainer">
        <div class="AdminOptions">
            <ul class="optionList">
                <span class="slideLine"></span>
                <li class="opt" onclick="window.location.href='TheaterDashboard.php'"><i class="fa-solid fa-bars"></i>Dashboard</li>
                <li class="opt active" onclick="window.location.href=''"><i class="fa-solid fa-film"></i>Movies</li>
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
                <div class="rows SecondRow">
                  <h3>Shows</h3>
                   <input type="button" value="↻ Refresh" class="Refresh" id="Refresh">
                   <div class="moviesContainer">
                   <h3>Sort By : </h3>
                                <select name="Movie" id="Movies" class="Movies">
                                    <option value="Movie">Movie</option>
                                    <?php
                                    $query="Select MovieName from movies where Status='NOW SHOWING MOVIE'";
                                    $result=mysqli_query($connect,$query);
                                    if(mysqli_num_rows($result)>0){
                                        while($row=mysqli_fetch_array($result)){
                                           echo '<option value="'.$row['MovieName'].'">'.$row['MovieName'].'</option>'; 
                                        }}
                                    
                                    ?>
                                </select>
                   </div>
                   <div class="dateContainer">
                   <h3>Sort By : </h3>
                   <input type="date" name="date" class="date" id="date"></div>
                  <input type="button" value="+ Add Shows" class="AddMovieButton" onclick="window.location.href='AddShows.php'">
                </div> 
                <div class="rows ThirdRow">
                     <div class="thirdContainer" id="ThirdContainer">
                        <?php 
                        $query="select shows.Language,shows.ScreenNo,shows.ShowId,shows.ScreenType,shows.Time,
                        shows.Date,movies.MovieName,movies.MovieGenre,movies.MovieLength,movies.MovieVerticalImage
                        from shows 
                        INNER JOIN movies ON shows.MovieId=movies.MovieId
                        WHERE shows.TheaterId='".$MyTheaterId."'";
                        $result=mysqli_query($connect,$query);
                        if(mysqli_num_rows($result)>0){
                            while($row=mysqli_fetch_array($result)){
                             echo "<div class='ThMovieContainer'>";
                             echo "<div class='imageContainer'>";
                             echo '<img src="data:image/jpg;base64,'.($row['MovieVerticalImage']).'" alt="MovieImage">';
                             echo "</div>";
                             echo "<div class='TextContainer'>";
                             echo "<h3>". $row['MovieName']."</h3>";
                             echo "<h3>Show Time :". $row['Time']."</h3>";
                             echo "<h3>Date :". $row['Date']."</h3>";
                             echo "<h3>Language:". $row['Language']."</h3>";
                             echo "<h3>Screen No:". $row['ScreenNo']."</h3>";
                             echo "<h3>Screen Type:". $row['ScreenType']."</h3>";
                             echo "<h3>Genre:". $row['MovieGenre']."</h3>";
                             echo "<h3>Length:". $row['MovieLength']."</h3>";
                             echo"</div>";
                             echo "<div class='ButtonContainer'>";
                             echo '<a href=TheaterMovies.php?ShowId='.$row['ShowId'].' class="delete">Delete</a>';
                             echo "</div>";
                             echo "</div>";
                            }
                        }
                        ?>
                        
                     </div>
                </div>   
            </div>
        </div>
    </div>
    <?php
    if(isset($_GET['ShowId'])){
        
         $deleteQuery="Delete from shows where ShowId='".$_GET['ShowId']."'";
        
         if ($connect->query($deleteQuery) === TRUE) {
       
            header('Location: TheaterMovies.php');
         } 
    }
    ?>
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
    </form>
</body>

</html>
<script>
    $(document).ready(function(){
        $("select.Movies").change(function(){
          var selectedMovie= $(".Movies option:selected").val();
          $.ajax({
              type: "POST",
              url: "GetDetailsThMovies.php",
              data: { query : selectedMovie } ,
              success:function(data){
                $('#ThirdContainer').html(data);
                  //console.log(data); 
              } ,
              error: function(xhr, status, error) {
         console.log(status);
            }
        });
      });
      $(".date").change(function(){
          var date= $(".date").val();
          $.ajax({
              type: "POST",
              url: "GetDetailsThMovies.php",
              data: { date : date } ,
              success:function(data){
                 $('#ThirdContainer').html(data);
                  console.log(data); 
              } ,
              error: function(xhr, status, error) {
         console.log(status);
            }
        });
      });
        $('#Refresh').click(function(){
        location.reload(true)
    });
    });
</script>