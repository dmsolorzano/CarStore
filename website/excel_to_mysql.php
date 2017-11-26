<?php

$servername = "earth.cs.utep.edu";
$username = "fgarciayala";
$password = "cs5339!fgarciayala";
$database = "fgarciayala";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection

try{
    // 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $row = 1;
    if (($handle = fopen("Allparts.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $arr = array();
            $num = count($data);
            //echo "<p> $num fields in line $row: <br /></p>\n";
            $row++;
            for ($c=0; $c < $num; $c++) {
                array_push($arr, $data[$c]);
                echo $data[$c] . "<br />\n";
            }
            echo sizeof($arr);
            $sql = "insert into parts(partName, partNumber, suppliers, description01, description02, description03, description04, description05, description06, price, estimatedShippingcost, associatedImageFilename1, associatedImageFilename2, associatedImageFilename3, associatedImageFilename4, notes, shippingWeight) values ("."'".(string)$arr[0]."', '". (string)$arr[1]. "', '" . (string)$arr[2] . "', '". (string)$arr[3] . "', '". (string)$arr[4]. "', '" . (string)$arr[5]. "', '" . (string)$arr[7]. "', '". (string)$arr[8]. "', ". (float)$arr[9]. ", ". (float)$arr[10]. ", '". (string)$arr[11]. "', '". (string)$arr[12]. "', '". (string)$arr[13]. "', '". (string)$arr[14]. "', '". (string)$arr[15]. "', '". (string)$arr[16]. "', ". (int)$arr[17]. ");";
                //$sql = addslashes($sql);
                $result = mysqli_query($conn, $sql);
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    $conn->close();
                }

            echo "<hr/>";
        }
        fclose($handle);
    }

}catch(Exception $e){
    echo "sorry!:(";
}

?>