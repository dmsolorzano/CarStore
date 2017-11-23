<head>
  <link rel="stylesheet" href="stylesheet.css">
</head>
<?php
 	require_once("signin.php");
    // collect value of input field
    $servername = "earth.cs.utep.edu";
    $username = "fgarciayala";
    $password = "cs5339!fgarciayala";
    $database = "fgarciayala";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	session_start();

    $username = filter_var($_POST['username']);
    $password_sess = filter_var(md5($_POST['password']."no you cant"));

    $result = mysqli_query($conn, "select * from users where name = '".$username."' and password = '".$password_sess."';");

   	sleep(1);
    if (mysqli_num_rows($result) > 0) {

   		$row = $result->fetch_assoc();
    	//echo "id:" . $row['email'];
    	$_SESSION['email'] = $row['email'];
    	$_SESSION['name'] = $row['name'];
    	$_SESSION['priviledge'] = $row['priviledge'];
		$conn->close();
		header("Location: welcome_screen.php");
    } else {
        $conn->close();
       	header("Location: not_found.php");
    }
?>