<?php
	require '../other/config_mysqli.php';

	$name=mysqli_real_escape_string($conn,$_POST['name']);
	$id=mysqli_real_escape_string($conn,$_POST['id']);
	// $email=mysqli_real_escape_string($conn,$_POST['email']);

	$res=mysqli_query($conn,"SELECT * FROM uLogin WHERE FacebookId = '$id'");
	$_SESSION['FB_ID']=$id;
	$_SESSION['FB_NAME']=$name;
	// $_SESSION['FB_EMAIL']=$email;
	if(mysqli_num_rows($res)>0){
		$fetch = mysqli_fetch_assoc($res);
		$fetch_status = $fetch['Block'];
		if($fetch_status !== "YES") {
			$_SESSION['logged_in'] = 'true';
		  }
		  else {
			  header('Location: login.php');
			  $errors['status'] = "You're Account is Blocked by Admin!";
		  }
	}
	else{
		$date = date("d/m/Y");
		$insert_data = "INSERT INTO `uLogin` (`UserId`, `Name`, `Phone`, `Email`, `Password`, `GoogleId`, `FacebookId`, `OtpVerified`, `Code`, `JoinedOn`, `Block`) 
		VALUES (NULL, '$name', 'N/A', 'N/A', 'N/A', 'N/A', '$id', 'N/A', 'N/A', '$date', 'NO')";
		$data_check = mysqli_query($conn, $insert_data);
		if($data_check) {
			$_SESSION['logged_in'] = 'FG_verify';
			header('Location: login.php');
		}
	}
?>