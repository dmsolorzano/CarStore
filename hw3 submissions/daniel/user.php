<?php 
session_start();
require('connect.php');

	//only users and admins can see this page
	if (!isset($_SESSION['regUsername']) && !isset($_SESSION['adminUsername'])) {
		$_SESSION['errormsg'] = "You must be logged in to view this content";
		header('location: signin.php');
	}


	if (isset($_POST['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		unset($_SESSION['adminUsername']);
		$_SESSION['errormsg'] = "You Signed out";
		header("location: signin.php");
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Users Area</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="header">
			<h2>Users Area</h2>
		</div>

		<?php include('navigationMenu.php') ?>

		<div class="content">
			<?php include('userInfo.php') ?>
		</div>

		<div class="content">
			<h2>  You're in the users area!!!</h2>
		</div>

	</body>
</html>