<?php
require 'dbms.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);

    if (empty($email)) {
        die("Error: Email is required");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    $sql = "SELECT id FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION["reset_user_id"] = $row["id"];

        
        header("Location: reset_password.php");
        exit();
    } else {
        echo "Error: Email not found in the record";
    }

    $conn->close();
} else {
    die("Invalid request");
}
?>
