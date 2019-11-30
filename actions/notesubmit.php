<?php
// Initialize the session
session_start();

$username = $_SESSION["username"];

$note = $_POST["note"];

require_once "../config.php";

//prepare sql statement
$query= $conn->prepare("INSERT INTO snotes (note,ownedby) VALUES (:note, :ownedby)");
//bind values
$query-> bindValue(':note', $note, PDO::PARAM_STR);
$query-> bindValue(':ownedby', $_SESSION['username'], PDO::PARAM_STR);
//execute
$query-> execute();

?>
