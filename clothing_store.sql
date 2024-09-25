-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 08:13 PM
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
(6, 'Go Beyond The Looks', 'ban1.jpg', 'Fashion is often perceived as just a way to look good, but it is so much more than that. It is an expression of identity, culture, and personality. Going beyond the looks means understanding the deeper meaning behind what we wear.\r\n\r\nPersonal Expression: Fashion allows individuals to express themselves uniquely. Each choice reflects a piece of their personality and story. As Coco Chanel once said, &quot;Fashion is not something that exists in dresses only. Fashion is in the sky, in the street, fashion has to do with ideas, the way we live, what is happening.&quot; I remember my first high school dance when I wore a vintage dress from my grandmother&#039;s closet. It wasn’t just a dress; it was a story of my family’s history and my own emerging sense of style. (Image: A diverse group of people wearing different styles of clothing, showcasing their unique fashion sense.)\r\n\r\nCultural Significance: Different cultures have distinct fashion styles that carry historical and traditional significance. Wearing these styles connects people to their heritage and keeps traditions alive. My friend, Amara, always wears a traditional kente cloth during family gatherings. For her, it’s not just about the vibrant colors but about honoring her Ghanaian roots. (Image: Traditional clothing from various cultures.)\r\n\r\nSustainability and Ethics: Modern fashion also involves making conscious choices about the impact of our clothing on the environment and society. Supporting sustainable and ethical brands is a step towards responsible fashion. Remember when I decided to switch to eco-friendly brands? It felt empowering to know that my choices were making a positive impact. &quot;Buy less, choose well, make it last,&quot; as Vivienne Westwood advocates. (Image: Eco-friendly clothing brands or sustainable fashion practices.)', 'hannanlk', 'Fashion is more than just appearances; it&#039;s a form of self-expression, cultural connection, and ethical responsibility. Discover the deeper meaning behind what we wear and how it impacts our world.', '2024-09-25 17:46:31'),
(7, 'Street Style Looks Worth Recreating This Summer', 'ban2.jpg', 'Street style is where fashion meets practicality, offering a perfect blend of comfort and trendiness. This summer, let&#039;s explore some street style looks that are worth recreating.\r\n\r\nCasual Chic: Pair a loose, white tee with high-waisted denim shorts and comfortable sneakers. Add a wide-brimmed hat and sunglasses for a relaxed yet stylish look. Last summer, I practically lived in this outfit. It was my go-to for everything from coffee runs to beach outings. (Image: Person wearing a casual chic street style outfit.)\r\n\r\nBoho Vibes: A flowy maxi dress with vibrant patterns, paired with gladiator sandals and a fringed bag, brings out the bohemian spirit perfect for summer festivals. I attended a summer music festival last year in this ensemble and felt effortlessly chic while staying cool and comfortable. (Image: Person in a boho-style maxi dress at a summer festival.)\r\n\r\nAthleisure: Mix athletic wear with casual pieces. Think of a sporty crop top with jogger pants and a lightweight bomber jacket. Finish the look with trendy sneakers. &quot;Athleisure is the perfect blend of comfort and style,&quot; says fashion blogger Jane Doe. I couldn’t agree more—it’s my favorite for weekend errands and casual hangouts. (Image: Person in an athleisure outfit, combining sportswear and casual pieces.)\r\n\r\nDenim on Denim: A classic denim jacket paired with skinny jeans or a denim skirt creates a timeless look. Accessorize with a statement belt and ankle boots. This look reminds me of my high school days, a nostalgic yet stylish choice. (Image: Person wearing a denim-on-denim outfit.)', 'Shree Wickrama Rajasinghe', 'From casual chic to boho vibes, summer street style is all about comfort and trendiness. Explore these easy-to-recreate looks that will keep you stylish all season long.', '2024-09-25 17:49:01'),
(8, 'How To Treat The Dry Skin', 'ban3.jpg', 'Dry skin can be a common issue, especially in harsh weather conditions. Understanding the science behind skin hydration can help in effectively treating it.\r\n\r\nHydration from Within: Drinking plenty of water is crucial as it helps maintain the skin&#039;s moisture balance. I always start my day with a glass of water, and it has made a noticeable difference in my skin’s hydration levels. (Image: A glass of water or someone drinking water.)\r\n\r\nMoisturizing: Use a good moisturizer that contains hyaluronic acid, glycerin, or urea, which attract and retain moisture in the skin. &quot;Hydration is the key to happy skin,&quot; says dermatologist Dr. Emily Roberts. I switched to a moisturizer with hyaluronic acid, and my skin has never felt better. (Image: Different types of moisturizers, showing ingredients.)\r\n\r\nAvoid Harsh Soaps: Harsh soaps can strip the skin of its natural oils, leading to dryness. Opt for gentle, hydrating cleansers instead. My dermatologist once advised me to switch to a milder cleanser, and it was a game-changer for my skin. (Image: Gentle cleansers versus harsh soaps.)\r\n\r\nHumidifiers: Using a humidifier can add moisture to the air, especially in dry indoor environments, helping keep the skin hydrated. During winter, my humidifier is my best friend—it keeps my skin from drying out in the heated air. (Image: A humidifier in a room setting.)\r\n\r\nDiet and Nutrition: Foods rich in omega-3 fatty acids, like fish and flaxseed, can help improve skin hydration. Incorporating salmon into my diet a few times a week has worked wonders for my skin. (Image: Foods rich in omega-3 fatty acids.)', 'Mangala Samaraweera', 'Dry skin can be managed with proper hydration, moisturizing, and a balanced diet. Learn about the science behind skin hydration and effective treatments to keep your skin healthy.', '2024-09-25 17:51:06'),
(9, 'Invest In Key Pieces', 'ban4.jpg', 'Building a versatile wardrobe doesn&#039;t require an extensive collection. Investing in key pieces can help create multiple outfits with a few essentials.\r\n\r\nClassic Blazer: A well-fitted blazer can elevate any outfit, from jeans to dresses, making it a must-have. I remember the day I invested in my first tailored blazer. It transformed my entire wardrobe, adding a touch of sophistication to every outfit. (Image: Different styles of blazers paired with various outfits.)\r\n\r\nLittle Black Dress: The LBD is timeless and versatile, suitable for numerous occasions with the right accessories. My go-to LBD has seen me through countless events, from dinner dates to business meetings. &quot;One is never overdressed or underdressed with a Little Black Dress,&quot; said Karl Lagerfeld. (Image: Various styles of little black dresses.)\r\n\r\nQuality Denim: A pair of high-quality jeans that fit perfectly can be dressed up or down. Finding the perfect pair of jeans was like discovering a fashion holy grail—they instantly became a staple in my wardrobe. (Image: Different styles of jeans paired with different tops.)\r\n\r\nWhite Shirt: A crisp white shirt is a wardrobe staple that can be styled in countless ways. I once wore a white shirt with a statement necklace to an interview, and it became my lucky charm for formal events. (Image: Different ways to style a white shirt.)\r\n\r\nComfortable Shoes: Investing in comfortable yet stylish shoes is essential for any wardrobe. Think of classic pumps, versatile flats, and trendy sneakers. I can&#039;t count the number of times my comfy loafers saved me during long workdays. (Image: Different types of essential shoes.)', 'AKD', 'Investing in key pieces like a classic blazer, little black dress, and quality denim can help build a versatile and stylish wardrobe. Discover the essentials that can transform your fashion game.', '2024-09-25 17:53:35');

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
(22, 'Black Mens Shorts', 1, 499.00, 'Introducing our black shorts, crafted from soft and breathable Tencel for all-day comfort. Designed with an elastic waistband for a flexible fit, these shorts offer ease of movement, perfect for casual outings or lounging. \r\n\r\nMaterial : Tencel\r\nMaterial Composition : 95% Tencel, 5% Spandex\r\n\r\nInspired by minimalistic, timeless styles, these versatile shorts are a must-have for any wardrobe.', 'men1.jpg', '2024-09-25 12:04:03', 0, 10),
(23, 'Short Sleeve Shirt', 1, 899.00, 'Our short sleeve shirt is made from 100% polyester, offering a lightweight and breathable feel for everyday wear. The fabric is wrinkle-resistant, ensuring a sharp look throughout the day. Its classic design features a relaxed fit, perfect for casual or semi-formal occasions.\r\n\r\nShort Sleeve\r\nMaterial : Polyester\r\nMaterial Composition : 100% Polyester\r\n\r\n Easy to care for, this shirt is machine washable and quick-drying. Ideal for versatile styling, it’s a great addition to any wardrobe.', 'men2.jpg', '2024-09-25 12:17:51', 0, 3),
(25, 'Lace Revere Collar Shirt', 1, 755.00, 'Introducing the Lace Revere Collar Shirt, a perfect fusion of elegance and comfort. Made from 80% Tencel and 20% Cotton, this short sleeve shirt is soft, breathable, and ideal for warm weather\r\n\r\nShort Sleeve\r\nMaterial : Tencel\r\nMaterial Composition : 80% Tencel 20% Cotton\r\n\r\nThe lace detailing adds a touch of sophistication, while the revere collar gives it a relaxed yet stylish look. Designed for both casual and semi-formal occasions, its easy to care for and can be machine washed. This shirt is your go-to piece for effortless chic.', 'men6.jpg', '2024-09-25 12:42:10', 1, 8),
(26, 'Chineese Collar Long Sleeve Shirt', 1, 996.00, 'The Chinese Collar Long Sleeve Shirt offers a sleek and modern look, perfect for both casual and formal occasions. The minimalist Chinese collar adds a refined touch, while the long sleeves make it suitable for year-round wear. Its lightweight design ensures all-day comfort and ease of movement.\r\n\r\nMaterial:\r\n100% Polyester\r\n\r\nDurable and easy to care for, this shirt is wrinkle-resistant and machine washable, maintaining its crisp, polished look with minimal effort. Ideal for those seeking style without compromising on convenience.', 'men3.jpg', '2024-09-25 12:56:14', 0, 4),
(27, 'Normal Collar Long Sleeve Shirt', 1, 1100.00, 'The Normal Collar Long Sleeve Shirt is a sophisticated choice for formal wear, offering a clean and timeless look. With its classic collar and tailored fit, this shirt is perfect for the office or formal events.\r\n\r\nMaterial:\r\n93% Polyester, 7% Spandex\r\n\r\nThe blend of polyester and spandex offers durability with a slight stretch, allowing for easy movement. Wrinkle-resistant and machine washable, this shirt combines style and practicality for effortless care.', 'men4.jpg', '2024-09-25 13:02:57', 0, 0),
(28, 'Printed Long Sleeve Shirt', 1, 1320.00, 'Long Sleeve Shirt combines bold patterns with a modern, minimalist design. Featuring a distinctive Chinese collar, this shirt adds a stylish twist to your formal or casual wardrobe\r\n\r\nMaterial:\r\n95% Cotton, 5% Spandex\r\n\r\nMade from a soft cotton blend with added spandex for flexibility, this shirt ensures comfort and ease of movement. It’s breathable, durable, and machine washable, making it both stylish and practical for any occasion.', 'men5.jpg', '2024-09-25 13:08:05', 0, 0),
(29, 'Double Pocket Long Sleeve Shirt', 1, 1299.00, 'Stand out in style with our Double Pocket Long Sleeve Shirt, featuring a bold dark red check print for a fashion-forward look. The double pocket design adds a touch of utility and sophistication, making this shirt a versatile choice for any occasion. Its long sleeves and tailored fit ensure a sharp, polished appearance, perfect for both casual and formal settings.\r\n\r\nMaterial:\r\n100% Cotton\r\n\r\nCrafted from pure cotton, this shirt is breathable, comfortable, and easy to care for. Machine washable, it offers a perfect blend of style and practicality, making it a must-have in any wardrobe.', 'men7.jpg', '2024-09-25 13:12:46', 0, 14),
(30, 'Pencil Skirt', 2, 2100.00, 'Made from a high-quality polyester blend, this skirt is both durable and comfortable. The added spandex provides a slight stretch, allowing for ease of movement throughout your day. Easy to care for and maintain, this pencil skirt is a timeless staple that combines style and functionality.\r\n\r\nMaterial:\r\n97% Polyester, 3% Spandex\r\n\r\nThe classic design allows for easy pairing with blouses or blazers, ensuring you always look polished and put-together.', 'women1.jpg', '2024-09-25 15:14:27', 1, 10),
(31, 'High Waisted Detail Skirt', 2, 899.00, 'The High Waisted Detail Skirt is perfect for evening and special occasions, offering a flattering silhouette with its high-waisted design and subtle detailing. Ideal for pairing with elegant tops for a refined look.\r\n\r\nMaterial:\r\n93% Polyester, 7% Elastane\r\n\r\nThe fabric blend provides comfort and a slight stretch, ensuring a sleek fit that moves with you throughout the evening.', 'women3.jpg', '2024-09-25 16:04:16', 0, 4),
(32, 'Denim Jacket', 2, 1199.00, 'Our Denim Jacket is a timeless classic, perfect for casual layering. With its structured fit and versatile style, it’s an essential wardrobe staple for any season.\r\n\r\nMaterial:\r\n100% Cotton\r\n\r\nCrafted from durable cotton, this jacket offers both comfort and long-lasting wear, making it ideal for everyday use.', 'women4.jpg', '2024-09-25 16:11:44', 1, 3),
(33, 'Square Neck Midi Dress', 2, 2000.00, 'The Square Neck Midi Dress is the perfect choice for occasional and evening wear, offering a sophisticated and elegant silhouette. The square neckline adds a modern touch, while the midi length creates a graceful, timeless look. Designed to make a statement at any event, this dress is ideal for formal occasions or evening gatherings.\r\n\r\nMaterial:\r\n97% Polyester, 3% Elastane\r\n\r\nCrafted from a soft yet durable polyester blend, with a hint of elastane for stretch, this dress offers a comfortable fit while maintaining its structure. Easy to care for and wrinkle-resistant, it’s both stylish and practical for any special occasion.', 'women11.jpg', '2024-09-25 16:13:19', 0, 8),
(34, 'Smoke Tube Top', 2, 988.00, 'The Smoke Tube Top is a chic addition to your occasional and evening wear collection. Designed with a sleek, strapless silhouette, this top hugs your figure for a flattering, elegant look. Perfect for pairing with high-waisted skirts or trousers, it’s ideal for parties, dinners, or any special event where you want to make a statement.\r\n\r\nMaterial:\r\n100% Polyester\r\n\r\nMade from 100% polyester, this top is lightweight, durable, and comfortable. The fabric offers a smooth finish, making it easy to care for and ensuring it maintains its shape throughout wear.', 'women6.jpg', '2024-09-25 16:17:43', 0, 0),
(35, 'Waist Wide Leg Pants', 2, 788.00, 'The Waist Wide Leg Pants offer a relaxed yet stylish fit, perfect for casual wear. Featuring a high-waist design and wide-leg silhouette, these pants provide comfort and effortless chic, ideal for a laid-back day or casual outings. Pair them with your favorite tops for an easy, fashionable look.\r\n\r\nMaterial:\r\n100% Rayon\r\n\r\nCrafted from lightweight and breathable rayon, these pants are soft to the touch and provide all-day comfort. Easy to care for and versatile, they’re a great addition to any casual wardrobe.', 'women10.jpg', '2024-09-25 16:21:41', 0, 0),
(36, 'Envoy Classic Leather Belt', 3, 3500.00, 'Elevate your accessories with the Envoy Classic Men’s Brown Leather Belt and Wallet set. Crafted from high-quality genuine cow leather, this sleek ensemble features a 35mm adjustable belt with a nickel-plated buckle and a matching wallet with 10 slots and a coin pocket.\r\n\r\nBrand: Envoy Classic\r\nMaterial: Genuine Cow Leather\r\nOccasion: Formal Wear\r\nColor: Coffee Brown\r\n\r\nThe perfect gift for those who appreciate timeless style and functionality.', 'acc1.jpg', '2024-09-25 16:44:01', 0, 0),
(37, 'Yardley Sport Perfume', 3, 5999.00, 'Yardley Sport Perfume is a refreshing fragrance designed for the active and dynamic man. Its invigorating scent combines fresh citrus notes with subtle woody undertones, perfect for everyday wear or post-workout freshness.\r\n\r\nBrand: Yardley\r\nOccasion: Casual &amp; Sporty\r\nFragrance Type: Eau de Toilette\r\nTop Notes: Citrus\r\nBase Notes: Woody\r\n\r\nStay fresh and energized with Yardley Sport, a perfect blend of vitality and sophistication.', 'acc3.jpg', '2024-09-25 16:50:02', 0, 2),
(38, 'Cufflink LK', 3, 4750.00, 'Elevate your style with the Envoy Classic Men’s Nickel-Plated Silver Embossed Cufflinks. Featuring a sleek silver finish and an embossed &quot;Envoy&quot; motif, these cufflinks add a touch of elegance to any formal attire.\r\n\r\nBrand: Envoy Classic\r\nMaterial: Nickel-Plated with Embossed &quot;Envoy&quot;\r\nColor: Silver\r\nIncludes: 1 Pair of Cufflinks in a Presentation Box\r\nOccasion: Formal Events, Weddings, Business Attire\r\n\r\nPerfect for adding sophistication to your look or as a gift for the discerning gentleman.', 'acc4.jpg', '2024-09-25 16:53:05', 0, 10),
(39, 'Envoy Classic Leather Belt', 3, 6200.00, 'The Envoy Classic Men’s Tan Leather Belt and Wallet set offers a perfect blend of style and sophistication. Crafted from genuine cow leather, this set features a sleek tan belt with a nickel-plated buckle and a matching wallet with 10 slots and a coin pocket, ideal for formal occasions.\r\n\r\nBrand: Envoy Classic\r\nMaterial: Genuine Cow Leather\r\nBelt Width: 35mm\r\nWallet Dimensions: 12 cm x 10 cm\r\nColor: Tan\r\nOccasion: Formal Wear\r\n\r\nThis classic set is the perfect gift for those who appreciate quality and timeless elegance.', 'acc2.jpg', '2024-09-25 16:54:46', 0, 7),
(40, 'Stripe Linen Shirt', 1, 4100.00, 'The Stripe Linen Shirt is a versatile addition to your wardrobe, offering a relaxed yet polished look. Its long sleeves and classic stripe pattern make it perfect for both casual and semi-formal occasions. The lightweight fabric ensures breathability and comfort throughout the day.\r\n\r\nMaterial:\r\n25% Linen, 75% Rayon\r\n\r\nThe blend of linen and rayon provides a soft, airy feel, making it ideal for warm weather. Easy to style and care for, this shirt brings effortless sophistication to any outfit.', 'men8.jpg', '2024-09-25 17:58:26', 0, 10),
(41, 'Ruched Skirt', 2, 4999.00, 'The Ruched Skirt is a stylish and comfortable choice for casual wear. Featuring a flattering ruched design, this skirt accentuates your curves while providing a relaxed fit. It&#039;s perfect for pairing with tees or blouses for a chic, laid-back look.\r\n\r\nMaterial:\r\n95% Rayon, 5% Spandex\r\n\r\nMade from a soft rayon blend with a touch of spandex for added stretch, this skirt offers all-day comfort and ease of movement. Easy to care for, it’s a versatile piece that adds a touch of flair to your casual wardrobe.', 'women8.jpg', '2024-09-25 18:00:24', 0, 10),
(42, 'Ruched Detail Midi Dress', 2, 7200.00, 'The Ruched Detail Midi Dress is a fashionable choice for casual wear, featuring flattering ruched accents that enhance your silhouette. The midi length and comfortable fit make it perfect for everyday outings or relaxed gatherings.\r\n\r\nMaterial:\r\n97% Polyester, 3% Elastane\r\n\r\nCrafted from a soft polyester blend with a hint of elastane for stretch, this dress offers comfort and ease of movement. Easy to care for and stylish, it’s a versatile addition to any casual wardrobe.', 'women7.jpg', '2024-09-25 18:02:35', 0, 8);

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
(12, 'Hannan Munas', 'hannanmunas76@gmail.com', '77, Hortan Pl, Colombo 07', '0768535555', 'hannanlk', '$2y$10$jwdy7UiXJyuGFIU5kR9xjOAATwU037ZhdZt1d5S6OcxW8g4y8a72S', '2024-09-25 22:46:44', 'admin'),
(13, 'Customer', 'Customer@apiit.lk', '388, Union Place, Colombo 02', '119', 'customer', '$2y$10$AgFqevp/nng4qTxL4nbzMOE8z8A2pfzwhotEE9qA1GD73FKqqFbCS', '2024-09-25 23:06:53', 'customer'),
(15, 'Admin Sirisena', 'admin@apiit.lk', '388, Union Place, Colombo 02', '1919', 'admin', '$2y$10$Bi6NW8LB58IY4.NqToGUJ.6qWZzp54ceJfl3L8hZlhMcLRuxpNwNm', '2024-09-25 23:08:13', 'admin');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
