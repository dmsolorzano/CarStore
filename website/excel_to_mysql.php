<?php

//create the table using darren's script

$servername = "earth.cs.utep.edu";
$username = "fgarciayala";
$password = "cs5339!fgarciayala";
$database = "fgarciayala";

/*
$servername = 'localhost:3306';
$username = 'root';
$password = '';
$database = 'carstore';
*/


// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection

try{
    // 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $row=1;
    if (($handle = fopen("spreadsheets/Allparts.csv", "r")) !== FALSE) {
        
        while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
            
           
            /*
            print_r($data);
            echo "<br/>";
            echo "<hr/>";
            */
            
            if($row > 1){
            $arr = $data;//array();
            $num = count($data);
            $sql = "insert into parts(partID, partName, partNumber, suppliers, category, description01, description02, description03, description04, description05, description06, price, estimatedShippingcost, associatedImageFilename1, associatedImageFilename2, associatedImageFilename3, associatedImageFilename4, notes, shippingWeight) values ('" . (int)$arr[0] . "', '" .(string)addslashes($arr[1]). "', '" . (int)$arr[2] . "', '". (string)addslashes($arr[3]) . "', '". (string)addslashes($arr[4]). "', '" . (string)addslashes($arr[5]). "', '" . (string)addslashes($arr[6]). "', '". (string)addslashes($arr[7]). "', '". (string)addslashes($arr[8]). "', '". (string)addslashes($arr[9]). "', '" . (string)addslashes($arr[10]) . "', '". (float)$arr[11]. "', '". (float)$arr[12]. "', '". (string)addslashes($arr[13]). "', '". (string)addslashes($arr[14]). "', '". (string)addslashes($arr[15]). "', '". (string)addslashes($arr[16]). "', '". (string)addslashes($arr[17]) . "', '" . (float)$arr[18] . "');";
                
                $result = mysqli_query($conn, $sql);

                /*
                if ($result === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    $conn->close();
                }
                */
            
            //echo "<hr/>";
            }
            $row++;
        }
        fclose($handle);
    }else{
        echo "couldnt open.";
    }

}catch(Exception $e){
    echo "sorry!:(";
}

?>
