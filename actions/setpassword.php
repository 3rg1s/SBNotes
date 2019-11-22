CTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
//
}
}

// Destory current password from LocalStorage
function clearPass() {
        localStorage.removeItem('Password');
        document.getElementById("Pass").value = "";
}


function setPass(){
// Check browser support
if(document.getElementById("Pass").value == "") {

Swal.fire({
  icon: 'error',
  title: 'Oops...',
  position: "top-end",
  text: 'Please set a password, to protect your data!',
})

} else {
if (typeof(Storage) !== "undefined") {


var pass = document.getElementById("Pass").value;

localStorage.setItem("Password", pass);
  // Retrieve
// document.getElementById("Pass").value = localStorage.getItem("Password");

} else {
  document.getElementById("Pass").innerHTML = "Sorry, your browser does not support Web Storage...";
}
window.location.replace("/");
}
}
</script>

<!-- <script type="text/javascript">
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
issetha = getCookie("Password");
if (issetha) {
        window.location.href="encnot.php"
} else {
var password = document.getElementById("Pass").value;
document.cookie = "Password=" +password +"; path=/";
}
</script> -->
</div>
</div>
</div>
</body>
