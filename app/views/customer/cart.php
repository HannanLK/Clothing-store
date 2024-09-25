<div class="container mx-auto p-5 max-w-screen-lg"> 
    <h1 class="text-3xl font-bold mb-5">YOUR CART</h1> 

    <?php if (!empty($cartItems)): ?>
        <div class="overflow-x-auto"> <!-- Scrollable on mobile screens -->
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="bg-gray-100 text-gray-800 px-4 py-3 border w-1/2 sm:w-1/4">Product</th>
                        <th class="bg-gray-100 text-gray-800 px-4 py-3 border w-1/4">Price</th>
                        <th class="bg-gray-100 text-gray-800 px-4 py-3 border w-1/4">Quantity</th>
                        <th class="bg-gray-100 text-gray-800 px-4 py-3 border w-1/4">Total</th>
                    </tr>
                </thead>
                <tbody id="cartItems">
                    <?php foreach ($cartItems as $item): ?>
                        <?php
                        $categoryFolder = 'unknown';
                        if (isset($item['category_id'])) {
                            switch ($item['category_id']) {
                                case 1: $categoryFolder = 'mens'; break;
                                case 2: $categoryFolder = 'womens'; break;
                                case 3: $categoryFolder = 'accessories'; break;
                            }
                        }
                        ?>
                        <tr data-product-id="<?= $item['id'] ?>">
                            <td class="border px-4 py-2">
                                <div class="flex items-center gap-4">
                                    <img src="<?= BASE_URL ?>images/<?= $categoryFolder ?>/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-20 h-20 object-cover ml-2">
                                    <div>
                                        <span class="font-semibold"><?= htmlspecialchars($item['name']) ?></span><br>
                                        <form action="<?= BASE_URL ?>cart/removeItem" method="POST" class="inline">
                                            <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                            <button type="submit" class="text-red-600 hover:underline">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td class="border px-4 py-2 text-center">$<?= number_format($item['price'], 2) ?></td>

                            <!-- Quantity Column with + and - buttons -->
                            <td class="border px-4 py-2 flex items-center justify-center">
                                <button class="bg-gray-100 px-3 py-1 decrement" data-id="<?= $item['id'] ?>">-</button>
                                <input type="text" value="<?= $item['quantity'] ?>" readonly class="quantity w-12 text-center border rounded-md mx-2">
                                <button class="bg-gray-100 px-3 py-1 increment" data-id="<?= $item['id'] ?>">+</button>
                            </td>

                            <td class="border px-4 py-2 text-center item-total">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-5 flex justify-end">
            <table class="border border-gray-400 w-full sm:w-1/2 max-w-xs bg-white"> 
                <tbody>
                    <tr>
                        <td class="px-4 py-2 border text-left font-medium">Subtotal</td>
                        <td class="px-4 py-2 border text-right">$<span id="subtotal"><?= number_format($subtotal, 2) ?></span></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border text-left font-medium">Tax (10%)</td>
                        <td class="px-4 py-2 border text-right">$<span id="tax"><?= number_format($tax, 2) ?></span></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border text-left font-semibold">Total</td>
                        <td class="px-4 py-2 border text-right font-semibold">$<span id="total"><?= number_format($total, 2) ?></span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr class="w-full mx-auto my-4 border-t-2 border-gray-300">

        <div class="flex justify-end px-2">
            <a href="<?= BASE_URL ?>cart/proceedToCheckout" class="bg-black text-white px-5 py-2 rounded-md uppercase hover:bg-white hover:text-black hover:border hover:border-black">Proceed to Checkout</a>
        </div>

    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<script>
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

    document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const quantityInput = row.querySelector('.quantity');
            let quantity = parseInt(quantityInput.value);
            const productId = row.getAttribute('data-product-id');

            quantityInput.value = quantity + 1;
            updateQuantity(productId, quantity + 1);
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
            }
        });
    });

    function updateQuantity(productId, quantity) {
        fetch('<?= BASE_URL ?>cart/updateQuantity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ product_id: productId, quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                recalculateTotals();
            } else {
                console.error('Failed to update quantity.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>
