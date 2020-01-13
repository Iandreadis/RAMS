<?php
// Start a new session
session_start();

// Display php error messages
ini_set('display_errors', 'On');
// Display all PHP runtime errors
error_reporting(E_ALL);


// web server or ip address of the API
define('WEB_SERVER', 'http://localhost/rams/');
// Database connection info
// Server
define('DBHOST','localhost');
// Database username
define('DBUSER','root');
// Database user password
define('DBPASS','11091968');
// Database name
define('DBNAME','rams');

// Connecto to the database
$conn = mysqli_connect (DBHOST, DBUSER, DBPASS);
mysqli_select_db ($conn, DBNAME);

// If connection fails, halt execution
if(!$conn)
{
    die( "Could not connect to the database server.");
}

// Set database character set 
mysqli_query($conn, "SET NAMES UTF8");
?>
