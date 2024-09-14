<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Admin Dashboard</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Mens Products Management -->
            <a href="/clothing-store/public/admin/mens" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md text-center">
                Manage Men's Products
            </a>

            <!-- Womens Products Management -->
            <a href="/clothing-store/public/admin/womens" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md text-center">
                Manage Women's Products
            </a>

            <!-- Accessories Products Management -->
            <a href="/clothing-store/public/admin/accessories" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md text-center">
                Manage Accessories
            </a>

            <!-- Users Management -->
            <a href="/clothing-store/public/admin/users" class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md text-center">
                Manage Users
            </a>

            <!-- Blogs Management -->
            <a href="/clothing-store/public/admin/blogs" class="bg-purple-500 text-white px-4 py-2 rounded-md shadow-md text-center">
                Manage Blogs
            </a>

            <!-- Add more links as needed -->
        </div>
    </div>

</body>
</html>
