<?php

	session_start();
	if(isset($_SESSION["adminlogin"])){
		unset($_SESSION["admin"]);
	}
	if(session_destroy())
			header("location: index.php");
	


?>