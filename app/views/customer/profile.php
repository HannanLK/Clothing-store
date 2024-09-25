<?php $title = "Profile"; ?> 
<div>
    <div class="container mx-auto p-5 max-w-screen-lg"> <!-- Center the container and limit the width -->
        <!-- Profile Header with Logout Button -->
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-3xl font-bold">PROFILE</h1>
            <a href="<?= BASE_URL ?>/logout" class="bg-red-500 text-white px-4 py-2 rounded-md">Logout</a>
        </div>

        <!-- Profile Information -->
        <div class="bg-white p-5 mb-5 shadow-md rounded">
            <h2 class="text-xl font-bold mb-3">Customer Information</h2>
            <form id="profile-info-form" action="<?= BASE_URL ?>/profile/edit" method="POST">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block font-semibold">Name:</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($customer['name']) ?>" class="w-full p-2 border rounded-md" disabled>
                    </div>
                    <div>
                        <label for="username" class="block font-semibold">Username:</label>
                        <input type="text" name="username" value="<?= htmlspecialchars($customer['username']) ?>" class="w-full p-2 border rounded-md" disabled>
                    </div>
                    <div>
                        <label for="address" class="block font-semibold">Address:</label>
                        <input type="text" name="address" value="<?= htmlspecialchars($customer['address']) ?>" class="w-full p-2 border rounded-md" disabled>
                    </div>
                    <div>
                        <label for="phone" class="block font-semibold">Phone:</label>
                        <input type="text" name="phone" value="<?= htmlspecialchars($customer['phone']) ?>" class="w-full p-2 border rounded-md" disabled>
                    </div>
                </div>
                <button type="button" id="editButton" class="bg-blue-500 text-white px-4 py-2 mt-3 rounded-md">Edit Profile</button>
                <button type="submit" id="saveButton" class="bg-green-500 text-white px-4 py-2 mt-3 rounded-md hidden">Save</button>
            </form>
        </div>

        <!-- Order History Section -->
        <div class="bg-white p-5 mb-5 shadow-md rounded">
            <h2 class="text-xl font-bold mb-3">ORDER HISTORY</h2>

            <?php if (!empty($orders) && is_array($orders)): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-2 py-2 border w-1/12">Order ID</th>
                                <th class="px-2 py-2 border w-2/12">Date</th>
                                <th class="px-4 py-2 border">Products Ordered</th>
                                <th class="px-4 py-2 border w-2/12">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td class="px-2 py-2 border"><?= htmlspecialchars($order['id']) ?></td>
                                    <td class="px-2 py-2 border"><?= htmlspecialchars($order['created_at']) ?></td>
                                    <td class="px-4 py-2 border">
                                        <ul>
                                            <?php foreach ($order['products'] as $product): ?>
                                                <?php
                                                $categoryFolder = '';
                                                if (isset($product['category_id'])) {
                                                    switch ($product['category_id']) {
                                                        case 1: $categoryFolder = 'mens'; break;
                                                        case 2: $categoryFolder = 'womens'; break;
                                                        case 3: $categoryFolder = 'accessories'; break;
                                                        default: $categoryFolder = 'unknown';
                                                    }
                                                } else {
                                                    $categoryFolder = 'unknown';
                                                }

                                                $imageUrl = BASE_URL . "images/{$categoryFolder}/" . htmlspecialchars($product['image']);
                                                ?>

                                                <li class="flex flex-col md:flex-row items-start md:items-center mb-2">
                                                    <img src="<?= $imageUrl ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-28 h-28 object-cover mr-6">
                                                    <span class="font-semibold px-2"><?= htmlspecialchars($product['name']) ?></span> - <?= htmlspecialchars($product['quantity']) ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                    <td class="px-4 py-2 border">$<?= number_format($order['total'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>No orders found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const editButton = document.getElementById('editButton');
        const saveButton = document.getElementById('saveButton');
        const inputs = document.querySelectorAll('#profile-info-form input');

        editButton.addEventListener('click', function() {
            inputs.forEach(input => {
                input.disabled = false;  
            });
            editButton.classList.add('hidden'); 
            saveButton.classList.remove('hidden');
        });
    </script>
</div>
