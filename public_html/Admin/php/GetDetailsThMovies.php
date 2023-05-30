<?php
session_start();
$username=$_SESSION['Thusername'];
$_SESSION['MyUser']=$username;
if($username==""){
    header('Location:TheaterLogin.php');
  }
include 'Connection.php';
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
 }else{
   

if(isset($_POST['query'])){
    $MyTheaterId=0;
    $username=$_SESSION['MyUser'];
    $query2="Select TheaterID from theaterCredentials where Theatername='".$username."'";
    $result2 = mysqli_query($connect, $query2);
    if(mysqli_num_rows($result2)>0){
    while($row = mysqli_fetch_array($result2))
        {
            $MyTheaterId=$row["TheaterID"];
        }
    }
    
    $query3="Select MovieId from movies where MovieName='".$_POST['query']."'";
    $result3 = mysqli_query($connect, $query3);
    $MovieId=0; 
    if(mysqli_num_rows($result3)>0){
        while($row = mysqli_fetch_array($result3))
            { 
                $MovieId=$row['MovieId'];
            }
        }
        
    $query5="select shows.Language,shows.ScreenNo,shows.ShowId,shows.ScreenType,shows.Time,
    shows.Date,movies.MovieName,movies.MovieGenre,movies.MovieLength,movies.MovieVerticalImage
    from shows 
    INNER JOIN movies ON shows.MovieId=movies.MovieId
    WHERE shows.TheaterId='".$MyTheaterId."' and shows.MovieId='".$MovieId."'";
    $result4= mysqli_query($connect, $query5);
    $output="";
    if(mysqli_num_rows($result4)>0){
        while($row = mysqli_fetch_array($result4))
            { 
                 $output.="<div class='ThMovieContainer'>";
                 $output.= "<div class='imageContainer'>";
                 $output.='<img src="data:image/jpg;base64,'.($row['MovieVerticalImage']).'" alt="MovieImage">';
                 $output.= "</div>";
                 $output.= "<div class='TextContainer'>";
                 $output.= "<h3>". $row['MovieName']."</h3>";
                 $output.= "<h3>Show Time :". $row['Time']."</h3>";
                 $output.= "<h3>Date :". $row['Date']."</h3>";
                 $output.= "<h3>Language:". $row['Language']."</h3>";
                 $output.= "<h3>Screen No:". $row['ScreenNo']."</h3>";
                 $output.= "<h3>Screen Type:". $row['ScreenType']."</h3>";
                 $output.= "<h3>Genre:". $row['MovieGenre']."</h3>";
                 $output.= "<h3>Length:". $row['MovieLength']."</h3>";
                 $output.="</div>";
                 $output.= "<div class='ButtonContainer'>";
                 $output.= '<a href=TheaterMovies.php?ShowId='.$row['ShowId'].' class="delete">Delete</a>';
                 $output.= "</div>";
                 $output.= "</div>";
            }
        }
echo $output;
}
if(isset($_POST['date'])){
    $MyTheaterId=0;
    $username=$_SESSION['MyUser'];
    $query2="Select TheaterID from theaterCredentials where Theatername='".$username."'";
    $result2 = mysqli_query($connect, $query2);
    if(mysqli_num_rows($result2)>0){
    while($row = mysqli_fetch_array($result2))
        {
            $MyTheaterId=$row["TheaterID"];
        }
    }  
    $query5="select shows.Language,shows.ScreenNo,shows.ShowId,shows.ScreenType,shows.Time,
    shows.Date,movies.MovieName,movies.MovieGenre,movies.MovieLength,movies.MovieVerticalImage
    from shows 
    INNER JOIN movies ON shows.MovieId=movies.MovieId
    WHERE shows.TheaterId='".$MyTheaterId."' and shows.Date='".$_POST['date']."'";
    $result4= mysqli_query($connect, $query5);
    $output="";
    if(mysqli_num_rows($result4)>0){
        while($row = mysqli_fetch_array($result4))
            { 
                 $output.="<div class='ThMovieContainer'>";
                 $output.= "<div class='imageContainer'>";
                 $output.='<img src="data:image/jpg;base64,'.($row['MovieVerticalImage']).'" alt="MovieImage">';
                 $output.= "</div>";
                 $output.= "<div class='TextContainer'>";
                 $output.= "<h3>". $row['MovieName']."</h3>";
                 $output.= "<h3>Show Time :". $row['Time']."</h3>";
                 $output.= "<h3>Date :". $row['Date']."</h3>";
                 $output.= "<h3>Language:". $row['Language']."</h3>";
                 $output.= "<h3>Screen No:". $row['ScreenNo']."</h3>";
                 $output.= "<h3>Screen Type:". $row['ScreenType']."</h3>";
                 $output.= "<h3>Genre:". $row['MovieGenre']."</h3>";
                 $output.= "<h3>Length:". $row['MovieLength']."</h3>";
                 $output.="</div>";
                 $output.= "<div class='ButtonContainer'>";
                 $output.= '<a href=TheaterMovies.php?ShowId='.$row['ShowId'].' class="delete">Delete</a>';
                 $output.= "</div>";
                 $output.= "</div>";
            }
        }
echo $output;
}
}
?>