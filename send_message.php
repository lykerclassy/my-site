<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost"; 
$user = "root"; 
$password = ""; 
$dbname = "user_auth"; 

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    // Validate fields
    if (empty($name) || empty($email) || empty($message)) {
        echo "error: Please fill in all fields.";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "error: Invalid email format.";
        exit;
    }

    // Prepare and insert message into the database
    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            echo "success"; // AJAX response
        } else {
            echo "error: Failed to insert message.";
        }

        $stmt->close();
    } else {
        echo "error: Failed to prepare statement.";
    }
}

$conn->close();
?>
