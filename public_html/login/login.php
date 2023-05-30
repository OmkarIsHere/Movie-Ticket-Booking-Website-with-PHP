<?php
require_once '../login/login_signup.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Sign-up</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/animation.css">
</head>

<body>
    <section id="pre-loader">
        <div class="dots">
          <span style="--i:1;"></span>
          <span style="--i:2;"></span>
          <span style="--i:3;"></span>
          <span style="--i:4;"></span>
          <span style="--i:5;"></span>
          <span style="--i:6;"></span>
          <span style="--i:7;"></span>
          <span style="--i:8;"></span>
          <span style="--i:9;"></span>
          <span style="--i:10;"></span>
          <span style="--i:11;"></span>
          <span style="--i:12;"></span>
          <span style="--i:13;"></span>
          <span style="--i:14;"></span>
          <span style="--i:15;"></span>
        </div>
        <div class="loader-text">
            <h4>Please Wait...</h4>
        </div>
    </section>

    <section id="load-html">
        <section id="header">
            <img src="../img/MOVIEtime_white.png" alt="logo" class="logo" />

            <div id="SearchContainer" class="SearchContainer">

                <input type="text" class="searchbar" name="searchbar " id="searchbar" placeholder="Search movies theaters...">
                <button type="submit" class="SearchBtn"><i class="fa-solid fa-magnifying-glass"></i></button>

                <div id="searchresult">

                </div>
            </div>

            <div class="LocationContainer" id="LocationContainer">
                <img src="../img/gps.png" alt="location" class="locationImg">
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
                <button type="submit" class="LocationBtn2" id="LocationToggle" onclick="ToggleLocation()"><i class="fa-solid fa-location-arrow"></i></button>

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
                        <div class="google_login_img">
                            <?php
                            if (isset($_SESSION['profile'])) {
                                echo $_SESSION['profile'];
                            }
                            ?>
                        </div>
                        <span>
                            <?php
                            if (isset($user['Name'])) {
                                echo $user['Name'];
                            }
                            if (isset($_SESSION['email'])) {
                                echo $fetch_info['Name'];
                            }
                            ?>
                        </span>
                    </div>
                    <button class="logout_btn" onclick="switchButtons(1)">
                        <a href="../login/logout.php">Logout</a>
                    </button>
                </div>
            </div>
            <ul id="menu">
                <div class="MyloginButton">
                    <img src="../img/gift-card.png" alt="gift" class="gift">
                    <h3>Unlock special offers & <br>great benefits</h3>
                    <a href="../login/login.php"><button class="loginRegister" id="login_register">Login/Register</button></a>
                </div>
                <div class="menu-links">
                    <a href="#" id="dashboard">
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
                    <a href="#">
                        <li>Show me more</li>
                    </a>
                </div>
            </ul>
        </section>

        <section class="container-login forms">

            <div class="form login" id="login">
                <div class="form-content">
                    <header>Login</header>
                    <?php
                    if (isset($_SESSION['info'])) {
                    ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (count($errors) > 0) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <form action="../login/login.php" method="POST" autocomplete="">
                        <div class="field input-field">
                            <input type="email" placeholder="Email" class="input" name="Email" required>
                        </div>

                        <div class="field input-field">
                            <input type="password" placeholder="Password" class="password" name="Password" required>
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="form-link">
                            <a href="javascript:void(0);" onclick="show_hide_Panels(4);" class="forgot-pass">Forgot password?</a>
                        </div>

                        <div class="field button-field">
                            <!-- <button>Login</button> -->
                            <input class="form-control button" type="submit" name="login" value="Login">
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Don't have an account? <a href="javascript:void(0);" onclick="show_hide_Panels(2);" class="link signup-link">Signup</a></span>
                    </div>
                </div>

                <div class="line"></div>

                <div class="media-options">
                    <a href="javascript:void(0)" onclick="fbLogin()" class="field facebook">
                        <i class='bx bxl-facebook facebook-icon'></i>
                        <span>Login with Facebook</span>
                    </a>
                </div>

                <div class="media-options">
                    <a href="javascript:void(0)" onclick="signIn()" class="field google">
                        <!-- <a href="" class="field google"> -->

                        <img src="../img/google.png" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div>

            </div>

            <!-- Signup Form -->
            <div class="form signup" id="signup">
                <div class="form-content">
                    <header>Signup</header>
                    <?php
                    if (count($errors) == 1) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                    } elseif (count($errors) > 1) {
                    ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach ($errors as $showerror) {
                            ?>
                                <li><?php echo $showerror; ?></li>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <form action="#" action="../login/login.php" method="post">
                        <div class="field input-field">
                            <input type="text" placeholder="Name" class="input" name="Name" required value="<?php if (isset($_SESSION['name'])) {
                                                                                                                echo $_SESSION['name'];
                                                                                                            } ?>">
                        </div>

                        <div class="field input-field">
                            <input type="email" placeholder="Email" class="input" name="Email" required value="<?php if (isset($_SESSION['email'])) {
                                                                                                                    echo $_SESSION['email'];
                                                                                                                } ?>">
                        </div>

                        <div class="field input-field">
                            <input type="tel" placeholder="Contact Number" minlength="10" maxlength="10" class="input" name="Contact" required value="<?php if (isset($_SESSION['contact'])) {
                                                                                                                                                            echo $_SESSION['contact'];
                                                                                                                                                        } ?>">
                        </div>

                        <div class="field input-field">
                            <input type="password" placeholder="Password" class="password" name="Password" required>
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="field input-field">
                            <input type="password" placeholder="Confirm password" class="con_password" name="Confirm_Password" required>
                            <i class='bx bx-hide eye-icon1'></i>
                        </div>

                        <div class="field button-field">
                            <input class="form-control button" type="submit" name="signup" value="Signup">
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Already have an account? <a href="javascript:void(0);" onclick="show_hide_Panels(1);" class="link login-link">Login</a></span>
                    </div>
                </div>

                <div class="line"></div>

                <div class="media-options">
                    <a href="javascript:void(0)" onclick="fbLogin()" class="field facebook">
                        <i class='bx bxl-facebook facebook-icon'></i>
                        <span>Login with Facebook</span>
                    </a>
                </div>

                <div class="media-options">
                    <a href="javascript:void(0)" onclick="signIn()" class="field google">
                        <!-- <a href="" class="field google"> -->

                        <img src="../img/google.png" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div>
            </div>

            <div class="form verification" id="verification">
                <div class="form-content">
                    <header>Email Verification</header>
                    <?php
                    if (isset($_SESSION['info'])) {
                    ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (count($errors) > 0) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <form action="" method="post">
                        <div class="field input-field">
                            <input type="text" placeholder="Enter Verification Code" class="input" name="otp" required />
                        </div>

                        <div class="field button-field">
                            <input class="form-control button" type="submit" name="check" value="Submit">
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Already have an account? <a href="javascript:void(0);" onclick="show_hide_Panels(1);" class="link login-link">Login</a></span>
                    </div>
                </div>

                <div class="line"></div>

                <div class="media-options">
                    <a href="javascript:void(0)" onclick="fbLogin()" class="field facebook">
                        <i class='bx bxl-facebook facebook-icon'></i>
                        <span>Login with Facebook</span>
                    </a>
                </div>

                <div class="media-options">
                    <a href="javascript:void(0)" onclick="signIn()" class="field google">
                        <!-- <a href="" class="field google"> -->

                        <img src="../img/google.png" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div>

            </div>

            <div class="form reset_code" id="reset_code">
                <div class="form-content">
                    <header>Code Verification</header>
                    <?php
                    if (isset($_SESSION['info'])) {
                    ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (count($errors) > 0) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <form action="" method="post">
                        <div class="field input-field">
                            <input type="number" placeholder="Enter Verification Code" class="input" name="otp" required />
                        </div>

                        <div class="field button-field">
                            <input class="form-control button" type="submit" name="check-reset-otp" value="Submit">
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Already have an account? <a href="javascript:void(0);" onclick="show_hide_Panels(1);" class="link login-link">Login</a></span>
                    </div>
                </div>

                <div class="line"></div>

                <div class="media-options">
                    <a href="javascript:void(0)" onclick="fbLogin()" class="field facebook">
                        <i class='bx bxl-facebook facebook-icon'></i>
                        <span>Login with Facebook</span>
                    </a>
                </div>

                <div class="media-options">
                    <a href="javascript:void(0)" onclick="signIn()" class="field google">
                        <!-- <a href="" class="field google"> -->

                        <img src="../img/google.png" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div>

            </div>

            <div class="form forgot_password" id="forgot_password">
                <div class="form-content">
                    <header>Forgot Password</header>
                    <?php
                    if (isset($_SESSION['info'])) {
                    ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (count($errors) > 0) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <span>Enter your email address</span>
                    <form action="" method="post">
                        <div class="field input-field">
                            <input type="email" placeholder="Enter email address" class="input" name="Email" required />
                        </div>

                        <div class="field button-field">
                            <input class="form-control button" type="submit" name="check-email" value="Submit">
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Already have an account? <a href="javascript:void(0);" onclick="show_hide_Panels(1);" class="link login-link">Login</a></span>
                    </div>
                </div>

                <div class="line"></div>

                <div class="media-options">
                    <a href="javascript:void(0)" onclick="fbLogin()" class="field facebook">
                        <i class='bx bxl-facebook facebook-icon'></i>
                        <span>Login with Facebook</span>
                    </a>
                </div>

                <div class="media-options">
                    <a href="javascript:void(0)" onclick="signIn()" class="field google">
                        <!-- <a href="" class="field google"> -->

                        <img src="../img/google.png" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div>

            </div>

            <div class="form new_password" id="new_password">
                <div class="form-content">
                    <header>New Password</header>
                    <!-- <span>Enter your email address</span> -->
                    <?php
                    if (isset($_SESSION['info'])) {
                    ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (count($errors) > 0) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <form action="" method="post">
                        <div class="field input-field">
                            <input type="password" placeholder="Create New Password" class="password" name="Password" required />
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="field input-field">
                            <input type="password" placeholder="Confirm Password" class="con_password" name="Confirm_Password" required />
                            <i class='bx bx-hide eye-icon1'></i>
                        </div>

                        <div class="field button-field">
                            <input class="form-control button" type="submit" name="change-password" value="Submit">
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Already have an account? <a href="javascript:void(0);" onclick="show_hide_Panels(1);" class="link login-link">Login</a></span>
                    </div>
                </div>

                <div class="line"></div>

                <div class="media-options">
                    <a href="javascript:void(0)" onclick="fbLogin()" class="field facebook">
                        <i class='bx bxl-facebook facebook-icon'></i>
                        <span>Login with Facebook</span>
                    </a>
                </div>

                <div class="media-options">
                    <a href="javascript:void(0)" onclick="signIn()" class="field google">
                        <!-- <a href="" class="field google"> -->

                        <img src="../img/google.png" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div>

            </div>

            <div class="form email_contact" id="email_contact">
                <div class="form-content">
                    <header>Signup</header>
                    <!-- <span>Enter your email address</span> -->
                    <?php
                    if (isset($_SESSION['info'])) {
                    ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (count($errors) > 0) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <form action="" method="post">
                        <div class="field input-field">
                            <input type="email" placeholder="Email" class="input" name="Email" required value="<?php if (isset($_SESSION['email'])) {
                                                                                                                    echo $_SESSION['email'];
                                                                                                                } ?>">
                        </div>

                        <div class="field input-field">
                            <input type="tel" placeholder="Contact Number" minlength="10" maxlength="10" class="input" name="Contact" required>
                        </div>

                        <div class="field button-field">
                            <input class="form-control button" type="submit" name="email_contact" value="Submit">
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Already have an account? <a href="javascript:void(0);" onclick="show_hide_Panels(1);" class="link login-link">Login</a></span>
                    </div>
                </div>

                <div class="line"></div>

                <div class="media-options">
                    <a href="javascript:void(0)" onclick="fbLogin()" class="field facebook">
                        <i class='bx bxl-facebook facebook-icon'></i>
                        <span>Login with Facebook</span>
                    </a>
                </div>

                <div class="media-options">
                    <a href="javascript:void(0)" onclick="signIn()" class="field google">
                        <!-- <a href="" class="field google"> -->

                        <img src="../img/google.png" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div>

            </div>

        </section>

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
                        <li class="list"><a href="#">4DX</a></li>
                        <li class="list"><a href="#">PLAYHOUSE</a></li>
                        <li class="list"><a href="#">GOLD</a></li>

                    </ul>
                </div>
                <div class="col3-f1">
                    <h3>CINEMAS</h3>
                    <ul>
                        <li class="list"><a href="#">CINEMAS</a><span>><a href="#">V PRISTINE</a></span></li>
                        <li class="list"><a href="#">UPCOMING</a><span>><a href="#">NEST</a></span></li>
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
                        <img src="../img/Paytm-Logo.wine.png" alt="supports" class="supportimage" />
                        <img src="../img/notonsecure.png" alt="supports" class="supportimage" />
                    </div>
                    <div class="policyConditiionTerms">
                        <a href="#">PRIVACY<br />POLICY</a>
                        <a href="#">TERMS &<br />CONDITIONS</a>
                        <a href="#">TERMS OF<br />USE</a>
                    </div>
                    <div class="socialmediaContainer">
                        <img src="../img/facebook.png" alt="socialmedia" class="socialmediastart" />
                        <img src="../img/google-plus.png" alt="socialmedia" class="socialmedia" />
                        <img src="../img/youtube.png" alt="socialmedia" class="socialmedia" />
                        <img src="../img/twitter.png" alt="socialmedia" class="socialmedia" />
                        <img src="../img/instagram.png" alt="socialmedia" class="socialmedia" />
                        <img src="../img/linkedin.png" alt="socialmedia" class="socialmedia" />
                    </div>
                </div>
                <div class="row2-f2">
                    <p>COPYRIGHT © 2022 LYNX CINEMAS LTD. ALL RIGHTS RESERVED.</p>
                </div>
            </div>
        </footer>
    </section>


    <script src="../js/jquery.js"></script>
    <script src="../js/navbar.js"></script>
    <script src="../js/home.js"></script>
    <script src="../js/facebook.js"></script>
    <script src="../js/google.js"></script>
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <?php
    if (isset($_SESSION['logged_in'])) {
        $index = 0;
        if(isset($_SESSION['pswd_changed']) && $_SESSION['pswd_changed'] == 'true') {
            echo '<script>backButton(1);</script>';
            $index = 1;
        }
        if ($_SESSION['logged_in'] == 'true' && $index == 0) {
            echo '<script>backButton(0);</script>';
        }
    }

    if (isset($_SESSION['Sign_up'])) {
        if ($_SESSION['Sign_up'] == 'true') {
            echo '<script>registerAlert("Register Successfully");</script>';
            // unset($_SESSION['Sign_up']);
        }
    }

    if (isset($_SESSION['verify'])) {
        if ($_SESSION['verify'] == 'true') {
            echo '<script>show_hide_Panels(3);</script>';
            unset($_SESSION['verify']);
            // echo '<script>showSuccess("We ve sent a verification code to your email");</script>';
        }
    }

    if (count($errors) >= 1) {
        if ($errors['password'] == "Confirm password not matched!") {
            echo '<script>show_hide_Panels(2);</script>';
        }
        if ($errors['password-reset'] == "Confirm password not matched!") {
            echo '<script>show_hide_Panels(6);</script>';
        }
        if ($errors['email'] == "Incorrect email or password!") {
            echo '<script>show_hide_Panels(1);</script>';
        }
        if ($errors['email'] == "Email that you have entered is already exist!") {
            echo '<script>show_hide_Panels(2);</script>';
        }
        if ($errors['otp-error'] == "Failed while sending code!") {
            echo '<script>show_hide_Panels(2);</script>';
        }
        if ($errors['otp-error-reset'] == "You've entered incorrect code!") {
            echo '<script>show_hide_Panels(5);</script>';
        }
        if ($errors['email'] == "This email address does not exist!") {
            echo '<script>show_hide_Panels(4);</script>';
        }
        if ($errors['otp-error'] == "You've entered incorrect code!") {
            echo '<script>show_hide_Panels(3);</script>';
        }
    }

    if (isset($_SESSION['verify_pswd'])) {
        if ($_SESSION['verify_pswd'] == 'true') {
            echo '<script>show_hide_Panels(5);</script>';
            // echo '<script>showSuccess("We ve sent a password reset otp to your email");</script>';
            unset($_SESSION['verify_pswd']);
        }
    }

    if (isset($_SESSION['pswd_changed'])) {
        if ($_SESSION['pswd_changed'] == 'true') {
            echo '<script>show_hide_Panels(1);</script>';
            echo '<script>showSuccess("Password Changed Successfully");</script>';
            // unset($_SESSION['pswd_changed']);
        }
    }

    if (isset($_SESSION['reset_pswd'])) {
        if ($_SESSION['reset_pswd'] == 'true') {
            echo '<script>show_hide_Panels(6);</script>';
            unset($_SESSION['reset_pswd']);
        }
    }

    if (isset($_SESSION['FB_ID']) || isset($_SESSION['GOOGLE_ID'])) {
        $info = "Please Enter you're Email and Phone Number to continue";
        $_SESSION['info'] = $info;
        echo '<script>show_hide_Panels(7);</script>';
    }
    ?>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#searchbar').keyup(function() {
            var query = $(this).val();
            if (query != '') {

                $.ajax({
                    url: "../header-footer/search.php",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {

                        $('#searchresult').fadeIn();
                        $('#searchresult').html(data);

                        // console.log(data);
                    },
                    error: function(xhr, status, error) {
                        // console.log(status);
                    }

                });
            } else {
                $('#searchresult').fadeOut();
                $('#searchresult').html("");
            }
        });
        $(document).on('click', 'li', function() {
            $('#searchbar').val($(this).text());
            $('searchresult').fadeOut();
        });
    });
</script>

<?php mysqli_close($conn); ?>