<?php

session_start();
// Include config file
require_once "../config.php";

if ($_SESSION["username"] === "admin"){
        // Prepare sql statement
        $sql = "INSERT INTO invite(code) VALUES (UUID())";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

} else {
    header("Location: ../index.php");

}

?>
