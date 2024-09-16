<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .quantity-btn {
            cursor: pointer;
            padding: 4px 8px;
            border: 1px solid #ccc;
            margin: 0 5px;
            background-color: #f0f0f0;
        }
    </style>
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
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $total = 0; 
                        $categoryMap = [
                            1 => 'mens',
                            2 => 'womens',
                            3 => 'accessories'
                        ];

                        foreach ($data['cartItems'] as $item): 
                            $itemTotal = $item['price'] * $item['quantity'];
                            $total += $itemTotal;
                            $categoryFolder = isset($categoryMap[$item['category_id']]) ? $categoryMap[$item['category_id']] : 'unknown';
                    ?>
                        <tr>
                            <td class="border px-4 py-2 flex items-center">
                                <img src="/clothing-store/public/images/<?= $categoryFolder ?>/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-16 h-16 object-cover mr-4">
                                <div>
                                    <p><?= htmlspecialchars($item['name']) ?></p>
                                    <form action="/clothing-store/public/cart/removeItem" method="POST">
                                        <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                        <button type="submit" class="text-red-500 hover:underline">Remove</button>
                                    </form>
                                </div>
                            </td>
                            <td class="border px-4 py-2">$<?= htmlspecialchars($item['price']) ?></td>
                            <td class="border px-4 py-2">
                                <div class="flex items-center">
                                    <button class="quantity-btn" onclick="updateQuantity(<?= $item['id'] ?>, -1)">-</button>
                                    <span id="quantity-<?= $item['id'] ?>" class="mx-2"><?= htmlspecialchars($item['quantity']) ?></span>
                                    <button class="quantity-btn" onclick="updateQuantity(<?= $item['id'] ?>, 1)">+</button>
                                </div>
                            </td>
                            <td class="border px-4 py-2" id="total-<?= $item['id'] ?>" data-price="<?= $item['price'] ?>">$<?= number_format($itemTotal, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="mt-5">
                <p class="text-lg">Subtotal: $<span id="subtotal"><?= number_format($total, 2) ?></span></p>
                <p class="text-lg">Tax (10%): $<span id="tax"><?= number_format($total * 0.1, 2) ?></span></p>
                <p class="text-lg font-bold">Total: $<span id="grand-total"><?= number_format($total * 1.1, 2) ?></span></p>
            </div>

            <div class="mt-5">
                <a href="/clothing-store/public/checkout" class="bg-blue-500 text-white px-4 py-2 rounded-md">Proceed to Checkout</a>
            </div>

        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <script>
        function updateQuantity(productId, change) {
            const quantityElem = document.getElementById('quantity-' + productId);
            let newQuantity = parseInt(quantityElem.innerText) + change;
            if (newQuantity <= 0) return; // Prevent negative or zero quantity

            // Update quantity in the UI
            quantityElem.innerText = newQuantity;

            // Update the total for this product
            const priceElem = document.getElementById('total-' + productId);
            const price = parseFloat(priceElem.getAttribute('data-price')); // Retrieve price from data attribute
            const newTotal = newQuantity * price;
            priceElem.innerText = '$' + newTotal.toFixed(2);

            // Update the subtotal and total values
            updateCartTotals();
        }

        function updateCartTotals() {
            let subtotal = 0;
            document.querySelectorAll('[id^="total-"]').forEach(totalElem => {
                subtotal += parseFloat(totalElem.innerText.replace('$', ''));
            });
            const tax = subtotal * 0.1;
            const grandTotal = subtotal + tax;

            document.getElementById('subtotal').innerText = subtotal.toFixed(2);
            document.getElementById('tax').innerText = tax.toFixed(2);
            document.getElementById('grand-total').innerText = grandTotal.toFixed(2);
        }
    </script>

</body>
</html>
