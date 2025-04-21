<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SnapScribe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gradient-to-r from-black via-gray-900 to-black text-white"></body>
    <?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: signin.php");
        exit();
    }
    ?>
    <style>
        body {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        body.loaded {
            opacity: 1;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.body.classList.add("loaded");
        });
    </script>
    <!-- Navbar -->
    <nav class="flex justify-between items-center py-4 px-8 border-b border-gray-700">
        <a href="index.php" class="text-2xl font-bold text-purple-500 hover:text-white">SnapScribe</a>
        <ul class="flex space-x-20 pr-12 text-sm ml-auto">
        <li><a href="index.php" class="hover:text-blue-400 transition duration-300 text-lg font-medium">Home</a></li>
        <li><a href="gallery.php" class="hover:text-blue-400 transition duration-300 text-lg font-medium">Gallery</a></li>
        <li><a href="aboutUs.html" class="hover:text-blue-400 transition duration-300 text-lg font-medium">About Us</a></li>
        <li><a href="text_extract.html" class="hover:text-blue-400 transition duration-300 text-lg font-medium">Start Extracting</a></li>
        </ul>
        <div>
            <span class="mr-4 text-gray-300">Welcome, <strong class="text-purple-500"><?php echo htmlspecialchars($_SESSION["username"]); ?></strong>!</span>
            <a href="login.php" class="bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 text-white px-4 py-2 rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">Logout</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="text-center py-20 flex-grow">
        <h1 class="text-7xl font-bold">
            <span class="text-blue-500">Snap</span><span class="text-purple-500">Scribe</span>
        </h1>
        <h2 class="text-3xl font-semibold mt-10">Transform Your Images Into Text With Precision</h2>
        <p class="text-xl text-gray-400 mt-10 max-w-xl mx-auto">
            Our intelligent system stores your images securely while extracting valuable text content effortlessly. Perfect for notes, documents, and more.
        </p>
        <div class="mt-10 space-x-4">
            <a href="text_extract.html" class="bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 text-white px-6 py-3 rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">Upload Your Image</a>
            <a href="gallery.php" class="border border-gray-400 px-6 py-3 rounded-full text-gray-300 hover:bg-gray-400 hover:text-black shadow-lg transform hover:scale-105 transition-transform duration-300">View Gallery</a>
        </div>

        <!-- Features -->
        <div class="flex justify-center gap-6 mt-20 flex-wrap">
            <div class="bg-gray-900 p-6 rounded-lg w-60 hover:scale-105 transition-transform duration-300">
            <i class="fa-solid fa-lock text-purple-500 text-2xl mb-2"></i>
            <h3 class="font-bold text-lg">Secure Storage</h3>
            <p class="text-gray-400 text-sm mt-2">Your images are stored safely and accessible only to you.</p>
            </div>
            <div class="bg-gray-900 p-6 rounded-lg w-60 hover:scale-105 transition-transform duration-300">
            <i class="fa-solid fa-file-lines text-purple-500 text-2xl mb-2"></i>
            <h3 class="font-bold text-lg">Smart OCR</h3>
            <p class="text-gray-400 text-sm mt-2">Powerful text recognition engine for accurate extraction.</p>
            </div>
            <div class="bg-gray-900 p-6 rounded-lg w-60 hover:scale-105 transition-transform duration-300">
            <i class="fa-solid fa-clock-rotate-left text-purple-500 text-2xl mb-2"></i>
            <h3 class="font-bold text-lg">History Access</h3>
            <p class="text-gray-400 text-sm mt-2">Access all your uploaded images anytime.</p>
            </div>
        </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-center text-white py-6 mt-20">
        <p>© 2025 SnapScribe. All rights reserved.</p>
        <div class="flex justify-center space-x-6 mt-4">
            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-github"></i></a>
            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin"></i></a>
            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>
    </footer>
</body>
</html>