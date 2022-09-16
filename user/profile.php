<?php
error_reporting(E_ALL ^ E_WARNING);
include '../db_connect.php';
session_start();
if ($_SESSION["userlogin"] == 0) {
    header("location: index.php");
}
$user = $_SESSION["user"];


?>

<?php

$sql = "SELECT * FROM `public_login_info` WHERE `username` = '$user'";
$match = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($match);
$public_id = $row['public_id'];
?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Profile</title>
  <link rel="icon" type="image/x-icon" href="images/ratnagiripolice.png">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="images/ratnagiripolice.png" alt="" width="35" height="35" class="d-inline-block align-text-top" />
        Ratnagiri Police
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
        
        <p class="mt-3 mx-3">Logged In User : <?php echo $user; ?></p>

      </div>
    </div>
  </nav>



  <div class="container table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Receipt Id</th>
          <th scope="col">First Name</th>
          <th scope="col">Police Station</th>
          <th scope="col">Purpose</th>
          <th scope="col">Application Filled</th>
          <th scope="col">Application Approved</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>

      <?php
      $sql = "SELECT * FROM `info_visitor` WHERE `public_id` = '$public_id'";
      $result = mysqli_query($link,$sql);
      $count = mysqli_num_rows($result);
      if($count >= 1){
        while($row = mysqli_fetch_assoc($result)){

          echo '<tr>
          <th scope="row">'.$row['ReceiptID'].'</th>
          <td>'.$row['Name'].'</td>
          <td>'.$row['department'].'</td>
          <td>'.$row['Purpose'].'</td>
          <td>'.$row['Date'].'</td>
          <td>'.$row['application_approved'].'</td>
          ';
          if($row['Status'] == 1){
            echo '<td><button type="button" class="btn btn-success mx-2">Accepted</button></td>';

          }
          else{
            echo '<td><button type="button" class="btn btn-warning mx-2">Pending</button></td>';
          }
         
          
          echo '</tr>';
        }
      }
        ?>
      </tbody>
    </table>


    <p class="text-info bg-dark p-3">Visit the registered Police Station in next few days</p>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
    crossorigin="anonymous"></script>
</body>

</html>