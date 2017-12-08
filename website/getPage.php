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
			echo $row['partName'] ."<br>" . "<strong>" . $row['price'] . "</strong>";
			
			echo "
				<form method='post' action='checkout.php'>
					<input type=\"hidden\" name=\"part\" value=\"$row[partID]\">
					<input type='submit' value='Checkout'>

				</form>
				";

			echo "<br/>";
			echo "</li>";
		}

	}

?>