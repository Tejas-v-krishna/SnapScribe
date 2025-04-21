<?php
require 'dbms.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and trim input
    $name = mysqli_real_escape_string($conn, trim($_POST["name"]));
    $age = intval($_POST["age"]);
    $email = mysqli_real_escape_string($conn, trim($_POST["email"]));
    $password = trim($_POST["password"]);
    $gender = isset($_POST["gender"]) ? mysqli_real_escape_string($conn, $_POST["gender"]) : "";

    // Input validation
    if (empty($name) || empty($age) || empty($email) || empty($password) || empty($gender)) {
        die("Error: All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format");
    }
    if ($gender !== "Male" && $gender !== "Female") {
        die("Error: Invalid gender value");
    }

    // Check if email already exists
    $check_sql = "SELECT * FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        die("Error: This email is already registered. <a href='register.php'>Try Again</a>");
    }

    // Password hashing
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user
    $sql = "INSERT INTO users (name, age, email, password, gender) 
            VALUES ('$name', $age, '$email', '$hashed_password', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! <a href='login.php'>Login Here</a>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    die("Invalid Request");
}
?>
