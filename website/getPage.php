<?php 

	require_once('connect.php');

	session_start();

	$destination = $_GET['destination'];
	$totalPages = $_GET['totalPages'];
	$maxItemsPerPage = $_GET['maxItemsPerPage'];
	$query = $_SESSION['query'];

	$queryPage = $query . " " . "LIMIT " . (($destination*$maxItemsPerPage) - $maxItemsPerPage) . ", " . $maxItemsPerPage;

	$result = mysqli_query($db, $queryPage);

	if($result){

		while($row = $result->fetch_assoc()){
			echo "<li>";

			echo '<img src="http://localhost:8080/CarStore/website/partimages/' . $row['Associated_image_filename1'] . '"/>';
			echo $row['PartName'] . $row['Price'];

			echo "<br/>";
			echo "</li>";
		}

	}

?>