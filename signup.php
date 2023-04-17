<?php include "config.php";


if(LoggedIn())
    toHome();
$m = '';
$m_type = 'error';

if(!empty(inp('m'))){
    $m = inp('m');
    $m_type = inp('m_type');
}

if(inp("login")){
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];


    $q = "SELECT * FROM users WHERE username='$username'";
    $res = $db->query($q);
    if($res->num_rows){
        $m = "Account with the same username already exists.";
        $m_type = 'error';

        header("Location: signup.php?m=$m&m_type=$m_type");
        die();
    }

    $q = "SELECT * FROM users WHERE email='$email'";
    $res = $db->query($q);
    if($res->num_rows){
        $m = "Account with the same Email already exists.";
        $m_type = 'error';
        header("Location: signup.php?m=$m&m_type=$m_type");
        die();
    }

    $q = "INSERT INTO users (full_name, username, password, phone, email, address, level) VALUES ('$full_name','$username','$password','$phone','$email','$address', '2')";
    if($db->query($q)){
        $m = "Account created successfully. Please login to view properties.";
        $m_type = 'success';
       header("Location: index.php?m=$m&m_type=$m_type");
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

</head>
<body>

<div class="login-page">
    <div class="form">
        <h1 style="font-family: sans-serif;margin-bottom: 0;"><strong style=" font-weight: 1000; ">DREAM</strong>HOME</h1>

        <?php if(!empty($m)){
            echo "<p id='error_message' class='$m_type'>$m</p>";
        }
        ?>
        <h3 style="font-family: sans-serif;margin: 0;margin-bottom: 15px;">Signup</h3>

        <form class="login-form" method="POST">
            <input type="hidden" name="login" value="login">
            <input type="text" required placeholder="Full Name" name="full_name"/>
            <input type="text" required placeholder="Username" name="username"/>
            <input type="password" required placeholder="Password" name="password"/>
            <input type="text" required placeholder="Phone Number" name="phone"/>
            <input type="email" required placeholder="Email Address" name="email"/>
            <input type="text" placeholder="Address" name="address"/>
            <button>Signup Now</button>


            <p class="message">Already have an account? <a href="index.php">Login!</a></p>

        </form>
    </div>
</div>


<script src="bootstrap/js/jquery.js"></script>


</body>
</html>



<?php include 'footer.php';
ob_end_flush();?>
