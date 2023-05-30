<?php 
include('Connection.php');
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
 }else{

    if(isset($_POST['query'])){
        $output="";
        $query="Select * from uLogin where Name like '%".$_POST["query"]."%'";
        $result = mysqli_query($connect,$query);
        $output="<table class='table'>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Phone no.</th>
            <th>Email</th>
            <th>Facebook Id</th>
            <th>Google Id</th>
            <th>Otp Verified</th>
            <th>Joined On</th>
            <th>Block</th>
        </tr>";
    $output.="<tr>";
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
       
            $output.='<td>'.$row['UserId'].'</td>';
            $output.='<td>'.$row['Name'].'</td>';
            $output.='<td>'.$row['Phone'].'</td>';
            $output.='<td>'.$row['Email'].'</td>';
            $output.='<td>'.$row['FacebookId'].'</td>';
            $output.='<td>'.$row['GoogleId'].'</td>';
            $output.='<td>'.$row['OtpVerified'].'</td>';
            $output.='<td>'.$row['JoinedOn'].'</td>';
         if($row['Block']=='YES'){
            $output.='<td><div class="form-check form-switch">
             <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div></td>';
         }else{
            $output.='<td><div class="form-check form-switch">
             <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" ></div></td>';
         }
         $output.="</tr>"; 

        }
     }
     $output.='</table>';
     echo $output;
    }
 }


?>