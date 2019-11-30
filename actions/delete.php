<?php

session_start();

require_once "../config.php";

$id = $_GET['id'];

if($_SESSION["username"] === "admin"){
	
//prepare query	
$query = $conn -> prepare("DELETE FROM invite WHERE code = :id"); 
$query -> bindValue(':id', $id, PDO::PARAM_STR);
$query -> execute();
if ($query) {

    $_SESSION['deletedinv'] = "1";
    header('Location: ../invites.php'); 

} else {
    $_SESSION['deletedinv'] = "0";
    header('Location: ../login.php');
}

} else {

	header('Location: ../login.php');
}


?>

