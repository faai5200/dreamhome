<?php 

$user = @(object) $_SESSION['user'];

//$admin = @(object) $_SESSION['a_user'];

$isAdmin = false;
$isStaff = false;
$isClient = false;

if(@$user->level == 0){
    $isAdmin = true;
}
if(@$user->level == 1){
    $isStaff = true;
}
if(@$user->level == 2){
    $isClient = true;
}



function Loggedin(){
	return (isset($_SESSION['user']) AND !empty($_SESSION['user']));
}

function checkAdmin(){
	if(!Loggedin('a_user')){
		header("Location: index.php");
	}
}

function toHome(){
	GLOBAL $user,$redirects;
	header("Location: " . $redirects[$user->level]);
}

function isLevel($level){
		GLOBAL $user;
		if($user->level == $level)
			return true;
		else
			return false;
}



function checkLogin($level = false,$up = false){
	GLOBAL $user;
	if(!Loggedin()){
		header("Location: index.php");
    }
    else if($level){

		if($up){
			if($user->level > $level )
				header("Location: index.php");
		} else 
			if($user->level != $level )
            		header("Location: index.php");
    }
	
}


function inp($n){
    GLOBAL $db;
	if(isset($_REQUEST[$n]))
		return $db->real_escape_string($_REQUEST[$n]);
	else 
		return false;
}

function post($key){
	return inp($key);
}

function sendEmail($to,$subject,$body){

	GLOBAL $site;


	// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$site->title .'<'.$site->email.">\r\n".
    'Reply-To: '.$site->email."\r\n" .
	'X-Mailer: PHP/' . phpversion();
	

	mail($to,$subject,$body,$headers);
}

function saveImage($dir = 'img/', $name = 'file'){
					$cv = $_FILES[$name];
	
					$allowedExts = array("jpg", "png", "jpeg");
	                $jaksd = explode(".", $cv["name"]);
					$extension = end($jaksd);
	
					$file_name =  "img_" . time()."_".(rand() * 100000) .".".$extension ;
	
					$type = $cv['type'];
	
					$file_ok = false;
	
		if (($type == "image/jpg") || ($type == "image/jpeg") || ($type == "image/png") && ($cv["size"] < 20000000) && in_array($extension, $allowedExts))
		{
		  if ($cv["error"] > 0)
		  { 
					$file_ok = false;
		  }
		  else
		  {
					
			if( move_uploaded_file($cv['tmp_name'],$dir.$file_name)){
					$file_ok = true;
			} else {
				 $file_ok = false;
			}
		   
		  }
	  } else {
		  $file_ok = false;
	  }

	  if($file_ok)
		  return $file_name;
	else
	  	return $file_ok;
}

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


function multiple_image($product_id)
{

	GLOBAL $db;

if(count($_FILES['attachment']['name']) > 0){
    		
		// File Error Checking 
		foreach($_FILES['attachment']['error'] as $error) {
			if($error)
				die( "Error: ".$error); 		
		}
		
		$Kv = 0;
		$uploads_dir = "uploads/";
		foreach($_FILES['attachment']['name'] as $filename) {
			
			$extension = end(explode(".", $filename));
			$file_name =  "gallary_" . time()."_".(rand() * 100000) .".".$extension ;
			move_uploaded_file($_FILES["attachment"]["tmp_name"][$Kv], "uploads/$file_name"); 
			mysqli_query($db, "INSERT INTO  gallery (product_id,images) values ( $product_id,'".$file_name."')  " );			
				$Kv++;
			}					
		} 

} 


function printDate($date = false,$time=false){
	if(!$date)
		$date = date("Y-m-d H:i:s");
	if($time)
			$format = "h:i A d M Y";
	else 
			$format = "d M Y";
	return date('d M Y',strtotime($date));
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}