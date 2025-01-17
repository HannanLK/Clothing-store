<div>
    <div id="main-content" class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Manage Users</h1>

        <!-- Add User Button -->
        <button id="showAddUserForm" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-5">Add User</button>

        <!-- Sort Dropdown -->
        <select id="sortUsers" class="bg-white border border-gray-300 px-4 py-2 rounded-md mb-5">
            <option value="">Sort by</option>
            <option value="customer" <?= isset($_GET['sort']) && $_GET['sort'] == 'customer' ? 'selected' : '' ?>>Customers</option>
            <option value="admin" <?= isset($_GET['sort']) && $_GET['sort'] == 'admin' ? 'selected' : '' ?>>Admins</option>
            <option value="time_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'time_asc' ? 'selected' : '' ?>>Time Ascending</option>
            <option value="time_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'time_desc' ? 'selected' : '' ?>>Time Descending</option>
        </select>

        <!-- Error Message -->
        <?php if (isset($error)): ?>
            <div class="bg-red-500 text-white p-4 mb-4">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <!-- Add User Form (initially hidden) -->
        <div id="addUserForm" class="bg-white p-6 rounded-md shadow-md hidden">
            <h2 class="text-2xl font-semibold mb-4">Add User</h2>
            <form action="<?= BASE_URL ?>admin/addUser" method="POST">
                <input type="text" name="name" placeholder="Name" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">
                <input type="email" name="email" placeholder="Email" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">
                <input type="text" name="address" placeholder="Address" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">
                <input type="text" name="phone" placeholder="Phone" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">
                <input type="text" name="username" placeholder="Username" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">
                <input type="password" name="password" placeholder="Password" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">
                <select name="role" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Add User</button>
            </form>
        </div>

        <hr class="my-6">

        <!-- Display Existing Users -->
        <h2 class="text-2xl font-bold mb-4">Existing Users</h2>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Role</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="border px-4 py-2"><?= $user['user_id'] ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($user['name']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($user['email']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($user['role']) ?></td>
                            <td class="border px-4 py-2">
                                <button class="view-user bg-blue-500 text-white px-3 py-2 rounded-md" data-id="<?= $user['user_id'] ?>">View</button>
                                <button class="edit-user bg-yellow-500 text-white px-3 py-2 rounded-md ml-2" data-id="<?= $user['user_id'] ?>">Edit</button>
                                <button class="delete-user bg-red-500 text-white px-3 py-2 rounded-md ml-2" data-id="<?= $user['user_id'] ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="border px-4 py-2">No users found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal for Viewing and Editing Users -->
    <div id="userModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl">
            <div id="userFormContent" class="w-full"></div>
            <div class="flex justify-end gap-2 mt-4">
                <button id="closeModal" class="bg-red-500 text-white px-4 py-2 rounded-md">Close</button>
            </div>
        </div>
    </div>

    <script>
        // Show Add User form on button click
        document.getElementById('showAddUserForm').addEventListener('click', function() {
            var form = document.getElementById('addUserForm');
            form.classList.toggle('hidden');
        });

        // Sort Users
        document.getElementById('sortUsers').addEventListener('change', function() {
            const selectedSort = this.value;
            window.location.href = `<?= BASE_URL ?>admin/users?sort=${selectedSort}`;
        });

        // Show Modal for Viewing or Editing User
        function showModal(contentHtml) {
            const modal = document.getElementById('userModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex'); // Add flex when the modal is visible
            document.getElementById('userFormContent').innerHTML = contentHtml;
            document.getElementById('main-content').classList.add('blur-background');
        }

        // Hide Modal
        document.getElementById('closeModal').addEventListener('click', function() {
            const modal = document.getElementById('userModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex'); // Remove flex when hiding the modal
            document.getElementById('main-content').classList.remove('blur-background');
        });

        // View User button logic
        document.querySelectorAll('.view-user').forEach(button => {
            button.addEventListener('click', function() {
                var userId = this.getAttribute('data-id');
                var userData = <?= json_encode($users) ?>.find(u => u.user_id == userId);

                var viewHtml = `
                    <h2 class="text-2xl font-semibold mb-4">View User</h2>
                    <label class="block mb-2 font-bold">Name:</label>
                    <input type="text" value="${userData.name}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3" disabled>

                    <label class="block mb-2 font-bold">Email:</label>
                    <input type="email" value="${userData.email}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3" disabled>

                    <label class="block mb-2 font-bold">Address:</label>
                    <input type="text" value="${userData.address}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3" disabled>

                    <label class="block mb-2 font-bold">Phone:</label>
                    <input type="text" value="${userData.phone}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3" disabled>

                    <label class="block mb-2 font-bold">Username:</label>
                    <input type="text" value="${userData.username}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3" disabled>

                    <label class="block mb-2 font-bold">Role:</label>
                    <input type="text" value="${userData.role}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3" disabled>
                `;
                showModal(viewHtml);
            });
        });

        // Edit User button logic
        document.querySelectorAll('.edit-user').forEach(button => {
            button.addEventListener('click', function() {
                var userId = this.getAttribute('data-id');
                var userData = <?= json_encode($users) ?>.find(u => u.user_id == userId);

                var editHtml = `
                    <h2 class="text-2xl font-semibold mb-4">Edit User</h2>
                    <form action="<?= BASE_URL ?>admin/editUser" method="POST">
                        <input type="hidden" name="user_id" value="${userData.user_id}">

                        <label class="block mb-2 font-bold">Name:</label>
                        <input type="text" name="name" value="${userData.name}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">

                        <label class="block mb-2 font-bold">Email:</label>
                        <input type="email" name="email" value="${userData.email}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">

                        <label class="block mb-2 font-bold">Address:</label>
                        <input type="text" name="address" value="${userData.address}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">

                        <label class="block mb-2 font-bold">Phone:</label>
                        <input type="text" name="phone" value="${userData.phone}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">

                        <label class="block mb-2 font-bold">Username:</label>
                        <input type="text" name="username" value="${userData.username}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">

                        <label class="block mb-2 font-bold">Role:</label>
                        <select name="role" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">
                            <option value="customer" ${userData.role == 'customer' ? 'selected' : ''}>Customer</option>
                            <option value="admin" ${userData.role == 'admin' ? 'selected' : ''}>Admin</option>
                        </select>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Save Changes</button>
                    </form>
                `;
                showModal(editHtml);
            });
        });

        // Delete User button logic
        document.querySelectorAll('.delete-user').forEach(button => {
            button.addEventListener('click', function() {
                var userId = this.getAttribute('data-id');
                if (confirm("Are you sure you want to delete this user?")) {
                    window.location.href = `<?= BASE_URL ?>admin/deleteUser?id=${userId}`;
                }
            });
        });
    </script>
</div>
