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

    <?php if (!empty($cartItems)): ?>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
            <tr>
                <th class="bg-gray-100 text-gray-800 px-4 py-3 border">Product</th>
                <th class="bg-gray-100 text-gray-800 px-4 py-3 border">Price</th>
                <th class="bg-gray-100 text-gray-800 px-4 py-3 border">Quantity</th>
                <th class="bg-gray-100 text-gray-800 px-4 py-3 border">Total</th>
            </tr>
            </thead>
            <tbody id="cartItems">
            <?php foreach ($cartItems as $item): ?>
                <tr data-product-id="<?= $item['id'] ?>">
                    <td class="border px-4 py-2">
                        <?php
                        $categoryFolder = '';
                        switch ($item['category_id']) {
                            case 1: $categoryFolder = 'mens'; break;
                            case 2: $categoryFolder = 'womens'; break;
                            case 3: $categoryFolder = 'accessories'; break;
                            default: $categoryFolder = 'unknown';
                        }
                        ?>
                        <div class="flex items-center gap-4">
                            <img src="/clothing-store/public/images/<?= $categoryFolder ?>/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-24 h-24 object-cover ml-2">
                            <div>
                                <span class="font-semibold"><?= htmlspecialchars($item['name']) ?></span><br>
                                <form action="/clothing-store/public/cart/removeItem" method="POST" class="inline">
                                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                    <button type="submit" class="text-red-600 hover:underline">Remove</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td class="border px-4 py-2">$<?= number_format($item['price'], 2) ?></td>

                    <!-- Quantity Column with + and - buttons -->
                    <td class="border px-4 py-2 flex items-center">
                        <button class="bg-gray-100 px-3 py-1 decrement" data-id="<?= $item['id'] ?>">-</button>
                        <input type="text" value="<?= $item['quantity'] ?>" readonly class="quantity w-12 text-center border rounded-md mx-2">
                        <button class="bg-gray-100 px-3 py-1 increment" data-id="<?= $item['id'] ?>">+</button>
                    </td>

                    <!-- Total price for this item -->
                    <td class="border px-4 py-2 item-total">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Subtotal, Tax, Total -->
        <div class="mt-5">
            <div class="flex justify-end px-8 py-1 text-lg">
                <span>Subtotal:</span>
                <span class="ml-3">$<span id="subtotal"><?= number_format($subtotal, 2) ?></span></span>
            </div>
            <div class="flex justify-end px-8 py-1 text-lg">
                <span>Tax (10%):</span>
                <span class="ml-3">$<span id="tax"><?= number_format($tax, 2) ?></span></span>
            </div>
            <div class="flex justify-end px-8 py-1 font-semibold text-lg">
                <span>Total:</span>
                <span class="ml-3">$<span id="total"><?= number_format($total, 2) ?></span></span>
            </div>

            <!-- Horizontal line -->
            <hr class="w-full mx-auto my-4 border-t-2 border-gray-300">

            <!-- Proceed to Checkout Button -->
            <div class="flex justify-end px-4">
                <!-- Direct link to the checkout page -->
                <a href="/clothing-store/public/checkout" class="bg-black text-white px-5 py-2 rounded-md uppercase hover:bg-white hover:text-black hover:border hover:border-black">Proceed to Checkout</a>
            </div>
        </div>

    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<script>
    // Function to recalculate totals
    function recalculateTotals() {
        let subtotal = 0;

        document.querySelectorAll('#cartItems tr').forEach(row => {
            const price = parseFloat(row.querySelector('td:nth-child(2)').textContent.replace('$', ''));
            const quantity = parseInt(row.querySelector('.quantity').value);
            const itemTotal = price * quantity;

            row.querySelector('.item-total').textContent = `$${itemTotal.toFixed(2)}`;

            subtotal += itemTotal;
        });

        const tax = subtotal * 0.10;
        const total = subtotal + tax;

        document.getElementById('subtotal').textContent = subtotal.toFixed(2);
        document.getElementById('tax').textContent = tax.toFixed(2);
        document.getElementById('total').textContent = total.toFixed(2);
    }

    // Handle increment and decrement buttons
    document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const quantityInput = row.querySelector('.quantity');
            let quantity = parseInt(quantityInput.value);
            const productId = row.getAttribute('data-product-id');

            quantityInput.value = quantity + 1;
            updateQuantity(productId, quantity + 1);
            recalculateTotals();
        });
    });

    document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const quantityInput = row.querySelector('.quantity');
            let quantity = parseInt(quantityInput.value);
            const productId = row.getAttribute('data-product-id');

            if (quantity > 1) {
                quantityInput.value = quantity - 1;
                updateQuantity(productId, quantity - 1);
                recalculateTotals();
            }
        });
    });

    // Function to send updated quantity to the server
    function updateQuantity(productId, quantity) {
        fetch('/clothing-store/public/cart/updateQuantity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Quantity updated successfully.');
            } else {
                console.error('Failed to update quantity.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>

</body>
</html>
