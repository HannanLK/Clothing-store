<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Glitz Clothing Store' ?></title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navigation Bar -->
    <header class="bg-black fixed top-0 w-full z-50">
        <div class="container mx-auto flex items-center justify-between px-8 py-2">
            <div class="logo">
                <a href="<?= BASE_URL ?>"><img src="<?= BASE_URL ?>images/logos/logoWhite.png" alt="Logo" class="w-40 my-2"></a>
            </div>

            <!-- Hamburger Menu for mobile -->
            <button id="menu-btn" class="block md:hidden text-white focus:outline-none">
                <i class="fa fa-bars fa-lg"></i>
            </button>

            <!-- Navigation Menu -->
            <nav id="menu" class="hidden md:flex space-x-8 text-white">
                <ul class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-8">
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
    </header>

    <!-- Main Content -->
    <div class="flex-grow mt-20 md:mt-14">
        <!-- Content from specific views will be rendered here -->
        <?= $content ?>
    </div>

    <!-- Footer Section -->
    <footer class="bg-black text-white py-6 mt-auto">
        <div class="container mx-auto px-4 max-w-screen-xl grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left Section: Store Info and Logo -->
            <div class="flex flex-col">
                <a href="<?= BASE_URL ?>">
                    <img src="<?= BASE_URL ?>images/logos/logoWhite.png" alt="Glitz Logo" class="w-40 mb-3">
                </a>
                <p>Where style meets elegance.</p>
                <br>
                <p>388, Union Place, Colombo 02<br> +94768535555</p>
                <br>
                <p>CB011253@students.apiit.lk</p>
            </div>

            <!-- Middle Section: Quick Links -->
            <div class="flex flex-col">
                <h2 class="text-lg font-semibold mb-3">Quick Links</h2>
                <ul class="space-y-2">
                    <li><a href="<?= BASE_URL ?>mens" class="hover:underline">Men's</a></li>
                    <li><a href="<?= BASE_URL ?>womens" class="hover:underline">Women's</a></li>
                    <li><a href="<?= BASE_URL ?>accessories" class="hover:underline">Accessories</a></li>
                    <li><a href="<?= BASE_URL ?>blogs" class="hover:underline">Blog</a></li>
                    <li><a href="<?= BASE_URL ?>contact" class="hover:underline">Contact</a></li>
                </ul>
            </div>

            <!-- Right Section: Newsletter and Social Media -->
            <div>
                <h2 class="text-lg font-semibold mb-3">Newsletter</h2>
                <p class="mb-2">Signup to our Newsletter.</p>
                <form class="flex flex-col space-y-2">
                    <input type="email" placeholder="Your email" class="w-full p-2 bg-gray-800 text-white border-b border-gray-500 focus:outline-none">
                    <button type="submit" class="bg-white text-black px-4 py-2 rounded-lg hover:bg-gray-200">Subscribe</button>
                </form>
                <div class="flex space-x-4 mt-4">
                    <a href="https://www.instagram.com/hannan.lk/" class="hover:underline">Instagram</a>
                    <a href="https://x.com/hannanmunas" class="hover:underline">Twitter</a>
                    <a href="https://www.linkedin.com/in/hannan76/" class="hover:underline">LinkedIn</a>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-600 mt-4 flex flex-col md:flex-row justify-between items-center max-w-screen-xl mx-auto px-4">
            <p class="text-center md:text-left">&copy; 2024 Glitz. All rights reserved.</p>
            <p class="text-center md:text-right">Designed by <a href="https://www.linkedin.com/in/hannan76/" class="hover:underline">Hannan Munas</a></p>
        </div>
    </footer>

    <!-- Script for Hamburger Menu -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const menu = document.getElementById('menu');

        menuBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
