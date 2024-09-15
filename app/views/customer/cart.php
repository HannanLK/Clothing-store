<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Your Cart</h1>

        <?php if (!empty($data['cartItems'])): ?>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Product</th>
                        <th class="px-4 py-2 border">Price</th>
                        <th class="px-4 py-2 border">Quantity</th>
                        <th class="px-4 py-2 border">Total</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['cartItems'] as $item): ?>
                        <tr>
                            <td class="border px-4 py-2"><?= htmlspecialchars($item['name']) ?></td>
                            <td class="border px-4 py-2">$<?= htmlspecialchars($item['price']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($item['quantity']) ?></td>
                            <td class="border px-4 py-2">$<?= htmlspecialchars($item['price'] * $item['quantity']) ?></td>
                            <td class="border px-4 py-2">
                                <form action="/clothing-store/public/cart/removeItem" method="POST">
                                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

</body>
</html>
