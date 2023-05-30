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
    <link rel="stylesheet" href="../Css/AddCrewCast.css">
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
            <li class="opt" onclick="window.location.href='AdminDashboard.php'"><i class="fa-solid fa-bars"></i>Dashboard</li>
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
                <h3>MOVIE : <?php
                  ob_start();
                
                echo $_GET['name'];
                $_SESSION['moviename']=$_GET['name']
                ?></h3>
            </div>
            <div id="cast">
                <div class="heading">
                    <h3>Cast</h3>
                    <input type="button" value='+ Add' class="submitform" onclick="addcast()">
                </div>
                <div class="container">
                    <div class="CastBox">
                    <div class="parts">
                        <h3>Cast 1 :</h3>
                        <input type="text" name="CastName[]"class="input" required placeholder="Name">
                    </div>
                    <div class="parts">
                    <h3>Cast Role :</h3>
                    <input type="text" class="input" name="CastRole[]" required placeholder="Role"> 
                    </div>
                    <div class="parts">
                    <h3>Cast Image :</h3>
                    <input type="file" class="inputImage" name="castImage[]" accept="image/png , image/jpg , image/jpeg" required multiple>
                    </div>
                    
                    </div>
                    <div id="extracast"></div>
                </div>
            </div>
            <div id="crew">
                <div class="heading">
                    <h3>Crew</h3>
                    <input type="button" value="+ Add" class="submitform" onclick="addcrew()">
                </div>
                <div class="container">
                <div class="CrewBox">
                    <div class="parts">
                    <h3>Crew 1 :</h3>
                    <input type="text" class="input" name="CrewName[]" required placeholder="Name">
                    </div>
                    <div class="parts">
                    <h3>Crew Role :</h3>
                    <input type="text" class="input"  name="CrewRole[]" required placeholder="Role">
                    </div>
                    <div class="parts">
                    <h3>Crew Image :</h3>
                    <input type="file" class="inputImage"  name="CrewImage[]" accept="image/png , image/jpg , image/jpeg" required>
                    </div>
                   
                </div>
                <div id="extracrew"></div>
                </div>
            </div>
            <div class="formElementsSubmit">
                    <input  class="submitform" name="submit" type="submit" value="Submit">
                </div>
        </div>
    </div>
    </div>
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
    </form>
<?php
include 'Connection.php';
if($connect->connect_error){
    die("connection failed".$connect->connect_error);
}else{
    if(isset($_POST['submit'])){
     $movieName=$_GET['name'];
     $MovieId=1;
     $query='Select MovieId from movies where MovieName="'.$movieName.'"';
     $result=mysqli_query($connect,$query);
     if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
          $MovieId=$row['MovieId'];
        }
     }else{
        echo"no data found";
     }
     
    $castname=$_POST['CastName'];
    $castrole=$_POST['CastRole'];
    for($i=0;$i< count($castname);$i++){   
    $MovieCastImage=addslashes(file_get_contents($_FILES['castImage']['tmp_name'][$i]));
    $query="insert into cast_details (movieId,cast_name,cast_role,cast_img) values('$MovieId','$castname[$i]','$castrole[$i]','$MovieCastImage')";
    mysqli_query($connect,$query);
    }
    $crewname=$_POST['CrewName'];
    $crewrole=$_POST['CrewRole'];
    for($i=0;$i<count($crewname);$i++){
        $MovieCrewImage=addslashes(file_get_contents($_FILES['CrewImage']['tmp_name'][$i]));
        $query="insert into crew_details(movieid,crew_name,crew_role,crew_img) values('$MovieId','$crewname[$i]','$crewrole[$i]','$MovieCrewImage')";
    mysqli_query($connect,$query); 
   
       
    header('Location: AdminMovies.php');
    
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
    
        var textbox="";
        var extraCrew=document.getElementById("extracrew") ;
        var extraCast=document.getElementById("extracast") ;
       
    function addcrew(){
       
       
          var div=document.createElement("div");
          div.setAttribute("class","CrewBox");
          div.setAttribute("id","crewBox_"+counter);
          textbox=' <div class="parts"><h3>Crew '+counter+' :</h3><input type="text" class="input" name="CrewName[]" required placeholder="Name"></div>'+
                    '<div class="parts">'+
                    '<h3>Crew '+counter+' Role :</h3>'+
                    '<input type="text" class="input"  name="CrewRole[]" required placeholder="Role"></div>'+
                    '<div class="parts">'+
                    '<h3>Crew '+counter+' Image :</h3>'+
                    '<input type="file" class="inputImage"  name="CrewImage[]" accept="image/png , image/jpg , image/jpeg" required></div>'+
                    '<button type="button" class="cancel" onclick="removecrew(this)"><i class="fa-solid fa-xmark"></i></button>;'
          div.innerHTML=textbox;
          extraCrew.appendChild(div);
          counter++;
    }
    function removecrew(ele){
     ele.parentNode.remove();
     counter--;
    }
    function addcast(){
       
       
       var div=document.createElement("div");
       div.setAttribute("class","CastBox");
       div.setAttribute("id","castBox_"+counter2);
       textbox=' <div class="parts"><h3>Cast '+counter2+' :</h3><input type="text" class="input" name="CastName[]" required placeholder="Name"></div>'+
                    '<div class="parts">'+
                    '<h3>Cast '+counter2+' Role :</h3>'+
                    '<input type="text" class="input"  name="CastRole[]" required placeholder="Role"></div>'+
                    '<div class="parts">'+
                    '<h3>Cast '+counter2+' Image :</h3>'+
                    '<input type="file" class="inputImage"  name="castImage[]" accept="image/png , image/jpg , image/jpeg" required></div>'+
                    '<button type="button" class="cancel" onclick="removecast(this)"><i class="fa-solid fa-xmark"></i></button>;';
       div.innerHTML=textbox;
       extraCast.appendChild(div);
       counter2++;
 }
 function removecast(ele){
  ele.parentNode.remove();
  counter2--
 }
 function getMI(image){
    var myimage=image.replace(/^.*\\/,"");
   $('#getMovieImage').html(myimage);
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