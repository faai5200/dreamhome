<?php include"config.php";

checkLogin(0);

$table = "users";

$cols = array("username","full_name","email","phone");


include "listAjax.php";