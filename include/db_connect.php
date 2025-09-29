<?php
$host = "localhost";
$dbname = "hostel_portal";
$user = "root";   // change if needed
$pass = "";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>