<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBnotes Install</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>


<div class="container">
<div class="form-group">
<h1>Welcome to Sbnotes installer</h1>
<br>
<form action="" method="POST">
  <label for="dbname">Database name:</label><br>
  <input type="text" class="form-control" name="dname"><br><br>
  <label for="hostname">hostname name:</label><br>
  <input type="text" class="form-control" name="hostname"><br><br>
  <label for="password">User name:</label><br>
  <input type="text" class="form-control" name="username" ><br><br>
  <label for="password">Password:</label><br>
  <input type="text"  class="form-control" name="password"><br> <br>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>

</form> 
</div>
</body>
</html>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$config = [
    'host'=> trim($_POST['hostname']),
    'database'=> trim($_POST['dname']),
    'username' => trim($_POST['username']),
    'password'=> trim($_POST['password'])
];

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


$query= $conn->prepare("SELECT code FROM invite WHERE id = :id"); // prepare my sql query

    $query->bindValue(':id', 1, PDO::PARAM_INT); // bind username
    $query->execute(); // execute the query
    $result=$query->fetch(); //fetch the results

//store invite code in session variable
$_SESSION["code"] = $result['code'];

}


function check_connection(array $config) {
    if (empty($config['host'])) {
        echo 'Host Missing';
        echo "<br>";
    }

    if (empty($config['database'])) {
        echo 'Database Missing';
        echo "<br>";
    }

    if (empty($config['username'])) {
        echo 'Username Missing';
        echo "<br>";
    }

    if (empty($config['password'])) {
        echo 'Password Missing';
    }

    try {
        $conn= new PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['username'], $config['password']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "\nWriting to config file\n";
        write_config($config);
    }catch(PDOException $e) {
        switch ($e->getCode()) {
            // Database Error Code
            case 1049:
                echo "Unknown database '{$config['database']}'";
            break;

            // Host Error Code
            case 2002:
                echo "Name or service not known '{$config['database']}'";
            break;

            // Access Denied Error Code
            case 1045:
                echo "Access denied";
            break;
            
            case "42S01":
                echo "The database already exists";
            break;
        }
    }
}


function write_config(Array $config) {
$config_file = fopen("config.php", "w") or die("Unable to open file!");
$header = <<< 'EOD'

<?php

try {
EOD;
$body =  '$conn= new PDO("mysql:host=' . $config['host'] . ';dbname=' .  $config['database'] .  "\"" . ',' . "\"". $config['username']  . "\"" .  ',' ."\"" . $config['password'] . "\"" . ');';

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

$final_config = $creds . $header . $body . $footer;
fwrite($config_file, $final_config);
fclose($config_file);
create_table();
header( "Location: actions/register.php");
unlink("install.php");
}
check_connection($config);
}

?>