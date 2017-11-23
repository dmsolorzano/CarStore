<head>
  <link rel="stylesheet" href="stylesheet.css">
</head>
<div class = "navbar">
we will never let you down.<a href = "welcome_screen.php">go back.</a>
</div>
<div class = "center">
<form method = 'post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

email: <input type = 'text' name = 'email' required></br>
name: <input type = 'text' name = 'name' required></br>
password: <input type = 'password' name = 'password' required></br>
<input type="radio" name="priviledge" <?php if (isset($priviledge) && $priviledge=="admin") echo "checked";?> value="admin">admin
<input type="radio" name="priviledge" <?php if (isset($priviledge) && $priviledge=="user") echo "checked";?> value="user">user</br>
<input type = 'submit'>
</form>
</div>
<?php
session_start();
unset($_SESSION);
session_destroy();

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

if(isset($_POST['name']) AND isset($_POST['password'])){
	sleep(1);

	$username = filter_var($_POST['name']);
	$u_password = filter_var(md5($_POST['password']."no you cant"));
	$email = filter_var($_POST['email']);
	$priviledge = $_POST['priviledge'];
	$result = mysqli_query($conn, "select * from users where username = '".$username."';");
	if (mysqli_num_rows($result) > 0) {

		$conn->close();
		echo "this username is already in use. try another one";
		
	}else{
		sleep(1);
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$sql = "INSERT INTO users (name, password, email, priviledge) VALUES ('". $username. "','". $u_password."','". $email."', '". $priviledge. "');";

			if ($conn->query($sql) === FALSE) {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$_SESSION['name'] = $username;

			$_SESSION['password'] = $password;

			$conn->close();
			header("Location: signin.php");
		}else{
			echo "enter a valid email address.";
		}
	}
}
?>