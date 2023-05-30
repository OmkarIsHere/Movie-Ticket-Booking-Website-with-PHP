<title>Payment</title>

<!-- <div class="container">
	<div class="row">
	<h2>Example: Razorpay Payment Gateway Integration in PHP</h2>
	<br><br><br> -->
<?php
require('config.php');
require('razorpay-php/Razorpay.php');
session_start();
$order_id = rand(999999, 111111);
use Razorpay\Api\Api;
$api = new Api($keyId, $keySecret);
$orderData = [
    'receipt'         => 3456,
    'amount'          => $_POST['amount'] * 100,
    'currency'        => $_POST['currency'],
    'payment_capture' => 1
];
$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];
$_SESSION['razorpay_order_id'] = $razorpayOrderId;
$displayAmount = $amount = $orderData['amount'];
$_SESSION['total-amount'] = $orderData['amount']  / 100;
if ($displayCurrency !== 'INR') {
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}
$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $_POST['item_name'],
    "description"       => $_POST['item_description'],
    "image"             => "",
    "prefill"           => [
    "name"              => $_POST['cust_name'],
    "email"             => $_POST['email'],
    "contact"           => $_POST['contact'],
    ],
    "notes"             => [
    "address"           => $_POST['address'],
    "merchant_order_id" => $order_id,
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);


require("checkout/manual.php");
?>