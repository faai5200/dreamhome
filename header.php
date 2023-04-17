<?php include"config.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title><?php echo $site->title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/font-awesome.css" rel="stylesheet">

		
		<link rel="stylesheet" href="bootstrap/css/bootstrap-table.css">
    <link rel="stylesheet" href="bootstrap/css/jquery-ui.min.css">
    <link href="bootstrap/css/bootstrap-datetimepicker.css" rel="stylesheet" />


<style>

@media print {
  body * {
    visibility: visible;
  }
  .section-to-print, .section-to-print * {
    visibility: visible;
  }
  .section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }

  .section-not-to-print, .section-not-to-print * {
    visibility: hidden;
  }
  .section-not-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>

  </head>

  <body>

<?php if(Loggedin()){ ?>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a style="padding-top:5px" class="navbar-brand" href="index.php">
              <h1 style="font-family: sans-serif;margin-bottom: 0;margin: 0;"><strong style=" font-weight: 1000; ">DREAM</strong>HOME</h1>
          </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">


            <ul class="nav navbar-nav navbar-right">

                <?php if($isAdmin || $isStaff){?>
                    <li><a href="properties.php">Property Management</a></li>
                <?php } ?>

                <?php if($isAdmin){?>
                    <li><a href="users.php">User Management</a></li>
                <?php } ?>



                <li><a href="view_properties.php">View Properties</a></li>


              <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Hello <?php echo $user->full_name;?>! <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li><a href="profile.php">Update Profile</a></li>
        <li><a href="logout.php">Logout</a></li>

    </ul>
</li>
          </ul>



        </div><!--/.nav-collapse -->
      </div>
    </nav>

<?php  } ?> 

    <div class="container" style="margin-top: 70px;">

      <div class="starter-template">
       