<?php //include config
require_once('../includes/config.php');
include '../includes/connection.php';
//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Add User</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
</head>
<body>

<div id="wrapper">

	<?php include('menu.php');?>
	<p><a href="users.php">User Admin Index</a></p>

	<h2>Add User</h2>

	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		//extract($_POST);
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
                $passwordConfirm =trim($_POST['passwordConfirm']);
                $email     = trim($_POST['email']);
		//very basic validation
		if($username ==''){
			$error[] = 'Please enter the username.';
		}

		if($password ==''){
			$error[] = 'Please enter the password.';
		}

		if($passwordConfirm ==''){
			$error[] = 'Please confirm the password.';
		}

		if($password != $passwordConfirm){
			$error[] = 'Passwords do not match.';
		}

		if($email ==''){
			$error[] = 'Please enter the email address.';
		}
                
                
                $userverifysql = "SELECT * FROM blog_members WHERE username = '$username'";
                $result = mysqli_query($conn, $userverifysql);
                if( mysqli_num_rows($result)> 0 ) {
                        $error[] = "username already exist;";
                        
                } 
                 
                if(!isset($error)){

                    $hashedpassword = $user->password_hash($password, PASSWORD_BCRYPT);

                    //insert into database
                    $sql = "INSERT INTO blog_members (username,password,email) VALUES ('$username', '$hashedpassword', '$email')";
                    
                    mysqli_query($conn, $sql);

                    //redirect to index page
                    header('Location: users.php?action=added');
                    exit;			
		}
	}

	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
	?>

	<form action='' method='post'>

		<p><label>Username</label><br />
		<input type='text' name='username' value='<?php if(isset($error)){ echo $_POST['username'];}?>'></p>

		<p><label>Password</label><br />
		<input type='password' name='password' value='<?php if(isset($error)){ echo $_POST['password'];}?>'></p>

		<p><label>Confirm Password</label><br />
		<input type='password' name='passwordConfirm' value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>'></p>

		<p><label>Email</label><br />
		<input type='text' name='email' value='<?php if(isset($error)){ echo $_POST['email'];}?>'></p>
		
		<p><input type='submit' name='submit' value='Add User'></p>

	</form>

</div>
