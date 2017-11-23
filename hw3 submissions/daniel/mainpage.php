<?php 
session_start();
require('connect.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Main Page</h2>
	</div>

	<?php include('navigationMenu.php'); ?>

	<div class="content">
		
		<h2>Content:</h2><br/>
		<?php include('loremipsum.php'); ?>

	</div>

</body>
</html>