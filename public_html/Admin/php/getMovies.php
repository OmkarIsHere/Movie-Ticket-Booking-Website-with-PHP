<?php
$connect=mysqli_connect("localhost","id20121598_root","Movietime@123","id20121598_movietime");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
 }else{
    

 
if(isset($_POST["query"])){
   $mystatus=$_POST["query"];
    $output='';
    $query="Select * from movies where Status='".$_POST["query"]."'";
   $result = mysqli_query($connect,$query);
  
   if(mysqli_num_rows($result)>0){
     while($row=mysqli_fetch_array($result)){
      if($mystatus=="Up comming movie"){
         $output.='<li class="NWmovies">
         <img src="data:image/jpg;base64,'.base64_encode($row['MovieImage']).'" />
         <div class="moviedetails">
            <h3 class="moviename">'.$row['MovieName'].'</h3>
            <h3>'.$row['MovieLanguages'].'</h3>
            <h3>Duration: '.$row['MovieLength'].'</h3>
            <h3>'.$row['MovieGenre'].'</h3>
            <h3>Release Date: '.$row['ReleaseDate'].'</h3>
         </div>
         <div class="upmovieop">
            <a href="AdminMovies.php?name='.$row['MovieName'].'" class="delete">Delete</a>
            <a href="AdminMovies.php?addMovie='.$row['MovieName'].'" class="delete">Add</a>
         </div>
         </li>';
      }else{
        $output.='<li class="NWmovies"><img src="data:image/jpg;base64,'.base64_encode($row['MovieImage']).'" /><div class="moviedetails"><h3 class="moviename">'.$row['MovieName'].'</h3><h3>'.$row['MovieLanguages'].'</h3><h3>Duration: '.$row['MovieLength'].'</h3><h3>'.$row['MovieGenre'].'</h3><h3>Release Date: '.$row['ReleaseDate'].'</h3></div><div class="upmovieop"><a href="AdminMovies.php?name='.$row['MovieName'].'" class="delete">Delete</a></div></li>';
      }
     }
   }else{
    $output.='<li class="NWmovies" style="text-align:center;color:Red;">No Data Found</li>';
   }
 
   echo $output;
  
}

}
?>