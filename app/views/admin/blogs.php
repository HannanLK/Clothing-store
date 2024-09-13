<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="container mx-auto p-5">
    <h1 class="text-3xl font-bold mb-5">Blog Management</h1>

    <!-- Add Blog Button -->
    <button id="showAddBlogForm" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-5">Add Blog</button>

    <!-- Add Blog Form (hidden initially) -->
    <div id="addBlogForm" class="bg-white p-6 rounded-md shadow-md hidden">
        <h2 class="text-2xl font-semibold mb-4">Add Blog</h2>
        <form action="/clothing-store/public/admin/addBlog" method="POST" enctype="multipart/form-data">
            <label for="title" class="block text-lg font-medium">Blog Title:</label>
            <input type="text" id="title" name="title" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">

            <label for="summary" class="block text-lg font-medium">Summary:</label>
            <textarea id="summary" name="summary" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"></textarea>

            <label for="content" class="block text-lg font-medium">Content:</label>
            <textarea id="content" name="content" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"></textarea>

            <label for="author" class="block text-lg font-medium">Author:</label>
            <input type="text" id="author" name="author" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">

            <label for="image" class="block text-lg font-medium">Blog Image:</label>
            <input type="file" id="image" name="image" class="w-full mb-3"><br>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Save Blog</button>
        </form>
    </div>

    <hr class="my-6">

    <!-- Blog Table -->

    <!-- Blog Table -->
    <h2 class="text-2xl font-bold mb-4">Existing Blogs</h2>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Date Added</th>
                <th class="px-4 py-2 border">Title</th>
                <th class="px-4 py-2 border">Summary Text</th>
                <th class="px-4 py-2 border">Author</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($blogs)): ?>
                <?php foreach ($blogs as $blog): ?>
                <tr>
                    <td class="border px-4 py-2"><?= htmlspecialchars($blog['id']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($blog['date_added']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($blog['title']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($blog['summary']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($blog['author']) ?></td>
                    
                    <td class="border px-4 py-2">
                        <button class="view-blog bg-blue-500 text-white px-3 py-2 rounded-md w-20" data-id="<?= $blog['id'] ?>">View</button>
                        <button class="edit-blog bg-yellow-500 text-white px-3 py-2 rounded-md w-20" data-id="<?= $blog['id'] ?>">Edit</button>
                        <button class="delete-blog bg-red-500 text-white px-3 py-2 rounded-md w-20" data-id="<?= $blog['id'] ?>">Delete</button>
                    </td>
                </tr>

                <!-- Edit Form inside the table (hidden initially) -->
                <tr id="edit-form-<?= $blog['id'] ?>" class="hidden">
                    <td colspan="6">
                        <form action="/clothing-store/public/admin/editBlog" method="POST" enctype="multipart/form-data" class="bg-gray-100 p-4 rounded-lg">
                            <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>">

                            <label for="title">Blog Title:</label>
                            <input type="text" name="title" value="<?= htmlspecialchars($blog['title']) ?>" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"><br>
                            
                            <label for="summary">Summary:</label>
                            <textarea name="summary" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"><?= htmlspecialchars($blog['summary']) ?></textarea><br>

                            <label for="content">Content:</label>
                            <textarea name="content" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"><?= htmlspecialchars($blog['content']) ?></textarea><br>

                            <label for="author">Author:</label>
                            <input type="text" name="author" value="<?= htmlspecialchars($blog['author']) ?>" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"><br>

                            <label for="image">Update Image:</label>
                            <input type="file" name="image" class="w-full mb-3"><br>

                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Save Changes</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" class="border px-4 py-2">No blogs found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <hr class="my-6">

    <!-- Blog Cards Section -->
    <h2 class="text-2xl font-bold mb-4">Blog Cards</h2>
    <div class="space-y-6">
        <?php if (!empty($blogs)): ?>
            <?php foreach ($blogs as $blog): ?>
            <div class="blog-card bg-white rounded-lg shadow-md p-4 flex items-center" data-id="<?= $blog['id'] ?>">
                <!-- First column: Blog Image -->
                <div class="w-1/3">
                    <img src="/clothing-store/public/images/blog/<?= htmlspecialchars($blog['image']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>" class="w-full h-auto object-cover">
                </div>
                <!-- Second column: Blog Details -->
                <div class="w-2/3 ml-6">
                    <p class="text-lg font-semibold">Blog Title: <?= htmlspecialchars($blog['title']) ?></p>
                    <p class="text-gray-600">Author: <?= htmlspecialchars($blog['author']) ?></p>
                    <p class="text-gray-700">Summary: <?= htmlspecialchars($blog['summary']) ?></p>
                    <div class="mt-4">
                        <button class="edit-blog bg-yellow-500 text-white px-4 py-2 rounded-md" data-id="<?= $blog['id'] ?>">Edit</button>
                        <button class="view-content bg-blue-500 text-white px-4 py-2 rounded-md ml-2">View Content</button>
                        <button class="delete-blog bg-red-500 text-white px-4 py-2 rounded-md ml-2" data-id="<?= $blog['id'] ?>">Delete</button>
                    </div>
                    <!-- Hidden blog content displayed below buttons -->
                    <div class="blog-full-content hidden mt-3">
                        <p><?= htmlspecialchars($blog['content']) ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No blogs found.</p>
        <?php endif; ?>
    </div>

</div>

<script>
    // Toggle the Add Blog Form
    document.getElementById('showAddBlogForm').addEventListener('click', function () {
        document.getElementById('addBlogForm').classList.toggle('hidden');
    });

    // Toggle the edit form visibility on button click and scroll to the form
    document.querySelectorAll('.edit-blog').forEach(button => {
        button.addEventListener('click', function () {
            const blogId = this.getAttribute('data-id');
            const editForm = document.getElementById(`edit-form-${blogId}`);
            editForm.classList.toggle('hidden');
            
            // Scroll to the edit form when toggled open
            if (!editForm.classList.contains('hidden')) {
                editForm.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Delete blog with confirmation
    document.querySelectorAll('.delete-blog').forEach(button => {
        button.addEventListener('click', function () {
            const blogId = this.getAttribute('data-id');
            if (confirm("Are you sure you want to delete this blog?")) {
                window.location.href = `/clothing-store/public/admin/deleteBlog?id=${blogId}`;
            }
        });
    });

    // Toggle blog content visibility in blog card
    document.querySelectorAll('.view-content').forEach(button => {
        button.addEventListener('click', function () {
            const blogCard = this.closest('.blog-card');
            const content = blogCard.querySelector('.blog-full-content');
            content.classList.toggle('hidden');
        });
    });

    // Scroll to the relevant blog card when clicking the View button in the table
    document.querySelectorAll('.view-blog').forEach(button => {
        button.addEventListener('click', function () {
            const blogId = this.getAttribute('data-id');
            const blogCard = document.querySelector(`.blog-card[data-id='${blogId}']`);
            
            if (blogCard) {
                blogCard.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>

</body>
</html>
