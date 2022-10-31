<?php
error_reporting(E_ALL ^ E_WARNING);
include "../db_connect.php";
session_start();
$_SESSION["adminlogin"] = 0;?>

<?php

$error = $uname = $pass = "";
$count = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM `login_info` WHERE `userName`= '$username'";
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['pass'])) {
                $_SESSION["admin"] = $_POST["username"];
                // $_SESSION["adminlogin"] = 1;
                echo "<script LANGUAGE='JavaScript'>
                            window.alert('Logged in Successfully');
                            window.location.href='verifyotp.php';
                            </script>";
            }
        }

    } else {
        $error = "Invalid Password or Username";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="images/ratnagiripolice.png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <!-- As a link -->
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/ratnagiripolice.png" alt="" width="35" height="35"
                    class="d-inline-block align-text-top" />
                Ratnagiri Police
            </a>
        </div>
    </nav>

    <div class="container">
        <h4 class="text-center mt-3">Admin Login</h4>
        <?php echo $error; ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username"
                    required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password"
                    required />
            </div>
            <button type="submit" name="submit" class="btn btn-primary">
                Submit
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</body>

</html>