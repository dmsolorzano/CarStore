<?php
    require_once('connect.php');
    // echo "Hello from checkout.php";
    $part =  $_POST['test'];
    
    $query = "SELECT * FROM parts WHERE partID = $part";
    $item = mysqli_query($db, $query);
    echo gettype($item);
    
    
?>
