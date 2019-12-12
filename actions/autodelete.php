<?php

session_start();


$id = $_GET['id'];
$user = $_SESSION['username'];


if($_POST['time']!="") {

if($_POST['time'] >= 1 && $_POST['time'] <= 60) {	

//Function to stop  after an error occurs and set autodeleted to 0 so when it goes back to view.php it throwns an error
function seterror() {
	$_SESSION['autodeleted'] = "0";
	header("Location: ../view.php");
	die();
}

$filename = $user . "_" . $id;
$myfile = fopen($filename,  "x+") or seterror(); 
	

$text1 = "sleep " . $_POST['time'] . "m\n";
$text2 = "mysql -u admin -ppassword! -e 'use proj;DELETE FROM snotes WHERE id =";
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
<body>


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

