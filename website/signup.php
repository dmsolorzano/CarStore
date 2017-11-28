<?php 

session_start();
require('connect.php');

//Signup normal user
if (isset($_POST['reg_user'])) {
	$username 	= 	mysqli_real_escape_string($db, $_POST['username']);
	$firstname 	= 	mysqli_real_escape_string($db, $_POST['firstname']);
	$lastname 	= 	mysqli_real_escape_string($db, $_POST['lastname']);
	$email 		= 	mysqli_real_escape_string($db, $_POST['email']);
	//hashtype is declared in resources.php

	//setting up the current date
	$datecreated = date("D, F j, Y, g:i a");
	$lastaccess = $datecreated;
	$password1 = 	mysqli_real_escape_string($db, $_POST['password1']);
	$password2 = 	mysqli_real_escape_string($db, $_POST['password2']);

	
	if (empty($username)) { array_push($errors, "Username is required"); }
	if (empty($firstname)) { array_push($errors, "First name is required"); }
	if (empty($lastname)) { array_push($errors, "last name is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($datecreated)) { array_push($errors, "ERRORCODE = tm"); }
	if (empty($password1)) { array_push($errors, "Password is required"); }

	if ($password1 != $password2) {
		array_push($errors, "The two passwords do not match");
		$_SESSION['errormsg'] = "The two passwords entered do not match";

	}

	//check for username uniqueness
	$checkdupquery = "SELECT * FROM $table WHERE username = '$username'";
	$dups = mysqli_query($db, $checkdupquery);

	if(mysqli_num_rows($dups) > 0){
		array_push($errors, "That username is not available");
		$_SESSION['errormsg'] = "That username is not available";
	}

	if (count($errors) == 0) {

		//salt the password
		$password = $salt . $password1 . $username; 
		$password = md5($password);
		$query = "INSERT INTO $table (username, firstname, lastname, email, hashtype, datecreated, lastaccess, password, rights) 
				  VALUES('$username', '$firstname', '$lastname', '$email', '$hashtype', '$datecreated', '$lastaccess', '$password', 'user')";
		$outcome = mysqli_query($db, $query);
		if($outcome){
		$_SESSION['success'] = "Registration successful";
		}else{
			$_SESSION['errormsg'] = "An error occurred, couldn't register, retry later.";
		}
		header('location: signin.php');
	}

} 

echo ' 

<!DOCTYPE html>
<html>

<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

	<div class="header">

		<h2>User Sign Up</h2>

	</div>
';

 require_once('navigationMenu.php'); 

echo '
	
	<form method="post" action="userReg.php" >

	<div style="width:100%; text-align:center;"> <h2>New User Registration</h2> </div>

	<div class="fields" align="center">

		<div class="inputLine">
			<label>Username</label>
			<input type="text" name="username" value=""/>
		</div>

		<div class="inputLine">
			<label>First Name</label>
			<input type="text" name="firstname" value=""/>
		</div>

		<div class="inputLine">
			<label>Last Name</label>
			<input type="text" name="lastname" value=""/>
		</div>		

		<div class="inputLine">
			<label>Email</label>
			<input type="email" name="email" value=""/>
		</div>

		<div class="inputLine">
			<label>Password</label>
			<input type="password" name="password1"/>
		</div>

		<div class="inputLine">
			<label>Confirm password</label>
			<input type="password" name="password2"/>
		</div>

		<div class="inputLine">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>

	</div>

';	
	
		if(isset($_SESSION['errormsg']))
		echo "<div style=\"width:100%; text-align:center; color:red;\"> <h2> ". $_SESSION['errormsg'] ." </h2> </div>";
		unset($_SESSION['errormsg']);

		if(isset($_SESSION['success']))
		echo "<div style=\"width:100%; text-align:center; color:green;\"> <h2> ". $_SESSION['success'] ." </h2> </div>";
		unset($_SESSION['success']);
	
echo '	
	</form>
</body>
</html>
';