<?php
$host = "localhost"; // Your database host
$user = "root"; // Database username
$password = ""; // Database password (leave empty if none)
$dbname = "user_auth"; // Your database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
