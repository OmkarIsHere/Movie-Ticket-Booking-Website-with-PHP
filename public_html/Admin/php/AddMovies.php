<?php
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
    <script src="../Javascript/navbar.js"></script>
    <link rel="stylesheet" href="../Css/AddMovies.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <form name="addMovies" action="" method="post" enctype="multipart/form-data">
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
            <li class="opt"  onclick="window.location.href='AdminDashboard.php'"><i class="fa-solid fa-bars"></i>Dashboard</li>
                <li class="opt active" onclick="window.location.href='AdminMovies.php'"><i class="fa-solid fa-film"></i>Movies</li>
                <li class="opt" onclick="window.location.href='theaters.php'">
                    </i><i class="fa-solid fa-building"></i>Theaters</li>
                <li class="opt"  onclick="window.location.href='Review.php'"><i class="fa-regular fa-star"></i>Reviews</li>
                <li class="opt" onclick="window.location.href='CheckBooking.php'"><i class="fa-solid fa-ticket"></i>Bookings</li>
                <li class="opt" onclick="window.location.href='giftCard.php'"><i class="fa-solid fa-gifts"></i>Gift Cards</li>
                <li class="opt" onclick="window.location.href='User.php'"><i class="fa-solid fa-users"></i>User</li>
            </ul>
        </div>
        <div class="AddMovies">
            <div class="AddMovieheading">
                <h3>ADD MOVIES : <?php
                ob_start();
               
                
                if(isset($_POST["NWMovies"]) ){
                    $_SESSION['movieType']='NOW SHOWING MOVIE';
                    echo  $_SESSION['movieType'];
                }if(isset($_POST["UpMovies"]) ){
                    $_SESSION['movieType']='UP COMMING MOVIE';
                    echo  $_SESSION['movieType'];
                }
         
                ?></h3>
            </div>
            <div class="addMovieContainer">
                <div class="formElements">
                    <div class="FEcontainer1">
                        <h4>Movie Name*</h4> <input type="text" name="Moviename"class="myFormInput" placeholder="Movie Name" required></div>
                    <div class="FEcontainer2">
                        <h4>Movie Genre*</h4> <input type="text" name="MovieGenre"class="myFormInput" placeholder="Genre"  required></div>
                </div>
                <div class="formElements">
                    <div class="FEcontainer1">
                        <h4>Movie Length</h4> <input type="text"  name="MovieLength"class="myFormInput"  required></div>
                    <div class="FEcontainer2">
                        <h4>Director Name</h4> <input type="text" name="DirectorName"class="myFormInput"  required></div>
                </div>
                <div class="formElements">
                    <div class="FEcontainer1">
                        <h4>Trailer Link</h4> <input type="text"name="TrailerLink" class="myFormInput" placeholder="link"  required></div>
                    <div class="FEcontainer2">
                    <h4>Release Date</h4> <input type="date" name="ReleaseDate"class="myFormInput"  required></div>
                        
                </div>
               
                <div class="formElementsImages">
                    <div class="FEcontainer1">
                        <h4>Movie Image</h4>
                        <h6>Size 374 × 226 px</h6>

                        <label for="MovieImage">Select Image <br><i class="fa-solid fa-camera-retro"></i><div id="getMovieImage"  ></div><input type="file"required
                            class="MovieImage" id="MovieImage"
                            name="MovieImage" accept="image/png , image/jpg , image/jpeg" onchange="getMI(this.value)"
                           ></label></div>
                    <div class="FEcontainer2">
                        <h4>Movie Poster</h4>
                        <h6>Size 1280 × 640 px</h6>

                        <label for="MovieImage2">Select Image <br><i class="fa-solid fa-camera-retro"></i><div id="getMoviePoster"></div><input type="file" required 
                        class="MovieImage2" id="MovieImage2" name="MoviePoster" accept="image/png , image/jpg , image/jpeg" onchange="getMP(this.value)"></label></div>
                </div>
                <div class="crewcastContainer1">
                <div class="FEcontainer1sp">
                        <h4>Movie Image</h4>
                        <h6>Size 400 × 600 px</h6>
                        <label for="MovieImage3">Select Image <br><i class="fa-solid fa-camera-retro"></i><div id="getMovieVerticalPoster"  ></div><input type="file"
                            class="MovieImage3" id="MovieImage3"
                            name="ImageVertical" accept="image/png , image/jpg , image/jpeg" onchange="getMi2(this.value)"
                            required></label></div>
                    <div class="crewElement2">
                        <div class="castBox thisbox">
                        <h4>About</h4> <input type="textarea"rows="4" cols="100" name="about" id="cast_1" class="myFormInputCrew" required>
                        </div>
                    </div>
                </div>
                <div class="crewcastContainer">
                    <div class="crewElement">
                        <div class="LanguageBox">
                        <h4>Language 1</h4> <input type="text" name="Language[]" id="Language_1" class="myFormInputCrew" required>
                        <button type="button" class="addcrew" onclick="addLanguage()">+</button>
                        </div>
                        <div id="extraLanguage"></div>
                    </div>
                    <div class="crewElement2">
                    <div class="crewBox">
                        <h4>Quality 1</h4> <input type="text" name="Crew[]" id="crew_1" class="myFormInputCrew" required>
                        <button type="button" class="addcrew" onclick="addCrew()">+</button>
                        </div>
                        <div id="extraCrew"></div>
                    </div>
                </div>
                <div class="formElementsSubmit">
                    <input  class="submitform" name="submit" type="submit" value="Submit">
                </div>
            </div>
           
        </div>
    </div>
    </div>
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
    </form>
    <?php


$servername = "localhost";
$username = "id20121598_root";
$password = "Movietime@123";
$Database = "id20121598_movietime";


?>
<?php

$connect=mysqli_connect($servername,$username,$password,$Database);
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
 }else{
     
   if(isset($_POST["submit"])){
    $myname= $_SESSION['movieType'];
    $about=$_POST['about'];
    $MovieName=strtoupper($_POST["Moviename"]);
    $_SESSION['moviename']=$MovieName;
    $MovieGenre=$_POST["MovieGenre"];
    $MovieLength=$_POST["MovieLength"];
    $DirectorName=$_POST["DirectorName"];
    $TrailerLink=$_POST["TrailerLink"];
    $ReleaseDate=date('Y-m-d',strtotime($_POST["ReleaseDate"]));
    $MovieImage=addslashes(file_get_contents($_FILES['MovieImage']['tmp_name']));
    $MoviePoster=addslashes(file_get_contents($_FILES["MoviePoster"]['tmp_name']));
    $MovieVerticalPoster=base64_encode(file_get_contents($_FILES["ImageVertical"]['tmp_name']));
    $crew=$_POST["Crew"];
    $language=$_POST["Language"];
    $Quality="";
    $NoOfLanguages="";
    foreach($crew as $key ){
        if($Quality==""){
            $Quality.=$key;
        }else{
            $Quality.=",".$key;
        }
       
    }
    foreach($language as $key ){
        if($NoOfLanguages==""){
            $NoOfLanguages.=$key;
        }else{
            $NoOfLanguages.=",".$key;
        }
       
    }
  


        $sql="insert into movies (MovieName,MovieGenre,MovieLength,DirectorName,YoutubeLink,ReleaseDate,MovieLanguages,Status,MovieImage,MoviePoster,MovieVerticalImage,Quality,About) values('$MovieName','$MovieGenre','$MovieLength','$DirectorName','$TrailerLink','$ReleaseDate','$NoOfLanguages','$myname','$MovieImage','$MoviePoster','$MovieVerticalPoster','$Quality','$about');";
 
        if ($connect->query($sql) === TRUE) {
       
           header('Location: AddCrewCast.php?name='.$_SESSION['moviename'].'');
        } 
        else {
            echo "Error: " . $connect->error;
            }
   
   }
   
 }
 
?>
</body>

</html>
<script>
   window.onload=function(){
    
    document.getElementById('hideSpinner').style.display='none';
   }
    var counter=2;
    var counter2=2;
    var counter3=2;
        var textbox="";
        var extraCrew=document.getElementById("extraCrew") ;
        var extraCast=document.getElementById("extracast") ;
        var extraLanguage=document.getElementById("extraLanguage") ;
    function addCrew(){
       
       
          var div=document.createElement("div");
          div.setAttribute("class","crewBox");
          div.setAttribute("id","crewBox_"+counter);
          textbox=' <h4>Quality'+" "+counter+'</h4> <input type="text" name="Crew[]" id="crew_'+counter+'"class="myFormInputCrew"><button type="button" class="addcrew" onclick="removeCrew(this)">-</button>';
          div.innerHTML=textbox;
          extraCrew.appendChild(div);
          counter++;
    }
    function removeCrew(ele){
     ele.parentNode.remove();
     counter--;
    }
    function addCast(){
       
       
       var div=document.createElement("div");
       div.setAttribute("class","castBox");
       div.setAttribute("id","castBox_"+counter2);
       textbox=' <h4>Quality'+" "+counter2+'</h4> <input type="text" name="cast[]" id="Cast_'+counter2+'"class="myFormInputCrew"><button type="button" class="addcrew" onclick="removeCast(this)">-</button>';
       div.innerHTML=textbox;
       extraCast.appendChild(div);
       counter2++;
 }
 function removeCast(ele){
  ele.parentNode.remove();
  counter2--
 }
 function getMI(image){
    var myimage=image.replace(/^.*\\/,"");
   $('#getMovieImage').html(myimage);
 }
  function getMi2(img){
    var myimage=img.replace(/^.*\\/,"");
   $('#getMovieVerticalPoster').html(myimage);
  }
 function getMP(image2){
    var myimage2=image2.replace(/^.*\\/,"");
   $('#getMoviePoster').html(myimage2);
 }
 function addLanguage(){
       
       
       var div=document.createElement("div");
       div.setAttribute("class","LanguageBox");
       div.setAttribute("id","LanguageBox_"+counter3);
       textbox=' <h4>Language'+" "+counter3+'</h4> <input type="text" name="Language[]" id="Language_'+counter2+'"class="myFormInputCrew"><button type="button" class="addcrew" onclick="removeLanguage(this)">-</button>';
       div.innerHTML=textbox;
       extraLanguage.appendChild(div);
       counter3++;
 }
 function removeLanguage(ele){
  ele.parentNode.remove();
  counter3--
 }
</script>