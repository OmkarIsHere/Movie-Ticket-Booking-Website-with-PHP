<?php
$errors = array();
require '../other/config_mysqli.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $password = mysqli_real_escape_string($conn, $_POST['Password']);
    $check_email = "SELECT * FROM uLogin WHERE Email = '$email'";
    $res = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['Password'];
        $fetch_status = $fetch['Block'];
        if($fetch_status === "YES") {
            $errors['status'] = "You're Account is Blocked by Admin!";
		}
		else {
            if (password_verify($password, $fetch_pass)) {
                if(isset($_SESSION['Sign_up']) && $_SESSION['Sign_up'] == 'true' || isset($_SESSION['pswd_changed']) && $_SESSION['pswd_changed'] == 'true') {
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['logged_in'] = 'true';
                    unset($_POST);
                    if(isset($_SESSION['pswd_changed'])) {
                        unset($_SESSION['pswd_changed']);
                    }
                    if(isset($_SESSION['Sign_up'])) {
                        unset($_SESSION['Sign_up']);
                    }
                    header('location: ../index.php');
                }
    
                else {
                // $_SESSION['email'] = $email;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['logged_in'] = 'true';
                }
            }
            else {
                // unset($_POST['login']);
                $errors['email'] = "Incorrect email or password!";
            }
        }  
    }
    else {
        $errors['email'] = "Account doesn't exists Please Signup!";
    }
}

if (isset($_POST['signup'])) {

    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $contact = mysqli_real_escape_string($conn, $_POST['Contact']);
    $password = mysqli_real_escape_string($conn, $_POST['Password']);

    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['contact'] = $contact;

    $cpassword = $_POST['Confirm_Password'];

    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    }

    $email_check = "SELECT * FROM uLogin WHERE Email = '$email'";
    $res = mysqli_query($conn, $email_check);

    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "Email that you have entered is already exist!";
    }

    if (count($errors) === 0) {
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "not verified";
        $block = "NO";
        $date = date("d/m/Y");
        $insert_data = "INSERT INTO uLogin (Name, Email, Phone, Password, Code, OtpVerified, JoinedOn, Block)
                                values('$name', '$email','$contact', '$encpass', '$code', '$status', '$date', '$block')";
        $data_check = mysqli_query($conn, $insert_data);

        if ($data_check) {
        
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
            $mail->addAddress($email, $name);
            $mail->isHTML(true);

            $mail->Subject="Your verify code";
            $mail->Body="<p>Dear $name, </p> <h3>Your verify OTP code is $code <br></h3>
            <br><br>
            <p>With regrads,</p>
            <b>MovieTime</b>";

            $info = "We've sent a verification code to your email - $email";
            $_SESSION['info'] = $info;
            $_SESSION['password'] = $password;
            $_SESSION['verify'] = 'true';

            if (!$mail->send()) {
                $errors['otp-error'] = "Failed while sending code!";
            }
        }
        else {
        //  $errors['db-error'] = "Failed while inserting data into database!";
        $errors['db-error'] = "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
        }
    }
}

if (isset($_POST['check'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
    $check_code = "SELECT * FROM uLogin WHERE Code = $otp_code";
    $code_res = mysqli_query($conn, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['Code'];
        $email = $fetch_data['Email'];
        $code = 'N/A';
        $status = 'verified';
        $update_otp = "UPDATE uLogin SET Code = '$code', OtpVerified = '$status' WHERE Email = '$email'";
        $update_res = mysqli_query($conn, $update_otp);
        if ($update_res) {
            $_SESSION['Sign_up'] = 'true';
        } else {
            //$errors['otp-error'] = "Failed while updating code!";
            $errors['db-error'] = "Error: " . $update_res . "<br>" . mysqli_error($conn);
        }
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

if (isset($_POST['change-password'])) { 
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($conn, $_POST['Password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['Confirm_Password']);
    if ($password !== $cpassword) {
        $errors['password-reset'] = "Confirm password not matched!";
    } else {
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE uLogin SET Code = '$code', Password = '$encpass' WHERE Email = '$email'";
        $run_query = mysqli_query($conn, $update_pass);
        if ($run_query) {
            $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            $_SESSION['pswd_changed'] = 'true';
        } 
        else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}

if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $check_email = "SELECT * FROM uLogin WHERE Email='$email'";
    $run_sql = mysqli_query($conn, $check_email);
    $fetch_pass = mysqli_fetch_assoc($run_sql);
    if (mysqli_num_rows($run_sql) > 0 && $fetch_pass['Password'] != "") {
        // $fetch = mysqli_fetch_assoc($run_sql);
        $name = $fetch_pass['Name'];
        $code = rand(999999, 111111);
        $insert_code = "UPDATE uLogin SET Code = $code WHERE Email = '$email'";
        $run_query =  mysqli_query($conn, $insert_code);
        if ($run_query) {
        
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
            $mail->addAddress($email, $name);
            $mail->isHTML(true);

            $mail->Subject = "Password Reset Code";
            $mail->Body = "<p>Dear $name, </p> <h3>Your password reset code is $code <br></h3>
                    <br><br>
                    <p>With regards,</p>
                    <b>MovieTime</b>";

            $info = "We've sent a password reset otp to your email - $email";
            $_SESSION['info'] = $info;
            // $_SESSION['password'] = $password;
            $_SESSION['verify_pswd'] = 'true';

            if (!$mail->send()) {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } 
        
        else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}

if (isset($_POST['check-reset-otp'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
    $check_code = "SELECT * FROM uLogin WHERE Code = $otp_code";
    $code_res = mysqli_query($conn, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['Email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on this site.";
        $_SESSION['info'] = $info;
        $_SESSION['reset_pswd'] = 'true';
    } else {
        $errors['otp-error-reset'] = "You've entered incorrect code!";
    }
}

if (isset($_POST['email_contact'])) {
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $contact = mysqli_real_escape_string($conn, $_POST['Contact']);

    if (isset($_SESSION['FB_ID'])) {
        $email_check = "SELECT * FROM uLogin WHERE Email = '$email'";
        $res = mysqli_query($conn, $email_check);
    
        if (mysqli_num_rows($res) > 0) {
            $errors['email'] = "Email that you have entered is already exist!";
        }
    
        if (count($errors) === 0) {
            $id = $_SESSION['FB_ID'];
            $update_det = "UPDATE uLogin SET Email = '$email', Phone = '$contact' WHERE FacebookId = '$id'";
            $run_query = mysqli_query($conn, $update_det);
            if ($run_query) {
                $_SESSION['logged_in'] = 'true';
                header('location: ../index.php');
            } else {
                $errors['db-error'] = "Failed to update Email and Contact Number";
            }
        }
    }

    if (isset($_SESSION['GOOGLE_ID'])) {
        $v_email = $_SESSION['email'];
        $id = $_SESSION['GOOGLE_ID'];
        $update_det = "UPDATE uLogin SET Email = '$v_email', Phone = '$contact' WHERE GoogleId = '$id'";
        $run_query = mysqli_query($conn, $update_det);
        if ($run_query) {
            $_SESSION['logged_in'] = 'true';
            header('location: ../index.php');
        } else {
            $errors['db-error'] = "Failed to update Email and Contact Number";
        }
    }
}

?>
