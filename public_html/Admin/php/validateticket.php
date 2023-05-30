<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../Css/validateticket.css">
</head>
<body>
    <?php
    $UniqueId = "";
    $UniqueId = $_POST["UniqueId"];
    $SeatNo = "";
    $BookingDate = "";
    $ShowId = "";
    $Status = "";
    $MovieId = "";
    $MovieName = "";
    $Time = "";
    $Date = "";

    $today_date = date("Y-m-d");
    $i = 0; 

    $servername = "localhost";
    $username = "id20121598_root";
    $password = "Movietime@123";
    $dbname = "id20121598_movietime";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT SeatNo, BookingDate, ShowId, Status FROM bookings WHERE UniqueId='$UniqueId'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $SeatNo .= " " . $row["SeatNo"];
            $BookingDate = $row["BookingDate"];
            $ShowId = $row["ShowId"];
            $Status = $row["Status"];
            $i++;
        }
    }

    $sql2 = "SELECT MovieId, ScreenNo, Time, Date FROM shows WHERE ShowId='$ShowId'";
    $result = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $MovieId = $row["MovieId"];
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
    $op = "";
    if($Status == "Active" And $today_date == $Date){
        echo '<script>
        swal({
            title: "Active✅",
            text: "It is active ticket",
            button: "OK",
            icon: "success"
        });
        </script>';
        $op .= "
            <main id='ticket-system'>
        <section id='ticket-section'>
            <h1>Valid Ticket ✅</h1>
            <div id='printer'></div>
            <div id='transform'>
                <div id='ticket-wrapper'>
                    <div id='ticket'>
                        <img id='logo' src='../image/MOVIEtime_black.png' alt='Logo'>
                        <div id='movie-info'>
                            <div id='movie-img'>";

                                $sql2 = "SELECT MovieVerticalImage FROM movies WHERE MovieName='$MovieName'";
                                $result2 = mysqli_query($conn, $sql2);
                                    $row = mysqli_fetch_assoc($result2);
                                    $op .= ' <img src="data:image;base64,' . $row['MovieVerticalImage'] . '" id="poster" alt="poster"/>';

                            $op .= "
                            </div>
                            <div id='movie-details'>
                                <p id='movie-name'>$MovieName</p>
                                <p id='theatre-name'>Show Id: $ShowId</p>
                                <p id='date-time'>Date: $Date $Time</p>
                            </div>
                        </div>
                        <div id='seat-info'>
                            <p id='seat-type'>Booking Date: $BookingDate Booking Id: $UniqueId</p>
                            <p id='seat'>$i tickets: $SeatNo</p>
                        </div>
                    </div>
                    <div id='qr-code-div'>
                    <img src='../image/validTicket.png' alt='Ticekt'>
                        <p id='qr-code-use'>Valid Ticket</p>
                            </div>
                        </div>
                    </div>
                    <a href='scan.php' id='scan-again'>Scan again</a>
                </section>
            </main>";
            
                //to inactive ticket after used once
    $sqlUpdate = "UPDATE bookings SET Status='Inactive' WHERE UniqueId='$UniqueId'";
    mysqli_query($conn, $sqlUpdate);
    }else{
        echo '<script>
        swal({
            title: "Inactive❌",
            text: "It is inactive ticket",
            button: "OK",
            icon: "warning"
        });
        </script>';
        echo "<div class='container'>
        <h1 class='heading'>Used Ticket or invalid!, Try contacting theatre employees or manager if you think this is a mistake.</h1>
        <a href='scan.php' id='scan-again'>Scan again</a>
        </div>
        ";
    }
    ?>
    <?php
    echo $op;
    ?>
</body>
</html>