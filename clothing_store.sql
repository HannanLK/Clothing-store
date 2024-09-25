-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 01:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothing_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `image`, `content`, `author`, `summary`, `date_added`) VALUES
(1, 'bnn', '12.jpg', 'jj', 'kk', 'mmkk', '2024-09-09 12:17:48'),
(3, 'Hello World', '12.jpg', 'lorem ipsum', 'HannanLK', 'Hello World is the what we test', '2024-09-09 13:00:28'),
(4, 'Test2', '12.jpg', 'hahahhuu', 'huu', 'test2', '2024-09-09 13:02:31'),
(5, 'Hannan', NULL, 'jfoheoh2wehhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh\r\n\r\nfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 'ddndnd', 'ye8y2832y4r', '2024-09-20 06:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(72, 1, 19, 3),
(86, 9, 20, 7),
(87, 9, 1, 4),
(88, 9, 17, 1),
(89, 9, 19, 1),
(91, 10, 19, 2),
(92, 10, 20, 2),
(94, 10, 17, 8),
(97, 10, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'mens', 'Men\'s clothing and accessories'),
(2, 'womens', 'Women\'s clothing and accessories'),
(3, 'accessories', 'Accessories for men and women');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `inquiry_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('pending','complete') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`inquiry_id`, `name`, `email`, `contact_number`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(5, 'John Doe', 'john@example.com', '1234567890', 'Product Inquiry', 'I want to know more about your product.', 'complete', '2024-09-14 14:08:44', '2024-09-18 20:15:08'),
(6, 'Jane Smith', 'jane@example.com', '0987654321', 'Order Status', 'When will my order arrive?', 'complete', '2024-09-14 14:08:44', '2024-09-17 13:05:16'),
(7, 'Bob Johnson', 'bob@example.com', '5551234567', 'Refund Request', 'I would like to request a refund.', 'pending', '2024-09-14 14:08:44', '2024-09-14 14:08:44'),
(8, 'Hannan', 'MunasDeen@slt.lk', '5558866633', 'Order Delay', 'Hello this is to inform you that this is a testing', 'pending', '2024-09-25 00:12:11', '2024-09-25 03:42:11');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_status_history`
--

CREATE TABLE `inquiry_status_history` (
  `history_id` int(11) NOT NULL,
  `inquiry_id` int(11) NOT NULL,
  `old_status` enum('pending','complete') NOT NULL,
  `new_status` enum('pending','complete') NOT NULL,
  `changed_at` datetime DEFAULT current_timestamp(),
  `changed_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiry_status_history`
--

INSERT INTO `inquiry_status_history` (`history_id`, `inquiry_id`, `old_status`, `new_status`, `changed_at`, `changed_by`) VALUES
(12, 5, 'pending', 'complete', '2024-09-14 14:54:58', 'Admin User'),
(14, 6, 'pending', 'complete', '2024-09-17 13:05:16', 'Admin User'),
(15, 5, 'pending', 'complete', '2024-09-18 20:15:08', 'Admin User');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `address`, `contact_number`, `created_at`) VALUES
(1, 1, 336.60, '', '', '2024-09-16 15:45:47'),
(2, 1, 584.10, '77, Hortan Pl, Colombo 07', '0768535555', '2024-09-16 16:29:42'),
(3, 1, 1.00, '77, Hortan Pl, Colombo 07', '0768535555', '2024-09-16 16:36:14'),
(4, 1, 183.70, '77, Hortan Pl, Colombo 07', '0768535555', '2024-09-17 07:26:54'),
(5, 10, 272.80, 'malwana', '77777777777777', '2024-09-19 06:29:37'),
(6, 10, 0.00, 'malwana', '77777777777777', '2024-09-19 06:37:20'),
(7, 10, 130.89, 'malwana', '77777777777777', '2024-09-19 08:03:36'),
(8, 10, 73.70, 'malwana', '77777777777777', '2024-09-19 19:52:24'),
(9, 10, 218.90, 'malwana', '77777777777777', '2024-09-20 09:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 7, 17, 1, 1.00),
(2, 7, 20, 1, 66.00),
(3, 7, 1, 1, 29.99),
(4, 7, 15, 1, 22.00),
(5, 8, 17, 1, 1.00),
(6, 8, 20, 1, 66.00),
(7, 9, 17, 1, 1.00),
(8, 9, 20, 3, 66.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_featured` tinyint(1) DEFAULT 0,
  `quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `price`, `description`, `image`, `created_at`, `is_featured`, `quantity`) VALUES
(1, 'Shirt', 1, 29.99, 'Men\'s casual shirt', 'shirt.png', '2024-09-09 05:18:03', 1, 20),
(3, 'Skirt', 2, 39.99, 'Women\'s skirt', 'skirt.png', '2024-09-09 05:18:03', 1, 0),
(4, 'Blouse', 2, 24.99, 'Women\'s blouse', 'blouse.png', '2024-09-09 05:18:03', 1, 0),
(5, 'Wallet', 3, 19.99, 'Leather wallet for men and women', '', '2024-09-09 05:18:03', 0, 2),
(6, 'Belt', 3, 14.99, 'Stylish belt for men and women', '', '2024-09-09 05:18:03', 0, 0),
(13, 'Testing 1', 1, 20.00, 'hhhhhhh', 'trousers.png', '2024-09-09 07:04:14', 1, 0),
(14, 'testing 3', 1, 3.00, '33', 'trousers.png', '2024-09-09 07:04:32', 0, 0),
(15, 'testing 2', 1, 22.00, '22', 'trousers.png', '2024-09-09 07:04:51', 0, 11),
(16, 'testing 4', 1, 3.00, '22', 'trousers.png', '2024-09-09 07:05:11', 0, 0),
(17, '1', 1, 1.00, 'a', 'trousers.png', '2024-09-09 07:39:01', 1, 2),
(18, '2', 1, 33.00, '33', 'trousers.png', '2024-09-09 07:40:56', 0, 0),
(19, 'bbb', 2, 50.00, 'guvuvjv', 'trousers.png', '2024-09-10 08:51:29', 1, 2),
(20, 'test55', 1, 66.00, 'ddd', 'trousers.png', '2024-09-13 03:33:19', 0, 13),
(21, 'Jane Smith', 1, 22.00, '222', 'trousers.png', '2024-09-25 09:33:07', 0, 22);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `revenue` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `role` enum('customer','admin') DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `address`, `phone`, `username`, `password`, `created_at`, `role`) VALUES
(1, 'testing 3', 'hannanmunas76@gmail.com', '77, Hortan Pl, Colombo 07', '0768535555', 'hannanlk', '$2y$10$X.Oq/O3PTuNCBpUvAwCRtePFhyOVgj1y8qjzOySq2RS6n2wj.G2ai', '2024-09-14 09:43:25', 'admin'),
(7, 'Hannan Munas', 'CB011253@students.apiit.lk', '44', '444444', 'submit', '$2y$10$/m3JzsBvBlNQqXgZATgcAeX8kFIEHXhSLULLiD9bVrZRD6GE3jpa6', '2024-09-17 15:30:05', 'customer'),
(8, 'Hannan Munas', 'hello@gmail.com', '15/dd', '0412230760', 'hannan', '$2y$10$BEsOvzYy8oDf9qmoF4ws9ORx/rnWUREW9FYBjd7Xb7AqU8bg94gXG', '2024-09-17 15:37:37', 'customer'),
(9, 'admin', 'admin@gmail.com', 'admin', '0111223658888', 'admin', '$2y$10$ziMCR4ZicJZ.3P80v7Zm3OG.s5rRAddMpSbs5KXXUyh9afbDCklLm', '2024-09-17 15:38:29', 'admin'),
(10, 'Dilanka Yasuru', 'yasiru@gmail.com', 'malwana', '77777777777777', 'dilanka', '$2y$10$9EYPm50UI1BggwGTVOe6COny6nbeHKYoPQ8vL39lxlCvND7nrJcsW', '2024-09-17 16:31:45', 'customer'),
(11, 'Anura Kumara', 'akd@slt.lk', 'pelawatte', '44411155522', 'akd', '$2y$10$9xM3IC8Ap0/McAuFW2tLU.kXLuSajK3TVT9Uofr5eAPqZA//G2iga', '2024-09-18 17:05:36', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`product_id`),
  ADD KEY `cart_ibfk_2` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`inquiry_id`);

--
-- Indexes for table `inquiry_status_history`
--
ALTER TABLE `inquiry_status_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `inquiry_id` (`inquiry_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inquiry_status_history`
--
ALTER TABLE `inquiry_status_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inquiry_status_history`
--
ALTER TABLE `inquiry_status_history`
  ADD CONSTRAINT `inquiry_status_history_ibfk_1` FOREIGN KEY (`inquiry_id`) REFERENCES `inquiries` (`inquiry_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
