<?php
// Initialize the session
session_start();

$username = $_SESSION["username"];

$note = $_POST["note"];

require_once "config.php";

$sql = "INSERT INTO snotes (note,ownedby) VALUES (?,?)";

     if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $note, $username);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: view.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
?>
