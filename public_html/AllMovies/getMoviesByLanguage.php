<?php
$servername = "localhost";
$username = "id20121598_root";
$password = "Movietime@123";
$Database = "id20121598_movietime";

$connect=mysqli_connect($servername,$username,$password,$Database);
if(isset($_POST['language'])){
$output="";
    $query="SELECT * FROM `movies` WHERE movies.MovieLanguages like '%".$_POST['language']."%'";
    $result=mysqli_query($connect,$query);
    if(mysqli_num_rows($result)>0){
      while($row=mysqli_fetch_array($result)){
        $output.='<div class="card">';
        $output.='<img src="data:image/jpg;base64,'.($row['MovieVerticalImage']).'" class="movieImage" alt="movieImage">';
        $output.='</div> ';
      }
    }
    echo $output;
}

if(isset($_POST['Genre'])){
  $output="";
      $query="SELECT * FROM `movies` WHERE movies.MovieGenre like '%".$_POST['Genre']."%'";
      $result=mysqli_query($connect,$query);
      if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
          $output.='<div class="card">';
          $output.='<img src="data:image/jpg;base64,'.($row['MovieVerticalImage']).'" class="movieImage" alt="movieImage">';
          $output.='</div> ';
        }
      }
      echo $output;
  }
  
if(isset($_POST['format'])){
  $output="";
      $query="SELECT * FROM `movies` WHERE movies.Quality like '%".$_POST['format']."%'";
      $result=mysqli_query($connect,$query);
      if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
          $output.='<div class="card">';
          $output.='<img src="data:image/jpg;base64,'.($row['MovieVerticalImage']).'" class="movieImage" alt="movieImage">';
          $output.='</div> ';
        }
      }
      echo $output;
  }

  
?>