<?php

$server = "localhost";
$user = "root";
$pass = "";
$dbName = "vms";

$link = mysqli_connect($server, $user, $pass, $dbName);

if (!$link) {
    die("Error" . mysqli_error());

}
function url(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER["REQUEST_URI"].'?').'/';
}

$baseUrl = url();
