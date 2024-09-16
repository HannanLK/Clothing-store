<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessories Products</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Tailwind CSS -->
    <style>
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

    <div id="main-content" class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Accessories Products</h1>

        <!-- Sort Options -->
        <div class="mb-5">
            <label for="sortOptions" class="font-semibold mr-3">Sort by:</label>
            <select id="sortOptions" class="bg-white border border-gray-300 px-4 py-2 rounded-md">
                <option value="name_asc">Name (A-Z)</option>
                <option value="name_desc">Name (Z-A)</option>
                <option value="price_asc">Price (Low to High)</option>
                <option value="price_desc">Price (High to Low)</option>
            </select>
        </div>

        <div id="productContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card bg-white rounded-lg shadow-md p-5">
                        <img src="/clothing-store/public/images/accessories/<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-48 object-cover mb-3">
                        <h2 class="text-xl font-semibold"><?= htmlspecialchars($product['name']) ?></h2>
                        <p class="text-gray-600">$<?= htmlspecialchars($product['price']) ?></p>
                        
                        <!-- Stock notice -->
                        <?php if ($product['quantity'] < 5): ?>
                            <p class="text-red-500 text-sm mt-2">Only <?= $product['quantity'] ?> left in stock</p>
                        <?php endif; ?>

                        <div class="mt-3">
                            <button class="view-product bg-blue-500 text-white px-3 py-1 rounded-md" data-id="<?= $product['id'] ?>">View Product</button>
                            <button class="add-to-cart bg-green-500 text-white px-3 py-1 rounded-md ml-2" data-id="<?= $product['id'] ?>">Add to Cart</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
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
            // Modal functionality
            const modal = document.getElementById('productModal');
            const closeModal = document.getElementsByClassName('close')[0];

            document.querySelectorAll('.view-product').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');

                    // Use AJAX to fetch product details
                    fetch(`/clothing-store/public/product/details?id=${productId}`)
                        .then(response => response.json())
                        .then(product => {
                            document.getElementById('modalProductName').innerText = product.name;
                            document.getElementById('modalProductPrice').innerText = `$${product.price}`;
                            document.getElementById('modalProductDescription').innerText = product.description;
                            document.getElementById('modalProductImage').src = `/clothing-store/public/images/accessories/${product.image}`;
                            document.getElementById('modalAddToCart').setAttribute('data-id', product.id); // Update product ID for "Add to Cart"
                            modal.style.display = 'block';
                        })
                        .catch(error => {
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

            // Add to Cart functionality (AJAX)
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');

                    // Send AJAX request to add product to cart
                    fetch(`/clothing-store/public/cart/addToCart`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `product_id=${productId}`
                    })
                    .then(response => response.text())
                    .then(() => {
                        // Show notification
                        const notification = document.getElementById('notification');
                        notification.style.display = 'block';
                        setTimeout(() => { notification.style.display = 'none'; }, 2000);
                    });
                });
            });

            // Add to Cart button in Modal
            document.getElementById('modalAddToCart').addEventListener('click', function() {
                const productId = this.getAttribute('data-id');

                // Send AJAX request to add product to cart from modal
                fetch(`/clothing-store/public/cart/addToCart`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `product_id=${productId}`
                })
                .then(response => response.text())
                .then(() => {
                    const notification = document.getElementById('notification');
                    notification.style.display = 'block';
                    setTimeout(() => { notification.style.display = 'none'; }, 2000);
                });

                // Close the modal
                modal.style.display = 'none';
            });
        }

        // Initialize event listeners on page load
        document.addEventListener('DOMContentLoaded', () => {
            initializeEventListeners();

            // Handle sort functionality
            document.getElementById('sortOptions').addEventListener('change', function() {
                const sortOption = this.value;

                fetch(`/clothing-store/public/accessories?sort=${sortOption}`)
                    .then(response => response.json())
                    .then(products => {
                        const productContainer = document.getElementById('productContainer');
                        productContainer.innerHTML = ''; // Clear the existing products
                        
                        products.forEach(product => {
                            productContainer.innerHTML += `
                                <div class="product-card bg-white rounded-lg shadow-md p-5">
                                    <img src="/clothing-store/public/images/accessories/${product.image}" alt="${product.name}" class="w-full h-48 object-cover mb-3">
                                    <h2 class="text-xl font-semibold">${product.name}</h2>
                                    <p class="text-gray-600">$${product.price}</p>
                                    ${product.quantity < 5 ? `<p class="text-red-500 text-sm mt-2">Only ${product.quantity} left in stock</p>` : ''}
                                    <div class="mt-3">
                                        <button class="view-product bg-blue-500 text-white px-3 py-1 rounded-md" data-id="${product.id}">View Product</button>
                                        <button class="add-to-cart bg-green-500 text-white px-3 py-1 rounded-md ml-2" data-id="${product.id}">Add to Cart</button>
                                    </div>
                                </div>
                            `;
                        });

                        // Re-initialize event listeners for the newly added elements
                        initializeEventListeners();
                    })
                    .catch(error => {
                        console.error('Error fetching sorted products:', error);
                    });
            });
        });
    </script>
</body>
</html>
