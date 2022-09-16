<?php
include 'db_connect.php';
include 'phpqrcode/qrlib.php';
session_start();

$rid = $_GET['querystring'];
$sql = "SELECT * FROM `info_visitor` WHERE `ReceiptID` =  $rid";
$res = mysqli_query($link, $sql);
$result = mysqli_fetch_array($res, MYSQLI_ASSOC);

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visitor Details</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>


    <div class="container mt-5">
            <img src="<?php echo $result['user_image'];?>" class="user-img" alt="Visitors image">
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Visitor Name : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['Name'].' ' .$result['Middle_Name'].' ' .$result['Last_Name'];?>">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Visitor Contact : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['Contact'];?>">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Visitor Nationality : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['Nationality'];?>">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Visitor Purpose : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['Purpose'];?>">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Visitor Last Work Details : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['lwd'];?>">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Visitor Agent Name : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['agent_name'];?>">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Visitor Agent Contact : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['agent_contact'];?>">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Visitor Employer Name : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['owner_name'];?>">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Visitor Employer Contact : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['owner_contact'];?>">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Visitor Employer Address : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['owner_address'];?>">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Visitor Caste : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['visitor_caste'];?>">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Visitor Religion : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['visitor_religion'];?>">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Visitor Permanent Address : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['Per_address'];?>">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Visitor Temporary Address : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['temp_address'];?>">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Application Filled Date : </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="  <?php echo $result['Date'];?>">
            </div>
            
        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>