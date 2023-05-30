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
$UniqueId = "";
    $UniqueId = $_POST['UniqueId'];
    $SeatNo = "";
    $BookingDate = "";
    $ShowId = "";
    $Status = "";
    $MovieId = "";
    $Time = "";
    $Date = "";
    $MovieName = "";
    $TheaterId = "";
    $TheaterName = "";
    $SeatType = "";
    $Amount = "";
    $BookingId = "";
    $TheaterAddress= "";


    $servername = "localhost";
    $username = "id20121598_root";
    $password = "Movietime@123";
    $dbname = "id20121598_movietime";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT BookingId, SeatNo, BookingDate, ShowId, Status, SeatType FROM bookings WHERE UniqueId='$UniqueId'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $SeatNo .= " " . $row["SeatNo"];
            $BookingDate = $row["BookingDate"];
            $SeatType .= " " . $row["SeatType"];
            $ShowId = $row["ShowId"];
            $Status = $row["Status"];
            $BookingId = $row["BookingId"];
        }
    }

    $sql2 = "SELECT MovieId, ScreenNo, TheaterId, Time, Date FROM shows WHERE ShowId='$ShowId'";
    $result = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $MovieId = $row["MovieId"];
            $TheaterId = $row["TheaterId"];
            $Time = $row["Time"];
            $Date = $row["Date"];
        }
    }

    $sql3 = "SELECT MovieName FROM movies WHERE MovieId='$MovieId'";
    $result = mysqli_query($conn, $sql3);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $MovieName = $row["MovieName"];
        }
    }
    $sql4 = "SELECT TheaterName, TheaterAddress FROM theaters WHERE TheaterId='$TheaterId'";
    $result = mysqli_query($conn, $sql4);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $TheaterName = $row["TheaterName"];
            $TheaterAddress = $row["TheaterAddress"];
        }
    }
    $sql5 = "SELECT Amount FROM payment WHERE BookingId='$BookingId'";
    $result = mysqli_query($conn, $sql5);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $Amount = $row["Amount"];
        }
    }

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
                                $sql2 = "SELECT MovieVerticalImage FROM movies WHERE MovieName='$MovieName'";
                                $result2 = mysqli_query($conn, $sql2);
                                    $row = mysqli_fetch_assoc($result2);
                                    echo ' <img src="data:image;base64,' . $row['MovieVerticalImage'] . '" id="poster" alt="poster"/>';
                                ?>
                            </div>
                            <div id="movie-details">
                                <p id="movie-name"><?php echo $MovieName ?></p>
                                <p id="theatre-name"><?php echo "$TheaterName" ?></p>
                                <p id="theatre-name"><?php echo "$TheaterAddress" ?></p>
                                <p id="date-time"><?php echo "$Date  $Time" ?></p>
                            </div>
                        </div>
                        <div id="seat-info">
                            <p id="seat-type"> <?php echo $SeatType ?></p>
                            <p id="seat"> <?php echo $SeatNo ?></p>
                        </div>
                        <div id="payment-info">
                            <div id="total-pay-div">
                                <p id="total-pay-text">Total Amount</p>
                                <p id="total-pay"><?php echo "INR " . $Amount ?></p>
                            </div>
                        </div>
                    </div>
                    <div id="qr-code-div">
                        <?php
                        $op = "";
                        $op .='<img src="https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=';
                        $op .= $UniqueId;
                        $op .= '&choe=UTF-8" title="Qr Code" alt="Qr code" id="qr-code"/>';
                        echo $op;
                        ?>
                        <p id="qr-code-use">Scan at the entrance.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="div2">
            <a href="index.php" id="home">Home</a>
        </div>
    <script>
        window.onload = function () {
            var pre_loader = document.getElementById("pre-loader");
            var load_html = document.getElementById("load-html");

            load_html.style.display = 'block';
            pre_loader.style.display = 'none';

        }

    </script>
</body>
</html>