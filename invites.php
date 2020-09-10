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
<script type="text/javascript">
    function confirmcreate(){
                $.ajax({
                url: "actions/generatecode.php",
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
		    location.reload();
		    }, 700)
                    
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


// Check if deleted and then show result
var deleteornot = "<?php echo $_SESSION['deletedinv'];?>";
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
unset($_SESSION['deletedinv']);
?>
</script>
</head>
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

$query = $conn->prepare("SELECT * FROM invite");

$query->execute();
$result= $query->fetchAll();

//loop on earch row
foreach($result as $row) {

    echo "<td id=\"id\">" . $row["id"]. "</td>";
    echo "<td id=\"used\">" . $row["used"]. "</td>";
    echo "<td id=\"code\">". $row["code"]. "</td>";
	echo "<td id=\"ownedby\">" . $row["ownedby"]. "</td>";
	echo "<td><a href='actions/delete.php?id=" .$row['code']."'><button type=\"button\" class=\"btn btn-danger\">Delete</button></a></td>";
	echo "</tr>";
}
}else{
	header("Location: index.php");
} 

?>

<!-- </div> -->
</tbody>
<a href="javascript:void(0);" onclick="confirmcreate()"<button style="float:right" type="button" class="btn btn-success">Generate</button> </a>
</div>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
</body>
</html>
