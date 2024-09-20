<script src="https://cdn.tailwindcss.com"></script>
<div>
    <!-- Sliding Banner Section -->
    <header class="relative overflow-hidden w-full h-80 slider">
        <div class="slides flex transition-transform duration-500 ease-in-out">
            <!-- Slide 1 -->
            <div class="min-w-full relative slide">
                <img src="<?= BASE_URL ?>images/banners/bannerHomeMens.png" alt="Banner 1" class="w-full h-full object-cover">
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center text-white">
                    <h2 class="text-5xl font-light text-sky-950 mb-6">Exclusive Men's Wear</h2>
                    <a href="<?= BASE_URL ?>/mens" class="bg-sky-900 text-white px-4 py-2 rounded-sm">Shop Mens</a>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="min-w-full relative slide">
                <img src="<?= BASE_URL ?>images/banners/bannerHome2.png" alt="Banner 2" class="w-full h-full object-cover">
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center">
                    <h2 class="text-5xl font-light mb-6 text-pink-800">Exclusive Women's Wear</h2>
                    <a href="<?= BASE_URL ?>/womens" class="bg-pink-500 text-white px-4 py-2 rounded-sm mb-2">Shop Women's</a>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="min-w-full relative slide">
                <img src="<?= BASE_URL ?>images/banners/bannerHome3.png" alt="Banner 3" class="w-full h-full object-cover">
                <div class="absolute top-1/2 left-2/3 transform -translate-x-1/2 -translate-y-1/2">
                    <h2 class="text-5xl font-light mb-6 text-emerald-700">Exclusive Accessories</h2>
                    <a href="<?= BASE_URL ?>/accessories" class="bg-emerald-800 text-white px-4 py-2 rounded-sm">Shop Accessories</a>
                </div>
            </div>
        </div>
        <div class="absolute inset-y-1/2 flex justify-between w-full items-center">
            <button id="prev-slide" class="bg-black bg-opacity-50 text-white p-3 rounded-md">&lt;</button>
            <button id="next-slide" class="bg-black bg-opacity-50 text-white p-3 rounded-md">&gt;</button>
        </div>
    </header>

    <div class="container mx-auto p-5">
        <!-- New Arrivals Section -->
        <h2 class="text-3xl font-bold mb-3 text-center mt-2">NEW ARRIVALS</h2>
        <hr class=" w-10 border-t-2 border-blue-950 mx-auto mb-2">
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
                <div class="relative product-card rounded-lg p-5">
                    <img src="<?= BASE_URL ?>images/<?= $categoryFolder ?>/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-80 object-cover mb-3 rounded-md shadow-md">
                    <p class="font-semibold text-lg"><?= htmlspecialchars($product['name']) ?></p>
                    <p class="text-gray-600">$<?= htmlspecialchars($product['price']) ?></p>
                    <button class="view-product bg-white text-black px-3 py-2 rounded-sm outline outline-1" data-id="<?= $product['id'] ?>">View Product</button>
                    <button class="add-to-cart bg-black text-white px-3 py-2 rounded-sm ml-2 mt-2" data-id="<?= $product['id'] ?>">Add to Cart</button>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Featured Products Section -->
        <h2 class="text-3xl font-bold my-3 text-center pt-2">FEATURED PRODUCTS</h2>
        <hr class=" w-10 border-t-2 border-blue-950 mx-auto mb-2">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($featuredProducts as $product): 
                $categoryFolder = isset($categoryMap[$product['category_id']]) ? $categoryMap[$product['category_id']] : 'unknown';
            ?>
                <div class="relative product-card rounded-lg p-5">
                    <img src="<?= BASE_URL ?>images/<?= $categoryFolder ?>/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-80 object-cover mb-3 rounded-md shadow-md">
                    <p class="font-semibold text-lg"><?= htmlspecialchars($product['name']) ?></p>
                    <p class="text-gray-600">$<?= htmlspecialchars($product['price']) ?></p>
                    <button class="view-product bg-white text-black px-3 py-2 rounded-sm outline outline-1" data-id="<?= $product['id'] ?>">View Product</button>
                    <button class="add-to-cart bg-black text-white px-3 py-2 rounded-sm ml-2 mt-2" data-id="<?= $product['id'] ?>">Add to Cart</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Product Modal -->
    <div id="productModal" class="fixed hidden inset-0 bg-black bg-opacity-50 items-center justify-center">
        <div class="bg-white p-5 border border-gray-300 rounded-lg max-w-md w-full flex">
            <img id="modalProductImage" class="w-1/2 rounded-lg object-cover" src="" alt="Product Image">
            <div class="ml-4 w-1/2">
                <span class="close text-gray-500 hover:text-black text-2xl font-bold cursor-pointer">&times;</span>
                <h2 id="modalProductName" class="text-xl font-bold"></h2>
                <p id="modalProductPrice" class="text-gray-600"></p>
                <p id="modalProductDescription" class="my-2"></p>
                <button id="modalAddToCart" class="bg-green-500 text-white px-4 py-2 rounded-md mt-3">Add to Cart</button>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div id="notification" class="fixed top-20 right-5 bg-orange-500 text-white px-4 py-2 rounded-md hidden">Product added to cart!</div>

    <script>
        function initializeEventListeners() {
            const modal = document.getElementById('productModal');
            const closeModal = document.getElementsByClassName('close')[0];

            // Handle View Product button click
            document.querySelectorAll('.view-product').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');

                    fetch('<?= BASE_URL ?>product/details?id=' + productId)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error fetching product details.');
                            }
                            return response.json();
                        })
                        .then(product => {
                            const categoryMap = {
                                1: 'mens',
                                2: 'womens',
                                3: 'accessories'
                            };

                            const categoryFolder = categoryMap[product.category_id] || 'unknown';
                            const imagePath = '<?= BASE_URL ?>images/' + categoryFolder + '/' + product.image;

                            document.getElementById('modalProductName').innerText = product.name;
                            document.getElementById('modalProductPrice').innerText = '$' + product.price;
                            document.getElementById('modalProductDescription').innerText = product.description;
                            document.getElementById('modalProductImage').src = imagePath;

                            modal.classList.remove('hidden');
                            modal.classList.add('flex');
                        })
                        .catch(error => {
                            alert(error.message);
                            console.error('Error fetching product details:', error);
                        });
                });
            });

            closeModal.onclick = function() {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }
            }

    // Function to initialize event listeners for Add to Cart functionality
    function initializeAddToCartListeners() {
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');

                    // Send AJAX request to add product to cart
                    fetch('/clothing-store/public/cart/addToCart', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `product_id=${productId}`
                    })
                    .then(response => response.text())
                    .then(() => {
                        // Show notification
                        const notification = document.getElementById('notification');
                        notification.classList.remove('hidden');
                        setTimeout(() => { notification.classList.add('hidden'); }, 2000);
                    })
                    .catch(error => {
                        console.error('Error adding product to cart:', error);
                    });
                });
            });
        }

        // Call this function after loading the page or updating the DOM
        initializeAddToCartListeners();

            document.getElementById('modalAddToCart').addEventListener('click', function() {
                const productId = this.getAttribute('data-id');

                fetch('<?= BASE_URL ?>cart/addToCart', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'product_id=' + productId
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error adding product to cart.');
                    }
                    return response.text();
                })
                .then(() => {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');

                    const notification = document.getElementById('notification');
                    notification.classList.remove('hidden');
                    setTimeout(() => { notification.classList.add('hidden'); }, 2000);
                })
                .catch(error => {
                    alert(error.message);
                    console.error('Error adding product to cart:', error);
                });
            });
        }

        initializeEventListeners();

        // Slider Functionality
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
</div>
