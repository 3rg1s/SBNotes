<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
     header("location: ../login.php");                                                                                                                                                                                                                  exit;                                                                                                                                                                                                                                     }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome</title>
<script src="/js/sweetalert2@8"></script>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
</head>
<body onload="checkpass()">
   <?php
 include '../navigator2.php';
 ?>
<div class="container">
  <div class="row">
    <div class="col-sm">
<div class="alert alert-info" role="alert">
  Set your encryption password, this would never be send to our servers, Please store it in a safe place!
</div>
<form>
  <div class="form-group">
      Password: <input autofocus type="text" id="Pass" required ><br>
      <br>
   <button  type="button" class="btn btn-primary" onclick="setPass()" >Set password</button>
   <button  type="button" class="btn btn-danger" onclick="clearPass()" >Destory current password</button>
  </div>
</form>
<script>

function checkpass(){
if (localStorage.getItem("Password") != null) {
var input = document.getElementById("Pass");
input.value = localStorage.getItem("Password");
} else {
// do nothing here atm
}
}

// Destory current password from LocalStorage
function clearPass() {
	
if (localStorage.getItem('Password') != null) {
	document.getElementById("Pass").value = "";
	localStorage.removeItem('Password');
swal.fire({
    position: "top-end",
    type: "success",
    title: "Password is now gone!",
    showConfirmButton: false,
    timer: 1200
});

}

 else {
swal.fire({
    position: "top-end",
    type: "info",
    title: "No password is set",
    showConfirmButton: false,
    timer: 1200
});

}
}

function setPass(){
// Check browser support
if(document.getElementById("Pass").value == "") {

swal.fire({
    position: "top-end",
    type: "error",
    title: "Please enter a password",
    showConfirmButton: false,
    timer: 1200
});

} 

else {

 if (typeof(Storage) !== "undefined") {

	// create a localStorage variable and assign the password.
	var pass = document.getElementById("Pass").value;
	localStorage.setItem("Password", pass);

} 

else {

// If not supported show error
swal.fire({
    position: "top-end",
    type: "error",
    title: "Sorry, your browser does not support Web Storage...",
    showConfirmButton: false,
    timer: 1200
});

}

//Redirect function
function redirect() {
window.location.assign("/");
}

//set password and show success message
swal.fire({
    position: "top-end",
    type: "success",
    title: "Password set, please remember it",
    showConfirmButton: false,
    timer: 1200
});

window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "/";

    }, 2000);
}
}
</script>

</div>
</div>
</div>
</body>
