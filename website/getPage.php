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
			foreach ($row as $key => $value) {

				if(strcmp($key, "PartName") == 0)
					echo  "<strong>" . $value . "  </strong>";
				
				if(strcmp($key, "Price") == 0)
					echo "<p style=\"float:right;\">Price: " . $value . "</p>";

			}
			echo "<br/>";
			echo "</li>";
		}

	}

?>