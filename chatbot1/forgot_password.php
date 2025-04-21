<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SnapScribe - Forgot Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-700 via-gray-900 to-black min-h-screen flex items-center justify-center">
  <div class="bg-gray-800 bg-opacity-95 p-10 rounded-xl shadow-lg w-full max-w-md mx-4">
    <!-- Logo -->
    <div class="text-center mb-8">
      <h1 class="text-4xl font-extrabold tracking-wide">
        <span class="text-blue-400">Snap</span><span class="text-purple-400">Scribe</span>
      </h1>
    </div>

    <!-- Header Text -->
    <h2 class="text-white text-3xl font-extrabold mb-8 text-center">Reset Password</h2>
    
    <!-- Reset Password Form -->
    <form action="forgot_password_process.php" method="POST">
      <!-- Description -->
      <p class="text-gray-300 mb-8 text-center leading-relaxed">
        Enter your email address below and we'll send you a link to reset your password.
      </p>
      
      <!-- Email Field -->
      <div class="mb-6">
        <label for="email" class="block text-gray-200 mb-2 font-medium">Email Address</label>
        <input 
          type="email" 
          id="email" 
          name="email"
          placeholder="Enter your email"
          class="w-full p-4 rounded-lg bg-gray-900 border border-gray-700 text-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none"
          required
        >
      </div>
      
      <!-- Submit Button -->
      <button 
        type="submit" 
        class="w-full py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-semibold rounded-lg hover:opacity-90 transition duration-300 shadow-lg"
      >
        Reset Password
      </button>
    </form>
    
    <!-- Return to login link -->
    <div class="mt-8 text-center">
      <p class="text-gray-400">
        Remember your password? 
        <a href="login.php" class="text-purple-400 font-medium hover:underline">Sign In</a>
      </p>
    </div>
  </div>
</body>
</html>