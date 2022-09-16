<?php

	session_start();
	if(isset($_SESSION["operatorlogin"])){
		unset($_SESSION["operator"]);
	}
	if(session_destroy())
			header("location: index.php");
	


?>