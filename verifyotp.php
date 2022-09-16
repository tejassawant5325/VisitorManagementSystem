<?php
// error_reporting(E_ALL ^ E_WARNING);

session_start();
$ch = curl_init();
include "db_connect.php";
$operator = $_SESSION["operator"];

?>

<?php
$sql = "SELECT `operator_contact` FROM `operators_login_info` WHERE `operator_username`='$operator'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$operatorContact = $row['operator_contact'];

?>
<?php

$showmsg = '';
if (isset($_POST['sendotp'])) {

    $contact = $_POST["contact"];

    $otp = mt_rand(10000, 99999);
    // setcookie('otp', $otp);
    $_SESSION['otp'] = $otp;
    $url = 'http://49.50.67.32/smsapi/httpapi.jsp?username=ratnagir&password=123123&from=MAHPOL&to=' . $contact . '&text=OTP-' . $otp . '.MAHPOL&pe_id=1601100000000004090&template_id=1607100000000120635';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $res = curl_exec($ch);
    $showmsg = "OTP sent check your phone";

}

if (isset($_POST['verifyotp'])) {
    $otp = $_POST['otp'];

    if ($_SESSION['otp'] == $otp) {
        // $_SESSION["operatorlogin"] = 1;

        echo "<script LANGUAGE='JavaScript'>
    window.alert('OTP Verified, Logged In');
    window.location.href='dashboard.php';
    </script>";

    } else {
        echo "<script LANGUAGE='JavaScript'>
    window.alert('OTP did not match,Try Again');
    window.location.href='verifyotp.php';
    </script>";
    }

}

?>

<?php
function maskPhoneNumber($number)
{

    $mask_number = str_repeat("*", strlen($number) - 4) . substr($number, -4);

    return $mask_number;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verfiy OTP</title>
    <link rel="icon" type="image/x-icon" href="images/ratnagiripolice.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- As a link -->
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Ratnagiri Police</a>
        </div>
    </nav>

    <div class="container">
        <h4 class="text-center mt-3">Verify OTP</h4>
        <h5 class="text-center text-success"><?php echo $showmsg; ?></h5>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="number" name="contact" class="form-control" id="number"
                    value="<?php echo $operatorContact; ?>" readonly required>
            </div>
            <button type="submit" name="sendotp" class="btn btn-primary">Send OTP</button>
            <!-- <a type="submit" href="<?php echo $url; ?>" name="sendotp" class="btn btn-primary">Send OTP</a> -->

        </form>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="mb-3">
                <label for="otp" class="form-label">Enter OTP</label>
                <input type="number" name="otp" class="form-control" id="otp" placeholder="Enter OTP" required>
            </div>
            <button type="submit" name="verifyotp" class="btn btn-success">Verify OTP</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>