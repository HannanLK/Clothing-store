<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Tailwind CSS -->
    <style>
        .blog-content {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Our Blogs</h1>

        <!-- Blog Cards Section -->
        <div id="blogsContainer">
            <?php if (!empty($blogs)): ?>
                <?php foreach ($blogs as $blog): ?>
                    <div class="blog-card bg-white rounded-lg shadow-md p-5 mb-5">
                        <div class="flex">
                            <!-- Blog Image -->
                            <img src="/clothing-store/public/images/blog/<?= htmlspecialchars($blog['image']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>" class="w-1/3 h-48 object-cover rounded-lg mr-5">
                            
                            <!-- Blog Details -->
                            <div class="w-2/3">
                                <h2 class="text-2xl font-bold"><?= htmlspecialchars($blog['title']) ?></h2>
                                <p class="text-gray-600"><?= htmlspecialchars($blog['summary']) ?></p>
                                <p class="text-sm text-gray-500 mt-2">By <?= htmlspecialchars($blog['author']) ?> on <?= date('M d, Y', strtotime($blog['date_added'])) ?></p>
                                
                                <!-- Continue Reading Link -->
                                <button class="bg-blue-500 text-white px-4 py-2 rounded-md mt-3 continue-reading" data-id="<?= $blog['id'] ?>">Continue Reading</button>
                                
                                <!-- Blog Content (Hidden Initially) -->
                                <div id="content-<?= $blog['id'] ?>" class="blog-content mt-3">
                                    <p><?= htmlspecialchars($blog['content']) ?></p>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-md mt-2 hide-content" data-id="<?= $blog['id'] ?>">Hide</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No blogs available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Event listeners for Continue Reading and Hide buttons
        document.querySelectorAll('.continue-reading').forEach(button => {
            button.addEventListener('click', function() {
                const blogId = this.getAttribute('data-id');
                const content = document.getElementById('content-' + blogId);
                content.style.display = 'block';  // Show the blog content
                this.style.display = 'none';  // Hide the "Continue Reading" button
            });
        });

        document.querySelectorAll('.hide-content').forEach(button => {
            button.addEventListener('click', function() {
                const blogId = this.getAttribute('data-id');
                const content = document.getElementById('content-' + blogId);
                content.style.display = 'none';  // Hide the blog content
                document.querySelector(`.continue-reading[data-id="${blogId}"]`).style.display = 'inline-block';  // Show the "Continue Reading" button
            });
        });
    </script>

</body>
</html>
