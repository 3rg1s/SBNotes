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

        <?php
        if ($_SESSION["username"] === "admin") {
            echo "<br>";
            echo '<a class="btn btn-primary" href="invites.php">Show invite code</a>';

        } else {
            echo "";
        }
        ?>
    <script type="text/javascript">
    function confirmcreate(){
        swal.fire({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes create it',
        }) 
        .then((result) => {
            if (result.value) {
                $.ajax({
                url: "/actions/generatecode.php",
                type: "GET",
                success: function(){
                    swal.fire({
                        position: "top-end",
                        type: "success",
                        title: "Invite code created",
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr,ajaxOptions,thrownError){
                        swal.fire({
                        position: "top-end",
                        type: "error",
                        title: "An error occured",
                        showConfirmButton: false,
                        timer: 1500
                    });

                }
            });
            } else {
                swal.fire({
                        position: "top-end",
                        type: "info",
                        title: "Request Canceled",
                        showConfirmButton: false,
                        timer: 1500
                    });
            }
            
        });
    }
    </script>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
</body>
</html>
