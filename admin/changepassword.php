<?php
error_reporting(E_ALL ^ E_WARNING);
include '../db_connect.php';
session_start();
if ($_SESSION["adminlogin"] == 0) {
    header("location: index.php");
}
$admin = $_SESSION["admin"];

$sql = "SELECT `mobile` FROM `login_info` WHERE `userName` = '$admin'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);

$row = mysqli_fetch_assoc($result);
$contact = $row['mobile'];
?>

<?php

$error = $showMsg = "";
$count = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    // $contact = $_POST["contact"];
    $password = $_POST["password"];

    $passwordHash = password_hash($password,PASSWORD_DEFAULT);
    $sql = "UPDATE `login_info` SET `pass`='$passwordHash' WHERE `userName` = '$username'";
    $result = mysqli_query($link, $sql);

    if ($result) {
       echo $showMsg = "Password Changed";
       header('location:index.php');

    } else {
        $error = "Try Again";
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

    <style>

    </style>
</head>

<body>
    <!-- As a link -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Ratnagiri Police</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Admin Controls
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="addoperators.php">Add Operators</a></li>
                            <li><a class="dropdown-item" href="adddepartments.php">Add Police Station</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="viewdata.php">View Visitors</a></li>
                            <li><a class="dropdown-item" href="viewdepartments.php">View Police Station</a></li>
                            <li><a class="dropdown-item" href="viewoperators.php">View Operators</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="registeradmins.php">Register Admins</a></li>
                            <li><a class="dropdown-item" href="changepassword.php">Change Password</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
                <p class="mt-3 mx-3">Admin : <?php echo $admin; ?></p>
            </div>
        </div>
    </nav>

    <div class="container">
        <h4 class="text-center mt-3">Change Password</h4>
        <?php echo $error; ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username"
                    required />
            </div>
            <!-- <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="number" name="contact" class="form-control" id="mobile" value="<?php echo $contact; ?>"
                    minlength="10" maxlength="10" placeholder="Enter Mobile Number" required />
            </div> -->
            <div class="mb-3 position">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" class="form-control" id="password"
                    placeholder="Enter New Password" required />
                <button type="button" class="btn btn-info btn-sm" id="view" onmousedown="viewPassword()" onmouseup="viewPassword()" onmouseleave="viewPassword()";>View</button>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">
                Submit
            </button>
        </form>
    </div>

    <script>
    const viewButton = document.getElementById('view');

    function viewPassword() {
        const inputPass = document.getElementById('password');
        inputPass.type = "text";
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>