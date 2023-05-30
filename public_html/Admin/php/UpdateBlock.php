<?php
include('Connection.php');
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
 }else{

    if(isset($_POST['query'])){
        $status="";
        $query1="Select Block from userlogin where UserId='".$_POST['query']."'";
        $result = mysqli_query($connect,$query1);
        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_array($result)){
                $status=($row['Block']);    
           }
      }
      if($status=="NO"){
        $query2="Update userlogin set Block='YES' where UserId='".$_POST['query']."'";
        mysqli_query($connect,$query2);
      }else{
        $query3="Update userlogin set Block='NO' where UserId='".$_POST['query']."'";
        mysqli_query($connect,$query3);
      }
      echo $_POST['query'];
    }
 
 }
?>