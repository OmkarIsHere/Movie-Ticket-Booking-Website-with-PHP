<?php
session_start();
require 'config_mysqli.php';
/* Below code is to generate a unique number while inserting seats in db,
here first we will fetch last tickets number and increase it with one so every bunch of tickets will get
different number. */

if (isset($_GET['payment_status'])) {
    if (isset($_SESSION['paymentStatus']) && $_SESSION['paymentStatus'] == 'Pending') {
        $status = $_GET['payment_status'];
        if ($status == "success") {
            $sql_last_no = "SELECT UniqueId FROM bookings ORDER BY UniqueId DESC LIMIT 1";
            $result_id = mysqli_query($conn, $sql_last_no);
            $row_id = mysqli_fetch_assoc($result_id);
            $id = $row_id["UniqueId"] + 1;
            $_SESSION['UniqueId'] = $id;
            $userId = $_SESSION['userid'];
            $numSeat = $_SESSION["no-of-selected-seat"];
            $today_date = date("Y-m-d");
            // Code to enter data in database
            $tem = 1;
            for ($k = 0; $k < $numSeat; $k++) {
                if ($_SESSION["amt$tem"] == 150) {
                    $seat_type = "Silver";
                } elseif ($_SESSION["amt$tem"] == 200) {
                    $seat_type = "Gold";
                } elseif ($_SESSION["amt$tem"] == 300) {
                    $seat_type = "Platinum";
                }
                $currentSeat = $_SESSION["seat$tem"];
                
                    $sql_insert = "INSERT INTO `bookings` (`BookingDate`, `UserId`, `ShowId`, `NoOfTickets`, `SeatNo`, `SeatType`, `Status`, `UniqueId`)
                                            VALUES ('$today_date', '$userId', '$_SESSION[showid]', '1', '$currentSeat', '$seat_type', 'Active', '$id')";
                $data_check = mysqli_query($conn, $sql_insert);

                if ($data_check) {
                    echo "success!";
                    $_SESSION['UniqueId'] = $id;
                } else {
                    echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
                }

                $tem++;
            }
        }
    }
}

/*Below code is for updating revenue in theaters table */

if (isset($_GET['payment_status'])) {
    if (isset($_SESSION['paymentStatus']) && $_SESSION['paymentStatus'] == 'Pending') {
        $status = $_GET['payment_status'];
        if ($status == "success") {
            $theaterId = $_SESSION['theaterid'];
            $sql = "SELECT * FROM theaters WHERE TheaterId = '$theaterId'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $fetch = mysqli_fetch_assoc($result);
                $fetch_revenue = $fetch['Revenue'];
                $amt = $_SESSION['total'];
                $total_revenue = $fetch_revenue + $amt;
                $update_query = "UPDATE theaters SET Revenue = '$total_revenue' WHERE TheaterId = '$theaterId'";
                $update_res = mysqli_query($conn, $update_query);
                if (!$update_res) {
                    echo "Error: " . $update_res . "<br>" . mysqli_error($conn);
                }
            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}

/*Below code is for inserting data in payment table after successfull payment redirect */

if (isset($_GET['payment_status'])) {
    if (isset($_SESSION['paymentStatus']) && $_SESSION['paymentStatus'] == 'Pending') {
        $status = $_GET['payment_status'];
        if ($status == "success") {
            $sql_last_no = "SELECT BookingId FROM bookings ORDER BY BookingId DESC LIMIT 1";
            $result_id = mysqli_query($conn, $sql_last_no);
            $row_id = mysqli_fetch_assoc($result_id);
            $id = $row_id["BookingId"];
            $amt = $_SESSION['total'];
            $today_date = date("Y-m-d");

            $sql_insert = "INSERT INTO `payment` (`BookingId`, `PaymentMethod`, `Amount`, `Time`)
                                        VALUES ('$id', 'online', '$amt', '$today_date')";
            $data_check = mysqli_query($conn, $sql_insert);

            if ($data_check) {
                echo "success!";
                header('Location: ../printticket/print.php');
            } else {
                echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
            }
        }
    }
}


?>