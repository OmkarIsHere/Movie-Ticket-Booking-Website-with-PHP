<?php

  session_start(); 
  $servername = "localhost";
  $username = "id20121598_root";
  $password = "Movietime@123";
  $Database = "id20121598_movietime";
$myname=$_SESSION['movieType'];
echo"<script>alert('$myname')</script>";

?>
<?php
  
  $connect=mysqli_connect($servername,$username,$password,$Database);
  if ($connect->connect_error) {
      die("Connection failed: " . $connect->connect_error);
   }else{
       
     if(isset($_POST["submit"])){
       
      $MovieName=$_POST["Moviename"];
      $MovieGenre=$_POST["MovieGenre"];
      $MovieLength=$_POST["MovieLength"];
      $DirectorName=$_POST["DirectorName"];
      $TrailerLink=$_POST["TrailerLink"];
      $ReleaseDate=date('Y-m-d',strtotime($_POST["ReleaseDate"]));
      $MovieImage=addslashes(file_get_contents($_FILES['MovieImage']['tmp_name']));
      $MoviePoster=addslashes(file_get_contents($_FILES["MoviePoster"]['tmp_name']));
      $crew=$_POST["Crew"];
      $cast=$_POST["cast"];
      $crewname="";
      $castname="";
      foreach($crew as $key ){
          $crewname.=$key.",";
      }
      foreach($cast as $key ){
          $castname.=$key.",";
      }


    $sql="insert into movies values('','$MovieName','$MovieGenre','$MovieLength','$DirectorName','$TrailerLink','$castname','$crewname','$ReleaseDate','English','$myname','$MovieImage','$MoviePoster');";
    $sql2="insert into adminlogin values ('','$mystatus','34574f');";
      $sql="insert into image value('$MovieImage');";
    if ($connect->query($sql) === TRUE) {

      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $connect->error;
    }
     
     }
    
   }
?>