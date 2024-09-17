<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-5">
    <!-- Profile Header with Logout Button -->
    <div class="flex justify-between items-center mb-5">
        <h1 class="text-3xl font-bold">Profile</h1>
        <a href="http://localhost/clothing-store/public/logout" class="bg-red-500 text-white px-4 py-2 rounded-md">Logout</a>
    </div>

    <!-- Profile Information -->
    <div class="bg-white p-5 mb-5 shadow-md rounded">
        <h2 class="text-xl font-bold mb-3">Customer Information</h2>
        <form id="profile-info-form" action="/clothing-store/public/profile/edit" method="POST">
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
            <!-- Buttons for Edit/Save -->
            <button type="button" id="editButton" class="bg-blue-500 text-white px-4 py-2 mt-3 rounded-md">Edit Profile</button>
            <button type="submit" id="saveButton" class="bg-green-500 text-white px-4 py-2 mt-3 rounded-md hidden">Save</button>
        </form>
    </div>

    <!-- Order History -->
    <div class="bg-white p-5 mb-5 shadow-md rounded">
        <h2 class="text-xl font-bold mb-3">Order History</h2>
        <?php if (!empty($orders)): ?>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                <tr>
                    <th class="px-4 py-2 border">Order ID</th>
                    <th class="px-4 py-2 border">Total</th>
                    <th class="px-4 py-2 border">Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= $order['id'] ?></td>
                        <td class="border px-4 py-2">$<?= number_format($order['total'], 2) ?></td>
                        <td class="border px-4 py-2"><?= date('F j, Y', strtotime($order['created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No orders found.</p>
        <?php endif; ?>
    </div>

</div>

<script>
    // Get the edit and save buttons and the input fields
    const editButton = document.getElementById('editButton');
    const saveButton = document.getElementById('saveButton');
    const inputs = document.querySelectorAll('#profile-info-form input');

    // Enable input fields and switch buttons when "Edit Profile" is clicked
    editButton.addEventListener('click', function() {
        inputs.forEach(input => {
            input.disabled = false;  // Enable input fields
        });
        editButton.classList.add('hidden'); // Hide the "Edit Profile" button
        saveButton.classList.remove('hidden'); // Show the "Save" button
    });
</script>

</body>
</html>
