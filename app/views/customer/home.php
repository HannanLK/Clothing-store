<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Clothing Store</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Ensure Tailwind CSS is loaded -->
</head>
<body class="bg-gray-100">

    <!-- Banner Section -->
    <header class="bg-cover bg-center h-64" style="background-image: url('/clothing-store/public/images/banner.jpg');">
        <div class="container mx-auto text-center py-20">
            <h1 class="text-5xl font-bold text-white">Welcome to Our Clothing Store</h1>
            <p class="text-xl text-white mt-4">Shop the Latest Trends</p>
        </div>
    </header>

    <div class="container mx-auto p-5">

        <!-- New Arrivals Section -->
        <h2 class="text-3xl font-bold mb-5">New Arrivals</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php 
            // Map category_id to folder names
            $categoryMap = [
                1 => 'mens',
                2 => 'womens',
                3 => 'accessories'
            ];

            foreach ($newArrivals as $product): 
                $categoryFolder = isset($categoryMap[$product['category_id']]) ? $categoryMap[$product['category_id']] : 'unknown';
            ?>
                <div class="product-item bg-white rounded-lg shadow-md p-4">
                    <img src="/clothing-store/public/images/<?= $categoryFolder ?>/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-64 object-cover mb-2 rounded-lg">
                    <p class="font-semibold text-lg"><?= htmlspecialchars($product['name']) ?></p>
                    <p class="text-gray-600">$<?= htmlspecialchars($product['price']) ?></p>
                    <a href="/clothing-store/public/products/<?= $product['id'] ?>" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-3 inline-block">View Product</a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Featured Products Section -->
        <h2 class="text-3xl font-bold my-10">Featured Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($featuredProducts as $product): 
                $categoryFolder = isset($categoryMap[$product['category_id']]) ? $categoryMap[$product['category_id']] : 'unknown';
            ?>
                <div class="product-item bg-white rounded-lg shadow-md p-4">
                    <img src="/clothing-store/public/images/<?= $categoryFolder ?>/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-64 object-cover mb-2 rounded-lg">
                    <p class="font-semibold text-lg"><?= htmlspecialchars($product['name']) ?></p>
                    <p class="text-gray-600">$<?= htmlspecialchars($product['price']) ?></p>
                    <a href="/clothing-store/public/products/<?= $product['id'] ?>" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-3 inline-block">View Product</a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Explore Section (Cards for Blog, Mens, Womens, Accessories) -->
        <h2 class="text-3xl font-bold my-10">Explore</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <!-- Blog Card -->
            <div class="explore-item bg-white rounded-lg shadow-md p-4">
                <img src="/clothing-store/public/images/blog.jpg" alt="Our Blog" class="w-full h-48 object-cover mb-2 rounded-lg">
                <p class="font-semibold text-lg">Our Blog</p>
                <p class="text-gray-600">Latest fashion tips and trends.</p>
                <a href="/clothing-store/public/blog" class="bg-purple-500 text-white px-4 py-2 rounded-md mt-3 inline-block">Read Blog</a>
            </div>

            <!-- Men's Collection Card -->
            <div class="explore-item bg-white rounded-lg shadow-md p-4">
            <img src="/clothing-store/public/images/banners/cardmens.jpg" alt="Men's Collection" class="w-full h-48 object-cover mb-2 rounded-lg">
                <p class="font-semibold text-lg">Men's Collection</p>
                <p class="text-gray-600">Shop the latest men's fashion.</p>
                <a href="/clothing-store/public/products/mens" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-3 inline-block">Shop Mens</a>
            </div>

            <!-- Women's Collection Card -->
            <div class="explore-item bg-white rounded-lg shadow-md p-4">
            <img src="/clothing-store/public/images/banners/cardwomens.jpg" alt="Women's Collection" class="w-full h-48 object-cover mb-2 rounded-lg">
                <p class="font-semibold text-lg">Women's Collection</p>
                <p class="text-gray-600">Shop the latest women's fashion.</p>
                <a href="/clothing-store/public/products/womens" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-3 inline-block">Shop Womens</a>
            </div>

            <!-- Accessories Collection Card -->
            <div class="explore-item bg-white rounded-lg shadow-md p-4">
                <img src="/clothing-store/public/images/banners/cardaccessories.jpg" alt="Accessories" class="w-full h-48 object-cover mb-2 rounded-lg">
                <p class="font-semibold text-lg">Accessories</p>
                <p class="text-gray-600">Complete your look with accessories.</p>
                <a href="/clothing-store/public/products/accessories" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-3 inline-block">Shop Accessories</a>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white py-4 mt-10">
        <div class="container mx-auto text-center">
            <p>&copy; <?= date('Y') ?> Clothing Store. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
