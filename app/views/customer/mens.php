<?php $title = "Mens Collection"; ?>
<div>
    <!-- Banner Image -->
    <div class="relative w-full h-80">
        <img src="<?= BASE_URL ?>images/banners/bannerMens.png" alt="mens banner img" class="w-full h-full object-cover">
        <h1 class="absolute inset-0 flex items-center justify-center text-white text-4xl font-light">
            MENS COLLECTION
        </h1>
        <!-- Sort Options in the bottom right corner -->
        <div class="absolute bottom-5 right-5 flex items-center bg-opacity-70 px-4 py-2 rounded-lg">
            <label for="sortOptions" class="font-semibold mr-3 text-white">SORT BY:</label>
            <select id="sortOptions" class="bg-white border border-gray-300 px-4 py-2 rounded-md">
                <option value="name_asc" <?= isset($sortOption) && $sortOption == 'name_asc' ? 'selected' : '' ?>>Name Ascending</option>
                <option value="name_desc" <?= isset($sortOption) && $sortOption == 'name_desc' ? 'selected' : '' ?>>Name Descending</option>
                <option value="price_asc" <?= isset($sortOption) && $sortOption == 'price_asc' ? 'selected' : '' ?>>Price (Low to High)</option>
                <option value="price_desc" <?= isset($sortOption) && $sortOption == 'price_desc' ? 'selected' : '' ?>>Price (High to Low)</option>
            </select>
        </div>
    </div>

    <div id="main-content" class="container mx-auto p-5">
        
        <hr class=" w-10 border-t-2 border-blue-950 mx-auto mb-2">
        <!-- Retrieving Product as Cards -->
        <div id="productContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="relative product-card rounded-lg p-5">
                        <div class="relative">
                            <img src="<?= BASE_URL ?>images/mens/<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-full object-cover mb-3 rounded-md shadow-md">

                            <!-- Out of Stock Overlay, limited to the image -->
                            <?php if ($product['quantity'] <= 0): ?>
                                <div class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center rounded-lg">
                                    <span class="text-black font-normal text-center text-lg">Will Be <br> Available Soon!</span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold"><?= htmlspecialchars($product['name']) ?></h2>
                            <p class="text-gray-600">$<?= htmlspecialchars($product['price']) ?></p>
                        </div>

                        <!-- Add to Cart Button -->
                        <?php if ($product['quantity'] > 0): ?>
                            <div class="mt-2">
                                <button class="view-product bg-white text-black px-3 py-2 rounded-sm outline outline-1" data-id="<?= $product['id'] ?>">View Product</button>
                                <button class="add-to-cart bg-black text-white px-3 py-2 rounded-sm ml-2" data-id="<?= $product['id'] ?>">Add to Cart</button>
                            </div>
                        <?php else: ?>
                            <button class="bg-gray-400 text-white px-3 py-1 rounded-sm mt-3 w-full cursor-not-allowed" disabled>Out of Stock</button>
                        <?php endif; ?>

                        <!-- Stock notice -->
                        <?php if ($product['quantity'] < 5 && $product['quantity'] > 0): ?>
                            <p class="text-red-500 text-sm mt-2">Only <?= $product['quantity'] ?> left in stock</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Product Modal -->
    <div id="productModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 text-justify">
        <div class="modal-content bg-white mx-auto my-10 p-5 border border-gray-300 rounded-lg max-w-4xl flex">
            <img id="modalProductImage" class="w-1/2 object-cover rounded-lg" src="" alt="Product Image">
            <div class="modal-details w-1/2 pl-5">
                <span class="close text-gray-500 text-2xl font-bold cursor-pointer">&times;</span>
                <h2 id="modalProductName" class="text-xl font-bold mt-3"></h2>
                <p id="modalProductPrice" class="text-gray-600 mt-2"></p>
                <p id="modalProductDescription" class="mt-3"></p>
                <button id="modalAddToCart" class="bg-black text-white px-3 py-3 rounded-sm mt-5">Add to Cart</button>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div id="notification" class="fixed top-20 right-5 bg-orange-500 text-white px-4 py-2 rounded-md hidden">Product added to cart!</div>

    <script>
        // Function to initialize event listeners for View Product and Add to Cart
        function initializeEventListeners() {
            const modal = document.getElementById('productModal');
            const closeModal = document.getElementsByClassName('close')[0];

            document.querySelectorAll('.view-product').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');

                    // Use AJAX to fetch product details
                    fetch(`<?= BASE_URL ?>product/details?id=${productId}`)
                        .then(response => response.json())
                        .then(product => {
                            document.getElementById('modalProductName').innerText = product.name;
                            document.getElementById('modalProductPrice').innerText = `$${product.price}`;
                            document.getElementById('modalProductDescription').innerText = product.description;
                            document.getElementById('modalProductImage').src = `<?= BASE_URL ?>images/mens/${product.image}`;
                            document.getElementById('modalAddToCart').setAttribute('data-id', product.id); // Update product ID for "Add to Cart"
                            modal.classList.remove('hidden');
                        })
                        .catch(error => {
                            console.error('Error fetching product details:', error);
                        });
                });
            });

            closeModal.onclick = function() {
                modal.classList.add('hidden');
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.classList.add('hidden');
                }
            }

            // Add to Cart functionality (AJAX)
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');

                    // Send AJAX request to add product to cart
                    fetch(`<?= BASE_URL ?>cart/addToCart`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `product_id=${productId}`
                    })
                    .then(response => response.text())
                    .then(() => {
                        const notification = document.getElementById('notification');
                        notification.classList.remove('hidden');
                        setTimeout(() => { notification.classList.add('hidden'); }, 2000);
                    });
                });
            });

            document.getElementById('modalAddToCart').addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                fetch(`<?= BASE_URL ?>cart/addToCart`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `product_id=${productId}`
                })
                .then(response => response.text())
                .then(() => {
                    modal.classList.add('hidden');
                    const notification = document.getElementById('notification');
                    notification.classList.remove('hidden');
                    setTimeout(() => { notification.classList.add('hidden'); }, 2000);
                });
            });
        }

        initializeEventListeners();

        // Function to handle sorting and update the same product layout
        document.getElementById('sortOptions').addEventListener('change', function() {
            const sortOption = this.value;
            fetch(`<?= BASE_URL ?>mens?sort=${sortOption}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(products => {
                const productContainer = document.getElementById('productContainer');
                productContainer.innerHTML = '';
                products.forEach(product => {
                    productContainer.innerHTML += `
                        <div class="relative product-card rounded-lg p-5">
                            <div class="relative">
                                <img src="<?= BASE_URL ?>images/mens/${product.image}" alt="${product.name}" class="w-full h-96 object-cover mb-3 rounded-md shadow-md">
                                ${product.quantity <= 0 ? '<div class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center rounded-lg"><span class="text-black font-normal text-center text-lg">Will Be <br> Available Soon!</span></div>' : ''}
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold">${product.name}</h2>
                                <p class="text-gray-600">$${product.price}</p>
                            </div>
                            <div class="mt-2">
                                <button class="view-product bg-white text-black px-3 py-2 rounded-sm outline outline-1" data-id="${product.id}">View Product</button>
                                ${product.quantity > 0 ? `<button class="add-to-cart bg-black text-white px-3 py-2 rounded-sm ml-2" data-id="${product.id}">Add to Cart</button>` : '<button class="bg-gray-400 text-white px-3 py-1 rounded-md mt-3 w-full cursor-not-allowed" disabled>Out of Stock</button>'}
                                ${product.quantity < 5 && product.quantity > 0 ? `<p class="text-red-500 text-sm mt-2">Only ${product.quantity} left in stock</p>` : ''}
                            </div>
                        </div>
                    `;
                });
                initializeEventListeners();
            })
            .catch(error => {
                console.error('Error fetching sorted products:', error);
            });
        });
    </script>
</div>
