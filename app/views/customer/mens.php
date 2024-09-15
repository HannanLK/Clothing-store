<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Men's Products</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Tailwind CSS -->
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Shop Men's Products</h1>

        <!-- Sort Dropdown -->
        <select id="sortProducts" class="bg-white border border-gray-300 px-4 py-2 rounded-md mb-5">
            <option value="name_asc" <?= isset($data['sortOption']) && $data['sortOption'] == 'name_asc' ? 'selected' : '' ?>>Sort by Name: A to Z</option>
            <option value="name_desc" <?= isset($data['sortOption']) && $data['sortOption'] == 'name_desc' ? 'selected' : '' ?>>Sort by Name: Z to A</option>
            <option value="price_asc" <?= isset($data['sortOption']) && $data['sortOption'] == 'price_asc' ? 'selected' : '' ?>>Sort by Price: Low to High</option>
            <option value="price_desc" <?= isset($data['sortOption']) && $data['sortOption'] == 'price_desc' ? 'selected' : '' ?>>Sort by Price: High to Low</option>
            <option value="date_new" <?= isset($data['sortOption']) && $data['sortOption'] == 'date_new' ? 'selected' : '' ?>>Sort by Date: Newest First</option>
            <option value="date_old" <?= isset($data['sortOption']) && $data['sortOption'] == 'date_old' ? 'selected' : '' ?>>Sort by Date: Oldest First</option>
        </select>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php if (!empty($data['products'])): ?>
                <?php foreach ($data['products'] as $product): ?>
                    <div class="product-item bg-white rounded-lg shadow-md p-4">
                        <img src="/clothing-store/public/images/mens/<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-64 object-cover rounded-lg mb-2">
                        <strong class="text-lg font-semibold"><?= htmlspecialchars($product['name']) ?></strong><br>
                        <span class="text-gray-700">$<?= htmlspecialchars($product['price']) ?></span><br>
                        <p class="text-gray-600 text-sm mb-2"><?= htmlspecialchars($product['description']) ?></p><br>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found in this category.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Trigger sorting when a new option is selected
        document.getElementById('sortProducts').addEventListener('change', function() {
            const selectedSort = this.value;
            window.location.href = `/clothing-store/public/mens?sort=${selectedSort}`;
        });
    </script>
</body>
</html>
