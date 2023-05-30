<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
    

    header('Content-Type:application/json');
    $conn = mysqli_connect("localhost","id20121598_root","Movietime@123","id20121598_movietime");
    // CHECK DATABASE CONNECTION
    if(mysqli_connect_errno()){
        echo "Connection Failed".mysqli_connect_error();
        exit;
    }

    if (isset($_POST['Login'])) {
        
        // $arr[] = array();
        
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        
        $check_email = "SELECT * FROM uLogin WHERE Email = '$email'";
        $res = mysqli_query($conn, $check_email);

        if (mysqli_num_rows($res) != 0) {
            
            $i = 0;

            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['Password'];
            $fetch_status = $fetch['Block'];

            if($fetch_status === "YES") {
                $response['status'] = "error";
                $response['error'] = "You're Account is Blocked by Admin!";
                echo json_encode($response, JSON_PRETTY_PRINT);
            }

            else {
                if (password_verify($password, $fetch_pass)) {
                    
                    $response['status'] = "success";
                    
                    $response['UserId'] = $fetch['UserId'];
                    $response['Name'] = $fetch['Name'];
                    $response['Email'] = $fetch['Email'];
                    $response['Phone'] = $fetch['Phone'];
                    echo json_encode($response, JSON_PRETTY_PRINT);
                }
                else {
                    $response['status'] = "error";
                    $response['error'] = "Incorrect email or password!";
                    echo json_encode($response, JSON_PRETTY_PRINT);
                }
            }  
        }
        else {
            $response['status'] = "error";
            $response['error'] = "Account doesn't exists Please Signup!";
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }

    if (isset($_POST['SignUp'])) {
        
        $name = $_POST['Username'];
        $email = $_POST['Email'];
        $contact = $_POST['Phone'];
        $password = $_POST['Password'];
        
        $email_check = "SELECT * FROM uLogin WHERE Email = '$email'";
        $res = mysqli_query($conn, $email_check);

        if (mysqli_num_rows($res) > 0) {
            $response['status'] = "error";
            $response['error'] = "Email that you have entered is already exist!";
            echo json_encode($response, JSON_PRETTY_PRINT);
        }

        else {
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $code = "N/A";
            $status = "verified";
            $block = "NO";
            $date = date("d/m/Y");
            $insert_data = "INSERT INTO uLogin (Name, Email, Phone, Password, Code, OtpVerified, JoinedOn, Block)
                                    values('$name', '$email','$contact', '$encpass', '$code', '$status', '$date', '$block')";
            $data_check = mysqli_query($conn, $insert_data);
    
            if ($data_check) {
                $response['status'] = "success";
                echo json_encode($response, JSON_PRETTY_PRINT);
            }
    
            else {
                $response['status'] = "error";
                $response['error'] = "Error! Something Went Wrong Please Try Again After Some Time";
                echo json_encode($response, JSON_PRETTY_PRINT);
            }
        }

    }

    if (isset($_POST['Change_Password'])) {
        
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        
        $code = "N/A";
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE uLogin SET Code = '$code', Password = '$encpass' WHERE Email = '$email'";
        $run_query = mysqli_query($conn, $update_pass);
        if ($run_query) {
            $response['status'] = "success";
            $response['info'] = "Your password changed. Now you can login with your new password.";
            echo json_encode($response, JSON_PRETTY_PRINT);
        } 
        else {
            $response['status'] = "error";
            $response['error'] = "Failed to change your password!";
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
        
    }

    if (isset($_POST['Check_Otp'])) {
        
        $email = $_POST['Email'];
        $otp_code = $_POST['Otp'];
        
        $check_code = "SELECT * FROM uLogin WHERE Code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);

        if (mysqli_num_rows($code_res) > 0) {
            $response['status'] = "success";
            echo json_encode($response, JSON_PRETTY_PRINT);
        } 
        
        else {
            $response['status'] = "error";
            $response['error'] = "You've entered incorrect code!";
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
        
    }

    if (isset($_POST['Send_Email'])) {
        
        $email = $_POST['Email'];

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

                // $info = "We've sent a password reset otp to your email - $email";

                if (!$mail->send()) {
                    $response['status'] = "error";
                    $response['error'] = "Failed while sending code!";
                    echo json_encode($response, JSON_PRETTY_PRINT);
                    
                }

                else {
                    $response['status'] = "success";
                    $response['verify_code'] = $code;
                    echo json_encode($response, JSON_PRETTY_PRINT);
                }
            } 
            
            else {
                $response['status'] = "error";
                $response['error'] = "Error! Database Error";
                echo json_encode($response, JSON_PRETTY_PRINT);
            }
        } 
        
        else {
            $response['status'] = "error";
            $response['error'] = "This email address does not exist!";
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }

    if(isset($_POST['Facebook'])) {
        
        $id=mysqli_real_escape_string($conn,$_POST['FG_Id']);
        $name=mysqli_real_escape_string($conn,$_POST['Username']);
        $email=mysqli_real_escape_string($conn,$_POST['Email']);
        $phone=mysqli_real_escape_string($conn,$_POST['Phone']);

        $res=mysqli_query($conn,"SELECT * FROM uLogin WHERE FacebookId = '$id'");

        if(mysqli_num_rows($res)>0) {

            $fetch = mysqli_fetch_assoc($res);
            $fetch_status = $fetch['Block'];

            if($fetch_status !== "YES") {
                $response['status'] = "success";
                echo json_encode($response, JSON_PRETTY_PRINT);
            }

            else {
                $response['status'] = "error";
                $response['error'] = "You're Account is Blocked by Admin!";
                echo json_encode($response, JSON_PRETTY_PRINT);
            }
        }
        else{

            $date = date("d/m/Y");
            $code = "N/A";
            $status = "verified";
            $block = "NO";
            $insert_data = "INSERT INTO `uLogin` (`UserId`, `Name`, `Phone`, `Email`, `Password`, `GoogleId`, `FacebookId`, `OtpVerified`, `Code`, `JoinedOn`, `Block`) 
            VALUES (NULL, '$name', '$phone', '$email', 'N/A', 'N/A', '$id', '$status', 'N/A', '$date', 'NO')";
            $data_check = mysqli_query($conn, $insert_data);

            if($data_check) {
                $response['status'] = "success";
                echo json_encode($response, JSON_PRETTY_PRINT);
            }

            else {
                $response['status'] = "error";
                $response['error'] = "Error! Something Went Wrong";
                echo json_encode($response, JSON_PRETTY_PRINT);
            }
        }
    }
    
    if(isset($_POST['Google'])) {
        
        $id=mysqli_real_escape_string($conn,$_POST['FG_Id']);
        $name=mysqli_real_escape_string($conn,$_POST['Username']);
        $email=mysqli_real_escape_string($conn,$_POST['Email']);
        $phone=mysqli_real_escape_string($conn,$_POST['Phone']);

        $date = date("d/m/Y");
        $code = "N/A";
        $status = "verified";
        $block = "NO";
        $insert_data = "INSERT INTO `uLogin` (`UserId`, `Name`, `Phone`, `Email`, `Password`, `GoogleId`, `FacebookId`, `OtpVerified`, `Code`, `JoinedOn`, `Block`) 
        VALUES (NULL, '$name', '$phone', '$email', 'N/A', '$id', 'N/A', '$status', 'N/A', '$date', 'NO')";
        $data_check = mysqli_query($conn, $insert_data);

        if($data_check) {
            $response['status'] = "success";
            echo json_encode($response, JSON_PRETTY_PRINT);
        }

        else {
            $response['status'] = "error";
            $response['error'] = "Error: " . mysqli_error($conn);
            echo json_encode($response, JSON_PRETTY_PRINT);
        }

    }

    if(isset($_POST["check_google"])) {

        $id=mysqli_real_escape_string($conn,$_POST['FG_Id']);
        $res=mysqli_query($conn,"SELECT * FROM uLogin WHERE GoogleId = '$id'");

        if(mysqli_num_rows($res)>0) {

            $fetch = mysqli_fetch_assoc($res);
            $fetch_status = $fetch['Block'];

            if($fetch_status !== "YES") {
                $response['status'] = "success";
                $response['UserId'] = $fetch['UserId'];
                $response['Phone'] = $fetch['Phone'];
                echo json_encode($response, JSON_PRETTY_PRINT);
            }

            else {
                $response['status'] = "error";
                $response['error'] = "You're Account is Blocked by Admin!";
                echo json_encode($response, JSON_PRETTY_PRINT);
            }
        }

        else {
            $response['status'] = "google_signup";
            echo json_encode($response, JSON_PRETTY_PRINT);
        }

    }

    if(isset($_POST["check_facebook"])) {

        $id=mysqli_real_escape_string($conn,$_POST['FG_Id']);
        $res=mysqli_query($conn,"SELECT * FROM uLogin WHERE GoogleId = '$id'");

        if(mysqli_num_rows($res)>0) {

            $fetch = mysqli_fetch_assoc($res);
            $fetch_status = $fetch['Block'];

            if($fetch_status !== "YES") {
                $response['status'] = "success";
                $response['UserId'] = $fetch['UserId'];
                $response['Phone'] = $fetch['Phone'];
                echo json_encode($response, JSON_PRETTY_PRINT);
            }

            else {
                $response['status'] = "error";
                $response['error'] = "You're Account is Blocked by Admin!";
                echo json_encode($response, JSON_PRETTY_PRINT);
            }
        }

        else {
            $response['status'] = "facebook_signup";
            echo json_encode($response, JSON_PRETTY_PRINT);
        }

    }
 
?>