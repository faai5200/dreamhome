<?php 
		include "config.php";
		$_SESSION['user'] = null;
		unset($_SESSION['user']);

		header("Location: index.php"); 

?>