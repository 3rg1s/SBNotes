<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">    

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
 include '../navigator2.php';
 ?>

<div class="container">
  <h2>Add Note</h2>
  <p>:</p>
  <form>
    <div class="form-group">
      <textarea class="form-control" type="text" rows="20" id="Message" name="fname"></textarea>
    </div>
   <button  type="button" class="btn btn-primary" onclick="encrypt()">Save Note</button>
  </form>
</div>

 
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
	var encrypted = CryptoJS.AES.encrypt(message, password, "{mode: CryptoJS.mode.CBC, padding:CryptoJs.pad.Pkcs7}").toString();
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
       window.location.replace("../view.php");
      }, 1000);
  }

});
}

</script>
</body>
</html>


