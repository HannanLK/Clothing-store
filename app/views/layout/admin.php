<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="bg-black w-64 min-h-screen text-white">
            <div class="p-5 text-2xl font-semibold border-b border-gray-700">
                <a href="http://localhost/clothing-store/public/admin/dashboard">Admin Panel</a>
            </div>

            <nav class="mt-5">
                <ul class="space-y-2">
                    <li class="border-b border-gray-700">
                        <a href="http://localhost/clothing-store/public/admin/dashboard" class="block px-5 py-3 hover:bg-gray-700 transition">Dashboard</a>
                    </li>
                    <li class="border-b border-gray-700">
                        <a href="http://localhost/clothing-store/public/admin/mens" class="block px-5 py-3 hover:bg-gray-700 transition">Manage Men's Products</a>
                    </li>
                    <li class="border-b border-gray-700">
                        <a href="http://localhost/clothing-store/public/admin/womens" class="block px-5 py-3 hover:bg-gray-700 transition">Manage Women's Products</a>
                    </li>
                    <li class="border-b border-gray-700">
                        <a href="http://localhost/clothing-store/public/admin/accessories" class="block px-5 py-3 hover:bg-gray-700 transition">Manage Accessories</a>
                    </li>
                    <li class="border-b border-gray-700">
                        <a href="http://localhost/clothing-store/public/admin/users" class="block px-5 py-3 hover:bg-gray-700 transition">Manage Users</a>
                    </li>
                    <li class="border-b border-gray-700">
                        <a href="http://localhost/clothing-store/public/admin/blogs" class="block px-5 py-3 hover:bg-gray-700 transition">Manage Blogs</a>
                    </li>
                    <li class="border-b border-gray-700">
                        <a href="http://localhost/clothing-store/public/admin/inquiries" class="block px-5 py-3 hover:bg-gray-700 transition">Manage Inquiries</a>
                    </li>
                    <li class="border-b border-gray-700">
                        <a href="http://localhost/clothing-store/public/logout" class="block px-5 py-3 hover:bg-red-600 transition">Logout</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 p-8">
            <!-- The main content for admin dashboard will go here -->
            <?= $content ?>
        </div>
    </div>
</body>
</html>
