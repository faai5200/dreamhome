<?php include "config.php";
if(inp("key")){
	$_SESSION['user'] = null;
	$user = null;
}

if(LoggedIn())
   		toHome();
 ?><?php 
	$m = '';
	$m_type = 'error';
	
	if(!empty(inp('m'))){
			$m = inp('m');
			$m_type = inp('m_type');
	}
	
	
	if(inp("login")){

		$query  = "SELECT * FROM users WHERE username='".inp('username')."' AND password = '".inp('password')."'";
			if($result = $db->query($query)){

				if($result->num_rows > 0){

							$_SESSION['user'] = $user = $result->fetch_object();
							toHome();
				} else {
			
						$m = "Username or Password are wrong.. Kindly try again.";
						$m_type = 'error';
						
					}
				}
		} 



		$change = false;
		
		if(inp("key")){
				$rkey = inp("key");
				
				$r = $db->query("SELECT * FROM users WHERE rkey = '$rkey'");
					if($r->num_rows > 0){
							$change = true;

						} else {
							header("Location:index.php?m_type=error&m=Reset Link is invalid");
						}
		}
		


		if(inp("reset_2")){

					$p = inp("password");
					$p2 = inp("password2");


					if($p != $p2){
								header("Location:index.php?key=$rkey&m_type=error&m=Password and confirm password should match");
								exit();
					} else {

						$db->query("UPDATE users SET password = '$p', rkey='' WHERE rkey = '$rkey'");
						header("Location:index.php?m_type=success&m=Password Update Sucessfully");
						exit();
					}
		}

		if(inp("reset")){

				$username = inp('username');

				if(!empty($username)){

						$u = $db->query("SELECT * FROM users WHERE username = '$username'");

						if($u->num_rows > 0){

									$us  = $u->fetch_object();

									$subject = "Reset Password - " . $site->title;
									$to = $us->email;
									$body = "Dear $us->full_name,<br/><br/>You have requested to reset your password, Please click the following link to reset your password.\n\n";

									$key = generateRandomString(20);

									$db->query("UPDATE users SET rkey = '$key' WHERE username= '$username'");

									$link = $site->url . '?key=' . $key;

									$body .= "<a href='$link'>$link</a> <br/><br/>Kind Regards<br/><strong>$site->title Team</strong>";

									sendEmail($to,$subject,$body);

									$m = "Password reset link is sent to your registered email, please check your email for further instructions.";
									$m_type = 'success';


						} else {
							$m = "Username not found";
							$m_type = 'error';
						}


				} else {
					$m = "Username should not be empty";
					$m_type = 'error';
				}





		}

		
		
		
		?><!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
			<title><?php echo $site->title;?></title>
			<link rel="stylesheet" href="bootstrap/css/login.css">
			<?php echo ($change) ? "<style> .form .login-form{ display:none } .form .register-form{ display:block }</style>": '' ; ?>
		</head>
		<body>

	<div class="login-page">
  <div class="form">
      <h1 style=" font-family: sans-serif; "><strong style=" font-weight: 1000; ">DREAM</strong>HOME</h1>
	
	<?php if(!empty($m)){
			echo "<p id='error_message' class='$m_type'>$m</p>";
	}
	?>



    <form class="register-form" method="POST">
			<input type="hidden" name="reset" value="login">
      <input type="text" placeholder="username" name="username"/>
      <button>reset password</button>
      <p class="message forgot">Have Password Already? <a href="#">Sign In</a></p>
    </form>


	<?php if($change){?>
    <form class="register-form" method="POST">
			<input type="hidden" name="reset_2" value="login">
			<input type="hidden" name="key" value="<?php echo $rkey; ?>">
			<input type="password" placeholder="password" name="password"/>
			<input type="password" placeholder="confirm password" name="password2"/>

      <button>update password</button>
      <p class="message forgot">Have Password Already? <a href="#">Sign In</a></p>
    </form>
	<?php } ?>










    <form class="login-form" method="POST">
			<input type="hidden" name="login" value="login">
      <input type="text" placeholder="username" name="username"/>
      <input type="password" placeholder="password" name="password"/>
      <button>login</button>

			<p class="message forgot">Forgot Password? <a href="#">Reset your password</a></p>
			<p class="message">Dont have an account? <a href="signup.php">Signup Now!</a></p>

    </form>
  </div>
</div>
			

			<script src="bootstrap/js/jquery.js"></script>
			
			<script>
			$('.forgot a').click(function(event){
					event.preventDefault();
 		  $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
				});
			</script>

		</body>
		</html>



 <?php include 'footer.php'; 
 ob_end_flush();?>
