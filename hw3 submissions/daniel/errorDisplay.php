<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ooops!</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Ooops!</h2>
	</div>

	<?php include('navigationMenu.php'); ?>

	<div class="content">
		
		<h2><?php echo $_SESSION['errormsg']; unset($_SESSION['errormsg']); ?></h2>
		<p>You dont have permission!!!</p>
		<img src="einsteinProblem.jpg"/>

	</div>

</body>
</html>