<?php

$filename = 'install.php';

if (file_exists($filename)) {
  header("Location: install.php");
}

// Initialize the session
session_start();             
//Check if user is logged in, if yes then redirect to index.php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
   exit;
}                                                                                                                    

// Include config file      
require_once "config.php"; 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

	if(empty($username_err) && empty($password_err)){
		
		$username = $_POST["username"]; // Get the username from  form and add to variable
	  $password = $_POST["password"]; //Get the password from form and add to variable

		$query= $conn->prepare("Select username,password from users where username = :username and password = :password"); // prepare my sql query
		$query->bindValue(':username', $username, PDO::PARAM_STR); // bind username
		$query->bindValue(':password', $password, PDO::PARAM_INT); // bind password
		$query->execute(); // execute the query
		$result = $query->fetch(); //fetch all data as array
		if($result && password_verify($_POST["password"], $result['password'])) {  
			// Password is correct, so start a new session
			session_start();
			
			//store data in session variables
			$_SESSION["loggedin"] = true;
			$_SESSION["id"] = $result['id'];
			$_SESSION["username"] = $result['username'];

			//redirect to user welcome page
			header("location: /actions/setpassword.php");
		} else {
			$error = "Invalid credentials";
		}
	
	}


}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/particles_css.css">
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
<div id="particles-js"></div>
<section id="loginform" class="outer-wrapper">
<link rel="stylesheet">
  <div class="inner-wrapper">
<div class="container">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-4">
      <h2 class="text-center">Welcome back.</h2>
       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($error)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($error)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="actions/register.php">Sign up now</a>.</p>
        </form>
    </div>
  </div>
</div>
</div>
</section>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>particlesJS.load('particles-js', '/css/particles.json')</script>
<script>localStorage.removeItem('Password'); // Destroy localstorage,if there is any left from previous user, not loged out using logout button.</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
</body>
</html>
