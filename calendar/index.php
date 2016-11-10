<?php
	session_start();
	if($_SESSION['isLogin'] != true)
	{
		header("location: ../index.php");
		exit;
	}

	header("location: calendar.php");
	exit;
?>