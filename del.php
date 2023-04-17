<?php
include "config.php";

if(isset($_REQUEST['id']) AND $user->level == 0){

	$idd = $_REQUEST['id'];
	$col = $_REQUEST['col'];
	$loc = $_REQUEST['loc'];
	$from = $_REQUEST['table'];

		$del_q = "DELETE FROM $from WHERE $col='$idd'";

	$db->query($del_q);
	header("Location: $loc");
}