<head>
  <link rel="stylesheet" href="styles.css">
</head>
<?php
session_start();
	echo "sorry we couln't find you.</br>";
	echo "please re-enter your credentials.</br>";
	echo "<a href = 'signin.php'>try again.</a>";
	echo $_SESSION['name'];
	echo $_SESSION['password'];
?>