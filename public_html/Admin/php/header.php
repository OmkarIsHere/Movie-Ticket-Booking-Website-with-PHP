
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <script src="../Javascript/navbar.js"></script>
    <link rel="stylesheet" href="../Css/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <style>

    </style>
</head>

<body>
    <div id="header">
        <img src="../image/MOVIEtime_white.png" alt="logo" class="logo" />

        <div id="SearchContainer" class="SearchContainer">
           
            <input type="text" class="searchbar" name="searchbar "id="searchbar"placeholder="Search movies theaters...">
            <button type="submit" class="SearchBtn"><i class="fa-solid fa-magnifying-glass"></i></button>
        
            <div id="searchresult">

            </div>
        </div>

        <div class="LocationContainer" id="LocationContainer">
            <img src="../image/gps.png" alt="location" class="locationImg">
            <select class="location">  
                <option value="Select">Select</option>}  
                <option value="Mumbai">Mumbai</option>  
                <option value="Delhi">Delhi</option>  
                <option value="Bengaluru">Bengaluru</option>  
                <option value="Kolkata">Kolkata</option>  
                <option value="Chennai">Chennai</option>  
                <option value="Ahmedabad">Ahmedabad</option>  
                <option value="Pune">Pune</option>  
                <option value="Chandigarh">Chandigarh</option>
                <option value="Hyderabad">Hyderabad</option>
 
              </select>
        </div>

        <div class="LogInContainer">
            <button type="submit" class="SearchBtn2" id="SearchToggle" onclick="ToggleSearch()"><i class="fa-solid fa-magnifying-glass"></i></button>
            <button type="submit" class="LocationBtn2" id="LocationToggle" onclick="ToggleLocation()"><i class="fa-solid fa-location-arrow" ></i></button>

            <!-- <button class="hambergerMenu"><i class="fa-solid fa-bars"></i></button> -->
        </div>

        <button type="button" class="toggle-collapse" id="toggle-button" onclick="slideMenuBar()">
            <i class="fa-solid fa-bars"></i>
           </button>

    </div>
    
    <div id="myMenuBar">
        <ul id="menu">
            <div class="Register">
                <h2>Hey!</h2>
            </div>
            <div class="MyloginButton">
                <img src="../image/gift-card.png" alt="gift" class="gift">
                <h3>Unlock special offers & <br>great benefits</h3>
                <button class="loginRegister">Login/Register</button>
            </div>
            <a href="#">
                <li>Help & Support</li>
            </a>
            <a href="#">
                <li>Rewards</li>
            </a>
            <a href="#">
                <li>About </li>
            </a>
            <a href="#">
                <li>Contact</li>
            </a>
            <a href="#">
                <li>Show me more</li>
            </a>
        </ul>
    </div>


    
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
</body>

</html>
<script>
    $(document).ready(function(){
     $('#searchbar').keyup(function(){
         var query=$(this).val();
        if(query!=''){
           
            $.ajax({
              url:"search.php",
              method:"POST",
              data:{query:query},
              success:function(data){
               
                $('#searchresult').fadeIn();
                $('#searchresult').html(data);
               
                console.log(data);
              } ,
              error: function(xhr, status, error) {
         console.log(status);
   }

            });
        }else{
            $('#searchresult').fadeOut();
                $('#searchresult').html("");
        }
      });
     $(document).on('click','li',function(){
      $('#searchbar').val($(this).text());
      $('searchresult').fadeOut();
       });
    });
</script>