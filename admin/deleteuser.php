<?php
include '../db_connect.php';

session_start();

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $sql = "DELETE FROM `operators_login_info` WHERE `operator_id`= '$id'";
    $res = mysqli_query($link, $sql);
    if ($res) {
        
        header('location:viewoperators.php');

    }
}

// if (isset($_GET['deptid'])) {
//     $dept_id = $_GET['deptid'];
//     $sql = "DELETE FROM `departments` WHERE `dept_id` = $dept_id";
//     $res = mysqli_query($link, $sql);
//     if ($res) {
//         header('location:showdepartments.php');
//     }
// }
