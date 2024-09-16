<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        th {
            background-color: #f3f4f6;
            color: #333;
            padding: 12px;
        }

        td {
            padding: 10px;
            vertical-align: middle;
        }

        .remove-link {
            color: #e53e3e;
            cursor: pointer;
        }

        .remove-link:hover {
            text-decoration: underline;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        .total-summary {
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
            font-size: 16px;
            width: 90%;
            margin: 10px auto;
        }

        .total-summary span {
            display: inline-block;
        }

        .total-value {
            text-align: right;
            white-space: nowrap;
        }

        .semi-bold {
            font-weight: 600;
        }

        .checkout-btn {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-transform: uppercase;
            text-align: center;
            cursor: pointer;
            display: inline-block;
        }

        .checkout-btn:hover {
            background-color: white;
            color: black;
            border: 1px solid black;
        }

        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-left: 10px;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .qty-btn {
            background-color: #f3f4f6;
            border: none;
            padding: 5px 12px;
            cursor: pointer;
        }

        .hr-line {
            width: 90%;
            margin: 10px auto;
            border-top: 2px solid #eaeaea;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-5">
    <h1 class="text-3xl font-bold mb-5">Your Cart</h1>

    <?php if (!empty($cartItems)): ?>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
            <tr>
                <th class="px-4 py-2 border">Product</th>
                <th class="px-4 py-2 border">Price</th>
                <th class="px-4 py-2 border">Quantity</th>
                <th class="px-4 py-2 border">Total</th>
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
                        <div class="product-info">
                            <img src="/clothing-store/public/images/<?= $categoryFolder ?>/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="product-image">
                            <div>
                                <span class="font-semibold"><?= htmlspecialchars($item['name']) ?></span>
                                <br>
                                <!-- Use POST for remove instead of GET -->
                                <form action="/clothing-store/public/cart/removeItem" method="POST" style="display: inline;">
                                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                    <button type="submit" class="remove-link">Remove</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td class="border px-4 py-2">$<?= number_format($item['price'], 2) ?></td>

                    <!-- Quantity Column with + and - buttons -->
                    <td class="border px-4 py-2 flex items-center">
                        <button class="qty-btn decrement" data-id="<?= $item['id'] ?>">-</button>
                        <input type="text" value="<?= $item['quantity'] ?>" readonly class="quantity w-12 text-center border rounded-md mx-2">
                        <button class="qty-btn increment" data-id="<?= $item['id'] ?>">+</button>
                    </td>

                    <!-- Total price for this item -->
                    <td class="border px-4 py-2 item-total">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Subtotal, Tax, Total -->
        <div class="mt-5">
            <div class="total-summary">
                <span>Subtotal:</span>
                <span class="total-value">$<span id="subtotal"><?= number_format($subtotal, 2) ?></span></span>
            </div>
            <div class="total-summary">
                <span>Tax (10%):</span>
                <span class="total-value">$<span id="tax"><?= number_format($tax, 2) ?></span></span>
            </div>
            <div class="total-summary semi-bold">
                <span>Total:</span>
                <span class="total-value">$<span id="total"><?= number_format($total, 2) ?></span></span>
            </div>

            <!-- Horizontal line -->
            <div class="hr-line"></div>

            <!-- Proceed to Checkout Button -->
            <div class="total-summary" style="justify-content: flex-end;">
                <a id="proceedToCheckout" class="checkout-btn">Proceed to Checkout</a>
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

            quantityInput.value = quantity + 1;
            recalculateTotals();
        });
    });

    document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const quantityInput = row.querySelector('.quantity');
            let quantity = parseInt(quantityInput.value);

            if (quantity > 1) {
                quantityInput.value = quantity - 1;
                recalculateTotals();
            }
        });
    });

    // Proceed to checkout button handler
    document.getElementById('proceedToCheckout').addEventListener('click', function () {
        fetch('/clothing-store/public/cart/checkLoginStatus', {
            method: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.isLoggedIn) {
                window.location.href = '/clothing-store/public/checkout';
            } else {
                window.location.href = '/clothing-store/public/login';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

</script>

</body>
</html>
