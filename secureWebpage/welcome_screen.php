<head>
  <link rel="stylesheet" href="stylesheet.css">
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<script type="text/javascript">
	function post_comment(){
	var comment = document.getElementById("comment").value;
	var author = document.getElementById("username").innerHTML;
	//alert(author);
	var list = document.getElementById('feed');
	var entry = document.createElement('li');
	entry.appendChild(document.createTextNode(author + " says: " + comment));
	list.appendChild(entry);
	document.getElementById("comment").value = "";
	document.getElementById("comment").focus();
}

	function test_php(){
		$.ajax({
	    url:"example.php",
	    dataType: "json",
	    success:function(data){
	       var obj = jQuery.parseJSON(data);
	       alert(obj.cenas);
	    }
	});

	}

</script>

<?php
	//require_once("check_user.php");

$logo = <<<EOD
<title>Home | Dashboard</title>
<div class = "navbar">
NHS
EOD;

$start = <<<EOD

<select class = "list1" name="forma" onchange="location = this.options[this.selectedIndex].value;">
	<option value="" selected disabled hidden>options</option>
	<option value = "logout.php">logout</option>
	<option value = "change_name.php"> change name</option>
</select>

EOD;

$admin_panel = <<<EOD
<a href = 'create_account.php'>add user</a>
</div>
<form action = "" method = "post">
<input type = "submit" name = "show_users" value = "show users">
</form>

EOD;

$n = <<<EOD

<div class = "center">
<h2>welcome 
EOD;


$next = <<<EOD
 , to your session of the not hackable web site.</h2>
 <span class = "picture">
<h2> here's a nice picture for you.</h2></br>
  <img src = bulldog.jpg>
  </span>
EOD;

session_start();
$page = "";
if(!empty($_SESSION)){

	$page .= $logo;
	$page .= $start;
	if(strcmp("admin", $_SESSION['priviledge']) === 0)
		$page .= $admin_panel;
	$page .= $n;
	$page .= "<span id = 'username'>";
	$page .= $_SESSION['name'];
	$page .=  "</span>";
	$page .= $next;
	echo $page;
}else{
	header("Location: not_found.php");
}

if(isset($_POST['show_users'])){
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

	$sql = "SELECT id, name, email FROM users;";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    echo "<table><tr><th>ID</th><th>Name</th></tr>";
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]." ".$row["email"]."</td></tr>";
	    }
	    echo "</table>";
	} else {
	    echo "0 results";
	}
	$conn->close();
}
?>