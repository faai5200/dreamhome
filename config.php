<?php
session_start();
ob_start();

$site = (object) array();
$site->title = "Project Title";
$site->url = "http://localhost/dreamhome/";

$site->multi_users = true;

$levels = array(0 => "Admin",1=>"Staff", 2=>"client");

$redirects = array(0 => "profile.php",1=>"profile.php",2=>"profile.php");

$site->enable_forgot = true;


$menu = array(
            array('item.php', 'Item', 0),
            array('item.php', 'Item', 0),
            array('item.php', 'Item', 0)
);


$site->email  = 'no-reply@test.website' ;

$list_view = false;

include 'db.php';
include "functions.php";
