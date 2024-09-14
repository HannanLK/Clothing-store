<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>

    <form action="" method="POST">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required><br>

        <label for="category">Category:</label>
        <?php //if (isset($_GET['category']) && $_GET['category'] == 'mens'): ?>
            <input type="text" value="mens" disabled>
            <input type="hidden" name="category" value="mens">
        <?php // elseif (isset($_GET['category']) && $_GET['category'] == 'womens'): ?>
            <input type="text" value="womens" disabled>
            <input type="hidden" name="category" value="womens">
        <?php // elseif (isset($_GET['category']) && $_GET['category'] == 'accessories'): ?>
            <input type="text" value="accessories" disabled>
            <input type="hidden" name="category" value="accessories">
        <?php // else: ?>
            <select id="category" name="category">
                <option value="mens">Mens</option>
                <option value="womens">Womens</option>
                <option value="accessories">Accessories</option>
            </select>
        <?php //endif; ?><br>

        <button type="submit">Add Product</button>
    </form>
</body>
</html> -->
