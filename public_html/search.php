<?php
$connect=mysqli_connect("localhost","id20121598_root","Movietime@123","id20121598_movietime");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
 }else{
    

 
if(isset($_POST["query"])){
   $flag=false;
   $flag2=false;
    $output='';
    $query="Select * from movies where MovieName like '%".$_POST["query"]."%'";
    $result = mysqli_query($connect,$query);
    $output='<ul class="SRul-list">';
    if(mysqli_num_rows($result)>0){
      while($row=mysqli_fetch_array($result)){
      $genre =str_replace(",","•",$row['MovieGenre']);
      $lang=str_replace(","," • ",$row['MovieLanguages']);
        $output.='<a href="./moviedetails.php?movieid=' . $row['MovieId'] . '">
        <li class="SRli-list">
         <span>Movie</span>
         <img src="data:image/jpg;base64,' . base64_encode($row['MovieImage']) . '" alt="" class="searchImg">
         <div class="details">
         <h3 id="name">'.$row['MovieName'].'</h3>
         <h4>'.$row['MovieLength'].' | '.$genre.'</h4>
         <h4>'.$lang.'</h4>
         </div></li></a>';
     }
   }else{
      $flag=true;
   }
   $query="Select * from theaters where theaters.TheaterName like '%".$_POST["query"]."%'";
   $result = mysqli_query($connect,$query);
   $i=1;
   if(mysqli_num_rows($result)>0){
     while($row=mysqli_fetch_array($result)){
       $output.='<li class="SRli-list">
        <span>Cinema</span>
        <img src="data:image/jpg;base64,'.($row['TheaterImages']).'" alt="" class="searchImg">
        <div class="details">
        <h3 id="name'.$i.'">'.$row['TheaterName'].'</h3>
        <h4>'.$row['TheaterAddress'].'</h4>
        </div></li>';
    }
  }else{
   $flag2=true;
   
  }
  if( $flag && $flag2){
   $output.='<li class="SRli-list">No Results Found</li>';
  }
   $output.='</ul>';
   echo $output; 
} 
}
?>