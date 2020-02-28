<?php
// Initialize the session
session_start();
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
 
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

	$id = $_SESSION['id'];
	$query= $conn->prepare("SELECT password FROM users WHERE id = :id"); // prepare my sql query
        $query->bindValue(':id', $id, PDO::PARAM_INT); // bind username
        $query->execute(); // execute the query
        $result=$query->fetch(); //fetch the results
if(password_verify($_POST["previous_password"], $result['password'])) {
             
}  else {
        $previous_password_err = "Previous password was incorrect";     

}



    // Validate previous password
    if(empty(trim($_POST["previous_password"]))){
        $previous_password_err = "Please enter the previous password.";     
    } else{
        $previous_password = trim($_POST["previous_password"]);
    }
	

    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err) && empty($previous_password_err)){
    
	    $password = password_hash($new_password, PASSWORD_DEFAULT);
            $id = $_SESSION["id"];	
	
	$query= $conn->prepare("UPDATE users SET password = :password WHERE id = :id"); // prepare my sql query
	$query->bindValue(':password', $password, PDO::PARAM_STR); // bind username
	$query->bindValue(':id', $id, PDO::PARAM_INT); // bind password
	$query->execute(); // execute the query
	if($query) {
$_SESSION['resetpass'] = "1";
header('Location: ../index.php');
}  else {
$_SESSION['resetpass'] = "0";
header('Location: ../index.php');
}
    }
    
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">    
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
 <?php
 include '../navigator2.php';
 ?>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
	    <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Previous Password</label>
                <input type="password" name="previous_password" class="form-control" value="<?php echo $previous_password; ?>" required>
                <span class="help-block"><?php echo $previous_password_err; ?></span>
            </div> 
	    <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>" required>
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="../index.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</html>
