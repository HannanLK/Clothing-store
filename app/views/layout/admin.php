<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Toggle sidebar for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100">
    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar (fixed) -->
        <aside id="sidebar" class="bg-black w-64 min-h-screen text-white fixed top-0 left-0 z-50 hidden md:block">
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

        <!-- Hamburger button for mobile -->
        <div class="md:hidden p-4 bg-black text-white fixed top-0 left-0 z-50">
            <button onclick="toggleSidebar()" class="focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 p-8 ml-0 md:ml-64">
            <!-- The main content for admin dashboard will go here -->
            <?= $content ?>
        </div>
    </div>
</body>
</html>
