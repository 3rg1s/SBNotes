<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost'); # This is your mysql server address, leave it localhost if you are running it locally
define('DB_USERNAME', ''); # Change this to your mysql username
define('DB_PASSWORD', ''); # Change this to your mysql password
define('DB_NAME', 'project'); # If you followed the ReadMe this should stay as it is otherwise change it to your own, (Database name) 
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
