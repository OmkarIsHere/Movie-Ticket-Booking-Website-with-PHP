<?php
$connect=mysqli_connect("localhost","id20121598_root","Movietime@123","id20121598_movietime");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
 }else{
    

 
if(isset($_POST["query"])){
   
    $output='';
    $query="Select * from movies where MovieName like '%".$_POST["query"]."%'";
   $result = mysqli_query($connect,$query);
   $output='<ul class="SRul-list">';
   if(mysqli_num_rows($result)>0){
     while($row=mysqli_fetch_array($result)){
        $output.='<li class="SRli-list">'.$row['Movie'].'</li>';
     }
   }else{
    $output.='<li class="SRli-list">No Results Found</li>';
   }
   $output.='</ul>';
   echo $output;
  
}
  
}
?>