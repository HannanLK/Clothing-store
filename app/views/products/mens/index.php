<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Men's Products</title>
</head>
<body>
    <h1>Men's Products</h1>
    
    <ul>
        <!-- Check if the $products array is not empty -->
        <?php if (!empty($data['products'])): ?>
            <!-- Loop through each product and display it -->
            <?php foreach ($data['products'] as $product): ?>
                <li>
                    <?= htmlspecialchars($product['name']) ?> - 
                    $<?= htmlspecialchars($product['price']) ?>
                    <br>
                    <?= htmlspecialchars($product['description']) ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found in the men's category.</p>
        <?php endif; ?>
    </ul>
</body>
</html>
