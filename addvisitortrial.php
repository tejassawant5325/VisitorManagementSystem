<?php
error_reporting(E_ALL ^ E_WARNING);
include 'db_connect.php';
session_start();
if ($_SESSION["operatorlogin"] == 0) {
    header("location: index.php");
}
$operator = $_SESSION["operator"];

$showmsg = false;
?>

<?php
$sql = "SELECT * FROM `public_login_info` WHERE `username` = '$user'";
$match = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($match);
$public_id = $row['public_id'];
?>

<?php
$sql = "SELECT `police_station` FROM `operators_login_info` WHERE `operator_username`='$operator'";
$sqlresult = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($sqlresult);
$policestation = $row['police_station'];
?>

<?php
function validatemobile($mobile)
{
    if (!preg_match('/^[0-9]{10}+$/', $phone)) {
        $validateMobile = "Enter Mobile Number Properly";
    }
}
?>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Visitor Details
    $vmobile = $_POST['vmobile'];
    // $sql = "SELECT * FROM `info_visitor` WHERE `Contact` = $vmobile";
    // $match = mysqli_query($link, $sql);
    // $count = mysqli_num_rows($match);
    // if(!$count>=1){

    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $work = $_POST['work'];
    $agentname = $_POST['agentname'];
    $agentno = $_POST['agentno'];
    $ownername = $_POST['ownername'];
    $ownerno = $_POST['ownerno'];
    $vcaste = $_POST['vcaste'];
    $vreligion = $_POST['vreligion'];
    $paddress = $_POST['paddress'];
    $taddress = $_POST['taddress'];

    $workdetails = $_POST['workdetails'];
    $nationality = $_POST['nationality'];
    $owneraddress = $_POST['owneraddress'];
    $lwd = $_POST['workdetails'];
    $age = $_POST['age'];


    date_default_timezone_set("Asia/Kathmandu");
    $timein = date("H:i:s");
    $rid = rand(100000, 900000);

    $date = date("Y/m/d");
    $comment = $_POST["comments"];
    $day = date("d");
    $month = date("m");
    $year = date("Y");
    $department = $_POST['dept'];
    $dob = $_POST["dob"];
    $file = $_FILES['photo'];
   

// files
    $filename = $file['name'];
    $fileerror = $file['error'];
    $filetmp = $file['tmp_name'];

    $fileext = explode('.', $filename ?? '');
    $filecheck = strtolower(end($fileext));

    $fileextstored = array('png', 'jpg', 'jpeg');
    if (in_array($filecheck, $fileextstored)) {
        $destinationfile = 'visitorphotos/' . $filename;
        move_uploaded_file($filetmp, $destinationfile);

    }
       // ----------------------------------------******-----------------------------------
       $idfile = $_FILES['idcarddoc'];
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
       $aggfile = $_FILES['agreement'];
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

    $sql = "INSERT INTO info_visitor(public_id,Name,Middle_name,Last_Name, Contact, Nationality,Purpose,lwd,agent_name,agent_contact,owner_name,owner_contact,owner_address,visitor_caste,visitor_religion,
per_address,temp_address,department,day,
 month, year, Date, TimeIN, ReceiptID,
Comment,registeredBy,dob,age,user_image,user_id_card,user_agreement) VALUES ('$public_id','$fname','$mname','$lname','$vmobile','$nationality','$work','$lwd','$agentname','$agentno','$ownername','$ownerno','$owneraddress','$vcaste','$vreligion','$paddress','$taddress',
'$department','$day', '$month', '$year', '$date',
'$timein','$rid','$comment',
'$user','$dob','$age','$destinationfile','$iddestinationfile','$aggdestinationfile')";
    $result = mysqli_query($link, $sql);
    if ($result) {
        $showmsg = true;
        $sql = "INSERT INTO `visitor_record`(`visitor_fname`, `visitor_mname`, `visitor_lname`, `contact`, `nationality`, `application_filled`, `per_address`, `temp_address`) VALUES ('$fname','$mname','$lname','$vmobile','$nationality','$date','$paddress','$taddress')";
        $result = mysqli_query($link, $sql);
    } else {
        $showmsg = false;

    }
// }
// else{
//     $userExist = true;
// }
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Visitor</title>
    <link rel="icon" type="image/x-icon" href="images/ratnagiripolice.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

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


    <?php
if ($showmsg) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success</strong> Application Submitted Successfully,Check You Profile.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if($userExist)
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Alert </strong> User Already Exist.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
?>
    <div class="container">
        <h4 class="text-center mt-3">Application Form for Visitor Id</h4>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
            <h5 class="text-center">Section A : Vistitor's Employer Details</h5>
            <div class="mb-3">
                <label for="Owner" class="form-label">Employer Name</label>
                <input type="text" name="ownername" class="form-control" id="ownername"
                    placeholder="Enter Employer Name" required>
            </div>
            <div class="mb-3">
                <label for="Owner Mobile Number" class="form-label">Employer Mobile Number</label>
                <input type="number" name="ownerno" class="form-control" id="ownerno" pattern="\d*" maxlength="10"
                    minlength="10" placeholder="Enter Employer Mobile Number" required>
            </div>
            <div class="mb-3">
                <label for="Owneraddress" class="form-label">Employer Address</label>
                <input type="text" name="owneraddress" class="form-control" id="owneraddress"
                    placeholder="Enter Employer Address" required>
            </div>
            <hr>
            <!-- ---------------------------------------*************************------------------------------- -->

            <h5 class="text-center">Section B : Visitors Personal Details</h5>
            <div class="mb-3">
                <label for="username" class="form-label">First Name</label>
                <input type="text" name="fname" class="form-control" id="firstname" placeholder="Enter First Name"
                    required>
            </div>
            <div class="mb-3">
                <label for="MiddleName" class="form-label">Middle Name</label>
                <input type="text" name="mname" class="form-control" id="middlename" placeholder="Enter Middle Name"
                    maxlength="10" required>
            </div>
            <div class="mb-3">
                <label for="LastName" class="form-label">Last Name</label>
                <input type="text" name="lname" class="form-control" id="lastname" placeholder="Enter Last Name"
                    required>
            </div>
            <div class="mb-3">
                <label for="Mobile" class="form-label">Mobile Number</label>
                <input type="number" name="vmobile" class="form-control" id="mobile" pattern="\d*" maxlength="10"
                    minlength="10" placeholder="Enter Mobile Number" required>
            </div>
            <div class="mb-3">
                <label for="Nationality" class="form-label">Nationality</label>
                <select class="form-select" name="nationality" id="nationality">
                    <option value="India">India</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="Work" class="form-label">Work</label>
                <select class="form-select" name="work" id="work">
                    <option value="Fishing">Fishing</option>
                    <option value="Mango Farm">Hotel</option>
                    <option value="Mango Farm">Mango Farm</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="Visitor Caste" class="form-label">Visitor Caste</label>
                <input type="text" name="vcaste" class="form-control" id="vcaste" placeholder="Enter Visitor Caste"
                    required>
            </div>
            <div class="mb-3">
                <label for="Visitor Religion" class="form-label">Visitor Religion</label>
                <input type="text" name="vreligion" class="form-control" id="vreligion"
                    placeholder="Enter Visitor Religion" required>
            </div>
            <div class="mb-3">
                <label for="Permanent Address" class="form-label">Permanent Address</label>
                <textarea class="form-control" placeholder="Permanent Address" id="paddress" name="paddress"></textarea>
            </div>
            <div class="mb-3">
                <label for="Temporary Address" class="form-label">Temporary Address</label>
                <textarea class="form-control" placeholder="Temporary Address" id="taddress" name="taddress"></textarea>
            </div>
            <div class="mb-3">
                <label for="Date Of Birth" class="form-label">Date Of Birth</label>
                <input type="date" name="dob" class="form-control" id="dob" required>
            </div>
            <div class="mb-3">
                <label for="Visitor Religion" class="form-label">Visitor Age</label>
                <input type="number" name="age" class="form-control" id="age" placeholder="Enter Visitor Age" required>
            </div>
            <div class="mb-3">
                <label for="Nearest Police Station" class="form-label">Nearest Police Station</label>
                <select class="form-select" name="dept">
                    <?php
                    $query = "SELECT `dept_name` FROM `departments`";
                    $result = mysqli_query($link, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['dept_name'] . '" name="dept">' . $row['dept_name'] . '</option>';
                    }
                    ?>

                </select>
            </div>
            <div class="mb-3">
                <label for="workdetails" class="form-label">Last Work Details</label>
                <input type="text" name="workdetails" class="form-control" id="vreligion"
                    placeholder="Enter Last Work Details" required>
            </div>
            <div class="mb-3">
                <label for="Photo" class="form-label">Photo</label>
                <input type="file" name="photo" class="form-control" id="photo" required>
            </div>
            <hr>

            <!-- ---------------------------------------*************************------------------------------- -->
            <h5 class="text-center">Section C : Vistors Agent Details</h5>
            <div class="mb-3">
                <label for="Agent" class="form-label">Agent</label>
                <input type="text" name="agentname" class="form-control" id="agentname" placeholder="Enter Agent Name"
                    required>
            </div>
            <div class="mb-3">
                <label for="Agent Mobile Number" class="form-label">Agent Mobile Number</label>
                <input type="number" name="agentno" class="form-control" id="anumber" pattern="\d*" maxlength="10"
                    minlength="10" placeholder="Enter Agent Mobile Number" required>
            </div>
            <hr>
            <!-- ---------------------------------------*************************------------------------------- -->
            <h5 class="text-center">Section D : Other Vistors Details</h5>
            <div class="mb-3">
                <label for="agreement" class="form-label">Agreement</label>
                <input type="file" name="agreement" class="form-control" id="agreement">
            </div>
            <div class="mb-3">
                <label for="idcard" class="form-label">Id Card</label>
                <input type="file" name="idcarddoc" class="form-control" id="idcarddoc">
            </div>
            <div class="mb-3">
                <label for="idcard" class="form-label">ID Card Number</label>
                <input type="text" name="idcard" class="form-control" id="idcard" placeholder="ID Card Number" required>
            </div>
            <div class="d-grid gap-2">
                <button class="mb-4 btn btn-primary" name="submit" type="submit">Submit</button>
            </div>
        </form>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>