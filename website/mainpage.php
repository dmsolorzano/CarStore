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


//RESULTSBLOCK
echo "<div class=\"resultsBlock\">";

echo "<ul class=\"resultRow\">";
		echo "<li>hello there</li>";
		echo "<li>mahalo</li>";
echo "</ul>";

echo "</div>";//RESULTSBLOCK



//PAGINATION

echo "<div class=\"paginationBlock\">";

echo "
<div class=\"pagination\">
  <a href=\"#\">&laquo;</a>
  <a href=\"#\">1</a>
  <a href=\"#\" class=\"active\">2</a>
  <a href=\"#\">3</a>
  <a href=\"#\">4</a>
  <a href=\"#\">5</a>
  <a href=\"#\">6</a>
  <a href=\"#\">&raquo;</a>
</div>
";

echo "</div>";//END PAGINATION

echo '
	</div>
</body>

<script>

function getPage(pageNum) {
  var xhttp;
  if (pageNum == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getcustomer.asp?q="+str, true);
  xhttp.send();
}

</script>

</html>
';


?>
