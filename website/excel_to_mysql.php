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
            $sql = "insert into parts(partName, partNumber, suppliers, description01, description02, description03, description04, description05, description06, price, estimatedShippingcost, associatedImageFilename1, associatedImageFilename2, associatedImageFilename3, associatedImageFilename4, notes, shippingWeight) values ('".(string)addslashes($arr[0])."', '". (string)addslashes($arr[1]). "', '" . (string)addslashes($arr[2]) . "', '". (string)addslashes($arr[3]) . "', '". (string)addslashes($arr[4]). "', '" . (string)addslashes($arr[5]). "', '" . (string)addslashes($arr[7]). "', '". (string)addslashes($arr[8]). "', ". (float)$arr[9]. ", ". (float)$arr[10]. ", '". (string)addslashes($arr[11]). "', '". (string)addslashes($arr[12]). "', '". (string)addslashes($arr[13]). "', '". (string)addslashes($arr[14]). "', '". (string)addslashes($arr[15]). "', '". (string)addslashes($arr[16]). "', ". (int)$arr[17]. ");";
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
