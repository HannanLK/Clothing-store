<?php $title = "Blogs"; ?>
<div>
    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5 text-center">OUR BLOGS</h1>
        <hr class=" w-10 border-t-2 border-blue-950 mx-auto mb-2">

        <!-- Blog Cards Section -->
        <div id="blogsContainer">
            <?php if (!empty($blogs)): ?>
                <?php foreach ($blogs as $blog): ?>
                    <div class="blog-card rounded-sm shadow-md mb-6">
                        <div class="flex flex-col md:flex-row"> <!-- Flex for responsiveness -->
                            <!-- Blog Image -->
                            <img src="<?= BASE_URL ?>images/blog/<?= htmlspecialchars($blog['image']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>" class="w-full md:w-1/3 h-64 object-cover rounded-sm mb-4 md:mb-0 md:mr-5">
                            
                            <!-- Blog Details -->
                            <div class="w-full md:w-2/3">
                                <h2 class="text-2xl font-bold"><?= htmlspecialchars($blog['title']) ?></h2>
                                <p class="text-gray-600"><?= htmlspecialchars($blog['summary']) ?></p>
                                <p class="text-sm text-gray-500 my-3">By <?= htmlspecialchars($blog['author']) ?> on <?= date('M d, Y', strtotime($blog['date_added'])) ?></p>
                                
                                <!-- Continue Reading Link -->
                                <button class="bg-black text-white px-3 py-2 rounded-sm mt-2 continue-reading" data-id="<?= $blog['id'] ?>">Continue Reading</button>
                                
                                <!-- Blog Content (Hidden Initially) -->
                                <div id="content-<?= $blog['id'] ?>" class="blog-content hidden mt-3">
                                    <p class="mr-6"><?= nl2br(htmlspecialchars($blog['content'])) ?></p>
                                    <button class="bg-white text-black px-3 py-2 rounded-sm outline outline-1 mt hide-content" data-id="<?= $blog['id'] ?>">Hide</button>
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
                content.classList.remove('hidden');  // Show the blog content
                this.style.display = 'none';  // Hide the "Continue Reading" button
            });
        });

        document.querySelectorAll('.hide-content').forEach(button => {
            button.addEventListener('click', function() {
                const blogId = this.getAttribute('data-id');
                const content = document.getElementById('content-' + blogId);
                content.classList.add('hidden');  // Hide the blog content
                document.querySelector(`.continue-reading[data-id="${blogId}"]`).style.display = 'inline-block';  // Show the "Continue Reading" button
            });
        });
    </script>
</div>
