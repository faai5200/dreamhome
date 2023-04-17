<?php include"config.php";

checkLogin(0);

$table = "properties";

$cols = array("title","rooms","rent","date_created");

$q = "SELECT properties.*, users.full_name  as owner_name FROM properties JOIN users ON properties.owner_id = users.id
     ";


$final = "  GROUP BY properties.id ";
include "listAjax.php";