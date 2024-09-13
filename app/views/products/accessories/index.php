<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessories</title>
</head>
<body>
    <h1>Accessories</h1>
    
    <ul>
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <li>
                    <?= htmlspecialchars($product['name']) ?> - 
                    $<?= htmlspecialchars($product['price']) ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No accessories found.</p>
        <?php endif; ?>
    </ul>
</body>
</html>
