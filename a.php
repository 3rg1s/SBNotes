<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBnotes Install</title>
</head>
<body>

<h1>Welcome to Sbnotes installer</h1>
    

<form action="" method="POST">
  <label for="dbname">Database name:</label><br>
  <input type="text" name="dname"><br><br>
  <label for="password">User name:</label><br>
  <input type="text" name="username" ><br><br>
  <label for="password">Password:</label><br>
  <input type="text" name="password"><br> <br>
  <input type="submit" value="Submit">

</form> 

</body>
</html>


<?php

$database = trim($_POST['dname']);
$username = $_POST['username'];
$password = $_POST['password'];

$config_file = fopen("config.php", "w") or die("Unable to open file!");


$header = <<< 'EOD'
<?php

$servername = "localhost";

try {
EOD;

$body =  '$conn= new PDO("mysql:host=$servername;dbname=' . $database .  "\"" . ',' . "\"". $username  . "\"" .  ',' ."\"" . $password . "\"" . ');';

$footer = <<< 'EOD'
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    exit();
    }
?> 
EOD;


$final_config = $header . $body . $footer;
fwrite($config_file, $final_config);
fclose($config_file);

?>