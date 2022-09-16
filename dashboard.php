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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
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

    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Visitors Registered</h5>
                        <p class="card-text">

                            <?php
$sql = "SELECT * FROM `info_visitor` WHERE `department` = '$policestation'";
$result = mysqli_query($link, $sql);
$totalVisitors = mysqli_num_rows($result);
?>
                            <?php echo $totalVisitors; ?>
                        </p>
                        <a href="viewdata.php" class="btn btn-info">View</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Pending Request</h5>
                        <p class="card-text">
                            <?php
$sql = "SELECT * FROM `info_visitor` WHERE `Status` IS NULL AND `department` = '$policestation'";
$result = mysqli_query($link, $sql);
$visitorsPending = mysqli_num_rows($result);
?>
                            <?php echo $visitorsPending; ?>

                        </p>
                        <a href="viewdata.php" class="btn btn-info">View</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Approved Request</h5>
                        <p class="card-text">
                            <?php
$sql = "SELECT * FROM `info_visitor` WHERE `Status`= 1 AND `department` = '$policestation'";
$result = mysqli_query($link, $sql);
$approvedVisitors = mysqli_num_rows($result);
?>
                            <?php echo $approvedVisitors; ?>
                        </p>
                        <a href="viewdata.php" class="btn btn-info">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <h4 class="text-center">View Search Results</h4>

        <div class="container mt-5 mb-5">

            <?php
if (isset($_POST['search'])) {
    $rid = $_POST['rid'];
    $sql = "SELECT * FROM `info_visitor` WHERE `ReceiptID` = '$rid'";
    $result = mysqli_query($link, $sql);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($result);

        echo ' <div class="card" style="width: 19rem;">
            <img src=" ' . $row['user_image'] . '" class="card-img-top" alt="Visitors image">
            <div class="card-body">
                <h5 class="card-title">' . $row['Name'] . ' ' . $row['Middle_Name'] . ' ' . $row['Last_Name'] . '</h5>
                <p class="card-text">Receipt Id : ' . $row['ReceiptID'] . '</p>
                <p class="card-text">Contact No : ' . $row['Contact'] . '</p>
                <p class="card-text">Work : ' . $row['Purpose'] . '</p>
                <p class="card-text">Address : ' . $row['temp_address'] . '</p>
                <p class="card-text">Police Station Verified at : ' . $row['department'] . '</p>

            </div>
        </div>';
    } else {
        echo '<p class="text-center fs-5">No Details To Show</p>';
    }
}
?>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>