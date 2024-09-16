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

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            display: flex;
        }
        .modal-content img {
            width: 50%;
            object-fit: cover;
            border-radius: 10px;
        }
        .modal-details {
            width: 50%;
            padding-left: 20px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Notification style */
        #notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            display: none;
        }
    </style>

</head>
<body class="bg-gray-100">

    <!-- Sliding Banner Section -->
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
                    <button class="view-product bg-blue-500 text-white px-4 py-2 rounded-md mt-3" data-id="<?= $product['id'] ?>">View Product</button>
                    <button class="add-to-cart bg-green-500 text-white px-4 py-2 rounded-md mt-3" data-id="<?= $product['id'] ?>">Add to Cart</button>
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
                    <button class="view-product bg-blue-500 text-white px-4 py-2 rounded-md mt-3" data-id="<?= $product['id'] ?>">View Product</button>
                    <button class="add-to-cart bg-green-500 text-white px-4 py-2 rounded-md mt-3" data-id="<?= $product['id'] ?>">Add to Cart</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Product Modal -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <img id="modalProductImage" src="" alt="Product Image">
            <div class="modal-details">
                <span class="close">&times;</span>
                <h2 id="modalProductName" class="text-xl font-bold"></h2>
                <p id="modalProductPrice" class="text-gray-600"></p>
                <p id="modalProductDescription"></p>
                <button id="modalAddToCart" class="bg-green-500 text-white px-4 py-2 rounded-md mt-3">Add to Cart</button>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div id="notification">Product added to cart!</div>

    <script>
        function initializeEventListeners() {
            const modal = document.getElementById('productModal');
            const closeModal = document.getElementsByClassName('close')[0];

            document.querySelectorAll('.view-product').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');

                    fetch(`/clothing-store/public/product/details?id=${productId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error fetching product details.');
                            }
                            return response.json();
                        })
                        .then(product => {
                            document.getElementById('modalProductName').innerText = product.name;
                            document.getElementById('modalProductPrice').innerText = `$${product.price}`;
                            document.getElementById('modalProductDescription').innerText = product.description;
                            document.getElementById('modalProductImage').src = `/clothing-store/public/images/${product.category}/${product.image}`;
                            document.getElementById('modalAddToCart').setAttribute('data-id', product.id);
                            modal.style.display = 'block';
                        })
                        .catch(error => {
                            alert(error.message);
                            console.error('Error fetching product details:', error);
                        });
                });
            });

            closeModal.onclick = function() {
                modal.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }

            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');

                    fetch(`/clothing-store/public/cart/addToCart`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `product_id=${productId}`
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error adding product to cart.');
                        }
                        return response.text();
                    })
                    .then(() => {
                        const notification = document.getElementById('notification');
                        notification.style.display = 'block';
                        setTimeout(() => { notification.style.display = 'none'; }, 2000);
                    })
                    .catch(error => {
                        alert(error.message);
                        console.error('Error adding product to cart:', error);
                    });
                });
            });

            document.getElementById('modalAddToCart').addEventListener('click', function() {
                const productId = this.getAttribute('data-id');

                fetch(`/clothing-store/public/cart/addToCart`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `product_id=${productId}`
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error adding product to cart.');
                    }
                    return response.text();
                })
                .then(() => {
                    modal.style.display = 'none';

                    const notification = document.getElementById('notification');
                    notification.style.display = 'block';
                    setTimeout(() => { notification.style.display = 'none'; }, 2000);
                })
                .catch(error => {
                    alert(error.message);
                    console.error('Error adding product to cart:', error);
                });
            });
        }

        initializeEventListeners();

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

        setInterval(function() {
            currentIndex = (currentIndex + 1) % totalSlides;
            showSlide(currentIndex);
        }, 5000);
    </script>
</body>
</html>
