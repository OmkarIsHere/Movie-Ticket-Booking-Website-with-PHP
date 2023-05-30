<?php
include('Connection.php');
  $_POST['ShowId']=$_GET['id'];
    
    if(!empty($_POST['ShowId'])){
        
        $showId=$_POST['ShowId'];
        if($connect){
        $SeatNos=array();    
       $query="Select SeatNo from bookings where ShowId='".$showId."'";
       $result=mysqli_query($connect,$query);
      if(mysqli_num_rows($result)>0){
         $i=0;
         while($row=mysqli_fetch_array($result)){
            $SeatNos[$i]=$row;
            $i++;
           }
       }
    }
    echo json_encode($SeatNos);
}
else{
    echo 'please pass the parameter';
}
?>