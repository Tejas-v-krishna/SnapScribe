<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: signin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $conn = new mysqli("localhost", "root", "", "chatbot");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $uploadDir = "uploads/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $uploadDir . time() . "_" . $fileName;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        $username = $conn->real_escape_string($_SESSION["username"]);
        $imagePath = $conn->real_escape_string($targetFilePath);

        $query = "INSERT INTO uploaded_images (username, image_path, uploaded_at)
                  VALUES ('$username', '$imagePath', NOW())";

        if ($conn->query($query)) {
            echo "
            <div style='font-family: Arial, sans-serif; text-align: center; margin-top: 50px;'>
                <p style='color: green; font-size: 20px;'>Image uploaded successfully.</p>
                <a href='index.php' style='text-decoration: none; color: white; background-color: #007BFF; padding: 10px 20px; border-radius: 5px;'>Go to Home</a>
            </div>";
        } else {
            echo "
            <div style='font-family: Arial, sans-serif; text-align: center; margin-top: 50px;'>
                <p style='color: red; font-size: 20px;'>Database insert failed: " . $conn->error . "</p>
            </div>";
        }
    } else {
        echo "
        <div style='font-family: Arial, sans-serif; text-align: center; margin-top: 50px;'>
            <p style='color: red; font-size: 20px;'>File upload failed.</p>
        </div>";
    }

    $conn->close();
} else {
    echo "
    <div style='font-family: Arial, sans-serif; text-align: center; margin-top: 50px;'>
        <p style='color: red; font-size: 20px;'>Invalid request.</p>
    </div>";
}
?>
