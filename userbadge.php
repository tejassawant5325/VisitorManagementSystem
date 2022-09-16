<?php
include 'db_connect.php';
include 'phpqrcode/qrlib.php';
session_start();

function displayBadge($result){
echo ' <div class="container mt-5" id="badge">
<div class="card" style="width: 20rem;">
    <div class="text-center m-1 mb-0">
        <img src="'. $result['user_image'].'" class="user-img text-center" alt="Visitors image">
    </div>
    <div class="card-body">
        <h5 class="card-title text-center mt-0">
            '. $result['Name'].' ' .$result['Middle_Name'].' ' .$result['Last_Name'].'</h5>
        <p class="card-text m-1">Receipt Id : '.$result['ReceiptID'].'</p>
        <p class="card-text m-1">Contact No : '. $result['Contact'].'</p>
        <p class="card-text m-1">Nationality : '. $result['Nationality'].'</p>
        <p class="card-text m-1">Employer Name : '. $result['owner_name'].'</p>
        <p class="card-text m-1">Work : '. $result['Purpose'].'</p>
        <p class="card-text m-1">Address : '. $result['temp_address'].'</p>

        <div class="d-flex">
            <div class="qr-img">
                <img class="qr-image" src=userqrcodes/'. $result['ReceiptID'].'.png alt="" srcset="">
            </div>
            <div class="signatures">
                <p class="card-text mb-2 mt-2">Employers Sign : </p>
                <p class="card-text mb-2 mt-4">Visitors Sign : </p>
            </div>
        </div>
      
        <p class="text-center m-0"><b>NOTE</b></p>
        <p class="card-text text-center m-0"><b>To be carried while in Ratnagiri</b></p>
        <p class="card-text text-center m-0"><b>This should not be treated as Govt Id</b></p>



    </div>
</div>

</div>


<div class="container mt-5 mb-4">
<button type="button" class="btn btn-info mx-2" onclick="printCertificate()">Print Id</button>
<a href="viewdata.php" class="btn btn-dark">Go Back</a>
</div>';
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Your ID</title>

    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>


<?php
$id = $_GET['id'];
$sql = "SELECT * FROM `info_visitor` WHERE `Serial` =  $id";
$res = mysqli_query($link, $sql);
$result = mysqli_fetch_array($res, MYSQLI_ASSOC);
if($result){   
    $serialId = $result['Serial'];
    $ReceiptID = $result['ReceiptID'];
    $hashSerialID = password_hash($serialId,PASSWORD_DEFAULT);
    $hashReceiptID = password_hash($ReceiptID,PASSWORD_DEFAULT);

    if (isset($_GET['id'])) {
        $path = 'userqrcodes/';
        $file = $path . $result['ReceiptID'] . '.png';
        $url = ''.$baseUrl.'/verifyuser.php?string=' . $hashSerialID . '&query='.$hashReceiptID.'&querystring='.$ReceiptID.'';
        Qrcode::png($url, $file);
    }
    displayBadge($result);
}
else{
    echo '<div class="alert alert-warning" role="alert">
  No Record Found
  </div>';

  echo '<a href="viewdata.php" class="btn btn-info">GO BACK</button>';
}
?>




    <script>
    function printCertificate() {
        const printContents = document.getElementById('badge').innerHTML;
        const originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>