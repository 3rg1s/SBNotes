<?php

session_start();

if(empty($_SESSION['username']))
{
    header('Location: index.html');;
}

require_once "../config.php";

$id = $_GET['id'];
$user = $_SESSION["username"];

//prepare query
$query= $conn-> prepare("DELETE FROM snotes WHERE id = :id and ownedby = :username ");
//bind params
$query-> bindValue(':id', $id , PDO::PARAM_INT);
$query-> bindValue(':username', $user , PDO::PARAM_STR);
//execute
$query->execute();

$result= $query->rowCount();

if($result > 0) {
$_SESSION['deleted'] = "1";
header("Location: ../view.php");
} else {

	$_SESSION['deleted'] = "0";
	header("Location: ../view.php");
}


?>

