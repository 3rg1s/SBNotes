<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Invite codes</title>
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="loginlogout.js" type="text/javascript"></script>
<script type="text/javascript">
    function confirmcreate(){
                $.ajax({
                url: "generatecode.php",
                type: "GET",
                success: function(){
                    swal.fire({
                        position: "top-end",
                        type: "success",
                        title: "Invite code created",
                        showConfirmButton: false,
                        timer: 1200
                    });
                    setTimeout(function(){
                    	location = location;
                    }, 900)
                    
                },
                error: function(xhr,ajaxOptions,thrownError){
                        swal.fire({
                        position: "top-end",
                        type: "error",
                        title: "An error occured",
                        showConfirmButton: false,
                        timer: 1100
                    });

                }
            
        });
    }
    </script>
</head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<body>
 <?php
 include 'navigator.php';
 ?>
<table class="table table-striped">                     
    <div class="table responsive">
        <thead>
            <tr>
              <th>#1</th>
              <th>Used</th>
              <th>Code</th>
              <th>User</th>
              <th>Action</th>
            </tr>
        </thead>
        <tbody>

<!-- <div id="invites"> -->
<?php

if ($_SESSION["username"] == "admin") {

// Include config file
require_once "config.php";

$sql = "SELECT * FROM invite LIMIT 15";

$result = mysqli_query($link, $sql); // First parameter is just return of "mysqli_connect()" function

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

    echo "<tr>";
    echo "<td id=\"id\">" . $row["id"]. "</td>";
    echo "<td id=\"used\">" . $row["used"]. "</td>";
    echo "<td id=\"code\">". $row["code"]. "</td>";
	echo "<td id=\"ownedby\">" . $row["ownedby"]. "</td>";
	echo "<td><a href='delete.php?id=" .$row['code']."'><button type=\"button\" class=\"btn btn-danger\">Delete</button></a></td>";
	echo "</tr>";
}
}
}else{
	header("Location: index.php");
} 

?>

<!-- </div> -->
</tbody>
</div>
</table>
</body>

</html>
