<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/seat.css">
    <link rel="stylesheet" href="css/variable.css">
    <title>Book Your Seat</title>
</head>

<body>
    <div id="header-container">
        
       <?php
        session_start();
        $op = "";
        $op .= "<div id='movie-name'>$_GET[movie]</div>
                        <div id='theatre-name'>$_GET[theatername]</div>";

        $_SESSION["moviename"] = $_GET["movie"];
        $_SESSION["theatername"] = $_GET["theatername"];
        $_SESSION["theaterid"] = $_GET["theaterid"];
        $_SESSION["movieid"] = $_GET["movieid"];
        $_SESSION["city"] = $_GET["city"];
        $_SESSION["date"] = $_GET["date"];
        $_SESSION["time"] = $_GET["time"];
        $_SESSION["showid"] = $_GET["showid"];
        $op = "";
        $op .= "    <a href='../moviedetails.php?movieid=$_SESSION[movieid]' id='back'>
                        <span id='back-Btn' class='iconify' data-icon=material-symbols:arrow-back-ios-rounded></span>
                    </a>";
        
        echo $op;
        ?>

        <form action="../payment/payment.php" method="POST">
            <div id="movie-info-container">
                <?php
                $op = "";
                $op .= "<div id='movie-name'>$_GET[movie]</div>
                <div id='theatre-name'>$_GET[theatername]</div>";

                echo $op;
                ?>
            </div>
            <span id="show-time">
                <?php echo $_GET["time"]; ?>
            </span>
            <div id="header-btns">
                <button type="button" id="no-of-ticket">
                    <span id="selected-tickets">0</span>
                    Tickets
                </button>
            </div>
            <div class="go-back">
                <i class="fa-solid fa-xmark" id="close" onclick="showAlert();"></i>
            </div>
    </div>
    <div id="seats-container">
        <?php
        $movieId = $_GET["movieid"];
        $conn = mysqli_connect("localhost", "id20121598_root", "Movietime@123", "id20121598_movietime") or die("Connection failed");
        $query1 = "select  * from movies where `MovieId`= '" . $movieId . "'";
        $res = mysqli_query($conn, $query1) or die("sql query failed");
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
        ?>
        <div class="background-img">
                    <?php echo  '<img src="data:image/jpeg;base64,' . base64_encode($row['MoviePoster']) . '" alt="image"/>'; ?>
        </div>
        <?php
            }}
        ?>
        <div id="seats">
            <div id="platinum">
                <div id="platinum-seats">
                    <div id="row-k">
                        <div>K</div>
                        <input value="300 K1" type="checkbox" id="K1" class="a1" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="K1" id="k1"></label>
                        <input value="300 K2" type="checkbox" id="K2" class="a2" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="K2" id="k2"></label>
                        <input value="300 K3" type="checkbox" id="K3" class="a3" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="K3" id="k3"></label>
                        <input value="300 K4" type="checkbox" id="K4" class="a4" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="K4" id="k4"></label>
                        <input value="300 K5" type="checkbox" id="K5" class="a5" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="K5" id="k5"></label>
                        <input value="300 K6" type="checkbox" id="K6" class="a6" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="K6" id="k6"></label>
                        <input value="300 K7" type="checkbox" id="K7" class="a7" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="K7" id="k7"></label>
                        <input value="300 K8" type="checkbox" id="K8" class="a8" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="K8" id="k8"></label>
                        <input value="300 K9" type="checkbox" id="K9" class="a9" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="K9" id="k9"></label>
                        <input value="300 K10" type="checkbox" id="K10" class="a10" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="K10" id="k10"></label>
                        <input value="300 K11" type="checkbox" id="K11" class="a11" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="K11" id="k11"></label>
                        <input value="300 K12" type="checkbox" id="K12" class="a12" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="K12" id="k12"></label>
                    </div>
                    <div id="row-j">
                        <div>J</div>
                        <input value="300 J1" type="checkbox" id="J1" class="a1" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="J1" id="j1"></label>
                        <input value="300 J2" type="checkbox" id="J2" class="a2" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="J2" id="j2"></label>
                        <input value="300 J3" type="checkbox" id="J3" class="a3" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="J3" id="j3"></label>
                        <input value="300 J4" type="checkbox" id="J4" class="a4" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="J4" id="j4"></label>
                        <input value="300 J5" type="checkbox" id="J5" class="a5" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="J5" id="j5"></label>
                        <input value="300 J6" type="checkbox" id="J6" class="a6" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="J6" id="j6"></label>
                        <input value="300 J7" type="checkbox" id="J7" class="a7" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="J7" id="j7"></label>
                        <input value="300 J8" type="checkbox" id="J8" class="a8" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="J8" id="j8"></label>
                        <input value="300 J9" type="checkbox" id="J9" class="a9" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="J9" id="j9"></label>
                        <input value="300 J10" type="checkbox" id="J10" class="a10" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="J10" id="j10"></label>
                        <input value="300 J11" type="checkbox" id="J11" class="a11" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="J11" id="j11"></label>
                        <input value="300 J12" type="checkbox" id="J12" class="a12" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="J12" id="j12"></label>
                    </div>
                </div>
                <div id="platinum-class">Platinum Rs. 300</div>
            </div>
            <div id="gold">
                <div id="break-gold"></div>
                <div id="gold-seats">
                    <div id="row-i">
                        <div>I</div>
                        <input value="200 I1" type="checkbox" id="I1" class="a1" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="I1" id="i1"></label>
                        <input value="200 I2" type="checkbox" id="I2" class="a2" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="I2" id="i2"></label>
                        <input value="200 I3" type="checkbox" id="I3" class="a3" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="I3" id="i3"></label>
                        <input value="200 I4" type="checkbox" id="I4" class="a4" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="I4" id="i4"></label>
                        <input value="200 I5" type="checkbox" id="I5" class="a5" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="I5" id="i5"></label>
                        <input value="200 I6" type="checkbox" id="I6" class="a6" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="I6" id="i6"></label>
                        <input value="200 I7" type="checkbox" id="I7" class="a7" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="I7" id="i7"></label>
                        <input value="200 I8" type="checkbox" id="I8" class="a8" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="I8" id="i8"></label>
                        <input value="200 I9" type="checkbox" id="I9" class="a9" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="I9" id="i9"></label>
                        <input value="200 I10" type="checkbox" id="I10" class="a10" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="I10" id="i10"></label>
                        <input value="200 I11" type="checkbox" id="I11" class="a11" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="I11" id="i11"></label>
                        <input value="200 I12" type="checkbox" id="I12" class="a12" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="I12" id="i12"></label>
                    </div>
                    <div id="row-h">
                        <div>H</div>
                        <input value="200 H1" type="checkbox" id="H1" class="a1" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="H1" id="h1"></label>
                        <input value="200 H2" type="checkbox" id="H2" class="a2" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="H2" id="h2"></label>
                        <input value="200 H3" type="checkbox" id="H3" class="a3" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="H3" id="h3"></label>
                        <input value="200 H4" type="checkbox" id="H4" class="a4" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="H4" id="h4"></label>
                        <input value="200 H5" type="checkbox" id="H5" class="a5" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="H5" id="h5"></label>
                        <input value="200 H6" type="checkbox" id="H6" class="a6" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="H6" id="h6"></label>
                        <input value="200 H7" type="checkbox" id="H7" class="a7" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="H7" id="h7"></label>
                        <input value="200 H8" type="checkbox" id="H8" class="a8" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="H8" id="h8"></label>
                        <input value="200 H9" type="checkbox" id="H9" hh class="a9" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="H9" id="h9"></label>
                        <input value="200 H10" type="checkbox" id="H10" class="a10" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="H10" id="h10"></label>
                        <input value="200 H11" type="checkbox" id="H11" class="a11" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="H11" id="h11"></label>
                        <input value="200 H12" type="checkbox" id="H12" class="a12" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="H12" id="h12"></label>
                    </div>
                    <div id="row-g">
                        <div>G</div>
                        <input value="200 G1" type="checkbox" id="G1" class="a1" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="G1" id="g1"></label>
                        <input value="200 G2" type="checkbox" id="G2" class="a2" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="G2" id="g2"></label>
                        <input value="200 G3" type="checkbox" id="G3" class="a3" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="G3" id="g3"></label>
                        <input value="200 G4" type="checkbox" id="G4" class="a4" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="G4" id="g4"></label>
                        <input value="200 G5" type="checkbox" id="G5" class="a5" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="G5" id="g5"></label>
                        <input value="200 G6" type="checkbox" id="G6" class="a6" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="G6" id="g6"></label>
                        <input value="200 G7" type="checkbox" id="G7" class="a7" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="G7" id="g7"></label>
                        <input value="200 G8" type="checkbox" id="G8" class="a8" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="G8" id="g8"></label>
                        <input value="200 G9" type="checkbox" id="G9" class="a9" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="G9" id="g9"></label>
                        <input value="200 G10" type="checkbox" id="G10" class="a10" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="G10" id="g10"></label>
                        <input value="200 G11" type="checkbox" id="G11" class="a11" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="G11" id="g11"></label>
                        <input value="200 G12" type="checkbox" id="G12" class="a12" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="G12" id="g12"></label>
                    </div>
                    <div id="row-f">
                        <div>F</div>
                        <input value="200 F1" type="checkbox" id="F1" class="a1" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="F1" id="f1"></label>
                        <input value="200 F2" type="checkbox" id="F2" class="a2" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="F2" id="f2"></label>
                        <input value="200 F3" type="checkbox" id="F3" class="a3" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="F3" id="f3"></label>
                        <input value="200 F4" type="checkbox" id="F4" class="a4" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="F4" id="f4"></label>
                        <input value="200 F5" type="checkbox" id="F5" class="a5" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="F5" id="f5"></label>
                        <input value="200 F6" type="checkbox" id="F6" class="a6" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="F6" id="f6"></label>
                        <input value="200 F7" type="checkbox" id="F7" class="a7" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="F7" id="f7"></label>
                        <input value="200 F8" type="checkbox" id="F8" class="a8" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="F8" id="f8"></label>
                        <input value="200 F9" type="checkbox" id="F9" class="a9" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="F9" id="f9"></label>
                        <input value="200 F10" type="checkbox" id="F10" class="a10" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="F10" id="f10"></label>
                        <input value="200 F11" type="checkbox" id="F11" class="a11" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="F11" id="f11"></label>
                        <input value="200 F12" type="checkbox" id="F12" class="a12" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="F12" id="f12"></label>
                    </div>
                    <div id="row-e">
                        <div>E</div>
                        <input value="200 E1" type="checkbox" id="E1" class="a1" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="E1" id="e1"></label>
                        <input value="200 E2" type="checkbox" id="E2" class="a2" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="E2" id="e2"></label>
                        <input value="200 E3" type="checkbox" id="E3" class="a3" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="E3" id="e3"></label>
                        <input value="200 E4" type="checkbox" id="E4" class="a4" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="E4" id="e4"></label>
                        <input value="200 E5" type="checkbox" id="E5" class="a5" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="E5" id="e5"></label>
                        <input value="200 E6" type="checkbox" id="E6" class="a6" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="E6" id="e6"></label>
                        <input value="200 E7" type="checkbox" id="E7" class="a7" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="E7" id="e7"></label>
                        <input value="200 E8" type="checkbox" id="E8" class="a8" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="E8" id="e8"></label>
                        <input value="200 E9" type="checkbox" id="E9" class="a9" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="E9" id="e9"></label>
                        <input value="200 E10" type="checkbox" id="E10" class="a10" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="E10" id="e10"></label>
                        <input value="200 E11" type="checkbox" id="E11" class="a11" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="E11" id="e11"></label>
                        <input value="200 E12" type="checkbox" id="E12" class="a12" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="E12" id="e12"></label>
                    </div>
                </div>
                <div id="gold-class">Gold Rs. 200</div>


            </div>
            <div id="silver">
                <div id="break-silver"></div>
                <div id="silver-seats">
                    <div id="row-d">
                        <div>D</div>
                        <input value="150 D1" type="checkbox" id="D1" class="a1" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="D1" id="d1"></label>
                        <input value="150 D2" type="checkbox" id="D2" class="a2" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="D2" id="d2"></label>
                        <input value="150 D3" type="checkbox" id="D3" class="a3" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="D3" id="d3"></label>
                        <input value="150 D4" type="checkbox" id="D4" class="a4" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="D4" id="d4"></label>
                        <input value="150 D5" type="checkbox" id="D5" class="a5" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="D5" id="d5"></label>
                        <input value="150 D6" type="checkbox" id="D6" class="a6" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="D6" id="d6"></label>
                        <input value="150 D7" type="checkbox" id="D7" class="a7" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="D7" id="d7"></label>
                        <input value="150 D8" type="checkbox" id="D8" class="a8" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="D8" id="d8"></label>
                        <input value="150 D9" type="checkbox" id="D9" class="a9" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="D9" id="d9"></label>
                        <input value="150 D10" type="checkbox" id="D10" class="a10" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="D10" id="d10"></label>
                        <input value="150 D11" type="checkbox" id="D11" class="a11" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="D11" id="d11"></label>
                        <input value="150 D12" type="checkbox" id="D12" class="a12" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="D12" id="d12"></label>
                    </div>
                    <div id="row-c">
                        <div>C</div>
                        <input value="150 C1" type="checkbox" id="C1" class="a1" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="C1" id="c1"></label>
                        <input value="150 C2" type="checkbox" id="C2" class="a2" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="C2" id="c2"></label>
                        <input value="150 C3" type="checkbox" id="C3" class="a3" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="C3" id="c3"></label>
                        <input value="150 C4" type="checkbox" id="C4" class="a4" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="C4" id="c4"></label>
                        <input value="150 C5" type="checkbox" id="C5" class="a5" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="C5" id="c5"></label>
                        <input value="150 C6" type="checkbox" id="C6" class="a6" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="C6" id="c6"></label>
                        <input value="150 C7" type="checkbox" id="C7" class="a7" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="C7" id="c7"></label>
                        <input value="150 C8" type="checkbox" id="C8" class="a8" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="C8" id="c8"></label>
                        <input value="150 C9" type="checkbox" id="C9" class="a9" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="C9" id="c9"></label>
                        <input value="150 C10" type="checkbox" id="C10" class="a10" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="C10" id="c10"></label>
                        <input value="150 C11" type="checkbox" id="C11" class="a11" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="C11" id="c11"></label>
                        <input value="150 C12" type="checkbox" id="C12" class="a12" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="C12" id="c12"></label>
                    </div>
                    <div id="row-b">
                        <div>B</div>
                        <input value="150 B1" type="checkbox" id="B1" class="a1" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="B1" id="b1"></label>
                        <input value="150 B2" type="checkbox" id="B2" class="a2" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="B2" id="b2"></label>
                        <input value="150 B3" type="checkbox" id="B3" class="a3" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="B3" id="b3"></label>
                        <input value="150 B4" type="checkbox" id="B4" class="a4" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="B4" id="b4"></label>
                        <input value="150 B5" type="checkbox" id="B5" class="a5" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="B5" id="b5"></label>
                        <input value="150 B6" type="checkbox" id="B6" class="a6" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="B6" id="b6"></label>
                        <input value="150 B7" type="checkbox" id="B7" class="a7" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="B7" id="b7"></label>
                        <input value="150 B8" type="checkbox" id="B8" class="a8" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="B8" id="b8"></label>
                        <input value="150 B9" type="checkbox" id="B9" class="a9" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="B9" id="b9"></label>
                        <input value="150 B10" type="checkbox" id="B10" class="a10" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="B10" id="b10"></label>
                        <input value="150 B11" type="checkbox" id="B11" class="a11" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="B11" id="b11"></label>
                        <input value="150 B12" type="checkbox" id="B12" class="a12" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="B12" id="b12"></label>
                    </div>
                    <div id="row-a">
                        <div>A</div>
                        <input value="150 A1" type="checkbox" id="A1" class="a1" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="A1" id="a1"></label>
                        <input value="150 A2" type="checkbox" id="A2" class="a2" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="A2" id="a2"></label>
                        <input value="150 A3" type="checkbox" id="A3" class="a3" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="A3" id="a3"></label>
                        <input value="150 A4" type="checkbox" id="A4" class="a4" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="A4" id="a4"></label>
                        <input value="150 A5" type="checkbox" id="A5" class="a5" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="A5" id="a5"></label>
                        <input value="150 A6" type="checkbox" id="A6" class="a6" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="A6" id="a6"></label>
                        <input value="150 A7" type="checkbox" id="A7" class="a7" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="A7" id="a7"></label>
                        <input value="150 A8" type="checkbox" id="A8" class="a8" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="A8" id="a8"></label>
                        <input value="150 A9" type="checkbox" id="A9" class="a9" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="A9" id="a9"></label>
                        <input value="150 A10" type="checkbox" id="A10" class="a10" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="A10" id="a10"></label>
                        <input value="150 A11" type="checkbox" id="A11" class="a11" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="A11" id="a11"></label>
                        <input value="150 A12" type="checkbox" id="A12" class="a12" name="checkArr[]"
                            onclick="retrieve_id(this)" />
                        <label for="A12" id="a12"></label>
                    </div>
                </div>
                <div id="silver-class">
                    Silver Rs. 150
                </div>
            </div>
        </div>
        <div id="screen">
            <img src="images/Screen.png" alt="Screen">
        </div>
    </div>
    <div id="pay">
        <label id="pay-btn">Pay Rs
            <button id="total-pay" name="submit" value='true' class="btn btn-default">0</button>
        </label>
    </div>
    </form>

    <?php include 'fetch_seats.php'; ?>
    <script src="seat.js"></script>
    <script>
        /* to change the color of selected seats and to disable them. */
        const A = [];
        const B = [];
        const C = [];
        const D = [];
        const E = [];
        const F = [];
        const G = [];
        const H = [];
        const I = [];
        const J = [];
        const K = [];
        const L = [];
        const M = [];
        A[0] = "<?php echo $A[0] ?>";
        A[1] = "<?php echo $A[1] ?>";
        A[2] = "<?php echo $A[2] ?>";
        A[3] = "<?php echo $A[3] ?>";
        A[4] = "<?php echo $A[4] ?>";
        A[5] = "<?php echo $A[5] ?>";
        A[6] = "<?php echo $A[6] ?>";
        A[7] = "<?php echo $A[7] ?>";
        A[8] = "<?php echo $A[8] ?>";
        A[9] = "<?php echo $A[9] ?>";
        A[10] = "<?php echo $A[10] ?>";
        A[11] = "<?php echo $A[11] ?>";

        B[0] = "<?php echo $B[0] ?>";
        B[1] = "<?php echo $B[1] ?>";
        B[2] = "<?php echo $B[2] ?>";
        B[3] = "<?php echo $B[3] ?>";
        B[4] = "<?php echo $B[4] ?>";
        B[5] = "<?php echo $B[5] ?>";
        B[6] = "<?php echo $B[6] ?>";
        B[7] = "<?php echo $B[7] ?>";
        B[8] = "<?php echo $B[8] ?>";
        B[9] = "<?php echo $B[9] ?>";
        B[10] = "<?php echo $B[10] ?>";
        B[11] = "<?php echo $B[11] ?>";

        C[0] = "<?php echo $C[0] ?>";
        C[1] = "<?php echo $C[1] ?>";
        C[2] = "<?php echo $C[2] ?>";
        C[3] = "<?php echo $C[3] ?>";
        C[4] = "<?php echo $C[4] ?>";
        C[5] = "<?php echo $C[5] ?>";
        C[6] = "<?php echo $C[6] ?>";
        C[7] = "<?php echo $C[7] ?>";
        C[8] = "<?php echo $C[8] ?>";
        C[9] = "<?php echo $C[9] ?>";
        C[10] = "<?php echo $C[10] ?>";
        C[11] = "<?php echo $C[11] ?>";

        D[0] = "<?php echo $D[0] ?>";
        D[1] = "<?php echo $D[1] ?>";
        D[2] = "<?php echo $D[2] ?>";
        D[3] = "<?php echo $D[3] ?>";
        D[4] = "<?php echo $D[4] ?>";
        D[5] = "<?php echo $D[5] ?>";
        D[6] = "<?php echo $D[6] ?>";
        D[7] = "<?php echo $D[7] ?>";
        D[8] = "<?php echo $D[8] ?>";
        D[9] = "<?php echo $D[9] ?>";
        D[10] = "<?php echo $D[10] ?>";
        D[11] = "<?php echo $D[11] ?>";

        E[0] = "<?php echo $E[0] ?>";
        E[1] = "<?php echo $E[1] ?>";
        E[2] = "<?php echo $E[2] ?>";
        E[3] = "<?php echo $E[3] ?>";
        E[4] = "<?php echo $E[4] ?>";
        E[5] = "<?php echo $E[5] ?>";
        E[6] = "<?php echo $E[6] ?>";
        E[7] = "<?php echo $E[7] ?>";
        E[8] = "<?php echo $E[8] ?>";
        E[9] = "<?php echo $E[9] ?>";
        E[10] = "<?php echo $E[10] ?>";
        E[11] = "<?php echo $E[11] ?>";

        F[0] = "<?php echo $F[0] ?>";
        F[1] = "<?php echo $F[1] ?>";
        F[2] = "<?php echo $F[2] ?>";
        F[3] = "<?php echo $F[3] ?>";
        F[4] = "<?php echo $F[4] ?>";
        F[5] = "<?php echo $F[5] ?>";
        F[6] = "<?php echo $F[6] ?>";
        F[7] = "<?php echo $F[7] ?>";
        F[8] = "<?php echo $F[8] ?>";
        F[9] = "<?php echo $F[9] ?>";
        F[10] = "<?php echo $F[10] ?>";
        F[11] = "<?php echo $F[11] ?>";

        G[0] = "<?php echo $G[0] ?>";
        G[1] = "<?php echo $G[1] ?>";
        G[2] = "<?php echo $G[2] ?>";
        G[3] = "<?php echo $G[3] ?>";
        G[4] = "<?php echo $G[4] ?>";
        G[5] = "<?php echo $G[5] ?>";
        G[6] = "<?php echo $G[6] ?>";
        G[7] = "<?php echo $G[7] ?>";
        G[8] = "<?php echo $G[8] ?>";
        G[9] = "<?php echo $G[9] ?>";
        G[10] = "<?php echo $G[10] ?>";
        G[11] = "<?php echo $G[11] ?>";

        H[0] = "<?php echo $H[0] ?>";
        H[1] = "<?php echo $H[1] ?>";
        H[2] = "<?php echo $H[2] ?>";
        H[3] = "<?php echo $H[3] ?>";
        H[4] = "<?php echo $H[4] ?>";
        H[5] = "<?php echo $H[5] ?>";
        H[6] = "<?php echo $H[6] ?>";
        H[7] = "<?php echo $H[7] ?>";
        H[8] = "<?php echo $H[8] ?>";
        H[9] = "<?php echo $H[9] ?>";
        H[10] = "<?php echo $H[10] ?>";
        H[11] = "<?php echo $H[11] ?>";

        I[0] = "<?php echo $I[0] ?>";
        I[1] = "<?php echo $I[1] ?>";
        I[2] = "<?php echo $I[2] ?>";
        I[3] = "<?php echo $I[3] ?>";
        I[4] = "<?php echo $I[4] ?>";
        I[5] = "<?php echo $I[5] ?>";
        I[6] = "<?php echo $I[6] ?>";
        I[7] = "<?php echo $I[7] ?>";
        I[8] = "<?php echo $I[8] ?>";
        I[9] = "<?php echo $I[9] ?>";
        I[10] = "<?php echo $I[10] ?>";
        I[11] = "<?php echo $I[11] ?>";

        J[0] = "<?php echo $J[0] ?>";
        J[1] = "<?php echo $J[1] ?>";
        J[2] = "<?php echo $J[2] ?>";
        J[3] = "<?php echo $J[3] ?>";
        J[4] = "<?php echo $J[4] ?>";
        J[5] = "<?php echo $J[5] ?>";
        J[6] = "<?php echo $J[6] ?>";
        J[7] = "<?php echo $J[7] ?>";
        J[8] = "<?php echo $J[8] ?>";
        J[9] = "<?php echo $J[9] ?>";
        J[10] = "<?php echo $J[10] ?>";
        J[11] = "<?php echo $J[11] ?>";

        K[0] = "<?php echo $K[0] ?>";
        K[1] = "<?php echo $K[1] ?>";
        K[2] = "<?php echo $K[2] ?>";
        K[3] = "<?php echo $K[3] ?>";
        K[4] = "<?php echo $K[4] ?>";
        K[5] = "<?php echo $K[5] ?>";
        K[6] = "<?php echo $K[6] ?>";
        K[7] = "<?php echo $K[7] ?>";
        K[8] = "<?php echo $K[8] ?>";
        K[9] = "<?php echo $K[9] ?>";
        K[10] = "<?php echo $K[10] ?>";
        K[11] = "<?php echo $K[11] ?>";

        for (let i = 0; i < 12; i++) {
            if (A[i] === "disabled") {
                document.getElementById("A" + (i + 1)).disabled = true;
                const root = document.querySelector(":root");
                root.style.setProperty("--a" + (i + 1), 'white');
            }
            if (B[i] === "disabled") {
                document.getElementById("B" + (i + 1)).disabled = true;
                const root = document.querySelector(":root");
                root.style.setProperty("--b" + (i + 1), 'white');
            }
            if (C[i] === "disabled") {
                document.getElementById("C" + (i + 1)).disabled = true;
                const root = document.querySelector(":root");
                root.style.setProperty("--c" + (i + 1), 'white');
            }
            if (D[i] === "disabled") {
                document.getElementById("D" + (i + 1)).disabled = true;
                const root = document.querySelector(":root");
                root.style.setProperty("--d" + (i + 1), 'white');
            }
            if (E[i] === "disabled") {
                document.getElementById("E" + (i + 1)).disabled = true;
                const root = document.querySelector(":root");
                root.style.setProperty("--e" + (i + 1), 'white');
            }
            if (F[i] === "disabled") {
                document.getElementById("F" + (i + 1)).disabled = true;
                const root = document.querySelector(":root");
                root.style.setProperty("--f" + (i + 1), 'white');
            }
            if (G[i] === "disabled") {
                document.getElementById("G" + (i + 1)).disabled = true;
                const root = document.querySelector(":root");
                root.style.setProperty("--g" + (i + 1), 'white');
            }
            if (H[i] === "disabled") {
                document.getElementById("H" + (i + 1)).disabled = true;
                const root = document.querySelector(":root");
                root.style.setProperty("--h" + (i + 1), 'white');
            }
            if (I[i] === "disabled") {
                document.getElementById("I" + (i + 1)).disabled = true;
                const root = document.querySelector(":root");
                root.style.setProperty("--i" + (i + 1), 'white');
            }
            if (J[i] === "disabled") {
                document.getElementById("J" + (i + 1)).disabled = true;
                const root = document.querySelector(":root");
                root.style.setProperty("--j" + (i + 1), 'white');
            }
            if (K[i] === "disabled") {
                document.getElementById("K" + (i + 1)).disabled = true;
                const root = document.querySelector(":root");
                root.style.setProperty("--k" + (i + 1), 'white');
            }
        }
    </script>
</body>

</html>