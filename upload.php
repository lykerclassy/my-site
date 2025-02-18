<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST['category_id'];
    $class_id = $_POST['class_id'];
    $subject_id = $_POST['subject_id'];
    $target_dir = "uploads/"; // Folder where files will be saved
    $file_name = basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $file_name;

    // Check if file was uploaded
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        // Insert into database
        $sql = "INSERT INTO downloads (category_id, class_id, subject_id, file_path) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiis", $category_id, $class_id, $subject_id, $target_file);

        if ($stmt->execute()) {
            echo "File uploaded and record saved successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>
