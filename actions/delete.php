<?php

session_start();


// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'admin');
// define('DB_PASSWORD', 'password!');
// define('DB_NAME', 'proj');
// // Include config file
// require_once "config.php";

$dbname = "proj";
$conn = mysqli_connect("localhost", "admin", "password!", $dbname);

$id = $_GET['id'];

if($_SESSION["username"]=== "admin"){
// sql to delete a record
$sql = "DELETE FROM invite WHERE Code = '$id' "; 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (mysqli_query($conn, $sql)) {

    mysqli_close($conn);

    header('Location: ../invites.php'); 

    exit;

} else {

    echo "Error deleting record";
}
} else {

	header('Location: ../login.php');
}

?>

