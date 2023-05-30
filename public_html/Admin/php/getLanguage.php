<?php
include 'Connection.php';
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
 }else{
 if(isset($_POST["query"])){
 $output='<option value="Select">Select</option>';
 $query="Select MovieLanguages from movies where MovieName='".$_POST["query"]."'"; 
 $result = mysqli_query($connect,$query);
 $myLanguages="";
 if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)){
     $myLanguages=$row['MovieLanguages'];
    }
}
if(strpos($myLanguages,",")){
    $arr=explode(',',$myLanguages);
    foreach($arr as $i){
        $output.='<option value="'.$i.'">'.$i.'</option>';
       }
}else{
    $output.='<option value="'.$myLanguages.'">'.$myLanguages.'</option>';  
}


 echo $output;
}
if(isset($_POST["MovieLength"])){
    $output='<h3>Movie Length : ';
    $query="Select MovieLength from movies where MovieName='".$_POST["MovieLength"]."'";  
    $result = mysqli_query($connect,$query);
    if(mysqli_num_rows($result)>0){
       while($row=mysqli_fetch_array($result)){
        $output.=$row['MovieLength'];
       }
   }
$output.="</h3>";
echo $output;
}
if(isset($_POST["MovieGenre"])){
    $output='<h3>Movie Genre : ';
    $query="Select MovieGenre from movies where MovieName='".$_POST["MovieGenre"]."'";  
    $result = mysqli_query($connect,$query);
    if(mysqli_num_rows($result)>0){
       while($row=mysqli_fetch_array($result)){
        $output.=$row['MovieGenre'];
       }
   }
$output.="</h3>";
echo $output;
}
if(isset($_POST["ScreenType"])){
$output='<option value="Select">Select</option>';
 $query="Select Quality from movies where MovieName='".$_POST["ScreenType"]."'"; 
 $result = mysqli_query($connect,$query);
 $Quality="";
 if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)){
     $Quality=$row['Quality'];
    }
}
if(strpos($Quality,",")){
    $arr=explode(',',$Quality);
    foreach($arr as $i){
        $output.='<option value="'.$i.'">'.$i.'</option>';
       }
}else{
    $output.='<option value="'.$Quality.'">'.$Quality.'</option>';  
}


 echo $output;
}
}
?>