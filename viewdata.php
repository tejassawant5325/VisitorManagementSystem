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




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Data</title>
    <link rel="icon" type="image/x-icon" href="images/ratnagiripolice.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>
<script>
function undisable() {
    document.getElementById("dateF").disabled = false;
    document.getElementById("dateP").disabled = false;
}

function disable() {
    document.getElementById("dateF").disabled = true;
    document.getElementById("dateP").disabled = true;
}
</script>

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
                <p class="mt-3">Police Station  : <?php echo $policestation; ?></p>

               
            </div>
        </div>
    </nav>

    <div class="container">
        <h4 class="text-center">Search Filters</h4>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <p>Search All <input type="radio" name="search" id="all" value="all" onclick="disable()"></p>
            <hr>

            <p>Search by Receipt Id <input type="radio" name="search" id="receiptid" value="receipt"
                    onclick="disable()"></p>
            <input type="text" name="receipt" id="receipt" placeholder="Enter Receipt Id">
            <hr>

            

            <p>Search by Job <input type="radio" name="search" id="job" value="job" onclick="disable()"></p>
            <select name="job" id="userjob">
                <option value="Fishing">Fishing</option>
                <option value="Mango Farm">Mango Farm</option>
            </select>
            <hr>

            <p>Search by Date <input type="radio" name="search" id="date" value="dates" onclick="undisable()"></p>
            <div>

                <input type="date" id="dateP" name="dateP" value="<?php echo $datePF; ?>" id="in1"
                    oninput="onDateInput()" disabled required />
                <input type="date" id="dateF" name="dateF" value="<?php echo $dateFP; ?>" id="in2" disabled required />

            </div>
            <script type="text/javascript">
            function onDateInput() {
                var inputDateA = document.getElementById('in1').value;

                if (inputDateA)
                    document.getElementById('in2').setAttribute('min', inputDateA);


            }
            </script>
            <hr>

            <p>Search by Owner Name <input type="radio" name="search" id="owner" value="ownername" onclick="disable()">
                <input type="text" name="oname" id="oname" placeholder="Enter Owner Name">

                <input class="btn btn-success" type="submit" value="Submit" name="submit">
        </form>
    </div>

    <div class="container table-responsive mt-5">
        <h4 class="text-center">Visitors Data</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Login Id No</th>
                    <th scope="col">Receipt Id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Police Station</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Purpose</th>
                    <th scope="col">Date</th>
                    <th scope="col">Owner Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Generate Badge</th>
                    <th scope="col">Id Status</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Agreement</th>
                    <th scope="col">Id Card</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>


                <?php

// Search Options
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["search"])) {
        echo "<br><br><span style = 'color : red;'>PLease Select any field !</span>";exit();}

    if (isset($_POST["search"]) && $_POST["search"] == "all") {
        $query = "SELECT * FROM `info_visitor` WHERE `department`='$policestation'";
        // $query = "SELECT * FROM `info_visitor`";
        $result = mysqli_query($link, $query);
        $count = mysqli_num_rows($result);

        if ($count) {
            echo "<br><h3 style = 'padding-left: 16px;''>Information of all visitors :</h3><br/>";
            headingMake($result);
        } else {echo "<br><span style = 'color : red;'>No Entries to Display</span>";}

    }
    //---------------------------------------------*****************-----------------------------------------
    elseif (isset($_POST["search"]) && $_POST["search"] == "ownername") {
        $ownername = $_POST['oname'];
        $query = "SELECT * FROM `info_visitor` WHERE `owner_name` = '$ownername' and `department` = '$policestation'";
        $result = mysqli_query($link, $query);
        $count = mysqli_num_rows($result);

        if ($count) {
            echo "<br><h3 style = 'padding-left: 16px;''>Information of all visitors :</h3><br/>";
            headingMake($result);
        } else {echo "<br><span style = 'color : red;'>No Entries to Display</span>";}
    }
    //---------------------------------------------*****************-----------------------------------------
    elseif (isset($_POST["search"]) && $_POST["search"] == "receipt") {
        $receiptid = $_POST['receipt'];
        $query = "SELECT * FROM `info_visitor` WHERE `ReceiptID` = $receiptid and `department` = '$policestation'";
        $result = mysqli_query($link, $query);
        $count = mysqli_num_rows($result);

        if ($count) {
            echo "<br><h3 style = 'padding-left: 16px;''>Information of all visitors :</h3><br/>";
            headingMake($result);
        } else {echo "<br><span style = 'color : red;'>No Entries to Display</span>";}
    }
    //---------------------------------------------*****************-----------------------------------------

    elseif (isset($_POST["search"]) && $_POST["search"]=="job") {
        $job = $_POST['job'];
        $query = "SELECT * FROM `info_visitor` WHERE `Purpose` = '$job' and `department` = '$policestation'";
        $result = mysqli_query($link,$query);
        $count = mysqli_num_rows($result);
                    
        if($count){
            echo "<br><h3 style = 'padding-left: 16px;''>Information of all visitors :</h3><br/>";
            headingMake($result);
        }else{echo "<br><span style = 'color : red;'>No Entries to Display</span>";}
    }
    // ----------------------------------------------DISPLAYING BY SELECTED DATE---------------------------------------------------

    else if (isset($_POST["search"]) && $_POST["search"] == "dates") {

        if (empty($_POST["dateP"]) || empty($_POST["dateF"])) {
            echo "<br><br><span style = 'color : red;'>Select a valid option</p>";
        } else {
            $datePF = $_POST['dateP'];
            $dateFP = $_POST['dateF'];
            $dateP = explode('-', $_POST['dateP']);
            $dateF = explode('-', $_POST['dateF']);
            /* Vriables used many times seperatly ,
             * so can't use arrray now !!
             * future Reminder
             */

            $day_start = $dateP[2];
            $day_end = $dateF[2];
            $month_start = $dateP[1];
            $month_end = $dateF[1];
            $year_start = $dateP[0];
            $year_end = $dateF[0];
            $inputDate = array("$day_start", "$day_end", "$month_start", "$month_end", "$year_start", "$year_end");

            if ($day_end >= $day_start && $month_end >= $month_start && $year_end >= $year_start) {
                if ($day_start <= 31 && $day_end <= 31) {
                    $sql = "SELECT * FROM info_visitor WHERE day >= '$day_start' AND day <= '$day_end' AND year >= '$year_start'
                     AND year <= '$year_end' AND month >= '$month_start' AND month <='$month_end' AND `department` = '$policestation'";
                    $result = mysqli_query($link, $sql);
                    $count = mysqli_num_rows($result);
                    if ($count) {

                        if ($inputDate[0] == $inputDate[1]) {
                            echo "<br><br><h3 style = 'padding-left: 16px;'>Visitor Information for $inputDate[0]-$inputDate[2]-$inputDate[4]<br/> :</h3>";
                        } else {
                            echo "<br><br><h3 style = 'padding-left: 16px;'>Visitor Information from $inputDate[0]-$inputDate[2]-$inputDate[4] to
                     $inputDate[1]-$inputDate[3]-$inputDate[5] : <br/></h3>";
                        }

                        headingMake($result);

                    } else {echo "<br><br><span style = 'color : red;'>No Match Found Sorry</span>";}
                } else {echo "<br><br><span style = 'color : red;'>Their are max 31 days in any month !</span>";}

            } else {
                echo "<br><br><p style = 'color : red;'>select correct order, from past  to future !</p>";
            }
        }
    }
}

//---------------------------------------------------****************---------------------------------------------------------
// Function to display data
function headingMake($res)
{

    while ($result = mysqli_fetch_array($res, MYSQLI_ASSOC)) {

        echo '
   <tr>
     <th scope=row>' . $result['Serial'] . '</th>
     <td>' . $result['ReceiptID'] . '</td>
     <td>' . $result['Name'] . '</td>
     <td>' . $result['department'] . '</td>
     <td>' . $result['Contact'] . '</td>
     <td>' . $result['Purpose'] . '</td>
     <td>' . $result['Date'] . '</td>
     <td>' . $result['owner_name'] . '</td>
    ';
        if ($result['Status'] == 1) {
            echo '<td><button type="button" class="btn btn-success btn-sm name="status">Accepted</button></td>';

          
        } else {
            echo '<td><a href="userstatus.php?id=' . $result['Serial'] . '&status=1" type="button" class="btn btn-warning btn-sm name="status">Pending</a></td>';

            
        }

        if ($result['Status'] == 1) {
            echo '<td><a href="userbadge.php?id=' . $result['Serial'] . '" type="button" class="btn btn-success btn-sm">Print</a></td>';
        } else {
            echo '
     <td><button type="button" class="btn btn-warning btn-sm">Pending</button></td>';
        }
        //  Renew button
        $date_now = date("Y-m-d");
        $nextYear =  date('Y', strtotime('+1 year'));
        if ($date_now < $nextYear.'-05-31' && $result['Status'] == 1 ) {
            echo '<td><button type="button" class="btn btn-success btn-sm">Valid</button></td>';
        } else {
            echo '<td><a href="user_profile.php?id=' . $result['Serial'] . '" type="button" class="btn btn-secondary btn-sm">Pending</a></td>';
        }
        echo '<td><a class="btn btn-info btn-sm" href="'.$result['user_image'].'" target="_blank">View</a></td>';
        echo '<td><a class="btn btn-info btn-sm" href="'.$result['user_agreement'].'" target="_blank">View</a></td>';
        echo '<td><a class="btn btn-info btn-sm" href="'.$result['user_id_card'].'" target="_blank">View</a></td>';
        echo '<td><a href="edituser.php?id=' . $result['Serial'] . '" type="button" class="btn btn-primary btn-sm">Edit</a></td>';
        echo '</tr>';
    }
}
?>


            </tbody>
        </table>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>