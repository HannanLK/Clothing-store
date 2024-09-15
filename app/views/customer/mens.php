<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mens Products</title>
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
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 800px;
            display: flex;
            border-radius: 10px;
        }
        .modal-content img {
            max-width: 300px;
            margin-right: 20px;
            border-radius: 8px;
        }
        .modal-content .info {
            flex: 1;
        }
        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 28px;
            color: #aaa;
            cursor: pointer;
        }
        .close:hover {
            color: black;
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
        <h1 class="text-3xl font-bold mb-5">Men's Products</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card bg-white rounded-lg shadow-md p-5">
                        <img src="/clothing-store/public/images/mens/<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-48 object-cover mb-3">
                        <h2 class="text-xl font-semibold"><?= htmlspecialchars($product['name']) ?></h2>
                        <p class="text-gray-600">$<?= htmlspecialchars($product['price']) ?></p>
                        
                        <!-- Stock notice -->
                        <?php if ($product['quantity'] < 5): ?>
                            <p class="text-red-500 text-sm mt-2">Only <?= $product['quantity'] ?> left in stock</p>
                        <?php endif; ?>

                        <div class="mt-3">
                            <button class="view-product bg-blue-500 text-white px-3 py-1 rounded-md" 
                                data-id="<?= $product['id'] ?>"
                                data-name="<?= htmlspecialchars($product['name']) ?>"
                                data-price="<?= htmlspecialchars($product['price']) ?>"
                                data-description="<?= htmlspecialchars($product['description']) ?>"
                                data-image="<?= $product['image'] ?>">
                                View Product
                            </button>
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
            <span class="close">&times;</span>
            <img id="modalImage" src="" alt="Product Image">
            <div class="info">
                <h2 id="modalName" class="text-2xl font-bold mb-3"></h2>
                <p id="modalPrice" class="text-xl mb-3"></p>
                <p id="modalDescription" class="text-gray-600"></p>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div id="notification">Product added to cart!</div>

    <script>
        // Modal functionality
        const modal = document.getElementById('productModal');
        const modalImage = document.getElementById('modalImage');
        const modalName = document.getElementById('modalName');
        const modalPrice = document.getElementById('modalPrice');
        const modalDescription = document.getElementById('modalDescription');
        const closeModal = document.getElementsByClassName('close')[0];

        document.querySelectorAll('.view-product').forEach(button => {
            button.addEventListener('click', function() {
                // Set the modal content with product details
                const productName = this.getAttribute('data-name');
                const productPrice = this.getAttribute('data-price');
                const productDescription = this.getAttribute('data-description');
                const productImage = this.getAttribute('data-image');

                modalName.textContent = productName;
                modalPrice.textContent = `Price: $${productPrice}`;
                modalDescription.textContent = `About the product: ${productDescription}`;
                modalImage.src = `/clothing-store/public/images/mens/${productImage}`;

                // Show the modal
                modal.style.display = 'block';
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
    </script>
</body>
</html>
