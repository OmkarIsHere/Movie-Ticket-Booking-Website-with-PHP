<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

ob_start();

include('Connection.php');
session_start();
 $username=$_SESSION['username'];
 if($username==""){
   header('Location:AdminLogin.php');
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieTime</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/AddTheaters.css">
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
2 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
3 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
4 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>

<body>
    <form action='' method="POST" enctype="multipart/form-data">
    <div class="loadingio-spinner-dual-ring-pi6b1155i7" id="hideSpinner"><div class="ldio-gydubrlv2y9">
<div></div><div><div></div></div>
</div></div>

    <header id="header">
        <img src="../image/MOVIEtime_white.png" alt="logo" class="logo" />

        <button class="visitwebsite">visit Website</button>
        <button class="visitwebsite">Android App Link </button>
        <input type="Submit" value="Logout" class="visitwebsite" name="logout">
        <?php
        if(isset($_POST["logout"])){
          unset( $_SESSION['username']);
        header('Location: AdminLogin.php');
        }

        ?>
    </header>
    <div id="parentContainer">
        <div class="AdminOptions">
            <ul class="optionList">
            <li class="opt"onclick="window.location.href='AdminDashboard.php'"><i class="fa-solid fa-bars"></i>Dashboard</li>
                <li class="opt" onclick="window.location.href='AdminMovies.php'"><i class="fa-solid fa-film"></i>Movies</li>
                <li class="opt active" onclick="window.location.href='theaters.php'">
                    </i><i class="fa-solid fa-building"></i>Theaters</li>
                <li class="opt"  onclick="window.location.href='Review.php'"><i class="fa-regular fa-star"></i>Reviews</li>
                <li class="opt" onclick="window.location.href='CheckBooking.php'"><i class="fa-solid fa-ticket"></i>Bookings</li>
                <li class="opt" onclick="window.location.href='giftCard.php'"><i class="fa-solid fa-gifts"></i>Gift Cards</li>
                <li class="opt" onclick="window.location.href='User.php'"><i class="fa-solid fa-users"></i>User</li>
            </ul>
        </div>
        <div class="AddMovies">
        <div class="AddMovieheading">
                <h3>Add Theaters</h3>
            </div>
            <div class="addMovieContainer">
                <div class="formElements">
                    <div class="FEcontainer1">
                        <h4>Theater Name*</h4> <input type="text" name='TheaterName' class="myFormInput" placeholder="Theater Name" required ></input></div>
                    <div class="FEcontainer2">
                        <h4>Address</h4> <input type="textarea"name='TheaterAddress'  rows="4" cols="50" class="myFormInput" placeholder="Address" required ></input></div>
                </div>
                <div class="formElements">
                    <div class="FEcontainer1">
                        <h4>Seat Types</h4> <input type="text" name='SeatTypes'class="myFormInput" placeholder="Ex .Prime" required ></input></div>
                    <div class="FEcontainer2">
                        <h4>City</h4> <input type="text" name="city" class="myFormInput" placeholder="Ex.Mumbai" required ></input></div>
                </div>
                <div class="formElements">
                    <div class="FEcontainer1">
                        <h4>No of Screen</h4> <input type="number" name='NoOfScreen'class="myFormInput" required ></input></div>
                    <div class="FEcontainer2">
                        <h4>Email</h4> <input type="email" placeholder="xyz@gmail.com" name="email"class="myFormInput"required ></input></div>
                </div>
                <div class="formElements">
                    <div class="FEcontainer1">
                        <h4>Phone no.</h4> <input type="tel" pattern = "[0-9]{10}"placeholder="7290XXXXXX"  maxlength="10" name="phoneNo"class="myFormInput" required ></input></div>
                    <div class="FEcontainer2">
                        <h4>Website Commission</h4> <input type="number" step=".01" placeholder="10" min="0"name='websiteCommision' class="myFormInput" required ></input></div>
                </div>
                
                <div class="formElementsImages">
                    <div class="FEcontainer1">
                        <div class="screentype">
                            <h3>Screen type:</h3>
                            <ul class="list-group">
  <li class="list-group-item">
    <input class="form-check-input me-1" type="checkbox" value="2D" name='screentype[]' id="firstCheckbox" checked disabled>
    <label class="form-check-label" for="firstCheckbox">2D</label>
  </li>
  <li class="list-group-item">
    <input class="form-check-input me-1" type="checkbox" value="3D" id="secondCheckbox" name='screentype[]' >
    <label class="form-check-label" for="secondCheckbox">3D</label>
  </li>
  <li class="list-group-item">
    <input class="form-check-input me-1" type="checkbox" value="4XD" id="thirdCheckbox" name='screentype[]'>
    <label class="form-check-label" for="thirdCheckbox">4DX</label>
  </li>
  <li class="list-group-item">
    <input class="form-check-input me-1" type="checkbox" value="IMAX 3D" id="thirdCheckbox"  name='screentype[]'>
    <label class="form-check-label" for="thirdCheckbox">IMAX 3D</label>
  </li>
</ul>
                        </div>
                      </div>
                    <div class="FEcontainer2">
                    <h4>Theater Image</h4>
                        <h6>Size 1280 × 640 px</h6>

                        <label for="MovieImage2" class="label">Select Image <br><i class="fa-solid fa-camera-retro"></i><div id="getMoviePoster"></div><input type="file" required 
                        class="theaterImage" id="MovieImage2" name="TheaterPoster" accept="image/png , image/jpg , image/jpeg" onchange="getTI(this.value)"></label>
                       </div>
                </div>
                <div class="formElementsSubmit">
                    <input type='submit' class="submitform" value='Submit' name='submit' ></input>
                </div>
            </div>
        </div>
    </div>
    <?php
   include ('Connection.php');

   if ($connect->connect_error) {
    
    die("Connection failed: " . $connect->connect_error);
 }else{
   
   if(isset($_POST['submit'])){
    if(isset($_FILES['ThImage'])){
   
    }
        $TheaterName=$_POST['TheaterName'];
         $TheaterAddress=$_POST['TheaterAddress'];
         $SeatTypes=$_POST['SeatTypes'];
         $city=trim($_POST['city']);
         $NoOfScreens=$_POST['NoOfScreen'];
         $email=$_POST['email'];
         $PhoneNo=trim($_POST['phoneNo']);
         $TheaterImage=base64_encode(file_get_contents($_FILES['TheaterPoster']['tmp_name']));
         $webComission=$_POST['websiteCommision'];
         $myscreen=$_POST['screentype'];
         $ScreenTypes="2D";
         foreach($myscreen as $key){
          $ScreenTypes.=",".$key;
         }
         $mysubstr=substr($TheaterName,0,4);
         $rand=rand(1000,9999);
         $username="MV_".$mysubstr."$rand";
         $randpassword=rand(1000,2000);
         $userPassword= (strtoupper($mysubstr))."@".$randpassword;
 

        //send email code------------------
   
                    $status = "not verified"; 
                    $block = "No"; 
        
                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->SMTPDebug = 0;
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'tls';
        
                    $mail->Username = 'movietime0355@gmail.com';
                    $mail->Password = 'firhxiezbdelibtt';
        
                    $mail->setFrom('movietime0355@gmail.com', 'MovieTime');
                    $mail->addReplyTo('movietime0355@gmail.com', 'MovieTime');
                    $mail->addAddress($email, $TheaterName);
                    $mail->isHTML(true);

                    $mail->Subject="Login Credentials"; 
                    $mail->Body="<p>Dear $TheaterName, </p> <br><h3>Hello from MovieTime,<br></h3> 
                   
                    <p>Congratulations, We have added your Theater to our website<br>
                    Username='$username'<br>Password='$userPassword'</p>

                    <p>With regrads,</p> 
                    <b>MovieTime</b>"; 
 
                    if(!$mail->send()) { 
                        $errors['otp-error'] = "Failed while sending code!"; 
                    }
    //   send email code ----------------end

    $query="insert into theaters(TheaterName,TheaterAddress,City,Email,PhoneNo,NoOfScreens,ScreenTypes,WebsiteCommission,SeatTypes,Revenue,Status,TheaterImages) values('$TheaterName','$TheaterAddress','$city','$email','$PhoneNo','$NoOfScreens','$ScreenTypes','$webComission',' $SeatTypes','0','YES','$TheaterImage')";
    mysqli_query($connect,$query);
   $TheaterId=0;
    $query2='Select TheaterId from theaters where TheaterName="'.$TheaterName.'"';
    $result=mysqli_query($connect,$query2);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
          $TheaterId=$row['TheaterId'];
        }
     }
     
     $query3="insert into theaterCredentials values('$TheaterId',' $username','$userPassword')";
     mysqli_query($connect,$query3);
     header('Location: theaters.php');
    }
    
    
 }
  
   ?>
    </form>
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
  
</body>
<script>
   

  
 window.onload=function(){
    
    document.getElementById('hideSpinner').style.display='none';
   }
function getTI(image2){
    var myimage2=image2.replace(/^.*\\/,"");
   $('#getMoviePoster').html(myimage2);
 }
 
</script>
</html>
