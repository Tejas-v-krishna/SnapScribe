<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "Not logged in.";
    exit();
}

$targetDir = "uploads/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if (isset($_FILES["file"])) {
    $filename = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . time() . "_" . $filename;
    
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // DB connection
        $conn = new mysqli("localhost", "root", "", "your_database_name");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $username = $_SESSION["username"];
        $stmt = $conn->prepare("INSERT INTO uploaded_images (username, image_path) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $targetFilePath);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        echo json_encode(["status" => "success", "path" => $targetFilePath]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No file uploaded."]);
}
?>
