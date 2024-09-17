<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-5">
    <h1 class="text-3xl font-bold mb-5">Login / Register</h1>

    <!-- Tabs for Login and Register -->
    <div class="flex mb-5">
        <button id="loginTab" class="px-4 py-2 bg-blue-500 text-white rounded-l-md">Login</button>
        <button id="registerTab" class="px-4 py-2 bg-gray-300 text-black rounded-r-md">Register</button>
    </div>

    <!-- Login Form -->
    <div id="loginForm" class="bg-white p-5 shadow-md rounded">
        <h2 class="text-xl font-bold mb-3">Login</h2>
        <form action="/clothing-store/public/login/login" method="POST">
            <input type="text" name="username" placeholder="Username" class="w-full p-2 border rounded-md mb-3" required>
            <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded-md mb-3" required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Login</button>
        </form>
    </div>

    <!-- Register Form (Initially Hidden) -->
    <div id="registerForm" class="bg-white p-5 shadow-md rounded hidden">
        <h2 class="text-xl font-bold mb-3">Register</h2>
        <form action="/clothing-store/public/register" method="POST">
            <input type="text" name="name" placeholder="Name" class="w-full p-2 border rounded-md mb-3" required>
            <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded-md mb-3" required>
            <input type="text" name="username" placeholder="Username" class="w-full p-2 border rounded-md mb-3" required>
            <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded-md mb-3" required>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Register</button>
        </form>
    </div>
</div>

<script>
    // Switch between Login and Register tabs
    document.getElementById('loginTab').addEventListener('click', function() {
        document.getElementById('loginForm').classList.remove('hidden');
        document.getElementById('registerForm').classList.add('hidden');
        this.classList.add('bg-blue-500', 'text-white');
        document.getElementById('registerTab').classList.remove('bg-blue-500', 'text-white');
        document.getElementById('registerTab').classList.add('bg-gray-300', 'text-black');
    });

    document.getElementById('registerTab').addEventListener('click', function() {
        document.getElementById('registerForm').classList.remove('hidden');
        document.getElementById('loginForm').classList.add('hidden');
        this.classList.add('bg-blue-500', 'text-white');
        document.getElementById('loginTab').classList.remove('bg-blue-500', 'text-white');
        document.getElementById('loginTab').classList.add('bg-gray-300', 'text-black');
    });
</script>

</body>
</html>
