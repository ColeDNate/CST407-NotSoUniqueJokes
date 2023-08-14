<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// modify these settings according to the account on your database server.
$host = "jokes-database-server.mysql.database.azure.com";
$port = "3306";
$username = "JokesAdmin";
$user_pass = "LopesLeap42";
$database_in_use = "jokes";

//attempting fix through azure quickstart
$conn = mysqli_init();
mysqli_real_connect($conn, $host, $username, $user_pass, $database_in_use, 3306);
if (mysqli_connect_errno()) {
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}
else{
    echo "Connection successful.<br>";
}


?>
