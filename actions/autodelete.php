<?php

session_start();

require_once "../config.php"; 


// Check if the user is logged in, otherwise redirect to login page                                                                                                                                                                           
 if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){                                                                                                                                                                         
     header("location: ../login.php");                                                                                                                                                                                                                  exit;                                                                                                                                                                                                                                     }


$id = $_GET['id'];
$user = $_SESSION['username'];


if($_POST['time']!="") {

if($_POST['time'] >= 1 && $_POST['time'] <= 60) {	

//Function to stop after an error occurs and set autodeleted to 0 so when it goes back to view.php it throwns an error
function seterror() {
	$_SESSION['autodeleted'] = "0";
	header("Location: ../view.php");
	die();
}

$filename = $user . "_" . $id;
$myfile = fopen($filename,  "x+") or seterror(); 
	

$text1 = "sleep " . $_POST['time'] . "m\n";
$text2 = "mysql -u $user -p $pass -e 'use proj;DELETE FROM snotes WHERE id =";
$text3 = $id;
$text4 = " and ";
$text5 = " ownedby= ";
$text6 = "\"";
$text7 = $user . "\"";
$text8 = "'";
$text9 = "\n";
$text10 = "rm " . $filename . "\n";	
$all =  $text1  . $text2 . $text3 .$text4 . $text5 . $text6 . $text7 . $text8 . $text9 . $text10;


fwrite($myfile, $all);
fclose($myfile);

$command = " bash ";
shell_exec('chmod 777 ' . $filename);
shell_exec($command . $filename . '> /dev/null 2>&1 &');
$_SESSION['autodeleted'] = "1";
header("Location: ../view.php");
}

}

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">    
        <title>Set Timer</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"></script>
</head>
<body>
<?php
 include '../navigator2.php';
?>  
<form action="" method="POST">
<br>
Delete After how many Minutes:
<input type="number" name="time" value="1" min="1" max="60">
<br>
<br>
<input type="submit" value="Submit">
</form> 
</body>
</html>

