<?php
session_start();
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
$id = "";
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    

 $file = $_FILES['userimage'];
 $filename = $file['name'];
 $fileerror = $file['error'];
 $filetmp = $file['tmp_name'];

 $fileext = explode('.', $filename ?? '');
 $filecheck = strtolower(end($fileext));

 $fileextstored = array('png', 'jpg', 'jpeg','pdf');
 if (in_array($filecheck, $fileextstored)) {
     $destinationfile = 'visitorphotos/' . $filename;
     move_uploaded_file($filetmp, $destinationfile);

 }
    // ----------------------------------------******-----------------------------------
    $idfile = $_FILES['useragreement'];
    $idfilename = $idfile['name']; 
    $idfileerror = $idfile['error'];
    $idfiletmp = $idfile['tmp_name'];

    $idfileext = explode('.', $idfilename ?? '');
    $idfilecheck = strtolower(end($idfileext));

    $idfileextstored = array('png', 'jpg', 'jpeg','pdf');
    if (in_array($idfilecheck, $idfileextstored)) {
        $iddestinationfile = 'visitorsidcard/' . $idfilename;
        move_uploaded_file($idfiletmp, $iddestinationfile);
    }
    // ----------------------------------------******-----------------------------------
    $aggfile = $_FILES['userid'];
    $aggfilename = $aggfile['name'];
    $aggfileerror = $aggfile['error'];
    $aggfiletmp = $aggfile['tmp_name'];

    $aggfileext = explode('.', $aggfilename ?? '');
    $aggfilecheck = strtolower(end($aggfileext));

    $aggfileextstored = array('png', 'jpg', 'jpeg','pdf');
    if (in_array($aggfilecheck, $aggfileextstored)) {
        $aggdestinationfile = 'visitoragreement/' . $aggfilename;
        move_uploaded_file($aggfiletmp, $aggdestinationfile);
    }
    
    $sql = "UPDATE `info_visitor` SET `user_image`='$destinationfile',`user_id_card`='$iddestinationfile',`user_agreement`='$aggdestinationfile' WHERE `Serial` = '$id'";
    $result = mysqli_query($link,$sql);
    if($result){
        echo "Done";
    }
    else{
        echo "Not Done";
    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="images/ratnagiripolice.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
                            Operator Controls
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="addvisitortrial.php">Add Visitor</a></li>
                            <li><a class="dropdown-item" href="viewdata.php">View Visitor Data</a></li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>

                    </li>
                </ul>
                <p class="mt-3 mx-3">Operator : <?php echo $operator; ?></p>
                <p class="mt-3">Police Station : <?php echo $policestation; ?></p>
            </div>
        </div>
    </nav>

    <div class="container">
        <h3 class="text-center mt-3">Edit Visitor</h3>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="visitorimage" class="form-label">Visitor Image</label>
                <input type="file" class="form-control" name="userimage" id="visitorimage" required>
            </div>
            <div class="mb-3">
                <label for="visitoragreement" class="form-label">Visitor Image</label>
                <input type="file" class="form-control" name="useragreement" id="visitoragreement" required>
            </div>
            <div class="mb-3">
                <label for="visitorid" class="form-label">Visitor Image</label>
                <input type="file" class="form-control" name="userid" id="visitorid" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>