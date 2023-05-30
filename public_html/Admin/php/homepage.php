
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


    <footer id="FooterContainer">
        <div class="Footerpart1">
            <div class="col1-f1">
                <h3>GENERAL</h3>
                <ul>
                    <li class="list"><a href="#">ABOUT US</a><span>><a href="#">EVENTS</a></span></li>
                    <li class="list"><a href="#">FAQ'S</a><span>><a href="#">NVSP</a></span></li>
                    <li class="list"><a href="#">INVESTORS SECTION</a></li>
                    <li class="list"><a href="#">CAREER</a></li>
                    <li class="list"><a href="#">NEWS</a></li>
                    <li class="list"><a href="#">FEEDBACK</a></li>

                </ul>
            </div>
            <div class="col2-f1">
                <h3>OUR BRANDS</h3>
                <ul>
                    <li class="list"><a href="#">DIRECTOR'S CUT</a><span>><a href="#">LUXE</a></span></li>
                    <li class="list"><a href="#">PICTURES</a><span>><a href="#">P[XL]</a></span></li>
                    <li class="list"><a href="#">IMAX</a><span>><a href="#">ONYX</a></span></li>
                    <li class="list"><a href="#">4DX</a><span>><a href="#">NEST</a></span></li>
                    <li class="list"><a href="#">PLAYHOUSE</a><span>><a href="#">V PRISTINE</a></span></li>
                    <li class="list"><a href="#">GOLD</a></li>

                </ul>
            </div>
            <div class="col3-f1">
                <h3>CINEMAS</h3>
                <ul>
                    <li class="list"><a href="#">CINEMAS</a></li>
                    <li class="list"><a href="#">UPCOMING</a></li>
                    <li class="list"><a href="#">ADVERTISE</a></li>
                    <li class="list"><a href="#">BEYOND MOVIES</a></li>
                    <li class="list"><a href="#">BIRTHDAY REQUEST</a></li>
                    <li class="list"><a href="#">SUBSCRIBE TO NEWSLETTER</a></li>

                </ul>
            </div>
        </div>
        <div class="Footerpart2">
            <div class="row1-f2">
                <div class="supportImageContainer">
                    <img src="../image/Paytm-Logo.wine.png" alt="supports" class="supportimage" />
                    <img src="../image/notonsecure.png" alt="supports" class="supportimage" /></div>
                <div class="policyConditiionTerms">
                    <a href="#">PRIVACY<br />POLICY</a>
                    <a href="#">TERMS &<br />CONDITIONS</a>
                    <a href="#">TERMS OF<br />USE</a></div>
                <div class="socialmediaContainer">
                    <img src="../image/facebook.png" alt="socialmedia" class="socialmediastart" />
                    <img src="../image/google-plus.png" alt="socialmedia" class="socialmedia" />
                    <img src="../image/youtube.png" alt="socialmedia" class="socialmedia" />
                    <img src="../image/twitter.png" alt="socialmedia" class="socialmedia" />
                    <img src="../image/instagram.png" alt="socialmedia" class="socialmedia" />
                    <img src="../image/linkedin.png" alt="socialmedia" class="socialmedia" /></div>
            </div>
            <div class="row2-f2">
                <p>COPYRIGHT © 2022 MOVIETIME CINEMAS LTD. ALL RIGHTS RESERVED.</p>
            </div>
        </div>
    </footer>
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