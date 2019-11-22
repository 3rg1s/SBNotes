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
$user = $_SESSION["username"];
//select ownedby,id from snotes where id= 1 and ownedby = "admin";

// sql to delete a record
$sql = "DELETE FROM snotes WHERE id = '$id' and ownedby = '$user' ";
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


if (mysqli_query($conn, $sql)) {
	
   mysqli_close($conn);

     header('Location: ../view.php'); 

    exit;

} else {	
	

	echo 'Some errors occured';
}


?>

