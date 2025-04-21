<?php
session_start();
require 'dbms.php';

if (!isset($_SESSION['reset_email'])) {
    header("Location: reset_password.php");
    exit();
}

$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = trim($_POST["new_password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if (empty($new_password) || empty($confirm_password)) {
        die("Both fields are required!");
    }
    if ($new_password !== $confirm_password) {
        die("Passwords do not match!");
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $email = $conn->real_escape_string($_SESSION['reset_email']);

    $sql = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
    if ($conn->query($sql) === TRUE) {
        $success_message = "✅ Password updated successfully!";
        session_destroy(); 
    } else {
        echo "❌ Error updating password!";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 350px;
            border-left: 5px solid #FF4500;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            text-align: left;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background: #FF4500;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
        }
        button:hover {
            background: #e03e00;
        }
        .success {
            color: green;
            font-weight: bold;
            margin-top: 15px;
        }
        .login-link {
            display: block;
            margin-top: 15px;
            padding: 10px;
            background: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .login-link:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🔒 Update Your Password</h2>
        
        <?php if (!empty($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
            <a href="login.php" class="login-link">Go to Login</a>
        <?php else: ?>
            <form method="POST">
                <label>New Password:</label>
                <input type="password" name="new_password" placeholder="Enter new password" required>
                
                <label>Confirm Password:</label>
                <input type="password" name="confirm_password" placeholder="Confirm password" required>
                
                <button type="submit">Update Password</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
