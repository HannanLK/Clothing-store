<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glitz Clothing Store</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navigation Bar -->
    <div class="bg-black fixed top-0 w-full z-50">
        <div class="container mx-auto flex items-center justify-between px-8 py-2">
            <div class="logo">
                <a href="<?= BASE_URL ?>"><img src="<?= BASE_URL ?>images/logos/logoWhite.png" alt="Logo" class="h-11"></a>
            </div>
            <nav>
                <ul class="flex space-x-8 text-white">
                    <li><a href="<?= BASE_URL ?>" class="hover:text-gray-300">HOME</a></li>
                    <li><a href="<?= BASE_URL ?>mens" class="hover:text-gray-300">MEN'S</a></li>
                    <li><a href="<?= BASE_URL ?>womens" class="hover:text-gray-300">WOMEN'S</a></li>
                    <li><a href="<?= BASE_URL ?>accessories" class="hover:text-gray-300">ACCESSORIES</a></li>
                    <li><a href="<?= BASE_URL ?>blogs" class="hover:text-gray-300">BLOG</a></li>
                    <li><a href="<?= BASE_URL ?>contact" class="hover:text-gray-300">CONTACT</a></li>
                    <li><a href="<?= BASE_URL ?>profile" class="hover:text-gray-300"><i class="fa-regular fa-circle-user fa-lg"></i></a></li>
                    <li><a href="<?= BASE_URL ?>cart" class="hover:text-gray-300"><i class="fa-solid fa-cart-shopping fa-lg"></i></a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-grow mt-14">
        <!-- Content from specific views will be rendered here -->
        <?= $content ?>
    </div>

    <!-- Footer Section -->
    <footer class="bg-black text-white mt-16">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-6 py-6">
            <div>
                <a href="<?= BASE_URL ?>"><img src="<?= BASE_URL ?>images/logos/logoWhite.png" alt="Glitz Logo" class="w-56 pt-8"></a>
            </div>
            <div>
                <p><strong>Store Address:</strong> 388, Union Place, Colombo 02</p>
                <p><strong>Phone:</strong> +94768535555</p>
                <p><strong>Email:</strong> CB011253@students.apiit.lk</p>
                <p><strong>Opening Hours:</strong> Mon-Fri 9:00 AM - 6:00 PM, Sat 9:00 AM - 2:00 PM</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Quick Links</h2>
                <a href="<?= BASE_URL ?>mens" class="hover:underline">Men's</a><br>
                <a href="<?= BASE_URL ?>womens" class="hover:underline">Women's</a><br>
                <a href="<?= BASE_URL ?>accessories" class="hover:underline">Accessories</a><br>
                <a href="<?= BASE_URL ?>blogs" class="hover:underline">Blog</a><br>
                <a href="<?= BASE_URL ?>contact" class="hover:underline">Contact</a>
            </div>
            <div>
                <h2 class="font-semibold text-lg">Newsletter</h2>
                <input type="email" placeholder="Your email" class="w-full p-2 bg-gray-800 border-b border-white outline-none">
                <button class="bg-white text-black p-2 mt-2 rounded-lg hover:bg-gray-200">Subscribe</button>
                <div class="flex space-x-4 mt-4">
                    <a href="https://www.instagram.com/hannan.lk/" class="hover:underline">Instagram</a>
                    <a href="https://x.com/hannanmunas" class="hover:underline">Twitter</a>
                    <a href="https://www.linkedin.com/in/hannan76/" class="hover:underline">LinkedIn</a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-600 py-2 flex justify-between items-center">
            <p>&copy; 2024 Glitz. All rights reserved.</p>
            <p>Designed by <a href="https://www.linkedin.com/in/hannan76/" class="hover:underline">Hannan Munas</a></p>
        </div>
    </footer>

</body>
</html>
