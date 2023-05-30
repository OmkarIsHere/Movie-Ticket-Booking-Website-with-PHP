<?php

include 'Connection.php';
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
 }else{
if(isset($_POST["query"])){
    $output='<h3>Movie Length :';
    $query="Select MovieLength from movies where MovieName='".$_POST["query"]."'";  
    $result = mysqli_query($connect,$query);
    if(mysqli_num_rows($result)>0){
       while($row=mysqli_fetch_array($result)){
        $output.=$row['MovieLength'];
       }
   }
$output.="</h3>";
echo $output;
}
 }
?>