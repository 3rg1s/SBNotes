<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" name="viewport" content="width=10000">
    <title>Encrypt Da notes</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js" integrity="sha256-xoJklEMhY9dP0n54rQEaE9VeRnBEHNSfyfHlKkr9KNk=" crossorigin="anonymous"></script>
    <script>
  function decrypt(encryptedtext){
  var pass = localStorage.getItem("Password");
  var decrypted = CryptoJS.AES.decrypt(encryptedtext, pass).toString(CryptoJS.enc.Utf8);
  return decrypted;
}
</script>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
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


      
<?php

session_start();

// Include config file
require_once "config.php";

$username = $_SESSION['username'];

$sql = "SELECT * FROM snotes WHERE ownedby = '$username'";
// echo $sql;

$result = mysqli_query($link, $sql); // First parameter is just return of "mysqli_connect()" function

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
echo '<hr widht="75%">';
     
   echo "<script> document.write(decrypt(" . '"' . $row["note"]    . '"' . "));</script>";
   echo "<br>";
}

}

?>
<br>
</div>
</div>
</div>

</body>
</html>


