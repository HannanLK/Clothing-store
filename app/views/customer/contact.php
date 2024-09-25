<?php $title = "Contact"; ?>
<!-- Contact Us Section -->
<div class="container mx-auto py-10 px-4 sm:px-6 md:px-10 lg:px-14">

    <!-- Display error message if present -->
    <?php if (isset($error)): ?>
        <div class="bg-red-500 text-white p-4 mb-4">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <h2 class="text-3xl font-bold text-left">CONTACT US</h2>
    <p class="text-left text-lg">
        388, Union Place, Colombo 02, Sri Lanka<br>
        Phone: +94768535555
    </p>

    <!-- Google Maps Embed -->
    <div class="my-5 shadow-lg rounded-md overflow-hidden">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.765657661971!2d79.85865397475698!3d6.918595293081008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2596d3cb8fe07%3A0x2b0ae2edd563a661!2sAsia%20Pacific%20Institute%20of%20Information%20Technology%20(APIIT)!5e0!3m2!1sen!2slk!4v1726928000515!5m2!1sen!2slk"
            width="100%" height="420" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <!-- Inquiries Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center my-6">
        <!-- Showroom Inquiries -->
        <div>
            <h3 class="text-lg font-semibold mb-3">Showroom Inquiries</h3>
            <p>9.00 AM - 6.00 PM (Mon - Fri)</p>
            <button class="bg-black text-white px-4 py-2 rounded-lg mt-2">Call Now</button>
        </div>
        <!-- Online Inquiries -->
        <div>
            <h3 class="text-lg font-semibold mb-3">Online Inquiries</h3>
            <p>Available 24/7</p>
            <button class="bg-black text-white px-4 py-2 rounded-lg mt-2">Call Now</button>
        </div>
        <!-- Order Status Inquiries -->
        <div>
            <h3 class="text-lg font-semibold mb-3">Order Status Inquiries</h3>
            <p>Available 24/7</p>
            <button class="bg-black text-white px-4 py-2 rounded-lg mt-2">Call Now</button>
        </div>
    </div>

    <hr class="w-10 border-t-2 border-blue-950 mx-auto my-5">

    <!-- Contact Form Section -->
    <div class="bg-white shadow-lg rounded-md mx-auto">
        <!-- Contact Form -->
        <form id="contactForm" action="<?= BASE_URL ?>contact/submit" method="POST" class="p-6 rounded-lg shadow-md">
            <h2 class="text-3xl font-semibold text-left my-2">REACH US</h2>
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="contact_number" class="block text-gray-700">Contact Number</label>
                <input type="text" id="contact_number" name="contact_number" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="subject" class="block text-gray-700">Subject</label>
                <input type="text" id="subject" name="subject" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="message" class="block text-gray-700">Message</label>
                <textarea id="message" name="message" class="w-full px-4 py-2 border rounded-lg" rows="5" required></textarea>
            </div>

            <div class="flex flex-col sm:flex-row">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-3 mb-2 sm:mb-0">Submit</button>
                <button type="reset" id="clearBtn" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Clear</button>
            </div>
        </form>
    </div>

    <hr class="w-10 border-t-2 border-blue-950 mx-auto my-7">

    <!-- About Us -->
    <div class="mt-5">
        <h2 class="text-3xl font-semibold mb-4">WHO ARE WE?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column: Image -->
            <div>
            <img src="<?= BASE_URL ?>images/banners/aboutUs.jpg" alt="about us image" class="w-full h-72 object-cover mb-4 rounded-lg">
            </div>
            <!-- Right Column: Text -->
            <div class="text-gray-600 text-justify mx-3">
                <p>
                    Established in 1972, Glitz has become the leading fashion retailer in Sri Lanka, renowned for our dedication to customer satisfaction and innovation. 
                    In 2012, we expanded our operations overseas, bringing our unique blend of contemporary and culturally rich designs to a global audience.
                    <br><br> 
                    Our collections are a testament to our commitment to quality and creativity, ensuring every piece reflects the elegance and heritage of Sri Lankan fashion.
                    At Glitz, we take pride in protecting Sri Lanka's cultural legacy while continuously introducing new design ideas that cater to diverse styles and preferences.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Script to Clear Form -->
<script>
    document.getElementById('clearBtn').addEventListener('click', function () {
        document.getElementById('contactForm').reset(); // Clear form fields
    });
</script>
