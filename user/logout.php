<?php

session_start();
if (isset($_SESSION["userlogin"])) {
    unset($_SESSION["user"]);
}
if (session_destroy()) {
    header("location: index.php");
}
