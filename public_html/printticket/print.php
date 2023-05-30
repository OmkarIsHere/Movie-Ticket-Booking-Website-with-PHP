<!-- INSPO:  https://www.behance.net/gallery/69583099/Mobile-Flights-App-Concept 
Tomas Pustelnik https://codepen.io/kamerat/pen/rRwMMq-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/print.css">
    <title>Ticket</title>
</head>
<body>
<?php
session_start();
ob_start();
$moviename = "N/A";
$theatername = "N/A";
$city = "N/A";
$date = "N/A";
$time = "N/A";
$totalAmt = "N/A";
$seat = "N/A";
$seatType = "N/A";
$transactionid = "N/A";
$ticket_price = "N/A";
$gst = "N/A";
$conFees = "N/A";
if (isset($_SESSION["moviename"])) {
    $moviename = $_SESSION["moviename"];
}
if (isset($_SESSION["theatername"])) {
    $theatername = $_SESSION["theatername"];
}
if (isset($_SESSION["city"])) {
    $city = $_SESSION["city"];
}
if (isset($_SESSION["date"])) {
    $date = $_SESSION["date"];
}
if (isset($_SESSION["time"])) {
    $time = $_SESSION["time"];
}
if (isset($_SESSION["total-amount"])) {
    $totalAmt = $_SESSION["total-amount"];
}

if (isset($_SESSION["seat1"])) {
    if ($_SESSION["no-of-selected-seat"] == 5) {
        $seat = $_SESSION["seat1"] . " " . $_SESSION["seat2"] . " " . $_SESSION["seat3"] . " " . $_SESSION["seat4"] . " " . $_SESSION["seat5"];
    } elseif ($_SESSION["no-of-selected-seat"] == 4) {
        $seat = $_SESSION["seat1"] . " " . $_SESSION["seat2"] . " " . $_SESSION["seat3"] . " " . $_SESSION["seat4"];
    } elseif ($_SESSION["no-of-selected-seat"] == 3) {
        $seat = $_SESSION["seat1"] . " " . $_SESSION["seat2"] . " " . $_SESSION["seat3"];
    } elseif ($_SESSION["no-of-selected-seat"] == 2) {
        $seat = $_SESSION["seat1"] . " " . $_SESSION["seat2"];
    } elseif ($_SESSION["no-of-selected-seat"] == 1) {
        $seat = $_SESSION["seat1"];
    }
}
if (isset($_SESSION["seatType1"])) {
    $seatType = $_SESSION["seatType1"];
}
if (isset($_SESSION["tid"])) {
    $transactionid = $_SESSION["tid"];
}
if (isset($_SESSION["amount"])) {
    $amount = $_SESSION["amount"];
}
if (isset($_SESSION["gst"])) {
    $gst = $_SESSION["gst"];
}
if (isset($_SESSION["conv_fees"])) {
    $conFees = $_SESSION["conv_fees"];
}
if((isset($_SESSION["moviename"])) && (isset($_SESSION["amount"])) && ($_SESSION["seat1"])){
    // if sessions are not set then ticket page will not show
?>

    <main id="ticket-system">
        <section id="ticket-section">
            <h1>Ticket</h1>
            <div id="printer"></div>
            <div id="transform">
                <div id="ticket-wrapper">
                    <div id="ticket">
                        <img id="logo" src="../img/MOVIEtime_black.png" alt="Logo">
                        <div id="movie-info">
                            <div id="movie-img">
                                <?php
                                $servername = "localhost";
                                $username = "id20121598_root";
                                $password = "Movietime@123";
                                $dbname = "id20121598_movietime";
                                $conn = mysqli_connect($servername, $username, $password, $dbname);
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                $sql2 = "SELECT MovieVerticalImage FROM movies WHERE MovieName='$moviename'";
                                $result2 = mysqli_query($conn, $sql2);
                                    $row = mysqli_fetch_assoc($result2);
                                    echo ' <img src="data:image;base64,' . $row['MovieVerticalImage'] . '" id="poster" alt="poster"/>';
                                ?>
                            </div>
                            <div id="movie-details">
                                <p id="movie-name"><?php echo $moviename ?></p>
                                <p id="theatre-name"><?php echo "$theatername, $city" ?></p>
                                <p id="date-time"><?php echo "$date  $time" ?></p>
                            </div>
                        </div>
                        <div id="seat-info">
                            <p id="seat-type"> <?php echo $seatType ?></p>
                            <p id="seat"> <?php echo $seat ?></p>
                        </div>
                        <div id="payment-info">
                            <div id="ticket-price-div">
                                <p id="ticket-price-text">Ticekt Price</p>
                                <p id="ticket-price"><?php echo $amount?></p>
                            </div>
                            <div id="con-fees-div">
                                <p id="con-fees-text">Convenience Fee</p>
                                <p id="con-fees"><?php echo $conFees ?></p>
                            </div>
                            <div id="gst-div">
                                <p id="gst-text">GST</p>
                                <p id="gst"><?php echo $gst ?></p>
                            </div>
                            <div id="total-pay-div">
                                <p id="total-pay-text">Total Amount</p>
                                <p id="total-pay"><?php echo $totalAmt ?></p>
                            </div>
                        </div>
                    </div>
                    <div id="qr-code-div">
                        <?php
                        $seat = $_SESSION['seat1'];
                        $userId = $_SESSION['userid'];
                        $showId = $_SESSION['showid'];
                        $query1 = "select * from bookings where `ShowId`= '" . $showId . "' and `UserId`= '" . $userId . "' and `SeatNo`= '" . $seat . "'";
                        $res = mysqli_query($conn, $query1) or die("sql query failed");
                        if (mysqli_num_rows($res) > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                        $op = "";
                        $op .='<img src="https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=';
                        $op .= $row['UniqueId'];
                        $op .= '&choe=UTF-8" title="Qr Code" alt="Qr code" id="qr-code"/>';
                        echo $op;
                            }
                        }
                        ?>
                        <p id="qr-code-use">Scan at the entrance.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="div2">
            <a href="../Ticket.php" id="print">Download</a>
            <a href="../index.php" id="home">Home</a>
        </div>
    <script>
        window.onload = function () {
            var pre_loader = document.getElementById("pre-loader");
            var load_html = document.getElementById("load-html");

            load_html.style.display = 'block';
            pre_loader.style.display = 'none';

        }

        function paymentStatus(message,logo) {
            swal({
                title: "Good Job!",
                text: message,
                icon: logo,
                button: "OK",
            }).then((value) => {
            // swal(`The returned value is: ${value}`);
            if(`${value}`) {
                if(logo == "error") {
                    window.location.href = '../index.php';
                }
            }
            });
        }

    </script>
    <?php
        if (isset($_SESSION['paymentStatus']) && $_SESSION['paymentStatus'] == 'Pending') {
            $_SESSION['paymentStatus'] = 'Done';
            echo '<script>paymentStatus("Payment Successful","success");</script>';
        }
        if (isset($_SESSION['paymentStatus']) && $_SESSION['paymentStatus'] == 'Failed') {
            echo '<script>paymentStatus("Payment Failed","error");</script>';
        }
            }
    else{
        echo "<h1 style='color: white;'>Something is wrong please check your dashboard to get ticket.<h1>";
    }
    ?>
</body>
</html>