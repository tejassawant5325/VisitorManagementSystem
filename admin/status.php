<?php

include 'db_connect.php';
session_start();
if (isset($_GET['deptid'])) {
    $dept_id = $_GET['deptid'];
    $status = $_GET['status'];
    $sql = "UPDATE `departments` SET `status`= $status WHERE `dept_id` =  $dept_id";
    $res = mysqli_query($link, $sql);

    echo "<script LANGUAGE='JavaScript'>
    window.alert('Police Station Status Changed');
    window.location.href='viewdepartments.php';
    </script>";
}
