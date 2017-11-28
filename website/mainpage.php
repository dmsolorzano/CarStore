<?php

//session used both for shopping cart and for members.
session_start();

//require database access.
require_once("connect.php");

if(!isset($_SESSION['currentPage'])){
	$_SESSION['currentPage'] = 1;
}

$currentPage = $_SESSION['currentPage'];


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
                  
$query = "SELECT * FROM $parts $where $order";

$_SESSION['query'] = $query;

$result = mysqli_query($db, $query);

if($result){
   	$numResults = $result->num_rows;
}

$maxItemsPerPage = 10;//later might give options to change this.
$totalPages = ceil($numResults/$maxItemsPerPage);  

//echo $query;

//initialize the header of the html.
echo "
<!DOCTYPE html>
<html>
<head>
	<title>CarStore</title>
	<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
</head>
<body onload=\"drawPagination($currentPage , $totalPages,  $maxItemsPerPage);\">  ";

//the body starts here.

echo '
	<div class="header">
		<h2>CarStore</h2>
	</div>
';

//display the dynamic navigation bar.
require_once('navigationMenu.php');

echo "
	<div class=\"content\">	
		<h2>";

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if((strcmp($_POST['category'], "All") == 0)){
				echo "Category: All, ";
			}else{
				echo "Category: " . $_POST['category'] . ", ";
			}

			if(!(strcmp($_POST['ordering'], "") == 0))
				echo "Ordering: " . $_POST['ordering'];
		}else{
			echo "Displaying All";
		}

echo "</h2><br/>
";

//RESULTSBLOCK START
echo "<div class=\"resultsBlock\">";

echo "<ul class=\"resultRow\" id=\"itemsList\">";

	//ITEMS ROWS DISPLAYED BY JAVASCRIPT HERE.	
	
echo "</ul>";

echo "</div>";
//RESULTSBLOCK END


//PAGINATION START
echo "<div class=\"paginationBlock\" id=\"paginationBlock\">";

	//PAGINATION BAR DISPLAYED BY JAVASCRIPT HERE.

echo "</div>";
//PAGINATION END


echo "
	</div>
</body>

<script>

function getPage(destination, totalPages, maxItemsPerPage) {
  var xhttp;
  if ((destination > totalPages) || (destination < 1)) {
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById(\"itemsList\").innerHTML = this.responseText;
    }
  };

  xhttp.open(\"GET\", \"getPage.php?destination=\" + destination + \"&totalPages=\" + totalPages + \"&maxItemsPerPage=\" + maxItemsPerPage, true);
  xhttp.send();
}


function drawPagination(currentPage, totalPages, maxItemsPerPage) {
  var xhttp;
  if ((currentPage > totalPages) || (currentPage < 1)) {
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById(\"paginationBlock\").innerHTML = this.responseText;
    }
  };

  getPage(currentPage, totalPages, maxItemsPerPage);

  xhttp.open(\"GET\", \"drawPagination.php?currentPage=\" + currentPage + \"&totalPages=\" + totalPages + \"&maxItemsPerPage=\" + maxItemsPerPage, true);
  xhttp.send();
}
";

echo "
</script>

</html>
";

?>
