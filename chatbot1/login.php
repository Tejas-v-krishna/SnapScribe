<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SnapScribe - Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-700 via-gray-800 to-black min-h-screen flex items-center justify-center">
  <div class="bg-gray-900 bg-opacity-95 p-10 rounded-xl shadow-lg w-full max-w-md mx-4">
    <!-- Logo -->
    <div class="text-center mb-8">
      <h1 class="text-4xl font-extrabold">
        <span class="text-blue-500">Snap</span><span class="text-purple-500">Scribe</span>
      </h1>
    </div>

    <!-- Welcome Text -->
    <h2 class="text-white text-2xl font-semibold mb-6 text-center">Welcome Back</h2>
    
    <!-- Login Form -->
    <form action="login_process.php" method="POST">
      <!-- Email Field -->
      <div class="mb-5">
        <label for="email" class="block text-gray-300 mb-2 text-sm font-medium">Email Address</label>
        <input 
          type="email" 
          id="email" 
          name="email"
          class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none"
          placeholder="Enter your email"
          required
        >
      </div>
      
      <!-- Password Field -->
      <div class="mb-6">
        <label for="password" class="block text-gray-300 mb-2 text-sm font-medium">Password</label>
        <input 
          type="password" 
          id="password" 
          name="password"
          class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 focus:ring-2 focus:ring-purple-500 focus:outline-none"
          placeholder="Enter your password"
          required
        >
      </div>
      
      <!-- Sign In Button -->
      <button 
        type="submit" 
        class="w-full py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:opacity-90 transition duration-300 shadow-md"
      >
        Sign In
      </button>
    </form>
    
    <!-- Additional Links -->
    <div class="mt-8 text-center">
      <p class="text-gray-400 mb-3">
        Don't have an account? 
        <a href="register.php" class="text-purple-400 hover:underline font-medium">Create Account</a>
      </p>
      <p class="text-gray-400">
        Forgot your password? 
        <a href="forgot_password.php" class="text-purple-400 hover:underline font-medium">Reset Password</a>
      </p>
    </div>
  </div>
</body>
</html>