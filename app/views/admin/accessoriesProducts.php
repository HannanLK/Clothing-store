<div>
    <div id="main-content" class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Manage Accessories Products</h1>

        <!-- Add Product Button -->
        <button id="showAddProductForm" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-5">Add Accessories Product</button>

        <!-- Sort Dropdown -->
        <select id="sortProducts" class="bg-white border border-gray-300 px-4 py-2 rounded-md">
            <option value="name_asc" <?= isset($data['sortOption']) && $data['sortOption'] == 'name_asc' ? 'selected' : '' ?>>Sort by Name: A to Z</option>
            <option value="name_desc" <?= isset($data['sortOption']) && $data['sortOption'] == 'name_desc' ? 'selected' : '' ?>>Sort by Name: Z to A</option>
            <option value="price_asc" <?= isset($data['sortOption']) && $data['sortOption'] == 'price_asc' ? 'selected' : '' ?>>Sort by Price: Low to High</option>
            <option value="price_desc" <?= isset($data['sortOption']) && $data['sortOption'] == 'price_desc' ? 'selected' : '' ?>>Sort by Price: High to Low</option>
            <option value="date_new" <?= isset($data['sortOption']) && $data['sortOption'] == 'date_new' ? 'selected' : '' ?>>Sort by Date: Newest First</option>
            <option value="date_old" <?= isset($data['sortOption']) && $data['sortOption'] == 'date_old' ? 'selected' : '' ?>>Sort by Date: Oldest First</option>
        </select>

        <!-- Stock Filter Buttons -->
        <button id="filterInStock" class="bg-green-500 text-white px-4 py-2 rounded-md ml-2">In Stock</button>
        <button id="filterOutOfStock" class="bg-red-500 text-white px-4 py-2 rounded-md ml-2">Out of Stock</button>

        <!-- Add Product Form (initially hidden) -->
        <div id="addProductForm" class="bg-white p-6 rounded-md shadow-md hidden mt-6">
            <h2 class="text-2xl font-semibold mb-4">Add Product</h2>
            <form action="<?= BASE_URL ?>admin/addProduct" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="category" value="accessories">

                <label for="name" class="block text-lg font-medium">Product Name:</label>
                <input type="text" id="name" name="name" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">

                <label for="price" class="block text-lg font-medium">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">

                <label for="quantity" class="block text-lg font-medium">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="0" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">

                <label for="description" class="block text-lg font-medium">Description:</label>
                <textarea id="description" name="description" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"></textarea>

                <label for="image" class="block text-lg font-medium">Product Image:</label>
                <input type="file" id="image" name="image" accept="image/png, image/jpg, image/jpeg" required class="w-full mb-3">

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Add Product</button>
            </form>
        </div>

        <hr class="my-6">

        <!-- Display table of existing accessories products -->
        <h2 class="text-2xl font-bold mb-4">Existing Accessories Products</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Product ID</th>
                        <th class="px-4 py-2 border">Time Added</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Price</th>
                        <th class="px-4 py-2 border">Quantity</th>
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
                                <td class="border px-4 py-2"><?= htmlspecialchars($product['quantity']) ?></td>
                                <td class="border px-4 py-2">
                                    <button class="view-product bg-blue-500 text-white px-3 py-2 rounded-md" data-id="<?= $product['id'] ?>">View</button>
                                    <button class="edit-product bg-yellow-500 text-white px-3 py-2 rounded-md ml-2" data-id="<?= $product['id'] ?>">Edit</button>
                                    <button class="delete-product bg-red-500 text-white px-3 py-2 rounded-md ml-2" data-id="<?= $product['id'] ?>">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="border px-4 py-2">No products found in this category.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Viewing and Editing Products -->
    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-4xl">
                <div class="flex">
                    <!-- Left side: Product Image -->
                    <div class="w-1/3">
                        <img id="productImage" src="" alt="Product Image" class="w-full h-auto object-cover">
                    </div>
                    <!-- Right side: Form -->
                    <div id="productFormContent" class="w-2/3 ml-4"></div>
                </div>
                <div class="flex justify-end gap-2 mt-4">
                    <button id="closeModal" class="bg-red-500 text-white px-4 py-2 rounded-md">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show Add Product form
        document.getElementById('showAddProductForm').addEventListener('click', function() {
            var form = document.getElementById('addProductForm');
            form.classList.toggle('hidden');
        });

        // Show Modal for Viewing or Editing Product
        function showModal(contentHtml, imageUrl) {
            document.getElementById('productFormContent').innerHTML = contentHtml;
            document.getElementById('productImage').src = imageUrl;
            document.getElementById('productModal').classList.remove('hidden');
            document.getElementById('main-content').classList.add('blur-background');
        }

        // Hide Modal
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('productModal').classList.add('hidden');
            document.getElementById('main-content').classList.remove('blur-background');
        });

        // View Product button logic
        document.querySelectorAll('.view-product').forEach(button => {
            button.addEventListener('click', function() {
                var productId = this.getAttribute('data-id');
                var productData = <?= json_encode($data['products']) ?>.find(p => p.id == productId);

                var viewHtml = `
                    <h2 class="text-2xl font-semibold mb-4">View Product</h2>
                    <label class="block text-lg font-medium mb-2">Product Name</label>
                    <input type="text" value="${productData.name}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3" disabled>

                    <label class="block text-lg font-medium mb-2">Price</label>
                    <input type="number" value="${productData.price}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3" disabled>

                    <label class="block text-lg font-medium mb-2">Description</label>
                    <textarea class="w-full h-48 border border-gray-300 rounded-lg px-3 py-2 mb-3" disabled>${productData.description}</textarea>
                `;
                showModal(viewHtml, '<?= BASE_URL ?>/images/accessories/' + productData.image);
            });
        });

        // Edit Product button logic
        document.querySelectorAll('.edit-product').forEach(button => {
            button.addEventListener('click', function() {
                var productId = this.getAttribute('data-id');
                var productData = <?= json_encode($data['products']) ?>.find(p => p.id == productId);

                var editHtml = `
                    <h2 class="text-2xl font-semibold mb-4">Edit Product</h2>
                    <form action="<?= BASE_URL ?>admin/editProduct" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="${productData.id}">
                        <input type="hidden" name="category" value="accessories">
                        
                        <label for="name" class="block text-lg font-medium">Name:</label>
                        <input type="text" name="name" value="${productData.name}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">
                        
                        <label for="price" class="block text-lg font-medium">Price:</label>
                        <input type="number" name="price" value="${productData.price}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">
                        
                        <label for="quantity" class="block text-lg font-medium">Quantity:</label>
                        <input type="number" name="quantity" value="${productData.quantity}" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">
                        
                        <label for="description" class="block text-lg font-medium">Description:</label>
                        <textarea name="description" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">${productData.description}</textarea>
                        
                        <label for="image" class="block text-lg font-medium">Update Image:</label>
                        <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" class="w-full mb-3">
                        
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Save Changes</button>
                    </form>
                `;
                showModal(editHtml, '<?= BASE_URL ?>/images/accessories/' + productData.image);
            });
        });

        // Delete Product button logic
        document.querySelectorAll('.delete-product').forEach(button => {
            button.addEventListener('click', function() {
                var productId = this.getAttribute('data-id');
                if (confirm("Are you sure you want to delete this product?")) {
                    window.location.href = `<?= BASE_URL ?>admin/deleteProduct?id=${productId}`;
                }
            });
        });

        // Sorting logic
        document.getElementById('sortProducts').addEventListener('change', function() {
            const selectedSort = this.value;
            window.location.href = `<?= BASE_URL ?>admin/accessories?sort=${selectedSort}`;
        });

        // In Stock button logic
        document.getElementById('filterInStock').addEventListener('click', function() {
            window.location.href = '<?= BASE_URL ?>admin/accessories?stock=in';
        });

        // Out of Stock button logic
        document.getElementById('filterOutOfStock').addEventListener('click', function() {
            window.location.href = '<?= BASE_URL ?>admin/accessories?stock=out';
        });
    </script>
</div>
