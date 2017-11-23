<?php 
		require('connect.php');
		//var_dump($_POST);
		if(isset($_POST['listUsers'])){
			$query = "SELECT * FROM $table WHERE rights='user'";
			$results = mysqli_query($db, $query);
			if($results){
				while($row = $results->fetch_assoc()){
					foreach($row as $key=>$value){
						if($key != 'password')
						echo $key . " = " . $value ."<br/>";
					}
					echo "______________________________ <br/>";
				}
			}
		}

?>