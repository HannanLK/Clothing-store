<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Women's Products</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Tailwind CSS loaded -->
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Manage Women's Products</h1>

        <!-- Add Product Button -->
        <button id="showAddProductForm" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Women's Product</button>
            
        <!-- Sort Dropdown -->
        <select id="sortProducts" class="bg-white border border-gray-300 px-4 py-2 rounded-md">
            <option value="name_asc" <?= isset($data['sortOption']) && $data['sortOption'] == 'name_asc' ? 'selected' : '' ?>>Sort by Name: A to Z</option>
            <option value="name_desc" <?= isset($data['sortOption']) && $data['sortOption'] == 'name_desc' ? 'selected' : '' ?>>Sort by Name: Z to A</option>
            <option value="price_asc" <?= isset($data['sortOption']) && $data['sortOption'] == 'price_asc' ? 'selected' : '' ?>>Sort by Price: Low to High</option>
            <option value="price_desc" <?= isset($data['sortOption']) && $data['sortOption'] == 'price_desc' ? 'selected' : '' ?>>Sort by Price: High to Low</option>
            <option value="date_new" <?= isset($data['sortOption']) && $data['sortOption'] == 'date_new' ? 'selected' : '' ?>>Sort by Date: Newest First</option>
            <option value="date_old" <?= isset($data['sortOption']) && $data['sortOption'] == 'date_old' ? 'selected' : '' ?>>Sort by Date: Oldest First</option>
        </select>

        <!-- Add Product Form (initially hidden) -->
        <div id="addProductForm" class="bg-white p-6 rounded-md shadow-md hidden">
            <h2 class="text-2xl font-semibold mb-4">Add Product</h2>
            <form action="/clothing-store/public/admin/addProduct" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="category" value="womens">

                <label for="name" class="block text-lg font-medium">Product Name:</label>
                <input type="text" id="name" name="name" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"><br>

                <label for="price" class="block text-lg font-medium">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"><br>

                <label for="description" class="block text-lg font-medium">Description:</label>
                <textarea id="description" name="description" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"></textarea><br>

                <label for="image" class="block text-lg font-medium">Product Image:</label>
                <input type="file" id="image" name="image" accept="image/png, image/jpg, image/jpeg" required class="w-full mb-3"><br>

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Add Product</button>
            </form>
        </div>

        <hr class="my-6">

        <!-- Display table of existing women's products -->
        <h2 class="text-2xl font-bold mb-4">Existing Women's Products</h2>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Product ID</th>
                    <th class="px-4 py-2 border">Time Added</th>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Price</th>
                    <th class="px-4 py-2 border">Description</th>
                    <th class="px-4 py-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['products'])): ?>
                    <?php foreach ($data['products'] as $product): ?>
                        <tr id="product-<?= $product['id'] ?>">
                            <td class="border px-4 py-2"><?= $product['id'] ?></td>
                            <td class="border px-4 py-2"><?= $product['created_at'] ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($product['name']) ?></td>
                            <td class="border px-4 py-2">$<?= htmlspecialchars($product['price']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($product['description']) ?></td>
                            <td class="border px-4 py-2">
                                <button class="view-product bg-blue-500 text-white px-2 py-1 rounded-md" data-id="<?= $product['id'] ?>">View</button>
                                <button class="edit-product bg-yellow-500 text-white px-2 py-1 rounded-md ml-2" data-id="<?= $product['id'] ?>">Edit</button>
                                <button class="delete-product bg-red-500 text-white px-2 py-1 rounded-md ml-2" data-id="<?= $product['id'] ?>">Delete</button>
                            </td>
                        </tr>

                        <!-- Edit Form inside the card (initially hidden) -->
                        <tr id="edit-form-<?= $product['id'] ?>" class="hidden">
                            <td colspan="6">
                                <form action="/clothing-store/public/admin/editProduct" method="POST" enctype="multipart/form-data" class="bg-gray-100 p-4 rounded-lg">
                                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                    <label for="name">Product Name:</label>
                                    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"><br>
                                    
                                    <label for="price">Price:</label>
                                    <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"><br>

                                    <label for="description">Description:</label>
                                    <textarea name="description" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"><?= htmlspecialchars($product['description']) ?></textarea><br>

                                    <label for="image">Update Image:</label>
                                    <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" class="w-full mb-3"><br>

                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Save Changes</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="border px-4 py-2">No products found in this category.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <hr class="my-6">

        <!-- Display products in a grid (4 products per row) -->
        <h2 class="text-2xl font-bold mb-4">Product Details</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php if (!empty($data['products'])): ?>
                <?php foreach ($data['products'] as $product): ?>
                    <div class="product-item bg-white rounded-lg shadow-md p-2" id="product-details-<?= $product['id'] ?>">
                        <strong class="text-lg font-semibold"><?= htmlspecialchars($product['name']) ?></strong><br>
                        <img src="/clothing-store/public/images/womens/<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-64 object-cover rounded-lg mb-2"><br>
                        <span class="text-gray-700">$<?= htmlspecialchars($product['price']) ?></span><br>
                        <p class="text-gray-600 text-sm mb-2"><?= htmlspecialchars($product['description']) ?></p><br>
                        <button class="edit-product bg-yellow-500 text-white px-2 py-1 rounded-md" data-id="<?= $product['id'] ?>">Edit</button>
                        <button class="delete-product bg-red-500 text-white px-2 py-1 rounded-md ml-2" data-id="<?= $product['id'] ?>">Delete</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found in this category.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- JavaScript to toggle the visibility of the form and scroll to the product -->
    <script>
        document.getElementById('showAddProductForm').addEventListener('click', function() {
            var form = document.getElementById('addProductForm');
            form.classList.toggle('hidden');
        });

        // Toggle the edit form when the Edit button is clicked
        document.querySelectorAll('.edit-product').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                const editForm = document.getElementById(`edit-form-${productId}`);
                editForm.classList.toggle('hidden'); // Show or hide the edit form
            });
        });

        // Delete product with confirmation
        document.querySelectorAll('.delete-product').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                if (confirm("Are you sure you want to delete this product?")) {
                    window.location.href = `/clothing-store/public/admin/deleteProduct?id=${productId}`;
                }
            });
        });

        // Scroll to the relevant product details when the view button is clicked
        document.querySelectorAll('.view-product').forEach(button => {
            button.addEventListener('click', function() {
                var productId = this.getAttribute('data-id');
                var productDetails = document.getElementById('product-details-' + productId);
                if (productDetails) {
                    productDetails.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Sorting logic
        document.getElementById('sortProducts').addEventListener('change', function() {
            const selectedSort = this.value;
            window.location.href = `/clothing-store/public/admin/womens?sort=${selectedSort}`;
        });
    </script>
</body>
</html>
