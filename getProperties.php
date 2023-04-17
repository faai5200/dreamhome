<?php include"config.php";

checkLogin(0);

$table = "properties";

$cols = array("title","rooms","rent","date_created");

$q = "SELECT properties.*, users.full_name  as owner_name, count(DISTINCT(property_view.user_id)) as p_views FROM properties JOIN users ON properties.owner_id = users.id
     LEFT JOIN property_view ON property_view.property_id = properties.id  ";

if(@$user->level == 1){
    $w = $where = " properties.owner_id = '".$_SESSION['user']->id."'";
}
$final = "  GROUP BY properties.id ";
include "listAjax.php";