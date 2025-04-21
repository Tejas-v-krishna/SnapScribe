<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SnapScribe - Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-700 via-gray-900 to-black min-h-screen flex items-center justify-center">
  <div class="bg-gray-800 bg-opacity-95 p-10 rounded-xl shadow-lg w-full max-w-lg mx-4">
    <!-- Logo -->
    <div class="text-center mb-8">
      <h1 class="text-4xl font-extrabold">
        <span class="text-blue-500">Snap</span><span class="text-purple-500">Scribe</span>
      </h1>
    </div>

    <!-- Header Text -->
    <h2 class="text-white text-3xl font-bold mb-8 text-center">Create Your Account</h2>
    
    <!-- Signup Form -->
    <form action="register_process.php" method="POST">
      <!-- Name Field -->
      <div class="mb-6">
        <label for="name" class="block text-gray-300 mb-2 font-medium">Name:</label>
        <input 
          type="text" 
          id="name" 
          name="name"
          class="w-full p-4 rounded-lg bg-gray-900 border border-gray-700 text-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none"
          required
        >
      </div>
      
      <!-- Age Field -->
      <div class="mb-6">
        <label for="age" class="block text-gray-300 mb-2 font-medium">Age:</label>
        <input 
          type="number" 
          id="age" 
          name="age"
          min="1" 
          max="120"
          class="w-full p-4 rounded-lg bg-gray-900 border border-gray-700 text-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none"
          required
        >
      </div>
      
      <!-- Email Field -->
      <div class="mb-6">
        <label for="email" class="block text-gray-300 mb-2 font-medium">E-mail:</label>
        <input 
          type="email" 
          id="email" 
          name="email"
          class="w-full p-4 rounded-lg bg-gray-900 border border-gray-700 text-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none"
          required
        >
      </div>
      
      <!-- Password Field -->
      <div class="mb-6">
        <label for="password" class="block text-gray-300 mb-2 font-medium">Password:</label>
        <input 
          type="password" 
          id="password" 
          name="password"
          minlength="6"
          class="w-full p-4 rounded-lg bg-gray-900 border border-gray-700 text-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none"
          required
        >
      </div>
      
      <!-- Gender Field -->
      <div class="mb-8">
        <label class="block text-gray-300 mb-2 font-medium">Gender:</label>
        <div class="flex items-center space-x-6">
          <div class="flex items-center">
            <input 
              type="radio" 
              id="male" 
              name="gender" 
              value="Male" 
              class="mr-2 focus:ring-2 focus:ring-blue-500"
              required
            >
            <label for="male" class="text-gray-300">Male</label>
          </div>
          <div class="flex items-center">
            <input 
              type="radio" 
              id="female" 
              name="gender" 
              value="Female" 
              class="mr-2 focus:ring-2 focus:ring-blue-500"
              required
            >
            <label for="female" class="text-gray-300">Female</label>
          </div>
        </div>
      </div>
      
      <!-- Sign Up Button -->
      <button 
        type="submit" 
        class="w-full py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:opacity-90 transition duration-300 shadow-lg"
      >
        Sign Up
      </button>
    </form>
    
    <!-- Already have account link -->
    <div class="mt-8 text-center"></div>
      <p class="text-gray-400">
        Already have an account? 
        <a href="login.php" class="text-purple-400 hover:underline">Sign In here</a>
      </p>
    </div>
  </div>
</body>
</html>