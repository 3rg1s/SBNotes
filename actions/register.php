<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$invite="";
$password="";
$username="";
$password_err = "";
$username_err = "";
$confim_password_err = "";
$confim_passsword= "";
//If post send to this file
if($_SERVER["REQUEST_METHOD"] == "POST"){

     // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
	$query= $conn-> prepare("Select username from users where username = :username");
	$query->bindValue(':username',trim($_POST['username']), PDO::PARAM_STR);
	$query->execute();
	$result = $query->fetch();
	if($result > 0) {
	
	    $username_err = "This username is already taken.";
	
	} else {
	
	    $username = trim($_POST['username']);
	
	}
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }


    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    if(trim($_POST["invite"])) {
	    //Check if invite exists and is used
	    $query=$conn->prepare('SELECT * FROM invite where code= :code');
	    $query->bindValue(':code', trim($_POST['invite']), PDO::PARAM_STR);
	    $query->execute();
	    //Fetchall not working, I wasted more than 1 hour here.
	    $result = $query->fetch();
	if($result['used'] == 0 && !empty(trim($result['code']))) {
		//Set current password as used now
		$query= $conn->prepare('UPDATE invite set used = "1", ownedby = :username where code = :code');
	    	$query->bindValue(':code', trim($_POST['invite']), PDO::PARAM_STR);
		$query->bindValue(':username', $username, PDO::PARAM_STR);
		$query->execute();
		} else {
		    
		    $invite_err= "There was an error with the invite code";
	    }
	   
	} else {
	
		$invite_err="Please enter Invite code";
	}

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($invite_err) ){
	    //Then add records to database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $query= $conn->prepare("INSERT INTO users (username,password) VALUES (:username,:password)"); 
	    $query->bindValue(':username', $username, PDO::PARAM_STR);	    
	    $query->bindValue(':password', $hashed_password, PDO::PARAM_STR);	    
	    $query->execute();
	    if($query) {
		    header("Location: ../index.php");
	    } else {
	    	echo "An error occured";
	    }

    }	
    
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<style>
html, body { height:100%; }
.outer-wrapper { 
display: table;
width: 100%;
height: 100%;
}
.inner-wrapper {
  display:table-cell;
  vertical-align:middle;
  padding:15px;
}
.login-btn { position:fixed; top:15px; right:15px; }
</style>
<body>
    <div class="wrapper">
<div class="container">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form id="formLogin" class="form" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input  autocomplete="off" type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input  autocomplete="off" type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input   autocomplete="off" type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($invite_err)) ? 'has-error' : ''; ?>">
                <label>Invite code</label>
                <input  autocomplete="off" type="password" name="invite" class="form-control" value="<?php echo $invite; ?>">
                <span class="help-block"><?php echo $invite_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="../login.php">Login here</a>.</p>
        </form>
    </div>  
</div>
</div>
</div>  
</body>
</html>
