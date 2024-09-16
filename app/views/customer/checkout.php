<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-5">
    <h1 class="text-3xl font-bold mb-5">CHECKOUT</h1>

    <!-- Customer Information -->
    <div class="bg-white p-5 mb-5 shadow-md rounded">
        <h2 class="text-xl font-bold mb-3">CUSTOMER INFORMATION</h2>
        <form id="customer-info-form" action="/clothing-store/public/checkout/updateCustomerInfo" method="POST">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block font-semibold">Name:</label>
                    <input type="text" id="name" value="<?= htmlspecialchars($customer['name']) ?>" class="w-full p-2 border rounded-md bg-gray-100 text-gray-600" disabled>
                </div>
                <div>
                    <label for="username" class="block font-semibold">Username:</label>
                    <input type="text" id="username" value="<?= htmlspecialchars($customer['username']) ?>" class="w-full p-2 border rounded-md bg-gray-100 text-gray-600" disabled>
                </div>
                <div>
                    <label for="address" class="block font-semibold">Address:</label>
                    <input type="text" name="address" id="address" value="<?= htmlspecialchars($customer['address']) ?>" class="w-full p-2 border rounded-md" required>
                </div>
                <div>
                    <label for="phone" class="block font-semibold">Contact Number:</label>
                    <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($customer['phone']) ?>" class="w-full p-2 border rounded-md" required>
                </div>
            </div>
        </form>
    </div>

    <!-- Cart Items -->
    <div class="bg-white p-5 mb-5 shadow-md rounded">
        <h2 class="text-xl font-bold mb-3">YOUR CART</h2>
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
                            <div class="flex items-center">
                                <img src="/clothing-store/public/images/<?= $categoryFolder ?>/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-16 h-16 object-cover mr-4">
                                <?= htmlspecialchars($item['name']) ?>
                            </div>
                        </td>
                        <td class="border px-4 py-2">$<?= number_format($item['price'], 2) ?></td>
                        <td class="border px-4 py-2"><?= $item['quantity'] ?></td>
                        <td class="border px-4 py-2">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Subtotal, Tax, Total -->
        <div class="mt-5">
            <div class="flex justify-end text-base mb-1">
                <span class="mr-2">Subtotal:</span>
                <span>$<?= number_format($subtotal, 2) ?></span>
            </div>
            <div class="flex justify-end text-base mb-1">
                <span class="mr-2">Tax (10%):</span>
                <span>$<?= number_format($tax, 2) ?></span>
            </div>
            <div class="flex justify-end font-semibold text-base">
                <span class="mr-2">Total:</span>
                <span>$<?= number_format($total, 2) ?></span>
            </div>
        </div>
    </div>

    <!-- Payment Form -->
    <div class="bg-white p-5 mb-5 shadow-md rounded">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold mb-3">PAYMENT DETAILS</h2>
            <div class="flex space-x-2">
                <img src="/clothing-store/public/images/logos/visa.png" alt="Visa" class="w-12 h-11">
                <img src="/clothing-store/public/images/logos/mastercard.png" alt="MasterCard" class="w-12 h-11">
                <img src="/clothing-store/public/images/logos/amex.png" alt="Amex" class="w-12 h-11">
            </div>
        </div>
        <form id="payment-form" action="/clothing-store/public/checkout/placeOrder" method="POST">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="card-number" class="block font-semibold">Card Number:</label>
                    <input type="text" name="card-number" id="card-number" class="w-full p-2 border rounded-md" placeholder="XXXX XXXX XXXX XXXX" maxlength="19" required oninput="formatCardNumber(this)">
                </div>
                <div>
                    <label for="card-expiry" class="block font-semibold">Expiry Date (MM/YY):</label>
                    <input type="text" name="card-expiry" id="card-expiry" class="w-full p-2 border rounded-md" placeholder="MM/YY" maxlength="5" required oninput="formatExpiryDate(this)">
                </div>
                <div>
                    <label for="card-cvv" class="block font-semibold">CVV:</label>
                    <input type="text" name="card-cvv" id="card-cvv" class="w-full p-2 border rounded-md" placeholder="XXX" maxlength="3" required>
                </div>
            </div>
            <div class="mt-5 flex space-x-2">
                <button type="submit" class="bg-black text-white px-4 py-2 rounded-md uppercase w-1/4">Place Order</button>
                <a href="/clothing-store/public/cart" class="bg-gray-300 text-black px-4 py-2 rounded-md uppercase w-1/4 text-center">Cancel Order</a>
            </div>
        </form>
    </div>
</div>

<script>
    // Format card number to display in groups of 4
    function formatCardNumber(input) {
        let value = input.value.replace(/\D/g, '');
        input.value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
    }

    // Format expiry date to add slash after MM
    function formatExpiryDate(input) {
        let value = input.value.replace(/\//g, '').replace(/[^0-9]/gi, '');
        if (value.length >= 2) {
            input.value = value.substring(0, 2) + '/' + value.substring(2, 4);
        } else {
            input.value = value;
        }
    }
</script>

</body>
</html>
