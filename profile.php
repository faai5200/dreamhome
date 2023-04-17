<?php include "header.php" ;
checkLogin();


$action = "profile.php";
  $user_ii = $user->id;
   $email_up = false;
  if($isAdmin AND isset($_REQUEST['editid'])){

 $email_up = false;

    $action = "profile.php?editid=".$_REQUEST['editid'];
    $user_ii = inp('editid');
  }

?>

<div class="col-md-10 col-md-offset-1">


<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Profile</h3>
  </div>
  <div class="panel-body">

<?php

if(inp("email")){

	$sq = "UPDATE users SET full_name = '".inp('full_name')."', email = '".inp('email')."', phone = '".inp('phone')."', address = '".inp('address')."' ";

	if(!empty(inp("password")))
	{

		if($_REQUEST['password'] == $_REQUEST['c_password']){

			$sq .= ", password = '".inp('password')."'";

		} else { ?>
			<div class="alert alert-danger">
				
				<strong>Error !</strong> Password Not Updated.
			</div>
		 <?php
          }
	}


	$sq .= " WHERE id = '".$user_ii."'";

	if($db->query($sq)){

        $_SESSION['user'] = $db->query("SELECT * FROM users WHERE id='".$user->id."'")->fetch_object();

        echo '<div class="alert alert-dismissible alert-success">
  		<button type="button" class="close" data-dismiss="alert">&times;</button>
  		<strong>Success! </strong> Profile Updated succesfully.</div>';

    } else {
        echo '<div class="alert alert-dismissible alert-danger">
  		<button type="button" class="close" data-dismiss="alert">&times;</button>
  		<strong>Error! </strong> Profile Not Updated.</div>';
    }

}


$user_i = $db->query("SELECT * FROM users WHERE id = '".$user_ii."' LIMIT 1")->fetch_object();

 ?>


 
<form action="<?php echo $action; ?>" method="POST" class="form-horizontal section-not-to-print" role="form">
		
	<div class="form-group">
      <label class="control-label col-sm-2" for="username">
      Username
      </label>
      <div class="col-sm-10">
       <input class="form-control" id="username" name="username" type="text" value="<?php echo $user_i->username; ?>" disabled/>
       
      
      </div>
     </div>

     <div class="form-group">
      <label class="control-label col-sm-2" for="full_name">
      Full Name
      </label>
      <div class="col-sm-10">
       <input class="form-control" id="full_name" name="full_name" value="<?php echo $user_i->full_name; ?>" type="text" />
       
       
      </div>
     </div>
      
      <div class="form-group">
      <label class="control-label col-sm-2" for="email">
      Email
      </label>
      <div class="col-sm-10">
       <input class="form-control" id="email" name="email" type="email" value="<?php echo $user_i->email; ?>" required/>
       
       
      </div>
     </div>


     <div class="form-group">
      <label class="control-label col-sm-2" for="phone">
      Phone
      </label>
      <div class="col-sm-10">
       <input class="form-control" id="phone" name="phone" value="<?php echo $user_i->phone; ?>" type="text" />
       
       
      </div>
     </div>

      <div class="form-group">
      <label class="control-label col-sm-2" for="address">
      Address
      </label>
      <div class="col-sm-10">
       <textarea class="form-control" id="address" name="address"><?php echo $user_i->address; ?></textarea>
       
      </div>
     </div>

     <legend>Change Password (no change if empty)</legend>
	<div class="form-group">
      <label class="control-label col-sm-2" for="password">
      New Password
      </label>
      <div class="col-sm-10">
       <input class="form-control" id="password" name="password" type="password" />
       
    
      </div>
     </div>

     <div class="form-group">
      <label class="control-label col-sm-2" for="c_password">
      Confirm New Password
      </label>
      <div class="col-sm-10">
       <input class="form-control" id="c_password" name="c_password" type="password" />
       
       
      </div>
     </div>

		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				<button type="submit" class="btn btn-primary">Update Profile</button>
			</div>
		</div>
</form>

</div>
<?php include "footer.php"; ?>