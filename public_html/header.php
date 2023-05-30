<?php
// session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./js/jquery.js"></script>
    <script src="./js/navbar.js"></script>
    <link rel="stylesheet" href="./css/header.css">
</head>

<body>
    <section id="header">
        <a href="./index.php"><img src="./img/MOVIEtime_white.png" alt="logo" class="logo" /></a>

        <div id="SearchContainer" class="SearchContainer">

            <input type="text" class="searchbar" name="searchbar " id="searchbar" placeholder="Search movies theaters...">
            <button type="submit" class="SearchBtn"><i class="fa-solid fa-magnifying-glass"></i></button>

            <div id="searchresult">
                
            </div>
        </div>

        <div class="LocationContainer" id="LocationContainer" onclick="showLocationPopup(0)">
            <img src="./img/gps.png" alt="location" class="locationImg">
            <select class="location" id="location" name="location">
            <?php
                if (isset($_SESSION["location"])) {
                    echo "<option style='background-color:#5a5a5a; color:white;' value='{$_SESSION["location"]}'>{$_SESSION["location"]}</option>";
                }
                else {
                    echo "<option value='Select'>Select</option>";
                }
                // echo "<option value='Mumbai'>Mumbai</option>";
                // echo "<option value='Delhi'>Delhi</option>";
                // echo "<option value='Bangaluru'>Bangaluru</option>";
                // echo "<option value='Kolkata'>Kolkata</option>";
                // echo "<option value='Chennai'>Chennai</option>";
                // echo "<option value='Ahmedabad'>Ahmedabad</option>";
                // echo "<option value='Pune'>Pune</option>";
                // echo "<option value='Chandigarh'>Chandigarh</option>";
                // echo "<option value='Hyderabad'>Hyderabad</option>";

                ?>
            </select>
        </div>







        <div class="LogInContainer">
            <button type="submit" class="SearchBtn2" id="SearchToggle" onclick="ToggleSearch()"><i class="fa-solid fa-magnifying-glass"></i></button>
            <button type="submit" class="LocationBtn2" id="LocationToggle" onclick="ToggleLocation()"><i class="fa-solid fa-location-arrow" onclick="showLocationPopup(0)"></i></button>

            <!-- <button class="hambergerMenu"><i class="fa-solid fa-bars"></i></button> -->
        </div>

        <button type="button" class="toggle-collapse" id="toggle-button" onclick="slideMenuBar()">
            <i class="fa-solid fa-bars" id="open"></i>
            <i class="fa-solid fa-xmark" id="close"></i>
        </button>

    </section>

    <section id="myMenuBar">
        <div class="Register" id="register">
            <h2>Hey!</h2>
        </div>
        <div class="login_section-row" id="login-row">
            <div class="login_section">
                <div class="login_details">
                    <?php
                        if (isset($_SESSION['profile'])) {
                            $colors = array("#F7C8E0", "#DFFFD8", "#B4E4FF", "#95BDFF", "#A7727D", "#EA8FEA", "#B5F1CC", "#C9F4AA", "#F6E6C2", "#6096B4","ffaf40","2A9BFB","ff5967","7870cc","33ccbf");
                            shuffle($colors);
                            $userImg = $_SESSION['profile'];
                            echo "<div style=' background-color: $colors[0] ' class='google_login_img'>$userImg</div>";
                        }
                        ?>
                    <span>
                        <?php
                        if (isset($user['Name'])) {
                            echo $user['Name'];
                        }
                        if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
                            echo $fetch_info['Name'];
                        }
                        ?>
                    </span>
                </div>
                <button class="logout_btn" onclick="switchButtons(1)">
                    <a href="./login/logout.php">Logout</a>
                </button>
            </div>
        </div>
        <ul id="menu">
            <div class="MyloginButton">
                <img src="./img/gift-card.png" alt="gift" class="gift">
                <h3>Unlock special offers & <br>great benefits</h3>
                <a href="./login/login.php"><button class="loginRegister" id="login_register">Login/Register</button></a>
            </div>
            <div class="menu-links">
                <a href="dashboard.php" id="dashboard-menu-link">
                    <li>Dashboard</li>
                </a>
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
                <a href="settings.php">
                    <li>Settings</li>
                </a>
            </div>
        </ul>
    </section>
    
    <section ID="selectLocation" class="selectLocation">
        <div class="mylocationContainer">
            <div class="box1">
                <span ID="Mylocation" class="MyLocationString">Select Your Location</span>
            </div>
            <hr />
            <div class="box2" id="searchBox">
                <input type="hidden" class="imagecircle active">
                <a href="javascript:void(0);" onclick="locationselector('Mumbai')" ID="Mumbai" Width="100px" Height="130px" class="citylinkbox">
                    <div class="imagecircle"><img src="images/Mumbai.png" alt="Mumbai" /></div>
                    <h3>Mumbai</h3>
                </a>
                <a href="javascript:void(0);" onclick="locationselector('Chennai')" ID="Chennai" Width="100px" Height="130px" class="citylinkbox">
                    <div class="imagecircle"><img src="images/Chennai.png" alt="Chennai" /></div>
                    <h3>Chennai</h3>
                </a>
                <a href="javascript:void(0);" onclick="locationselector('Bengaluru')" ID="Bengaluru" Width="100px" Height="130px" class="citylinkbox">
                    <div class="imagecircle"><img src="images/Banglore.png" alt="Bengaluru" /></div>
                    <h3>Bengaluru</h3>
                </a>
                <a href="javascript:void(0);" onclick="locationselector('Ahmedabad')" ID="Ahmedabad" Width="100px" Height="130px" class="citylinkbox">
                    <div class="imagecircle"><img src="images/Ahmedabad.png" alt="Ahmedabad" /></div>
                    <h3>Ahmedabad</h3>
                </a>
                <a href="javascript:void(0);" onclick="locationselector('Hyderabad')" ID="Hyderabad" Width="100px" Height="130px" class="citylinkbox">
                    <div class="imagecircle"><img src="images/Hyderabad.png" alt="Hyderabad" /></div>
                    <h3>Hyderabad</h3>
                </a>
                <a href="javascript:void(0);" onclick="locationselector('Pune')" ID="Pune" Width="100px" Height="130px" class="citylinkbox">
                    <div class="imagecircle"><img src="images/Pune.png" alt="Pune" /></div>
                    <h3>Pune</h3>
                </a>
                <a href="javascript:void(0);" onclick="locationselector('Chandigarh')" ID="Chandigarh" Width="100px" Height="130px" class="citylinkbox">
                    <div class="imagecircle"><img src="images/Chandigarh.png" alt="Chandigarh" /></div>
                    <h3>Chandigarh</h3>
                </a>
                <a href="javascript:void(0);" onclick="locationselector('Delhi')" ID="DelhiNCR" Width="100px" Height="130px" class="citylinkbox">
                    <div class="imagecircle"><img src="images/Delhi.png" alt="Delhi-NCR" /></div>
                    <h3>Delhi-NCR</h3>
                </a>
                <a href="javascript:void(0);" onclick="locationselector('Kolkata')" ID="Kolkata" Width="100px" Height="130px" class="citylinkbox">
                    <div class="imagecircle"><img src="images/Kolkata.png" alt="Kolkata" /></div>
                    <h3>Kolkata</h3>
                </a>
            </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
      $('#searchbar').val($(this).find("h3").text());
      $('searchresult').fadeOut();
       });
    });
</script>

<?php

if(!isset($_SESSION["location"])) {
    echo "<script>showLocationPopup(0);</script>";
}

if (isset($_SESSION['logged_in'])) {
    if ($_SESSION['logged_in'] == 'true') {
        echo "<script>slideMenuBar()</script>";
        echo "<script>switchButtons(0)</script>";
        echo '<script>loginAlert("Login Successfully");</script>';
        $_SESSION['Switch_button'] = "true";
        $_SESSION['logged_in'] = "false";
    }
}

if (isset($_SESSION['Switch_button'])) {
    echo "<script>switchButtons(0)</script>";
}

// if(isset($_SESSION['email'])) {
//     echo '<div class="form-item">';
//     echo '<label ID="Label1" Text="NAME" class="form-label">Name</label>';
//     echo '<input ID="Text1" class="form-input" value="'.$fetch_info['Name'].'"></input>';
//     echo '</div>';
//     echo '<div class="form-item">';
//     echo '<label ID="Label2" Text="E-MAIL" class="form-label">Email</label>';
//     echo '<input ID="Text2" class="form-input" value="'.$fetch_info['Email'].'"></input>';
//     echo '</div>';
//     echo '<div class="form-item">';
//     echo '<label ID="Label3" Text="PHONE" class="form-label">Contact</label>';
//     echo '<input ID="Text3" class="form-input" value="'.$fetch_info['Phone'].'"></input>';
//     echo '</div>';
// }
?>