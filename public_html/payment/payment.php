<?php
session_start();
// require '../login/login_status.php';
require 'config_mysqli.php';
require 'payment_code.php';

$seat_num = array();
$total_amt = 0;

$i = 0;
if (isset($_POST['submit'])) {
    if (!empty($_POST['checkArr'])) {
        foreach ($_POST['checkArr'] as $checked) {
            $seat_num[$i] = $checked;
            $i++;
        }
        if($i==5){
            $_SESSION["no-of-selected-seat"] = 5;
        }elseif($i==4){
            $_SESSION["no-of-selected-seat"] = 4;
        }elseif($i==3){
            $_SESSION["no-of-selected-seat"] = 3;
        }elseif($i==2){
            $_SESSION["no-of-selected-seat"] = 2;
        }else{
            $_SESSION["no-of-selected-seat"] = 1;
        }

    }
}
$no_of_selected_seat = $i;
$seat_amt = array();
$all_selected_seat = array();

for ($j = 0; $j < $no_of_selected_seat; $j++) {
    $seat_amt[$j] = substr($seat_num[$j], 0, 3);
    $all_selected_seat[$j] = substr($seat_num[$j], 4, 7);
    $total_amt += $seat_amt[$j];
}

$today_date = date("Y-m-d");

$tem = 1;
$temp_seat =  "";
for ($j = 0; $j < $no_of_selected_seat; $j++) {

    $_SESSION["seat$tem"] = $all_selected_seat[$j];
    $_SESSION["amt$tem"] = $seat_amt[$j];
    if ($seat_amt[$j] == 150) {
        $_SESSION["seatType$tem"] = "Silver";
    } elseif ($seat_amt[$j] == 200) {
        $_SESSION["seatType$tem"] = "Gold";
    } elseif ($seat_amt[$j] == 300) {
        $_SESSION["seatType$tem"] = "Platinum";
    }
    $temp_seat .= " " . $_SESSION["seatType$tem"];
    $tem++;
}

// $_SESSION["AllSeatType"] = $temp_seat;

// if (isset($_SESSION['total-amount'])) {
//     $_SESSION["totalAmt"] = $_SESSION['total-amount'];

//     $amount = $_SESSION["totalAmt"];
//     $convFees = 17.00;
//     $gst = $amount * 3.0 / 100;
//     $total = $amount + $convFees + $gst;
//     $total_float = number_format($total, 2);
//     $_SESSION['total'] = $total_float - $convFees - $gst;
// } else {
    $_SESSION["totalAmt"] = $total_amt;

    $amount = $_SESSION["totalAmt"];
    $convFees = 17.00;
    $gst = $amount * 3.0 / 100;
    $total = $amount + $convFees + $gst;
    // $total_float = number_format($total, 2);
    $_SESSION['total'] = $total;
// }

?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="../css/payment.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        <section class="payment-section">
            <section class="payment-row" id="payment-options">
                <div class="contact-section">
                    <div class="contact-title">
                        <h3>YOUR CONTACT DETAILS</h3>
                    </div>

                    <div class="contact-form">
                        <?php
                        if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
                            $email = $_SESSION['email'];
                            $sql = "SELECT * FROM uLogin WHERE Email = '$email'";
                            $run_Sql = mysqli_query($conn, $sql);
                            if ($run_Sql) {
                                $fetch_info = mysqli_fetch_assoc($run_Sql);
                                $_SESSION['p_name'] = $fetch_info['Name'];
                                $_SESSION['p_email'] = $fetch_info['Email'];
                                $_SESSION['p_phone'] = $fetch_info['Phone'];

                                if(!isset($_SESSION['userid'])) {
                                    $_SESSION['userid'] = $fetch_info["UserId"];
                                }
                            }

                            echo '<div class="form-item">';
                            echo '<label ID="Label1" Text="NAME" class="form-label">Name</label>';
                            echo '<input ID="Text1" class="form-input" value="' . $fetch_info['Name'] . '"></input>';
                            echo '</div>';
                            echo '<div class="form-item">';
                            echo '<label ID="Label2" Text="E-MAIL" class="form-label">Email</label>';
                            echo '<input ID="Text2" class="form-input" value="' . $fetch_info['Email'] . '"></input>';
                            echo '</div>';
                            echo '<div class="form-item">';
                            echo '<label ID="Label3" Text="PHONE" class="form-label">Contact</label>';
                            echo '<input ID="Text3" class="form-input" value="' . $fetch_info['Phone'] . '"></input>';
                            echo '</div>';
                        } 
                        
                        else if (isset($_SESSION['FB_ID'])) {
                            $id = $_SESSION['FB_ID'];
                            $get_user = mysqli_query($conn, "SELECT * FROM uLogin WHERE `FacebookId`='$id'");

                            if (mysqli_num_rows($get_user) > 0) {
                                $user = mysqli_fetch_assoc($get_user);
                                $_SESSION['p_name'] = $user['Name'];
                                $_SESSION['p_email'] = $user['Email'];
                                $_SESSION['p_phone'] = $user['Phone'];

                                if(!isset($_SESSION['userid'])) {
                                    $_SESSION['userid'] = $user["UserId"];
                                }
                            }

                            echo '<div class="form-item">';
                            echo '<label ID="Label1" Text="NAME" class="form-label">Name</label>';
                            echo '<input ID="Text1" class="form-input" value="' . $user['Name'] . '"></input>';
                            echo '</div>';
                            echo '<div class="form-item">';
                            echo '<label ID="Label2" Text="E-MAIL" class="form-label">Email</label>';
                            echo '<input ID="Text2" class="form-input" value="' . $user['Email'] . '"></input>';
                            echo '</div>';
                            echo '<div class="form-item">';
                            echo '<label ID="Label3" Text="PHONE" class="form-label">Contact</label>';
                            echo '<input ID="Text3" class="form-input" value="' . $user['Phone'] . '"></input>';
                            echo '</div>';
                        } 
                        
                        else if (isset($_SESSION['GOOGLE_ID'])) {
                            $id = $_SESSION['GOOGLE_ID'];
                            $get_user = mysqli_query($conn, "SELECT * FROM uLogin WHERE `GoogleId`='$id'");

                            if (mysqli_num_rows($get_user) > 0) {
                                $user = mysqli_fetch_assoc($get_user);
                                $_SESSION['p_name'] = $user['Name'];
                                $_SESSION['p_email'] = $user['Email'];
                                $_SESSION['p_phone'] = $user['Phone'];
                                
                                if(!isset($_SESSION['userid'])) {
                                    $_SESSION['userid'] = $user["UserId"];
                                }
                            }

                            echo '<div class="form-item">';
                            echo '<label ID="Label1" Text="NAME" class="form-label">Name</label>';
                            echo '<input ID="Text1" class="form-input" value="' . $user['Name'] . '"></input>';
                            echo '</div>';
                            echo '<div class="form-item">';
                            echo '<label ID="Label2" Text="E-MAIL" class="form-label">Email</label>';
                            echo '<input ID="Text2" class="form-input" value="' . $user['Email'] . '"></input>';
                            echo '</div>';
                            echo '<div class="form-item">';
                            echo '<label ID="Label3" Text="PHONE" class="form-label">Contact</label>';
                            echo '<input ID="Text3" class="form-input" value="' . $user['Phone'] . '"></input>';
                            echo '</div>';
                        }
                        ?>


                        <!-- <div class="form-item">
                            <label ID="Label1" Text="NAME" class="form-label">Name</label>
                            <input ID="Text1" class="form-input"></input>
                        </div>

                        <div class="form-item">
                            <label ID="Label2" Text="E-MAIL" class="form-label">Email</label>
                            <input ID="Text2" class="form-input"></input>
                        </div>

                        <div class="form-item">
                            <label ID="Label3" Text="PHONE" class="form-label">Contact</label>
                            <input ID="Text3" class="form-input"></input>
                        </div> -->

                    </div>

                    <div>
                        <div class="contact-title" style="margin-top:20px;">
                            <span>*Vouchers and Gift Card not refundable in case of cancellation.
                                <a href="#">View T&C</a>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="offer-payment-section">
                    <div class="show-payment">
                        <i class="fa-solid fa-chevron-left" id="back-btn" onclick="show_hide_options(0);"></i>
                        <h4>PAYMENT <span><?php echo $_SESSION['total'] ?></span></h4>
                    </div>
                    <div class="question-answer">
                        <div class="question">
                            <button class="question-btn">
                                <span class="up-icon">
                                    <i class="fas fa-chevron-up"></i>
                                </span>
                                <span class="down-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </button>
                            <h3 class="title-question">
                                Avail Offers
                            </h3>
                        </div>
                        <div class="answer">
                            <h1>Comming Soon!</h1>
                        </div>
                    </div>

                    <div class="question-answer show-text">
                        <div class="question">
                            <button class="question-btn">
                                <span class="up-icon">
                                    <i class="fas fa-chevron-up"></i>
                                </span>
                                <span class="down-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </button>
                            <h3 class="title-question">PAYMENT OPTIONS</h3>
                        </div>

                        <div class="answer">
                            <div class="payment-section-row">
                                <div class="payment-mode" id="payment-active">
                                    <div class="payment-col" onclick="showPaymentPanels(1);">
                                        <img src="../img/credit-card.svg" />
                                        <a href="javascript:void(0);" onclick="showPaymentPanels(1);" class="payment-text">Credit Card</a>
                                    </div>

                                    <div class="payment-col" onclick="showPaymentPanels(2);">
                                        <img src="../img/wallet.svg" />
                                        <a href="javascript:void(0);" onclick="showPaymentPanels(2);" class="payment-text">Paytm Postpaid</a>

                                    </div>

                                    <div class="payment-col" onclick="showPaymentPanels(1);">
                                        <img src="../img/net-banking.svg" />
                                        <a href="javascript:void(0);" onclick="showPaymentPanels(1);" class="payment-text">Net Banking</a>
                                    </div>

                                    <div class="payment-col" onclick="showPaymentPanels(2);">
                                        <img src="../img/wallet.svg" />
                                        <a href="javascript:void(0);" onclick="showPaymentPanels(2);" class="payment-text">Paytm</a>

                                    </div>

                                    <div class="payment-col" onclick="showPaymentPanels(1);">
                                        <img src="../img/wallet.svg" />
                                        <a href="javascript:void(0);" onclick="showPaymentPanels(1);" class="payment-text">GOOGLE PAY</a>
                                    </div>

                                    <div class="payment-col" onclick="showPaymentPanels(0);">
                                        <img src="../img/wallet.svg" />
                                        <a href="javascript:void(0);" onclick="showPaymentPanels(0);" class="payment-text">UPI</a>

                                    </div>

                                    <div class="payment-col" onclick="showPaymentPanels(1);">
                                        <img src="../img/wallet.svg" />
                                        <a href="javascript:void(0);" onclick="showPaymentPanels(1);" class="payment-text">PhonePe</a>
                                    </div>

                                    <div class="payment-col" onclick="showPaymentPanels(1);">
                                        <img src="../img/wallet.svg" />
                                        <a href="javascript:void(0);" onclick="showPaymentPanels(1);" class="payment-text">Mobikwik</a>
                                    </div>

                                    <div class="payment-col" onclick="showPaymentPanels(1);">
                                        <img src="../img/wallet.svg" />
                                        <a href="javascript:void(0);" onclick="showPaymentPanels(1);" class="payment-text">Airtel Payments Bank</a>

                                    </div>

                                    <div class="payment-col" onclick="showPaymentPanels(1);">
                                        <img src="../img/credit-card.svg" />
                                        <a href="javascript:void(0);" onclick="showPaymentPanels(1);" class="payment-text">Gift Cards</a>
                                    </div>
                                </div>

                                <div ID="panel_upi" class="payment-type">
                                    <form class="payment-type-row" id="submit_form_upi" action="razorpay/pay.php" method="POST">
                                        <input type="hidden" name="item_name" value="<?php if (isset($_SESSION['p_name'])) {
                                                                                            echo $_SESSION['p_name'];
                                                                                        } ?>">
                                        <input type="hidden" name="item_description" value="MovieTime Payment">
                                        <input type="hidden" name="item_number" value="3456">
                                        <input type="hidden" name="amount" value="<?php echo $_SESSION['total'] ?>">
                                        <input type="hidden" name="address" value="n/a">
                                        <input type="hidden" name="currency" value="INR">
                                        <input type="hidden" name="cust_name" value="<?php if (isset($_SESSION['p_name'])) {
                                                                                            echo $_SESSION['p_name'];
                                                                                        } ?>">
                                        <input type="hidden" name="email" value="<?php if (isset($_SESSION['p_email'])) {
                                                                                        echo $_SESSION['p_email'];
                                                                                    } ?>">
                                        <input type="hidden" name="contact" value="<?php if (isset($_SESSION['p_phone'])) {
                                                                                        echo $_SESSION['p_phone'];
                                                                                    } ?>">
                                        <div class="payment-col">
                                            <div class="payment-box">
                                                <div class="payment-box-row">
                                                    <div class="payment-box-col">
                                                        <h2>ACCOUNT NAME</h2>
                                                        <input id="Text4" type="text" placeholder="UPI Payer Account" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="payment-col">
                                            <input type="checkbox" required>
                                            <span class="custom-indicator"></span>
                                            <span>I Have Read And Accepted The MovieTime <a href="#">Terms & Conditions</a>
                                                Of
                                                This Transaction</span>
                                        </div>

                                        <div class="payment-col">
                                            <input type="checkbox" checked>
                                            <span>I would like to receive WhatsApp updates from LYNX</span>
                                        </div>

                                        <div class="payment-col">
                                            <!-- <button ID="Button1_make_payment" class="PaymentButton" onclick="makeRazorPayPayment(1)">MAKE PAYMENT</button> -->
                                            <input ID="Button1_make_payment" class="PaymentButton" type="submit" name="payment" value="MAKE PAYMENT">
                                        </div>
                                    </form>
                                </div>

                                <div ID="panel_paytm" class="payment-type">
                                    <form class="payment-type-row" id="submit_form" action="../payment/paytm/pgRedirect.php" method="post">
                                        <div class="payment-col">
                                            <input type="hidden" name="TXN_AMOUNT" value="<?php echo $_SESSION['total'] ?>">
                                            <a href="javascript:void(0)" onclick="makePaytmPayment()">
                                                <div class="payment-box" id="paytm-box">
                                                    <div class="payment-box-row">
                                                        <div class="payment-box-col">
                                                            <img src="../img/paytm.png" alt="Paytm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </form>
                                </div>

                                <div ID="panel_other_type">
                                    <form class="payment-type-row" id="submit_form_others" action="razorpay/pay.php" method="POST">
                                        <input type="hidden" name="item_name" value="<?php if (isset($_SESSION['p_name'])) {
                                                                                            echo $_SESSION['p_name'];
                                                                                        } ?>">
                                        <input type="hidden" name="item_description" value="MovieTime Payment">
                                        <input type="hidden" name="item_number" value="3456">
                                        <input type="hidden" name="amount" value="<?php echo $_SESSION['total'] ?>">
                                        <input type="hidden" name="address" value="n/a">
                                        <input type="hidden" name="currency" value="INR">
                                        <input type="hidden" name="cust_name" value="<?php if (isset($_SESSION['p_name'])) {
                                                                                            echo $_SESSION['p_name'];
                                                                                        } ?>">
                                        <input type="hidden" name="email" value="<?php if (isset($_SESSION['p_email'])) {
                                                                                        echo $_SESSION['p_email'];
                                                                                    } ?>">
                                        <input type="hidden" name="contact" value="<?php if (isset($_SESSION['p_phone'])) {
                                                                                        echo $_SESSION['p_phone'];
                                                                                    } ?>">
                                        <div class="payment-col">
                                            <input type="checkbox" required>
                                            <span class="custom-indicator"></span>
                                            <span>I Have Read And Accepted The MovieTime <a href="#">Terms & Conditions</a>
                                                Of
                                                This Transaction</span>
                                        </div>

                                        <div class="payment-col">
                                            <input type="checkbox" checked>
                                            <span>I would like to receive WhatsApp updates from MovieTime</span>
                                        </div>

                                        <div class="payment-col">
                                            <!-- <button ID="Button1_make_payment" class="PaymentButton" onclick="makeRazorPayPayment(2)">MAKE PAYMENT</button> -->
                                            <input ID="Button1_make_payment" class="PaymentButton" type="submit" name="payment" value="MAKE PAYMENT">
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="question-answer clear-border">
                        <div class="question">
                            <button class="question-btn">
                                <span class="up-icon">
                                    <i class="fas fa-chevron-up"></i>
                                </span>
                                <span class="down-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </button>
                            <h3 class="title-question">
                                Bank Offers
                            </h3>
                        </div>
                        <div class="answer">
                            <h1>Comming Soon!</h1>
                        </div>
                    </div>
                </div>

            </section>

            <section class="movie-row" id="billing-details">
                <div class="go-back">
                    <i class="fa-solid fa-xmark" id="close" onclick="showAlert();"></i>
                </div>
                <div class="show-payment">
                    <i class="fa-solid fa-chevron-left" id="back-btn" onclick="showAlert();"></i>
                    <h4>SOUNDS LIKE A PLAN</h4>
                </div>
                <div class="movie-details">
                    <div class="movie-name-seat">
                        <?php
                        $op = "";
                        $moviename = "";
                        if (isset($_SESSION['moviename'])) {
                            $moviename = $_SESSION['moviename'];
                        }
                        $op .= "<label ID='MovieName'>$moviename</label>";
                        echo $op;
                        ?>
                        <!-- <label ID='Label5'>AUDI 03</label> -->
                    </div>
                    <div class="movie-location-time">
                        <?php
                        $op_theatre = "";
                        $op_theatre .= "<label ID='TheaterName'>$_SESSION[theatername]</label>
                        <label ID='Date'>ON $_SESSION[date] at $_SESSION[time]</label>";
                        echo $op_theatre;
                        ?>
                    </div>
                </div>

                <div class="seat-info">
                    <h3>Seat Info</h3>
                    <ul class="seats-checkout">
                        <li class="seats-checkout-li">
                            <?php
                            $op_seats = "";
                            if ($_SESSION["no-of-selected-seat"] == 5) {
                                $op_seats .= "$_SESSION[seat1]-$_SESSION[seatType1], $_SESSION[seat2]-$_SESSION[seatType2], $_SESSION[seat3]-$_SESSION[seatType3], $_SESSION[seat4]-$_SESSION[seatType4], $_SESSION[seat5]-$_SESSION[seatType5]";
                            }
                            if ($_SESSION["no-of-selected-seat"] == 4) {
                                $op_seats .= "$_SESSION[seat1]-$_SESSION[seatType1], $_SESSION[seat2]-$_SESSION[seatType2], $_SESSION[seat3]-$_SESSION[seatType3], $_SESSION[seat4]-$_SESSION[seatType4]";
                            }
                            if ($_SESSION["no-of-selected-seat"] == 3) {
                                $op_seats .= "$_SESSION[seat1]-$_SESSION[seatType1], $_SESSION[seat2]-$_SESSION[seatType2], $_SESSION[seat3]-$_SESSION[seatType3]";
                            }
                            if ($_SESSION["no-of-selected-seat"] == 2) {
                                $op_seats .= "$_SESSION[seat1]-$_SESSION[seatType1], $_SESSION[seat2]-$_SESSION[seatType2]";
                            }
                            if ($_SESSION["no-of-selected-seat"] == 1) {
                                $op_seats .= "$_SESSION[seat1]-$_SESSION[seatType1]";
                            }

                            echo $op_seats;
                            $_SESSION["AllSeatType"] = $op_seats;
                            ?>
                        </li>
                    </ul>
                </div>

                <div class="checkout-summary">
                    <?php

                    echo '<div class="checkout-row">';
                    echo '<div>Tickets</div>';
                    echo '<span ID="Label9">INR ' . number_format($amount, 2) . '</span>';
                    echo '</div>';
                    echo '<div class="checkout-row">';
                    echo '<div>Conv. Fees</div>';
                    echo '<span ID="Label10">INR ' . number_format($convFees, 2) . '</span>';
                    echo '</div>';
                    echo '<div class="checkout-row">';
                    echo '<div>GST</div>';
                    echo '<span ID="Label11">INR ' . number_format($gst, 2) . '</span>';
                    echo '</div>';

                    $_SESSION["amount"] = "INR " . number_format($amount, 2);
                    $_SESSION["conv_fees"] = "INR " . number_format($convFees, 2);
                    $_SESSION["gst"] = "INR " . number_format($gst, 2);
                    $_SESSION["gst_number"] = "27AAACP4526D1ZQ";

                    ?>
                    <!-- <div class="checkout-row">
                        <div>Tickets</div>
                        <span ID="Label9">INR 110.00</span>
                    </div>
                    <div class="checkout-row">
                        <div>Conv. Fees</div>
                        <span ID="Label10">INR 17.00</span>
                    </div>
                    <div class="checkout-row">
                        <div>GST</div>
                        <span ID="Label11">INR 2.0</span>
                    </div> -->
                    <div class="checkout-row">
                        <div>State GST Number</div>
                        <span ID="Label12">27AAACP4526D1ZQ</span>
                    </div>
                </div>

                <div class="checkout-info">
                    <span class="checkout-image">
                        <img src="../img/ico_cancellation_popcorn.png" style="width: 25px;" />
                    </span>
                    <h3>100% Refund on F&B</h3>
                </div>

                <div class="terms-section">
                    <a href="#">View Terms & Conditions</a>
                </div>

                <div class="divider"></div>

                <div class="movie-total">
                    <div class="movie-total-row">
                        <h3>TOTAL</h3>
                        <h3>(INR)</h3>
                    </div>
                    <div class="movie-total-row" style="text-align: right;">
                        <span ID="Label13">
                            <?php echo $_SESSION['total'] ?>
                        </span>
                    </div>
                    <button class="pay_btn" onclick="show_hide_options(1);">
                        <span ID="Label13">PAY <?php echo $_SESSION['total'] ?></span>
                    </button>
                </div>
            </section>
        </section>
    </section>
    
    <section class="popup-section" id="countdown-popup">
        <span class="overlay"></span>

        <div class="modal-box">
        <!-- <div class="warning-icon swal-icon--warning"> -->
        <div class="warning-icon swal-icon--warning">
            <span class="warning_body">
            <span class="warning_dot"></span>
            </span>
        </div>
        
        <input type="hidden" id="set-time" value="10.00" />
        <div id="countdown">
            <h4>Warning</h4>
            <h3>Please make your payment within the time frame specified.</h3>
            <div id='tiles' class="color-full"></div>
        </div>
        <div class="buttons">
            <button class="close-btn">OK</button>
        </div>
        </div>
    </section>

    <script src="../js/home.js"></script>
    <script src="../js/payment.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/timer.js"></script>
    <script>showCountDownPopup()</script>
    <script>
        //Normal JS
        const questions = document.querySelectorAll('.question-answer');
        /*        const scroll = document.querySelectorAll('.payment-text');*/
        questions.forEach(function(question) {
            const btn = question.querySelector('.question');
            btn.addEventListener("click", function() {
                questions.forEach(function(item) {
                    if (item !== question) {
                        item.classList.remove("show-text");
                    }
                })
                question.classList.toggle("show-text");
            })
        })
    </script>

    <?php
    if (isset($_GET['payment_status'])) {
        $status = $_GET['payment_status'];

        if ($status == "success") {
            echo '<script>paymentStatus("Payment Successful","success");</script>';
        } else if ($status == "failed") {
            echo '<script>paymentStatus("Payment Failed","error");</script>';
        }
    }

    ?>
</body>

</html>
<?php mysqli_close($conn); ?>