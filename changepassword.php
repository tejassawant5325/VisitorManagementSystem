<?php session_start();
include "db_connect.php";
if ($_SESSION["operatorlogin"] == 0) {
    header("location: index.php");
}

$operator = $_SESSION["operator"];

$sql = "SELECT `police_station` FROM `operators_login_info` WHERE `operator_username`='$operator'";
$sqlresult = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($sqlresult);
$policestation = $row['police_station'];

?>



<?php

$error = $showMsg = "";
$count = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    // $contact = $_POST["contact"];
    $password = $_POST["password"];

    $passwordHash = password_hash($password,PASSWORD_DEFAULT);
    $sql = "UPDATE `operators_login_info` SET `operator_password`='$passwordHash' WHERE `operator_username` = '$username'";
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
    <title>Operator Login</title>
    <link rel="icon" type="image/x-icon" href="images/ratnagiripolice.png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
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
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Operator Controls
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="addvisitortrial.php">Add Visitor</a></li>
                            <li><a class="dropdown-item" href="viewdata.php">View Visitor Data</a></li>

                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="changepassword.php">Change Password</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="d-flex" role="search">
                    <input class="form-control me-2" type="search" name="rid" placeholder="Enter Receipt Id"
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                </form>
                <p class="mt-3 mx-3">Operator : <?php echo $operator; ?></p>
                <p class="mt-3"><?php echo $policestation; ?></p>

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
                <button type="button" class="btn btn-info btn-sm" id="view" onclick="viewPassword();">View</button>
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
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</body>

</html>