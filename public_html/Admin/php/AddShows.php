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
    <link rel="stylesheet" href="../Css/AddShows.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
2 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
3 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
4 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
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
          unset( $_SESSION['Thusername']);
        header('Location:TheaterLogin.php');
        }

        ?>
    </header>
    <div id="parentContainer">
        <div class="AdminOptions">
            <ul class="optionList">
                <span class="slideLine"></span>
                <li class="opt"><i class="fa-solid fa-bars"></i>Dashboard</li>
                <li class="opt active" onclick="window.location.href=''"><i class="fa-solid fa-film"></i>Movies</li>
                <li class="opt" onclick="window.location.href=''"><i class="fa-solid fa-arrow-up-right-dots"></i>Statistics</li>
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
                  <h3>Add Shows</h3>
                </div> 
                <div class="rows ThirdRow">
                     <div class="thirdContainer">
                        <div class="TcRows">
                            <div class="TcCol">
                                <h3>Movie :</h3>
                                <select name="Movie" id="Movies" class="Movies">
                                    <option value="Select">Select</option>
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
                            <div class="TcCol">
                            <h3>Language :</h3>
                                <select name="Language" id="Language" class="Language">
                                <option value="Select">Select</option>
                            </select>
                            </div>
                        </div>
                        <div class="TcRows">
                            <div class="TcCol">
                            <h3>Screen Type :</h3>
                                <select name="ScreenType" id="ScreenType" class="ScreenType">
                                <option value="Select">Select</option>
                                <?php
                                    $query="Select ScreenTypes from theaters where TheaterId='".$MyTheaterId."'";
                                    $result=mysqli_query($connect,$query);
                                    $MyscreenTypes="";
                                    if(mysqli_num_rows($result)>0){
                                        while($row=mysqli_fetch_array($result)){
                                            $MyscreenTypes=$row['ScreenTypes']; 
                                        }}
                                        $arr=explode(',',$MyscreenTypes);
                                    foreach($arr as $i){
                                        echo '<option value="'.$i.'">'.$i.'</option>'; 
                                    }
                                    ?>
                                </select>
                            </div>
                          
                            <div class="TcCol">
                            <h3>Screen No :</h3>
                                <select name="ScreenNo" id="ScreenNo" class="ScreenNo">
                                <option value="Select">Select</option>
                                <?php
                                    $query="Select NoOfScreens from theaters where TheaterId='".$MyTheaterId."'";
                                    $result=mysqli_query($connect,$query);
                                    $MyNoOfScreens=0;
                                    if(mysqli_num_rows($result)>0){
                                        while($row=mysqli_fetch_array($result)){
                                            $MyNoOfScreens=$row['NoOfScreens']; 
                                        }}
                                        
                                    for($i=1;$i<=$MyNoOfScreens;$i++){
                                        echo '<option value="'.$i.'">'.$i.'</option>'; 
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="TcRows">
                            <div class="TcCol">
                            <h3>Time :</h3>
                            <input type="time" name="time" class="Movies" required/>
                            </div>
                            <div class="TcCol">
                            <h3>Date :</h3>
                            <input type="Date" name="Date" class="Movies" required/>
                            </div>
                        </div>
                        <div class="TcRows">
                            <div class="TcCol special" id="MovieLength">
                                <h3>Movie Length : </h3>  
                            </div>
                            <div class="TcCol special" id="MovieGenre">
                            <h3>Movie Genre : </h3>  
                            </div>
                        </div>
                        <div class="TcRows">
                            <div class="TcCol special" id="MovieLength">
                              
                            </div>
                            <div class="TcCol special" id="MovieGenre">
                           <input type="submit" value="Submit" name="submit"  class="delete"/> 
                            </div>
                        </div>
                     </div>
                </div>   
            </div>
        </div>
    </div>
    <?php
    if(isset($_POST["submit"])){
  if($_POST['Movie']!='Select' && $_POST['Language']!='Select' && $_POST['ScreenType']!='Select'&& $_POST['ScreenNo']!='Select'){
   $MovieId=0;
   $language=$_POST['Language'];
   $SCreenType=$_POST['ScreenType'];
   $ScreenNo=$_POST['ScreenNo'];
   $Time=$_POST['time'];
   $date=$_POST['Date'];
   $query="Select MovieId from movies where MovieName='".$_POST['Movie']."'";
   $result=mysqli_query($connect,$query);
   if(mysqli_num_rows($result)){
    while($row=mysqli_fetch_array($result)){
        $MovieId=$row['MovieId'];
    }
   }
   $MyQuery="Insert  into shows (TheaterId,MovieId,Language,ScreenNo,ScreenType,Time,Date)values('$MyTheaterId','$MovieId','$language','$ScreenNo','$SCreenType','$Time','$date')";
  
   if ($connect->query($MyQuery) === TRUE) {
       
    header('Location: TheaterMovies.php');
 } 
 else {
     echo "Error: ". $connect->error;
     }
  }else{
    echo '<script>alert("Please select all the Options")</script>';
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
          var selectedLanguage = $(".Movies option:selected").val();
          $.ajax({
              type: "POST",
              url: "getLanguage.php",
              data: { query : selectedLanguage } ,
              success:function(data){
                $('#Language').html(data);
                //   console.log(data); 
              } ,
              error: function(xhr, status, error) {
         console.log(status);
            }
        });
      });
      $("select.Movies").change(function(){
          var selectedMovie = $(".Movies option:selected").val();
          $.ajax({
              type: "POST",
              url: "getLanguage.php",
              data: { MovieLength: selectedMovie } ,
              success:function(data){
                $('#MovieLength').html(data);
                   //console.log(data); 
              } ,
              error: function(xhr, status, error) {
         console.log(status);
            }
        });
      });
      $("select.Movies").change(function(){
          var selectedMovie = $(".Movies option:selected").val();
          $.ajax({
              type: "POST",
              url: "getLanguage.php",
              data: { MovieGenre: selectedMovie } ,
              success:function(data){
                $('#MovieGenre').html(data);
                   console.log(data); 
              } ,
              error: function(xhr, status, error) {
         console.log(status);
            }
        });
      });
      $("select.Movies").change(function(){
          var selectedScreenType = $(".Movies option:selected").val();
          $.ajax({
              type: "POST",
              url: "getLanguage.php",
              data: { ScreenType: selectedScreenType } ,
              success:function(data){
                $('#ScreenType').html(data);
                   //console.log(data); 
              } ,
              error: function(xhr, status, error) {
         console.log(status);
            }
        });
      });
  });
</script>