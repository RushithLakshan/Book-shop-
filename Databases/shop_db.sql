-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2023 at 09:14 AM
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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `number`, `message`) VALUES
(1, 'rusith', 'rusith@gmail.com', '1234567890', 'Hi book.lk'),
(2, 'sunil', 'sunil@gmail.com', '0361234567', 'This is a test message'),
(4, 'rusith', 'rusith@gmail.com', '0710999999', 'This message is send by rusith'),
(6, 'Kasun', 'kasun@gmail.com', '0710999999', 'my name is kasun'),
(7, 'nimal', 'nimal@gmail.com', '0710999999', 'New message');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `item_details` varchar(1000) NOT NULL,
  `total` int(100) NOT NULL,
  `user_data` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `item_details`, `total`, `user_data`) VALUES
(0, '1, Hobbit, 100, 1, 2, Labyrinths, 120, 1, 11, Meghan, 100, 1', 320, 'Date: 23/05/06\nName: rusith\nPhone Number: 1234567890\nEmail: rusith@gmail.com\nPayment Method : cash on delivery\nAddress: 2323 samagi colombo west Sri Lanka\nPostal Code :55555'),
(1, '1, Hobbit, 100, 1, 2, Labyrinths, 120, 10', 1300, 'Date: 23/05/06\nName: rusith\nPhone Number: 3434\nEmail: rusith@gmail.com\nPayment Method : cash on delivery\nAddress: 2323 samagi eheliyagoda west sri\nPostal Code :2323'),
(3, '1, Hobbit, 100, 1', 100, 'Date: 23/05/06\nName: nimal\nPhone Number: 3434\nEmail: rusith@gmail.com\nPayment Method : credit card\nAddress: 111 samagi colombo west sri\nPostal Code :2323'),
(4, '2, Labyrinths, 120, 2, 3, Mars, 150, 2', 540, 'Date: 23/05/06\nName: Bandula\nPhone Number: 036 5612499\nEmail: bandula@gmail.com\nPayment Method : paypal\nAddress: 122/2 Mitipola eheliyagoda sabaragamuwa Sri Lanka\nPostal Code :00400'),
(11, '1, Hobbit, 100, 1, 10, Posing, 400, 5', 2100, 'Date: 23/05/11\nName: nimal\nPhone Number: 0710999999\nEmail: nimal@gmail.com\nPayment Method : cash on delivery\nAddress: 270/1 Samagi Mawatha colombo Western Provience Sri Lanka\nPostal Code :55555');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `type`) VALUES
(1, 'Hobbitrrr', 100, 'books3.jpg', 'new'),
(2, 'Labyrinths', 120, 'Labyrinths.jpg', 'new'),
(3, 'Mars', 150, 'Mars.jpg', 'featured'),
(4, 'The dark tower', 90, 'The dark tower.jpg', 'featured'),
(7, 'Diana', 120, 'Diana.jpg', 'new'),
(8, 'Paris', 200, 'Paris.jpg', 'new'),
(9, 'Puss in Boot', 220, 'Puss In Boot.jpg', 'new'),
(10, 'Posing', 400, 'Posing.jpg', 'new'),
(11, 'Meghan', 100, 'Meghan.jpg', 'new'),
(12, 'Olivia', 140, 'Olivia.jpg', 'featured'),
(13, 'Hercules', 160, 'Hercules.jpg', 'featured'),
(14, 'Year One', 200, 'Year One.jpg', 'featured'),
(15, 'Survivors', 200, 'Survivors.jpg', 'featured');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'rusith', 'rusith@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(2, 'admin rusith', 'rusith.mm@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin'),
(3, 'Lakshab', 'lakshan@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(4, 'Bandula', 'bandula@gamil.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(5, 'ishan', 'ishan@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(10, 'kasun', 'kasun@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(11, 'Amal', 'Amal@gmail.com', '674f3c2c1a8a6f90461e8a66fb5550ba', 'user');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
