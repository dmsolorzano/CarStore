<?php

	if (!isset($_SESSION['regUsername']) && !isset($_SESSION['adminUsername'])) {
		$_SESSION['errormsg'] = "You must be logged in to view this content";
		header('location: signin.php');
	}

	//briefly ask for the user info
	if(isset($_SESSION['regUsername']))
		$username = $_SESSION['regUsername'];
	if(isset($_SESSION['adminUsername']))
		$username = $_SESSION['adminUsername'];
	$pass = $_SESSION['password'];
	$query = "SELECT * FROM $table WHERE username='$username' AND password='$pass'";
	

	$results = mysqli_query($db, $query);

	if($results){
		$row = $results->fetch_assoc();
		foreach($row as $key=>$value){
			if($key != 'password')
			echo $key . " = " . $value ."<br/>";
		}
	}
?>