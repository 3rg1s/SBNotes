<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" name="viewport" content="width=10000">
    <title>Encrypt Da notes</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js" integrity="sha256-xoJklEMhY9dP0n54rQEaE9VeRnBEHNSfyfHlKkr9KNk=" crossorigin="anonymous"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
   <?php
 include 'navigator.php';
 ?>
<form>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Enter Message</label>
      <textarea type="text" id="Message" size="20" name="fname"></textarea><br>
   <button  type="button" class="btn btn-primary" onclick="encrypt()">Encrypt Message</button>
  </div>
</form>
<script type="text/javascript">

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

function encrypt(){

	var message = document.getElementById("Message").value;
	var password = localStorage.getItem("Password");
	var encrypted = CryptoJS.AES.encrypt(message, password).toString();
  sendtodb(encrypted);

}


function sendtodb(note){

$.ajax({
  url: "notesubmit.php",
  type: "POST",
  data: {note: note},
  success: function(data){
        swal.fire({
        position: "top-end",
        type: "success",
        title: "Invite code created",
        showConfirmButton: false,
        timer: 100
    });
      setTimeout(function(){
       window.location.replace("view.php");
      }, 1000);
  }

});
}



// $.ajax({
//   url: "http://localhost/univproj/notesubmit.php",
//   type: "POST",
//   data: {note: not},
//   success: function(data){
//                         swal.fire({
//                         position: "top-end",
//                         type: "success",
//                         title: "Invite code created",
//                         showConfirmButton: false,
//                         timer: 500
//                     });
//                     setTimeout(function(){
//                      location.reload();
//                     }, 1000);
//   }
// })

// function decrypt(){
//   var pass = localStorageGetItem("Password");
//   var decrypted = CryptoJS.AES.decrypt(encrypted, beu);
// }

</script>
</body>
</html>


