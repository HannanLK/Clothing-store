<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Tailwind CSS -->
</head>
<body class="bg-gray-100 p-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Number of Products -->
        <div class="bg-blue-500 text-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold">Total Number of Products</h2>
            <p class="text-3xl font-semibold mt-2"><?= $productCount ?></p>
        </div>

        <!-- Total Number of Users -->
        <div class="bg-green-500 text-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold">Total Number of Users</h2>
            <p class="text-3xl font-semibold mt-2"><?= $userCount ?></p>
            <p>Admins: <?= $adminCount ?></p>
            <p>Customers: <?= $customerCount ?></p>
        </div>

        <!-- Total Number of Blogs -->
        <div class="bg-red-500 text-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold">Total Number of Blogs</h2>
            <p class="text-3xl font-semibold mt-2"><?= $blogCount ?></p>
        </div>
    </div>

    <!-- Second Row of Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <!-- Sales Revenue -->
        <div class="bg-yellow-500 text-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold">Sales Revenue</h2>
            <p class="text-3xl font-semibold mt-2">$<?= $salesRevenue ?></p>
        </div>

        <!-- Total Number of Inquiries -->
        <div class="bg-purple-500 text-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold">Total Inquiries</h2>
            <p class="text-3xl font-semibold mt-2"><?= $inquiryCount ?></p>
        </div>

        <!-- Pending Inquiries -->
        <div class="bg-orange-500 text-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold">Pending Inquiries</h2>
            <p class="text-3xl font-semibold mt-2"><?= $pendingInquiryCount ?></p>
        </div>
    </div>

    <hr class="my-8">

    <!-- Sales Table -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold mb-4">Sales Overview</h2>
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Order ID</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($sales as $sale): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $sale['order_id'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $sale['customer_name'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">$<?= $sale['total'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $sale['date'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button class="bg-blue-500 text-white px-3 py-2 rounded-md view-order-btn" data-order-id="<?= $sale['order_id'] ?>">View</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Order Details Modal -->
    <div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-xl font-bold mb-4">Order Details</h2>
            <div id="orderDetails"></div>
            <button id="closeModal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-md">Close</button>
        </div>
    </div>

    <script>
        // JavaScript to handle the view button click and display the order details modal
        document.querySelectorAll('.view-order-btn').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-order-id');
                
                // Fetch order details using AJAX (this is a placeholder)
                fetch(`/clothing-store/public/admin/getOrderDetails?id=${orderId}`)
                    .then(response => response.json())
                    .then(data => {
                        const orderDetails = document.getElementById('orderDetails');
                        orderDetails.innerHTML = `
                            <p><strong>Order ID:</strong> ${data.order_id}</p>
                            <p><strong>Customer:</strong> ${data.customer_name}</p>
                            <p><strong>Total:</strong> $${data.total}</p>
                            <p><strong>Products:</strong> ${data.products}</p>
                            <p><strong>Date:</strong> ${data.date}</p>
                        `;
                        
                        // Show the modal and apply flex properties
                        const modal = document.getElementById('orderModal');
                        modal.classList.remove('hidden');
                        modal.classList.add('flex', 'items-center', 'justify-center');
                    });
            });
        });

        // Close the modal
        document.getElementById('closeModal').addEventListener('click', function() {
            const modal = document.getElementById('orderModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });
    </script>
</body>
</html>
