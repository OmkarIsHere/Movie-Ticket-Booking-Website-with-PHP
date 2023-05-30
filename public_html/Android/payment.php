<?php 

header('Content-Type:application/json');
$conn = mysqli_connect("localhost","id20121598_root","Movietime@123","id20121598_movietime");

// CHECK DATABASE CONNECTION
if(mysqli_connect_errno()){
    echo "Connection Failed".mysqli_connect_error();
    exit;
}

if (isset($_POST['booking'])) {

    $userId = $_POST['userId'];
    $showId = $_POST['showId'];
    $numSeat = $_POST["seatNo"];
    $seat_type = $_POST['seatType'];
    $today_date = date("Y-m-d");

    $sql_last_no = "SELECT UniqueId FROM bookings ORDER BY UniqueId DESC LIMIT 1";
    $result_id = mysqli_query($conn, $sql_last_no);
    $row_id = mysqli_fetch_assoc($result_id);
    $id = $row_id["UniqueId"] + 1;

    $sql_insert = "INSERT INTO `bookings` (`BookingDate`, `UserId`, `ShowId`, `NoOfTickets`, `SeatNo`, `SeatType`, `Status`, `UniqueId`)
        VALUES ('$today_date', '$userId', '$showId', '1', '$numSeat', '$seat_type', 'Active', '$id')";
    $data_check = mysqli_query($conn, $sql_insert);

    if ($data_check) {
        $response['status'] = "success";
        echo json_encode($response, JSON_PRETTY_PRINT);
    } 
    
    else {
        $response['status'] = "error";
        $response['error'] = "Sorry Something Went Wrong! Booking";
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

}

if(isset($_POST['payment'])) {

    $amt = $_POST['total'];

    $sql_last_no = "SELECT BookingId FROM bookings ORDER BY BookingId DESC LIMIT 1";
    $result_id = mysqli_query($conn, $sql_last_no);
    $row_id = mysqli_fetch_assoc($result_id);
    $id = $row_id["BookingId"];
    $today_date = date("Y-m-d");

    $sql_insert = "INSERT INTO `payment` (`BookingId`, `PaymentMethod`, `Amount`, `Time`)
                                VALUES ('$id', 'online', '$amt', '$today_date')";
    $data_check = mysqli_query($conn, $sql_insert);

    if ($data_check) {
        $response['status'] = "success";
        echo json_encode($response, JSON_PRETTY_PRINT);
    } 
    
    else {
        $response['status'] = "error";
        $response['error'] = "Sorry Something Went Wrong! Payment";
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}

?>