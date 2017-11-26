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
		<h2>display item blocks here</h2><br/>
';



echo "
	<div>
";

//first we must check how many results are there based onthe filters, to know page number.
//if one filter field is set all will be, they work as unit in the form.
$numResults = 0;
$where = "";
$order = "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){

	switch($_POST['ordering']){
		case "None":
			//do nothing
			break;
		case "Price: High to low":
			$order = "ORDER BY Price DESC";
			break;
		case "Price: Low to high":
			$order = "ORDER BY Price";
			break;
	}

	//prepare based on category.
	if(strcmp($_POST['category'], "All") != 0){//if a category selected
		$where = "WHERE Category='" . $_POST['category'] . "'";
	}//else do nothing

	$filtering = $where . $order;
}
                  
$query = "SELECT * FROM inventory $where $order";
$result = mysqli_query($db, $query);

if($result){
   	$numResults = $result->num_rows;
}

$maxItemsPerPage = 10;//later might give options to change this.
$numPages = ceil($numResults/$maxItemsPerPage);  

echo $numResults . " items found in category. <br/>";
echo "would require " . $numPages . " pages of " . $maxItemsPerPage . " results per page <br/>";

echo '
	</div>
</body>

<script></script>

</html>
';


?>
