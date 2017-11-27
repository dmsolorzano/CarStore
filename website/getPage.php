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

			echo '<img src="partimages/' . $row['associatedImageFilename1'] . '"/>';
			echo $row['partName'] . $row['price'];

			echo "<br/>";
			echo "</li>";
		}

	}

?>