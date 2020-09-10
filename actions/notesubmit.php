<?php
// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page                                                                                                                                                                           
 if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
     header("location: ../login.php");                                                                                                                                                                                                                  exit;                                                                                                                                                                                                                                     }
$username = $_SESSION["username"];
$note = $_POST["note"];

$note = htmlspecialchars($note, ENT_QUOTES, 'UTF-8');

if($note) {
require_once "../config.php";

//prepare sql statement
$query= $conn->prepare("INSERT INTO snotes (note,ownedby) VALUES (:note, :ownedby)");
//bind values
$query-> bindValue(':note', $note, PDO::PARAM_STR);
$query-> bindValue(':ownedby', $_SESSION['username'], PDO::PARAM_STR);
//execute
$query-> execute();
}
else {

    echo "Username or note is missing";
}

?>
