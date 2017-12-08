<?php

    session_start();

    //if user is not signed in he cant access this page.
    if((!isset($_SESSION['adminUsername']))&&(!isset($_SESSION['regUsername']))){
        $_SESSION['errormsg'] = "Please sign in to make a purchase";
        header('location: signin.php');
    }

    require_once('connect.php');
    

    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <title>CarStore</title>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
    </head>
    <body>  ";

//the body starts here.

echo '
    <div class="header">
        <h2>Checkout</h2>
    </div>
';

//navigation bar.
require_once('navigationMenu.php');

echo "<div class=\"content\">";

    if(isset($_POST['part'])){
    $part =  $_POST['part'];
    $_SESSION['part'] = $part;    
    }else{
        $part = $_SESSION['part'];
    }

    //echo $part;

    $partsQuery = "SELECT * FROM parts WHERE partID = $part";
    $item = mysqli_query($db, $partsQuery);
   
    $row = $item->fetch_assoc();

    //this part could use more styling.
    echo '<img src="partimages/' . $row['associatedImageFilename1'] . '"/>';
    echo "<h2>". $row['partName'] . "</h2><br>";
    echo "<p>". $row['description01'] . "</p><br>";
    echo "<hr>";
    //enter shipping information.
    echo "<h3>Calculate shipping cost: </h3> <br>";
    
    //display dropdown of states
    echo "

                <div>
                  <label>Select State </label>

                  <select form=\"shipInfo\" name=\"shipState\">";

                  $statesQuery = "SELECT DISTINCT StateAbrv FROM ziptostate";
                  $result = mysqli_query($db, $statesQuery);
                  while($states = $result->fetch_assoc()){
                    echo '<option>' . $states['StateAbrv'] . '</option>';
                  }

    echo "        </select><br><br>


                <form method=\"post\" action=\"checkout.php\" id=\"shipInfo>
                    <input type=\"hidden\" name=\"part\" value=\"$part\">
                    <label>City</label>
                    <input type=\"text\" name=\"city\">
                    <label>Address</label>
                    <input type=\"text\" name=\"address\">                    
                    <label>Zip Code </label>
                    <input type=\"text\" name=\"shipZip\">
                    <input type=\"submit\" name=\"submitShipInfo\" value=\"Calculate shipping cost\">
                </form>
                </div>

    ";

    $shippingCost = 0;

    //if shipping info is entered, calculate and display shipping cost.
    if(isset($_POST['submitShipInfo'])){
        echo "<h3> Price: <br>" . $row['price'] . "</h3><br>";
        echo "<h3>Shipping cost: </h3>";
        $zipEnding = $_POST['shipZip']%1000;
        $zoneQuery = "SELECT * FROM ZipToZone WHERE (LowZip <= $zipEnding) AND (HighZip >= $zipEnding)";
        $result = $result = mysqli_query($db, $zoneQuery);
        if($result){
            $zoneRow = $result->fetch_assoc();
            $zoneToCost = "SELECT * FROM upsgroundweightzoneprice WHERE weight=" . $row['shippingWeight'];
            $result = mysqli_query($db, $zoneToCost);
            if($result){
                $zonePrices = $result->fetch_assoc();
                $index = "zone" . $zoneRow['ZoneGround'];
                echo "<h3>$" . $zonePrices[$index] . "</h3>"; 
                $shippingCost = $zonePrices[$index];
                $total = $shippingCost + $row['price'];
                echo "
                <br>
                <hr>
                <h3>Total Price: " . $total . "</h3>";                
            }
        }
    }

    
    echo "
    </div>
    </body>
    </html>";
    
?>
