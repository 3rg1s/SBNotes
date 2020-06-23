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
  <label for="hostname">hostname name:</label><br>
  <input type="text" name="hostname"><br><br>
  <label for="password">User name:</label><br>
  <input type="text" name="username" ><br><br>
  <label for="password">Password:</label><br>
  <input type="text" name="password"><br> <br>
  <input type="submit" value="Submit">

</form> 

</body>
</html>


<?php
$hostname = $_POST['hostname'];
$database = trim($_POST['dname']);
$username = $_POST['username'];
$password = $_POST['password'];

function create_table() {

require_once "config.php";

$sql = "
create table invite (id int not null auto_increment unique, used boolean default '0', code varchar(50) not null unique, ownedby varchar(50) default '');
create table users(id int auto_increment not null primary key, username varchar(50) not null unique, password varchar(255) not null, created_at datetime default current_timestamp);
create table snotes(id int auto_increment not null primary key, note longtext not null, ownedby varchar(50) not null);
INSERT INTO invite(code) VALUES (UUID());
";
//prepare sql statement
$query= $conn->prepare($sql);
//execute
$query-> execute();


}


function check_connection($hostname,$database,$username,$password) {
    try {
        $conn= new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "\nWriting to config file\n";
        write_config($hostname,$database,$username,$password);
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }

}


function write_config($hostname,$database,$username,$password) {
$config_file = fopen("config.php", "w") or die("Unable to open file!");
$header = <<< 'EOD'
<?php

$servername = "localhost";

try {
EOD;
$body =  '$conn= new PDO("mysql:host=' . $hostname . ';dbname=' . $database .  "\"" . ',' . "\"". $username  . "\"" .  ',' ."\"" . $password . "\"" . ');';

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

create_table();

}


check_connection($hostname,$database,$username,$password);

header("Location: index.php");

unlink("install.php");

?>