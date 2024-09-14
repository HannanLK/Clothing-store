<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Blur background when modal is active */
        .blur-background {
            filter: blur(5px);
            pointer-events: none;
        }

        /* Modal styling */
        .modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            z-index: 100;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Modal overlay */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
        }
    </style>
</head>
<body class="bg-gray-100">

<div id="main-content" class="container mx-auto p-5">
    <h1 class="text-3xl font-bold mb-5">Manage Inquiries</h1>

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
        <tr>
            <th class="px-4 py-2 border">Inquiry ID</th>
            <th class="px-4 py-2 border">Name</th>
            <th class="px-4 py-2 border">Email</th>
            <th class="px-4 py-2 border">Contact Number</th>
            <th class="px-4 py-2 border">Subject</th>
            <th class="px-4 py-2 border">Message</th>
            <th class="px-4 py-2 border">Status</th>
            <th class="px-4 py-2 border">Status History</th>
            <th class="px-4 py-2 border">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($inquiries as $inquiry): ?>
            <tr>
                <td class="border px-4 py-2"><?= $inquiry['inquiry_id'] ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($inquiry['name']) ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($inquiry['email']) ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($inquiry['contact_number']) ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($inquiry['subject']) ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($inquiry['message']) ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($inquiry['status']) ?></td>
                <td class="border px-4 py-2">
                    <?php foreach ($inquiry['status_history'] as $history): ?>
                        <?= $history['old_status'] ?> to <?= $history['new_status'] ?> on <?= $history['changed_at'] ?><br>
                    <?php endforeach; ?>
                </td>
                <td class="border px-4 py-2">
                    <!-- Complete Status Button -->
                    <form action="/clothing-store/public/admin/updateStatus" method="POST" class="inline-block">
                        <input type="hidden" name="inquiry_id" value="<?= $inquiry['inquiry_id'] ?>">
                        <input type="hidden" name="status" value="complete">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md mb-2">Complete Status</button>
                    </form>

                    <!-- Edit Button -->
                    <button class="bg-yellow-500 text-white px-4 py-2 rounded-md mb-2" onclick="openEditModal(<?= htmlspecialchars(json_encode($inquiry)) ?>)">Edit</button>

                    <!-- Delete Button -->
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md" onclick="confirmDelete(<?= $inquiry['inquiry_id'] ?>)">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Edit Inquiry Modal -->
<div id="editModal" class="modal hidden">
    <form action="/clothing-store/public/admin/editInquiry" method="POST">
        <input type="hidden" id="editInquiryId" name="inquiry_id">
        <div class="flex">
            <!-- Form to Edit Inquiry -->
            <div class="w-full">
                <h2 class="text-2xl font-semibold mb-4">Edit Inquiry</h2>

                <label for="editName">Name</label>
                <input type="text" id="editName" name="name" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">

                <label for="editEmail">Email</label>
                <input type="email" id="editEmail" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">

                <label for="editContactNumber">Contact Number</label>
                <input type="text" id="editContactNumber" name="contact_number" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">

                <label for="editSubject">Subject</label>
                <input type="text" id="editSubject" name="subject" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">

                <label for="editMessage">Message</label>
                <textarea id="editMessage" name="message" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"></textarea>

                <!-- Status Dropdown -->
                <label for="editStatus">Status</label>
                <select id="editStatus" name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">
                    <option value="pending">Pending</option>
                    <option value="complete">Complete</option>
                </select>

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Save Changes</button>
            </div>
        </div>
    </form>
    <button id="closeModal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-md">Close</button>
</div>
<div id="modalOverlay" class="modal-overlay hidden"></div>

<script>
    // Open Edit Modal with prefilled inquiry data
    function openEditModal(inquiry) {
        document.getElementById('editInquiryId').value = inquiry.inquiry_id;
        document.getElementById('editName').value = inquiry.name;
        document.getElementById('editEmail').value = inquiry.email;
        document.getElementById('editContactNumber').value = inquiry.contact_number;
        document.getElementById('editSubject').value = inquiry.subject;
        document.getElementById('editMessage').value = inquiry.message;
        document.getElementById('editStatus').value = inquiry.status;

        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('modalOverlay').classList.remove('hidden');
        document.getElementById('main-content').classList.add('blur-background');  // Only blur the main content
    }

    // Close Modal
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('modalOverlay').classList.add('hidden');
        document.getElementById('main-content').classList.remove('blur-background');  // Unblur the main content
    });

    // Confirm before deleting an inquiry
    function confirmDelete(inquiryId) {
        if (confirm("Are you sure you want to delete this inquiry?")) {
            window.location.href = `/clothing-store/public/admin/deleteInquiry?id=${inquiryId}`;
        }
    }
</script>

</body>
</html>
