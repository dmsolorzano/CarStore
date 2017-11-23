<?php 
session_start();
require('connect.php');

// Login Normal and Admin Users
if (isset($_POST['login_user'])) {
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	//salt + pasword + username
	$password = $salt . $password . $username;

	if (count($errors) == 0) {
		$accessdate = date("D, F j, Y, g:i a");
		$password = md5($password);
		$query = "SELECT * FROM $table WHERE username='$username' AND password='$password'";
		$updatequery = "UPDATE $table SET lastaccess = '$accessdate' WHERE username = '$username'";
		$results = mysqli_query($db, $query);

		if ((mysqli_num_rows($results) > 0)) {
			//update timeaccess
			$update = mysqli_query($db, $updatequery);
			$isAdmin = false;
			while($row = $results->fetch_assoc()){
				if(strcmp($row['rights'], 'admin') == 0){
					$isAdmin = true;
				}
			}

			if(!$isAdmin){
				$_SESSION['regUsername'] = $username;
				$_SESSION['password'] = $password;
				$_SESSION['success'] = "You are now logged in as a user";
				header('location: user.php');
			}else{
				$_SESSION['adminUsername'] = $username;
				$_SESSION['password'] = $password;
				$_SESSION['success'] = "You are now logged in as an administrator";
				header('location: admin.php');
			}
		}else {
			$_SESSION['errormsg'] = "Wrong username or password";
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign in</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Sign In</h2>
	</div>

	<?php require('navigationMenu.php') ?>
	
	<form method="post" action="signin.php">

	<div style="width:100%; text-align:center;"> <h2>Existing Users/Admins</h2> </div>

	<div class="fields" align="center">

		<div class="inputLine">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="inputLine">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="inputLine">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
	</div>
	<?php

		//session_start();

		if(isset($_SESSION['errormsg']))
		echo "<div style=\"width:100%; text-align:center; color:red;\"> <h2> ". $_SESSION['errormsg'] ." </h2> </div>";
		unset($_SESSION['errormsg']);

		if(isset($_SESSION['success']))
		echo "<div style=\"width:100%; text-align:center; color:green;\"> <h2> ". $_SESSION['success'] ." </h2> </div>";
		unset($_SESSION['success']);
	
	?>
	</form>

</body>
</html>