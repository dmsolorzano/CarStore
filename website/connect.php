<?php 
//session_start();

$errors = array();


$host = 'localhost';
$user = 'root';
$password = '';
$database = 'CarStore';
$parts = 'parts';
$members = 'members';
$zipToState = 'ziptostate';
$zipToZone = 'ziptozone';

/*
$servername = "earth.cs.utep.edu";

$username = "fgarciayala";

$password = "cs5339!fgarciayala";

$database = "fgarciayala";
 
$parts = "parts";
*/

$salt = "123456789";//set 11/1/2017
$hashtype = "md5";


$db = mysqli_connect($host, $user, $password, $database);

if (!$db) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo  mysqli_connect_errno() . PHP_EOL;
    echo  mysqli_connect_error() . PHP_EOL;
    exit;
}

?>