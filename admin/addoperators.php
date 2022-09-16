<?php

error_reporting(E_ALL ^ E_WARNING);
include '../db_connect.php';
session_start();
if ($_SESSION["adminlogin"] == 0) {
    header("location: index.php");
}
$admin = $_SESSION["admin"];

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $contact = $_POST['contact'];
    $department = $_POST['dept'];
    $password = '';
    $password = $contact;

    $passwordhash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `operators_login_info`(`operator_username`, `operator_contact`,`police_station`,`operator_password`) VALUES ('$username','$contact','$department','$passwordhash');";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $url = 'http://49.50.67.32/smsapi/httpapi.jsp?username=ratnagir&password=123123&from=MAHPOL&to='. $contact.'&text=username:-'.$username.',password:-'.$password.'.MAHPOL&pe_id=1601100000000004090&template_id=1607100000000120635';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $res = curl_exec($ch);
        header('location:addoperators.php?success');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add Operators</title>
    <link rel="icon" type="image/x-icon" href="images/ratnagiripolice.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
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
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
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
                    <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <p class="mt-3 mx-3">Admin : <?php echo $admin; ?></p>

            </div>
        </div>
    </nav>


<?php
$showMsg = $_GET['success'];
if(isset($showMsg)){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success</strong>Operator Added Successfully
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>

    <div class="container">
        <h4 class="text-center">Add Operators</h4>
        <form class="" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control inputs" name="username" id="username"
                    aria-describedby="emailHelp" placeholder="Enter Username" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact No</label>
                <input type="number" class="form-control inputs" name="contact" id="contact"
                    aria-describedby="emailHelp" placeholder="Enter Mobile No" required>
            </div>

            <div class="mb-3 mt-3">
                <label for="policestation" class="form-label">Police Station</label>
                <!-- <input type="text" name="department" class="form-control" id="department" placeholder="Enter Police Station" required> -->
                <select name="dept" id="dept">
                    <?php
$query = "SELECT `dept_name` FROM `departments` WHERE `status` = 1;";
$result = mysqli_query($link, $query);
while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value="' . $row['dept_name'] . '" name="dept">' . $row['dept_name'] . '</option>';
}
?>

                </select>
            </div>


            <!-- <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control inputs" id="password"
                    placeholder="Enter password" required>
            </div> -->


            <!-- <button type="submit" name="gpass" class="btn btn-info mt-3" onclick="genPassword();">Generate Password</button> -->
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- <button type="submit" class="btn btn-info mt-3" onclick="genPassword();">Generate Password</button> -->


    </div>

    <script>
    function genPassword() {
        var chars = "0123456789abcdefghijklmnopqrstuvwxyz@#$&ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var passwordLength = 12;
        var password = "";


        for (var i = 0; i <= passwordLength; i++) {
            var randomNumber = Math.floor(Math.random() * chars.length);
            password += chars.substring(randomNumber, randomNumber + 1);
        }
        document.getElementById("password").value = password;

    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>