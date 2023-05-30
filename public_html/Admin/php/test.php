<?php
$err ="";
$ses = "";


if (isset($_POST['btn'])) {

$otp = rand(1111,9999);

$no = $_POST['num'];
if(preg_match("/^\d+\.?\d*$/",$no) && strlen($no)==10){

$fields = array(
"variables_values" => "$otp",
"route" => "otp",
"numbers" => "$no",
);

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_SSL_VERIFYHOST => 0,
CURLOPT_SSL_VERIFYPEER => 0,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => json_encode($fields),
CURLOPT_HTTPHEADER => array(
"authorization: tgn9FVpd6Yi2G8bWqvBzw34hf5rLla1oCEAPuJDMsxKReQcH7XeOin4WkyhBoTPEQJ8GdSjZ1HVcI9fw",
"accept: */*",
"cache-control: no-cache",
"content-type: application/json"
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
  echo $response;
// $data = json_decode($response);
// $sts = $data->return;
// if ($sts == false) {
// $err = "Otp Not Send";
// }else{
// $ses = "Your OTP is send";
// }
}


}else{
$err = "Invalied Mobile Number";
}

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Php send sms</title>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"></head>

<body>

<div class=" container mt-5">
<h1 class="text-center">Send OTP IN PHP</h1>
<form action="" method="post" class="mt-5">
<input type="text" placeholder="Mobile number" name="num" class="form-control"><br>
<input type="submit" class=" btn btn-primary" value="Send OTP" name="btn">
</form>
<p class=" text-center text-danger"><?php echo $err; ?></p>
<p class=" text-center text-success"><?php echo $ses; ?></p>
</div>

</body>

</html>