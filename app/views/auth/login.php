<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-5 max-w-md">
        <h1 class="text-3xl font-bold mb-5 text-center">Login</h1>
        <?php if (isset($data['error'])): ?>
            <p class="text-red-500 mb-3"><?= $data['error']; ?></p>
        <?php endif; ?>
        <form action="/clothing-store/public/login/login" method="POST">
            <label for="username" class="block mb-2">Username:</label>
            <input type="text" id="username" name="username" required class="w-full mb-3 p-2 border border-gray-300 rounded-lg">
            
            <label for="password" class="block mb-2">Password:</label>
            <input type="password" id="password" name="password" required class="w-full mb-3 p-2 border border-gray-300 rounded-lg">
            
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg">Login</button>
        </form>
    </div>
</body>
</html>
