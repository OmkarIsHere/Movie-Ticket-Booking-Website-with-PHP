<?php
include('Connection.php');
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
 }else{
    

 
if(isset($_POST["query"])){
   
    $output='';
   
    $query="Select * from theaters where TheaterName like '%".$_POST["query"]."%'";

    $result = mysqli_query($connect,$query);
   $output='  <table class="table" id="tablecontainer" id="theatersTable">
   <tr>
   <th>ID</th>
   <th>Theater Name</th>
   <th>Address</th>
   <th>Phone no.</th>
   <th>Email</th>
   <th>Revenue</th>
   <th>Status</th>
   <th>Actions</th>
</tr>';
   $output.='<tr>';
   if(mysqli_num_rows($result)>0){
     while($row=mysqli_fetch_array($result)){
        $output.="<td>".$row['TheaterId']."</td>";
        $output.="<td>".$row['TheaterName']."</td>";
        $output.="<td>".$row['TheaterAddress']."</td>";
        $output.="<td>".$row['PhoneNo']."</td>";
        $output.="<td>".$row['Email']."</td>";
        $output.="<td><i class='fa-solid fa-indian-rupee-sign' style='margin-right:5px'></i>".$row['Revenue']."</td>";
        if($row['Status']=="YES"){
            $output.="<td><div class='form-check form-switch'><input class='form-check-input' type='checkbox' role='switch' name='status' id='flexSwitchCheckChecked' value=".$row['TheaterId']." checked></div></td>";  
        }else{
            $output.="<td><div class='form-check form-switch'><input class='form-check-input' type='checkbox' role='switch' value=".$row['TheaterId']." name='status'id='flexSwitchCheckChecked' ></div></td>";
        }
        $output.="<td><a class='btn btn-primary btn-sm' href='viewAnalytics.php?theaterid=".$row['TheaterId']."'>view Analytics</a><a class='btn btn-primary btn-sm delete'  href='theaters.php?theaterid=".$row['TheaterId']."' >Delete</a></td></tr>";
     }
   }else{
    $output.='';
   }
   $output.='</table>';
   echo $output;
  
}
  
}
?>