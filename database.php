<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "students";

$connection = mysqli_connect($host, $username, $password, $database);
if (!$connection) {
    echo "Failed to connect to the database";
}
?>