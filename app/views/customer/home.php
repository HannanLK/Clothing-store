<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Clothing Store</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Custom styles for the slider */
        .slider {
            position: relative;
            overflow: hidden;
            height: 64vh;
        }
        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .slide {
            min-width: 100%;
            position: relative;
        }
        .slide-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }
        .slide-content h2 {
            font-size: 3rem;
            font-weight: bold;
        }
        .slide-content p {
            font-size: 1.5rem;
            margin: 10px 0;
        }
        .slider-controls {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .slider-controls button {
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
    </style>

</head>
<body class="bg-gray-100">

    <!-- Sliding Banner Section with Unique Content -->
    <header class="slider">
        <div class="slides">
            <!-- Slide 1 -->
            <div class="slide">
                <img src="/clothing-store/public/images/banners/2.png" alt="Banner 1" class="w-max h-full object-contain">
                <div class="slide-content">
                    <h2>New Summer Collection</h2>
                    <p>Discover the latest trends in summer fashion</p>
                    <a href="/clothing-store/public/products/mens" class="bg-blue-500 text-white px-4 py-2 rounded-md">Shop Mens</a>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="slide">
                <img src="/clothing-store/public/images/banners/2.png" alt="Banner 2" class="w-full h-full object-contain">
                <div class="slide-content">
                    <h2>Exclusive Women's Wear</h2>
                    <p>Style that speaks for you</p>
                    <a href="/clothing-store/public/products/womens" class="bg-pink-500 text-white px-4 py-2 rounded-md">Shop Womens</a>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="slide">
                <img src="/clothing-store/public/images/banners/2.png" alt="Banner 3" class="w-full h-full object-cover">
                <div class="slide-content">
                    <h2>Accessories Collection</h2>
                    <p>Complete your look with our premium accessories</p>
                    <a href="/clothing-store/public/products/accessories" class="bg-yellow-500 text-white px-4 py-2 rounded-md">Shop Accessories</a>
                </div>
            </div>
        </div>
        <div class="slider-controls">
            <button id="prev-slide">&lt;</button>
            <button id="next-slide">&gt;</button>
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

    <!-- JavaScript for the Slider -->
    <script>
        let currentIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

        function showSlide(index) {
            const offset = -index * 100;
            document.querySelector('.slides').style.transform = `translateX(${offset}%)`;
        }

        document.getElementById('next-slide').addEventListener('click', function() {
            currentIndex = (currentIndex + 1) % totalSlides;
            showSlide(currentIndex);
        });

        document.getElementById('prev-slide').addEventListener('click', function() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            showSlide(currentIndex);
        });

        // Auto-slide every 5 seconds
        setInterval(function() {
            currentIndex = (currentIndex + 1) % totalSlides;
            showSlide(currentIndex);
        }, 5000);
    </script>
</body>
</html>
