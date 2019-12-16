<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">    
	<title>Encrypt Da notes</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js" integrity="sha256-xoJklEMhY9dP0n54rQEaE9VeRnBEHNSfyfHlKkr9KNk=" crossorigin="anonymous"></script>
<style type="text/css">body{ font: 14px sans-serif; text-align: center; }</style>
</head>
<body>

<?php
 include 'navigator.php';
 ?>

 <div class="container">
  <div class="row">
    <div class="col-md">
<h1 class="display-1"> Your Notes </h1>
<br>
  <div class="alert alert-info">
    If there is a space between your notes or no notes show at all,  <strong>  That means you gave an invalid password, please make sure it is correct. <a href="actions/setpassword.php">Set Again!</a>
</strong>
  </div>

<script>
  function decrypt(encryptedtext){
  var pass = localStorage.getItem("Password");
  var decrypted = CryptoJS.AES.decrypt(encryptedtext, pass).toString(CryptoJS.enc.Utf8);
  return decrypted;
}
</script>

<?php

session_start();

// Check if the user is logged in, otherwise redirect to login page                                                                                                                                                                           
 if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
     header("location: ../login.php");                                                                                                                                                                                                                  exit;                                                                                                                                                                                                                                     }

// Include config file
require_once "config.php";


$query = $conn->prepare("SELECT * FROM snotes WHERE ownedby = :username");

$query->bindValue(':username', $_SESSION['username'], PDO::PARAM_STR);
$query->execute();
$result= $query->fetchAll();

//loop on earch row
foreach($result as $note) {

  echo '<hr widht="75%">';
   echo "<script> document.write(decrypt(" . '"' . $note["note"]    . '"' . "));</script>";
   echo "<script> if(decrypt(" . '"' . $note["note"]    . '"' . ") == \"\"){<style>view_buttons</style>} else {}</script>";
   echo "<td><a href='/actions/delete_note.php?id=" .$note['id']."'><button  name=\"ba\" type=\"button\" class=\"btn btn-danger\" style=\" float:right\" id=\"view_buttons\"  >Delete</button></a></td>";   
   echo "<td><a href='/actions/autodelete.php?id=" .$note['id']."'><button  name=\"autodelete\" type=\"button\" class=\"btn btn-info\" style=\" float:left\" id=\"view_buttons\"  >Auto_Delete</button></a></td>";   
   echo "<br>";

}

?>
<br>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
var deleteornot = "<?php echo $_SESSION['deleted'];?>";
console.log(deleteornot);	
if( deleteornot == "1") {

swal.fire({
    position: "top-end",
    type: "success",
    title: "Deleted successfully",
    showConfirmButton: false,
    timer: 1200
});

} else if (deleteornot == "0") {

swal.fire({
    position: "top-end",
    type: "error",
    title: "Error Deleting",
    showConfirmButton: false,
    timer: 1200
});



}

<?php 


//unset the variable

unset($_SESSION['deleted']);



?>
</script>
<script>
var autodeleteornot = "<?php echo $_SESSION['autodeleted'];?>";
if( autodeleteornot == "1") {

swal.fire({
    position: "top-end",
    type: "success",
    title: "Job set successfully",
    showConfirmButton: false,
    timer: 1200
});

} else if (autodeleteornot == "0") {

swal.fire({
    position: "top-end",
    type: "error",
    title: "Job already Exists",
    showConfirmButton: false,
    timer: 1200
});



}

<?php 


//unset the variable

unset($_SESSION['autodeleted']);



?>
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>


