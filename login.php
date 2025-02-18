<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'user_auth');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$email = $conn->real_escape_string($_POST['email']);
$password = $_POST['password'];

// Fetch user using prepared statements
$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();
  if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header("Location: dashboard.php");
  } else {
    echo "Invalid password!";
  }
} else {
  echo "User not found!";
}

$stmt->close();
$conn->close();
?>