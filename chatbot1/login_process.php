<?php
require 'dbms.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        die("Error: Email and Password are required.");
    }

    $email = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Set session and redirect
            $_SESSION["username"] = $row["name"]; // or $row["email"]
            header("Location: index.php");
            exit();
        } else {
            die("Error: Incorrect password.");
        }
    } else {
        die("Error: Email not found.");
    }

    $conn->close();
} else {
    die("Invalid request.");
}
?>
