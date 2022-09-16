<?php
include 'db_connect.php';
session_start();

$date = date("Y/m/d");
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $status = $_GET['status'];
    $sql = "UPDATE `info_visitor` SET `Status`= $status WHERE `Serial` =  $id";
    $res = mysqli_query($link, $sql);
    if ($res) {
        $sql = "UPDATE `info_visitor` SET `application_approved` = '$date' WHERE `Serial` =  $id";
        $res = mysqli_query($link, $sql);
        echo "<script LANGUAGE='JavaScript'>
      window.alert('Visitor Accepted');
      window.location.href='viewdata.php';
      </script>";
    }
}
