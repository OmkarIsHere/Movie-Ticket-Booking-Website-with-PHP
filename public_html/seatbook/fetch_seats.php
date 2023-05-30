<!-- Fetch selected seats from db and send to js to change the color and disable it -->
<?php
$servername = "localhost";
$username = "id20121598_root";
$password = "Movietime@123";
$dbname = "id20121598_movietime";
$seat = array();

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT SeatNo FROM bookings WHERE ShowId='$_SESSION[showid]'";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $j = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $seat[$j] = $row["SeatNo"];
        $j++;
    }
}

$A = array("A1", "A2", "A3", "A4", "A5", "A6", "A7", "A8", "A9", "A10", "A11", "A12");
$B = array("B1", "B2", "B3", "B4", "B5", "B6", "B7", "B8", "B9", "B10", "B11", "B12");
$C = array("C1", "C2", "C3", "C4", "C5", "C6", "C7", "C8", "C9", "C10", "C11", "C12");
$D = array("D1", "D2", "D3", "D4", "D5", "D6", "D7", "D8", "D9", "D10", "D11", "D12");
$E = array("E1", "E2", "E3", "E4", "E5", "E6", "E7", "E8", "E9", "E10", "E11", "E12");
$F = array("F1", "F2", "F3", "F4", "F5", "F6", "F7", "F8", "F9", "F10", "F11", "F12");
$G = array("G1", "G2", "G3", "G4", "G5", "G6", "G7", "G8", "G9", "G10", "G11", "G12");
$H = array("H1", "H2", "H3", "H4", "H5", "H6", "H7", "H8", "H9", "H10", "H11", "H12");
$I = array("I1", "I2", "I3", "I4", "I5", "I6", "I7", "I8", "I9", "I10", "I11", "I12");
$J = array("J1", "J2", "J3", "J4", "J5", "J6", "J7", "J8", "J9", "J10", "J11", "J12");
$K = array("K1", "K2", "K3", "K4", "K5", "K6", "K7", "K8", "K9", "K10", "K11", "K12");
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    for ($j = 1; $j <= 12; $j++) {
        if ($seat[$i] == "A" . $j) {
            $A[$j - 1] = "disabled";
        }
        if ($seat[$i] == "B" . $j) {
            $B[$j - 1] = "disabled";
        }
        if ($seat[$i] == "C" . $j) {
            $C[$j - 1] = "disabled";
        }
        if ($seat[$i] == "D" . $j) {
            $D[$j - 1] = "disabled";
        }
        if ($seat[$i] == "E" . $j) {
            $E[$j - 1] = "disabled";
        }
        if ($seat[$i] == "F" . $j) {
            $F[$j - 1] = "disabled";
        }
        if ($seat[$i] == "G" . $j) {
            $G[$j - 1] = "disabled";
        }
        if ($seat[$i] == "H" . $j) {
            $H[$j - 1] = "disabled";
        }
        if ($seat[$i] == "I" . $j) {
            $I[$j - 1] = "disabled";
        }
        if ($seat[$i] == "J" . $j) {
            $J[$j - 1] = "disabled";
        }
        if ($seat[$i] == "K" . $j) {
            $K[$j - 1] = "disabled";
        }
    }
}
mysqli_close($conn);
?>