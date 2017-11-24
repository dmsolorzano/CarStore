<?php

//session used both for shopping cart and for members.
session_start();

//require database access.
require_once("connect.php");

//initialize the header of the html.
echo '
<!DOCTYPE html>
<html>
<head>
	<title>CarStore</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
';

//the body starts here.

echo '
	<div class="header">
		<h2>CarStore</h2>
	</div>
';

//display the dynamic navigation bar.
require_once('navigationMenu.php');

echo '
	<div class="content">	
		<h2>Content:</h2><br/>
';


echo '
	</div>
</body>
</html>
';


?>
