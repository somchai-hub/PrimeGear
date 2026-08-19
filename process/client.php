<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "primegear_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("". $conn->connect_error);
} else {
    //echo "Connection Successful.";
}