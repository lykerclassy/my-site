<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'user_auth');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Sanitize inputs
$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);
$confirm_password = $conn->real_escape_string($_POST['confirm_password']);

// Validate passwords
if ($password !== $confirm_password) {
  die("Passwords do not match!");
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user using prepared statements (secure)
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed_password);

if ($stmt->execute()) {
  header("Location: index.php?signup=success");
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>