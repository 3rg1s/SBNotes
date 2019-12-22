<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
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
    <?php
    if (($_GET['status']) == 'loggedin') {
            echo '<script type/javascript>',
                'login();',
                '</script>'
                ;
        }
    ?>
    <div class="page-header">
        <h1>Hi, <b></b> Welcome to SBNotes 🗒️</h1>
        Please send a email to our main developer at : ehotza35 [at] gmail [dot] com , if you have any questions!
    </div>

<script>
var resetpass = "<?php echo $_SESSION['resetpass'];?>";
if( resetpass == "1") {

swal.fire({
    position: "top-end",
    type: "success",
    title: "Password changed",
    showConfirmButton: false,
    timer: 1200
});

} else if (resetpass == "0") {

swal.fire({
    position: "top-end",
    type: "error",
    title: "Error reseting password!",
    showConfirmButton: false,
    timer: 1200
});

}

<?php

//unset the variable

unset($_SESSION['resetpass']);


?>
</script>

</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>
