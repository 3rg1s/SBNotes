<?php

session_start();

// Include config file
require_once "../config.php";

if ($_SESSION["username"] === "admin"){

//prepare query
$query= $conn-> prepare("INSERT INTO invite(code) VALUES (UUID())");
//execute
$query -> execute();

} else {
    header("Location: ../index.php");

}

?>
