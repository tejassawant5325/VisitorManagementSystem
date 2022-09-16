<?php
error_reporting(E_ALL ^ E_WARNING);
include '../db_connect.php';
session_start();
if ($_SESSION["adminlogin"] == 0) {
    header("location: index.php");
}
$admin = $_SESSION["admin"];




$showMsg = '';
if (isset($_POST['submit'])) {
    $deptname = $_POST['deptname'];
    $status = 1;
    $sql = "INSERT INTO `departments`(`dept_name`, `status`) VALUES ('$deptname','$status')";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $showMsg = true;

    } else {
        $showMsg = false;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add Police Station</title>
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
    if($showMsg){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Police Station Added 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
   
    ?>
    <div class="container mt-3">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="mb-3">
                <label for="departmentname" class="form-label">Police Sation</label>
                <input type="text" name="deptname" class="form-control" id="departmentname"
                    placeholder="Enter Police Station Name" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>