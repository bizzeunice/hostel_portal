<?php
$host = "localhost";   // database server
$user = "root";        // database username
$pass = "";            // database password
$db   = "hostel_portal"; // database name

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
