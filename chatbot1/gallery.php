<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: signin.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "chatbot");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_image"])) {
    $imagePath = $_POST["image_path"];
    $username = $_SESSION["username"];

    // Delete the image from the database
    $stmt = $conn->prepare("DELETE FROM uploaded_images WHERE username = ? AND image_path = ?");
    $stmt->bind_param("ss", $username, $imagePath);
    $stmt->execute();
    $stmt->close();

    // Optionally, delete the image file from the server
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    header("Location: gallery.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - SnapScribe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-gray-900 via-black to-gray-900 text-white"></body>
<style>
        body {
            opacity: 0;
            animation: fadeIn 1s ease-in-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
    <!-- Navbar -->
    <nav class="flex justify-between items-center py-4 px-8 border-b border-gray-700">
    <a href="index.php" class="text-2xl font-bold text-purple-500 hover:text-white">SnapScribe</a>

        <ul class="hidden md:flex space-x-20 pr-12 text-sm ml-auto">
        <li><a href="index.php" class="hover:text-blue-400 transition duration-300 text-lg font-medium">Home</a></li>
        <li><a href="gallery.php" class="hover:text-blue-400 transition duration-300 text-lg font-medium">Gallery</a></li>
        <li><a href="aboutUs.html" class="hover:text-blue-400 transition duration-300 text-lg font-medium">About Us</a></li>
        <li><a href="text_extract.html" class="hover:text-blue-400 transition duration-300 text-lg font-medium">Start Extracting</a></li>

        </ul>

        <div class="space-x-4">
        <span class="mr-4 text-gray-300">Welcome, <strong class="text-purple-500"><?php echo htmlspecialchars($_SESSION["username"]); ?></strong>!</span>
        <a href="login.php" class="bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 text-white px-4 py-2 rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">Logout</a>

        </div>
    </nav>

    <!-- Gallery Section -->
    <section id="gallery" class="mt-20 px-8">
        <h2 class="text-3xl font-semibold mb-6 text-center text-white">Gallery</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php
            $username = $_SESSION["username"];
            $query = "SELECT image_path FROM uploaded_images WHERE username = '$username' ORDER BY uploaded_at DESC";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="bg-gray-800 p-4 rounded shadow transform transition-transform hover:scale-105">
                            <a href="' . htmlspecialchars($row["image_path"]) . '" target="_blank">
                                <img src="' . htmlspecialchars($row["image_path"]) . '" class="w-full h-64 object-cover rounded" />
                            </a>
                            <form method="POST" class="mt-4 text-center">
                                <input type="hidden" name="image_path" value="' . htmlspecialchars($row["image_path"]) . '">
                                <button type="submit" name="delete_image" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </div>';
                }
            } else {
                echo '<p class="col-span-3 text-center text-gray-400">No images uploaded yet.</p>';
            }

            $conn->close();
            ?>
        </div>
    </section>
</body>
</html>
