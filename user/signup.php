<?php 
error_reporting(E_ALL ^ E_WARNING);
include "../db_connect.php";
session_start();
$_SESSION["userlogin"] = 0;

$userexist = false;
$success = false;
$error = false;
?>




<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $sql = "SELECT * FROM `public_login_info` WHERE `username` = '$username'";
    $match = mysqli_query($link, $sql);
    $count = mysqli_num_rows($match);
    if (!$count) {
        $username = $_POST["username"];
        $mobile = $_POST['mobile'];
        $password = $_POST["password"];
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `public_login_info`(`username`, `mobile`, `password`) VALUES ('$username','$mobile','$passwordhash')";
        $result = mysqli_query($link, $sql);
    } else {
        $userexist = true;
    }
    if ($result) {
       $success = true;
      
    } else {
        $error = true;
    }

}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link rel="icon" type="image/x-icon" href="images/ratnagiripolice.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/ratnagiripolice.png" alt="" width="35" height="35"
                    class="d-inline-block align-text-top" />
                Ratnagiri Police
            </a>
        </div>
    </nav>
    <?php
    if($success){
        echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Registration Done Successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    else if($userexist){
        echo  '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning</strong> Username Already Exist,Use Unique Username.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    else if($error){
        echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Try Again</strong> Registration not Done.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    
?>
    <div class="container">
        <h4 class="text-center mt-3">User Registration</h4>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username"
                    required>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="number" name="mobile" class="form-control" id="mobile" placeholder="Enter Mobile Number"
                    maxlength="10" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password"
                    required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
        <a href="index.php">Already Registered ? Login Here</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>