-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 11:10 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(3, 'Food', 'restaurant.png'),
(4, 'Souvenirs', 'souvenir.png'),
(5, 'Clothes', 'clothes.png');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 1, 'Kammoun', '29528193', 'aminkammoun.2121@gmail.com', 'cash on delivery', 'flat no. adresse, sdasd, sfax, sak, tunisia - 3021', 'Barnous (80 x 1) - ', 80, '2024-04-19', 'pending'),
(2, 1, 'admin', '123456789', 'Test@gmail.com', 'paytm', 'flat no. adresse, sdasd, sfax, sak, tunisia - 20321', 'Barnous ($80 x 1piece(s)) - Deglet El Nour ($25 x 1piece(s)) - Chachiya ($15 x 1piece(s)) - Chachiya key ring ($5 x 1piece(s)) - ', 125, '2024-04-20', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_under_category` int(11) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `quantity`, `id_under_category`, `image_01`, `image_02`, `image_03`) VALUES
(7, 'Chachiya', 'The chechia, chachia, or chachiya, is a well-known headgear throughout the Mediterranean world.', 15, 50, 3, 'chechia-rouge-1.webp', 'chechia-rouge-avec-kobita.jpg', 'ROUGGGEEE.webp'),
(8, 'Barnous', 'The Tunisian barnous, a hooded, sleeveless woollen coat worn by Berber, Imazighan men who came from Africa in the early 19th century', 80, 30, 3, 'barnous-en-laine.jpg', 'barnous-en-laine (2).jpg', 'barnous-en-laine (1).jpg'),
(9, 'Deglet El Nour', 'Deglet Nours are popular in Algeria, and its seedlings have been harvested to Libya and Tunisia.', 25, 50, 6, 'deglet_nour_rama_02.png', '221-2211028_whole-dates-png-pic-deglet-nour-dates-png.png', 'DegletNourBranch_f7941fa6-fd81-4ae5-a82b-a36ece75731e.webp'),
(10, 'Chachiya key ring', 'A key ring souvenir of the Tunisian chachiya', 5, 100, 10, 'home-img-4.png', 'home-img-4.png', 'home-img-4.png'),
(11, 'Baklawa Fekia', 'Tunisian baklawa is a delectable pastry featuring layers of thin phyllo dough filled with nuts and spices, sweetened with honey or syrup, enjoyed as a delightful dessert in Tunisia and beyond.', 2, 50, 8, 'baklawa-fekia-500g.jpg', 'images.jpg', 'download (1).jpg'),
(12, 'Baklawa Almond', 'Tunisian baklawa is a delectable pastry featuring layers of thin phyllo dough filled with nuts and spices, sweetened with honey or syrup, enjoyed as a delightful dessert in Tunisia and beyond.', 2, 50, 8, 'baklawa-fekia-500g.png', 'Baklawa-amande-2.png', 'baklawa-amande_f3ab4f63-de5b-40c9-81cb-8b0c3ed8c5fd_1024x1024.webp'),
(13, 'Kaak Warka Almond', 'Kaak warka is a traditional Tunisian pastry made from thin sheets of warka dough, which is similar to phyllo dough, typically filled with a mixture of almonds, sugar, and spices such as cinnamon or anise.', 1, 50, 8, 'kaak-warka-amande-500g.jpg', 'kaak-warka-amande-500g.jpg', 'kaak-warka-amande-500g.jpg'),
(14, 'Kaak Ambar', 'Kaak warka is a traditional Tunisian pastry made from thin sheets of warka dough, which is similar to phyllo dough, typically filled with a mixture of almonds, sugar, and spices such as cinnamon or anise.', 1, 50, 8, 'kaak-ambar-500g.jpg', 'kaak-ambar-500g.jpg', 'kaak-ambar-500g.jpg'),
(15, 'Mlabes Almond', 'Mlabes is a traditional Tunisian sweet made from semolina, sugar, and oil, often flavored with citrus zest or rose water. The mixture is shaped into small balls or pressed into molds, then fried until golden brown and crispy. After frying, the mlabes is soaked in a syrup flavored with orange blossom water or rose water, giving it a sweet and aromatic taste.', 2, 50, 8, 'baklawa-fekia-500g (1).png', 'baklawa-fekia-500g (1).png', 'baklawa-fekia-500g (1).png'),
(16, 'Chocotom Biscuit', 'Chocotom Biscuit is a popular brand of biscuits in Tunisia, known for its chocolate-flavored biscuits. These biscuits often consist of two crunchy cookies sandwiched together with a creamy chocolate filling, providing a delightful chocolatey snack option.', 1, 50, 7, 'biscuit-choco-tom-gout-chocolat.jpg', 'biscuit-choco-tom-gout-chocolat.jpg', 'biscuit-choco-tom-gout-chocolat.jpg'),
(17, 'Tris Chocolate', 'food item featuring three varieties of chocolate, such as dark, milk, and white chocolate.', 1, 50, 7, 'chocolat-tris-croquant.jpg', 'chocolat-tris-croquant.jpg', 'chocolat-tris-croquant.jpg'),
(18, 'Said Chocolate Pouder', 'powder made from cocoa beans. Cocoa powder is often used as an ingredient in baking, hot chocolate drinks, and various desserts to add chocolate flavor.', 2, 50, 7, 'chocolat-en-poudre-said.jpg', 'chocolat-en-poudre-said.jpg', 'chocolat-en-poudre-said.jpg'),
(19, 'Break Cake', 'A delicious peace of cake', 1, 50, 7, 'gateaux-break-classic-fourres-vanille-saida-35g.jpg', 'gateaux-break-classic-fourres-vanille-saida-35g.jpg', 'gateaux-break-classic-fourres-vanille-saida-35g.jpg'),
(20, 'Sablito Biscuit', 'A delicious Tunisian Biscuit', 1, 50, 7, 'baklawa-fekia-500g (2).png', 'baklawa-fekia-500g (2).png', 'baklawa-fekia-500g (2).png'),
(21, 'Smile Biscuit', 'A biscuit that smiles for you :)', 1, 50, 7, 'biscuits-smile-gout-chocolat-kif.jpg', 'biscuits-smile-gout-chocolat-kif.jpg', 'biscuits-smile-gout-chocolat-kif.jpg'),
(22, 'Croustina Saida', 'Croustina', 1, 50, 7, 'croustina-saida-gout-cacao-vanille.jpg', 'croustina-saida-gout-cacao-vanille.jpg', 'croustina-saida-gout-cacao-vanille.jpg'),
(23, 'Gaucho Chocolate', 'Gaucho', 1, 50, 7, 'gaucho-gout-chocolat-saida.jpg', 'gaucho-gout-chocolat-saida.jpg', 'gaucho-gout-chocolat-saida.jpg'),
(24, 'Fourres Biscuit', 'Fourres', 1, 50, 7, 'biscuits-fourres-chocolat-kif.jpg', 'biscuits-fourres-chocolat-kif.jpg', 'biscuits-fourres-chocolat-kif.jpg'),
(25, 'Star Biscuit', 'Star in the sky', 1, 50, 7, 'galettes-start-aux-cereales-et-au-lait-saida.jpg', 'galettes-start-aux-cereales-et-au-lait-saida.jpg', 'galettes-start-aux-cereales-et-au-lait-saida.jpg'),
(26, 'Harissa Sicam', 'Harissa', 2, 50, 7, 'harissa-du-cap-bon-sicam-380-g.jpg', 'harissa-du-cap-bon-sicam-380-g.jpg', 'harissa-du-cap-bon-sicam-380-g.jpg'),
(27, 'Harissa Tube', 'Harrisa Tube', 1, 50, 7, 'harissa-en-tube-70gr-fnar.jpg', 'harissa-en-tube-70gr-fnar.jpg', 'harissa-en-tube-70gr-fnar.jpg'),
(28, 'Olive Oil 1L', 'Olive oil 1l', 5, 50, 7, 'lah-neya-robuste-huile-d-olive-extra-vierge-bio-de-tunisie-fermes-ali-sfar.jpg', 'lah-neya-robuste-huile-d-olive-extra-vierge-bio-de-tunisie-fermes-ali-sfar.jpg', 'lah-neya-robuste-huile-d-olive-extra-vierge-bio-de-tunisie-fermes-ali-sfar.jpg'),
(29, 'Olive Oil 3L', 'Olive oil 3l', 12, 50, 7, 'lah-neya-huile-d-olive-extra-vierge-de-tunisie-biologique-bidon-5l-fermes-ali-sfar (1).jpg', 'lah-neya-huile-d-olive-extra-vierge-de-tunisie-biologique-bidon-5l-fermes-ali-sfar (1).jpg', 'lah-neya-huile-d-olive-extra-vierge-de-tunisie-biologique-bidon-5l-fermes-ali-sfar (1).jpg'),
(30, 'Degla Standard', 'Standard dates', 18, 50, 6, 'coffret-1kg-1.png', 'coffret-1kg-1.png', 'coffret-1kg-1.png'),
(31, 'Camel Key Ring', 'CAMEL', 6, 50, 10, 'Souvenir-Gifts-Plastic-Keychain-Acrylic-Keychain-Camel-Keychain.jpg', 'Souvenir-Gifts-Plastic-Keychain-Acrylic-Keychain-Camel-Keychain.jpg', 'Souvenir-Gifts-Plastic-Keychain-Acrylic-Keychain-Camel-Keychain.jpg'),
(32, 'Tunisia Key Ring', 'Tunisia Key ring', 4, 50, 10, '5134VrCCQTL.jpg', '5134VrCCQTL.jpg', '5134VrCCQTL.jpg'),
(33, 'Khomsa Key Ring', 'Khomsa', 4, 50, 10, 'aert.jpg', 'aert.jpg', 'aert.jpg'),
(34, 'Camel Magnet', 'Magnet', 7, 50, 11, 'camel.png', 'camel.png', 'camel.png'),
(35, 'Tunisia Magnet', 'Tunisia Magnet', 5, 50, 11, 'tunisia_flag_firework_magnet-red6ae010a8664b7ab75f34e45d18e75d_x7js9_8byvr_307.jpg', 'tunisia_flag_firework_magnet-red6ae010a8664b7ab75f34e45d18e75d_x7js9_8byvr_307.jpg', 'tunisia_flag_firework_magnet-red6ae010a8664b7ab75f34e45d18e75d_x7js9_8byvr_307.jpg'),
(36, 'Camel Head Magnet', 'Camel magnet', 8, 50, 11, '513KUTmHgFL._AC_SY780_.jpg', '513KUTmHgFL._AC_SY780_.jpg', '513KUTmHgFL._AC_SY780_.jpg'),
(37, 'Tunisian Tabla', 'Tabla', 30, 50, 12, '61WF7bAeU2L.jpg', '61WF7bAeU2L.jpg', '61WF7bAeU2L.jpg'),
(38, 'Tunisian Camel Statue', 'Camel statue', 19, 50, 12, 'il_fullxfull.4424038874_hga8.jpg', 'il_fullxfull.4424038874_hga8.jpg', 'il_fullxfull.4424038874_hga8.jpg'),
(39, 'Fish Plate', 'Fish plate', 27, 50, 12, 'bluered-fish-plate-ceramics-handmade-tunisia.jpg', 'bluered-fish-plate-ceramics-handmade-tunisia.jpg', 'bluered-fish-plate-ceramics-handmade-tunisia.jpg'),
(40, 'Jebba', 'Jebba', 150, 50, 3, 'jebba tun.png', 'jebba tun.png', 'jebba tun.png'),
(41, 'Slippers', 'Slippers for woman', 20, 60, 4, 'blog_slippers_gallery1.jpg', 'blog_slippers_gallery1.jpg', 'blog_slippers_gallery1.jpg'),
(42, 'Jebba kids', 'Jebba kids', 70, 50, 5, 'jabador-child-2-pieces-off-white-child-circumcision-garment-gold-embroidery.jpg', 'jabador-child-2-pieces-off-white-child-circumcision-garment-gold-embroidery.jpg', 'jabador-child-2-pieces-off-white-child-circumcision-garment-gold-embroidery.jpg'),
(43, 'Kids Slippers', 'Slippers for kids', 15, 50, 5, 'ret.jpg', 'ret.jpg', 'ret.jpg'),
(44, 'Woman Jebba', 'Woman jebba', 105, 50, 4, 'Jebba woman.png', 'Jebba woman.png', 'Jebba woman.png');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `name`, `category_id`) VALUES
(3, 'Male', 5),
(4, 'Female', 5),
(5, 'Kids', 5),
(6, 'Dates', 3),
(7, 'Canned/Packed', 3),
(8, 'Traditional sweet', 3),
(10, 'Key ring', 4),
(11, 'Magnetic sticker', 4),
(12, 'Craftmanship', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'KMOON', 'aminkammoun.2121@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
