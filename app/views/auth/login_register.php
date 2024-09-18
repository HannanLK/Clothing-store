<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .toggle-active {
            background-color: black;
            color: white;
        }
        .toggle-inactive {
            background-color: lightgray;
            color: black;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex justify-center mt-20">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
            <!-- Toggle Buttons -->
            <div class="flex justify-center mb-4">
                <button id="loginToggle" class="toggle-active px-4 py-2 w-1/2">Login</button>
                <button id="registerToggle" class="toggle-inactive px-4 py-2 w-1/2">Register</button>
            </div>

            <!-- Login Form -->
            <form id="loginForm" method="POST" action="<?= BASE_URL ?>auth/login" class="space-y-4">
                <h2 class="text-2xl font-semibold mb-4">Login</h2>
                <div>
                    <label for="login-username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="login-username" class="block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="login-password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="login-password" class="block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <button type="submit" class="w-full bg-black text-white py-2 rounded-md">Login</button>
            </form>

            <!-- Register Form (Initially Hidden) -->
            <form id="registerForm" method="POST" action="<?= BASE_URL ?>auth/register" class="space-y-4 hidden">
                <h2 class="text-2xl font-semibold mb-4">Register</h2>
                <div>
                    <label for="register-name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" id="register-name" class="block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="register-email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="register-email" class="block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="register-address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="register-address" class="block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="register-phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="register-phone" class="block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="register-username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="register-username" class="block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="register-password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="register-password" class="block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <button type="submit" class="w-full bg-black text-white py-2 rounded-md">Register</button>
            </form>
        </div>
    </div>

    <script>
        const loginToggle = document.getElementById('loginToggle');
        const registerToggle = document.getElementById('registerToggle');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');

        // Toggle to show login form and hide register form
        loginToggle.addEventListener('click', () => {
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
            loginToggle.classList.add('toggle-active');
            loginToggle.classList.remove('toggle-inactive');
            registerToggle.classList.remove('toggle-active');
            registerToggle.classList.add('toggle-inactive');
        });

        // Toggle to show register form and hide login form
        registerToggle.addEventListener('click', () => {
            registerForm.classList.remove('hidden');
            loginForm.classList.add('hidden');
            registerToggle.classList.add('toggle-active');
            registerToggle.classList.remove('toggle-inactive');
            loginToggle.classList.remove('toggle-active');
            loginToggle.classList.add('toggle-inactive');
        });
    </script>
</body>
</html>
