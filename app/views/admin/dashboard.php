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
        <!-- Sales -->
        <div class="bg-cyan-600 text-white rounded-lg shadow-lg p-4">
            <h2 class="text-xl font-bold text-center">SALES REVENUE</h2>
            <p class="text-6xl font-semibold text-center mt-6">$<?= $salesRevenue ?></p>
        </div>

        <!-- Total Number of Products -->
        <div class="bg-amber-500 text-white rounded-md shadow-lg p-4">
            <h2 class="text-xl font-bold text-center">TOTAL PRODUCTS</h2>
            <p class="text-6xl font-semibold text-center mt-2"><?= $productCount ?></p>
            <hr class="my-3">
            <!-- Mens: Count -->
            <p class="flex justify-between mx-12">
                <span>Mens:</span>
                <span><?= isset($mensCount) ? $mensCount : 'N/A' ?></span>
            </p>
            <!-- Womens: Count -->
            <p class="flex justify-between mx-12">
                <span>Womens:</span>
                <span><?= isset($womensCount) ? $womensCount : 'N/A' ?></span>
            </p>
            <!-- Accessories: Count -->
            <p class="flex justify-between mx-12">
                <span>Accessories:</span>
                <span><?= isset($accessoriesCount) ? $accessoriesCount : 'N/A' ?></span>
            </p>
        </div>


        <!-- Total Number of Users -->
        <div class="bg-pink-700 text-white rounded-lg shadow-lg p-4">
            <h2 class="text-xl font-bold">TOTAL USERES</h2>
            <p class="text-6xl font-semibold text-center mt-2"><?= $userCount ?></p>
            <hr class="my-3">
            <p class="flex justify-between mx-12">
                <span>Admins: </span>
                <span><?= $adminCount ?></span>
            </p>

            <p class="flex justify-between mx-12">
                <span>Customers: </span>
                <span><?= $customerCount ?></span>
            </p>
        </div>
    </div>

    <!-- Second Row of Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

        <!-- Total Number of Blogs -->
        <div class="bg-gray-300 text-black rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold text-center">TOTAL BLOGS</h2>
            <p class="text-6xl font-semibold text-center mt-6"><?= $blogCount ?></p>
        </div>


        <!-- Total Number of Inquiries -->
        <div class="bg-gray-300 text-black rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold text-center">PENDING INQUIRIES</h2>
            <p class="text-6xl font-semibold text-center mt-2"><?= $pendingInquiryCount ?></p>
            <hr class="my-4 border-gray-400">
            <p class="flex justify-between mx-12">
                <span>Total Inquiries:</span>
                <span> <?= $inquiryCount ?></span>
            </p>
        </div>
    </div>

    <hr class="my-8">

    <!-- Sales Table -->
    <div class="mt-8 overflow-x-auto">
        <h2 class="text-2xl font-semibold mb-4">Sales Overview</h2>
        <!-- Sales Table -->
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Order ID</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Order Value</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Customer ID</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Products</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($sales as $sale): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $sale['order_id'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $sale['date'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">$<?= $sale['total'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $sale['customer_name'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= isset($sale['customer_id']) ? $sale['customer_id'] : 'N/A' ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= isset($sale['products']) ? $sale['products'] : 'N/A' ?></td>
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
        // Modal logic for viewing order details
        document.querySelectorAll('.view-order-btn').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-order-id');

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
                        document.getElementById('orderModal').classList.remove('hidden');
                    })
                    .catch(error => console.error('Error fetching order details:', error));
            });
        });

        // Close the modal
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('orderModal').classList.add('hidden');
        });
    </script>
</body>
</html>
