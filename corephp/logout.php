<?php
	session_start();

	//unset($_SESSION['user']);
	//unset($_SESSION['userid']);

	session_destroy();

	header("location:login.php");
?>