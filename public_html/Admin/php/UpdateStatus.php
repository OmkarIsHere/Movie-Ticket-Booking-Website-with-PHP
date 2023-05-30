<?php
include('Connection.php');
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
 }else{
    if(isset($_POST['query'])){
         $status="";
         $query1="Select Status from theaters where TheaterId='".$_POST['query']."'";
         $result = mysqli_query($connect,$query1);
         if(mysqli_num_rows($result)>0){
             while($row=mysqli_fetch_array($result)){
                 $status=($row['Status']);    
            }
       }
     if($status=='YES'){
        $query2="Update theaters set Status='NO' where TheaterId='".$_POST['query']."'"; 
        $result = mysqli_query($connect,$query2);
     }elseif($status=='NO'){
        $query3="Update theaters set Status='YES' where TheaterId='".$_POST['query']."'"; 
        $result = mysqli_query($connect,$query3);
     }
         echo  $status ;
    }
 }
?>