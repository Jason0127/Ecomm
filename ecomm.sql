-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2019 at 12:02 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pword` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `email`, `pword`, `first_name`, `last_name`) VALUES
(1, 'flores@gmail.com', '123456', 'jason', 'flores');

-- --------------------------------------------------------

--
-- Table structure for table `cosumer_tbl`
--

CREATE TABLE `cosumer_tbl` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pword` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `cart_tbl` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cosumer_tbl`
--

INSERT INTO `cosumer_tbl` (`id`, `email`, `pword`, `first_name`, `lastname`, `cart_tbl`) VALUES
(1, 'jason@gmail.com', '654321', 'jason', 'flores', '[{\"id\":\"33\",\"owner_id\":\"1\",\"product_name\":\"Test1\",\"qty\":\"2\",\"price\":\"20\",\"img\":\"b5d05dee3bddd1b5982d88a505e6aabf61dfe1b4.jpg\",\"descr\":\"TEST!\"},{\"id\":\"34\",\"owner_id\":\"1\",\"product_name\":\"TEST2\",\"qty\":\"2\",\"price\":\"20\",\"img\":\"7feb714d986d62cd0339c7372c3061abba9c2865.jpg\",\"descr\":\"TEST2\"},{\"id\":\"36\",\"owner_id\":\"1\",\"product_name\":\"TEST2\",\"qty\":\"39\",\"price\":\"20\",\"img\":\"3e97bce6d7f97c304ff773fa95e350f8a45f11d3.jpg\",\"descr\":\"TEST100\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `product_name` varchar(2555) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `stocks` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`id`, `owner_id`, `product_name`, `descr`, `price`, `stocks`, `img`) VALUES
(33, 1, 'Test1', 'TEST!', '20', '10', 'b5d05dee3bddd1b5982d88a505e6aabf61dfe1b4.jpg'),
(34, 1, 'TEST2', 'TEST2', '20', '10', '7feb714d986d62cd0339c7372c3061abba9c2865.jpg'),
(35, 1, 'TEEST23', 'TEST', '20', '20', 'ee11efff849e99f43b007a67a5088cc44d6ca93f.jpg'),
(36, 1, 'TEST2', 'TEST100', '20', '10', '3e97bce6d7f97c304ff773fa95e350f8a45f11d3.jpg'),
(37, 1, 'test2323', '', '20', '10', ''),
(38, 1, 'test2323', 'www', '20', '10', '8c3e054ef46a700f0a984b7657add3a286798f4d.jpg'),
(39, 1, 'qweqwe', 'wewew', '20', '20', '3e5ee5520c62ba295f95963db3aca947ae4336e8.jpg'),
(40, 1, 'ss', 'sss', 'ss', 'ss', '120856219eb427012013712d5d25264856e0725a.jpg'),
(41, 1, 'ss', 'sss', 'ss', 'ss', '120856219eb427012013712d5d25264856e0725a.jpg'),
(42, 1, 'ss', 'sss', 'ss', 'ss', '120856219eb427012013712d5d25264856e0725a.jpg'),
(43, 1, 'ss', 'sss', 'ss', 'ss', '120856219eb427012013712d5d25264856e0725a.jpg'),
(44, 1, 'ss', 'sss', 'ss', 'ss', '120856219eb427012013712d5d25264856e0725a.jpg'),
(45, 1, '', '', '', '', ''),
(46, 1, 'test', 'test', 'test', 'test', 'e255b1f98ea0eadef82a50d53cff682b43fc82a8.jpg'),
(47, 1, 'qwe', 'we', '', 'qw', '464a959086f4ad5342e1a41efb55888a149c8159.jpg'),
(48, 1, 'qweqwe', 'w', '20', 'w', 'd6412d768ea3be21391256d0ddf4422fa0f860af.jpg'),
(49, 1, 'w', 'w', 'w', 'w', '075aec318344099d9dcab9b24ac8cbd3664348ea.jpg'),
(50, 1, 'qweqwe', 'w', 'qwe', 'qw', '98ea94a6df53e79bb64018895d0eccd5199233ff.jpg'),
(51, 1, 'qweqwe', 'w', '20', '20', '2da30a9cbb18d9b00897ecc9ff4cc64f395afecf.jpg'),
(52, 1, 'qweqwe', 'w', 'qwe', '10', 'ee59fe272c8444e8bf66ab6e1d3cf2bf57bdb375.jpg'),
(53, 1, 'qweqwe', 'w', 'qwe', '10', 'ee59fe272c8444e8bf66ab6e1d3cf2bf57bdb375.jpg'),
(54, 1, 'qweqwe', 'w', 'qwe', '10', 'ee59fe272c8444e8bf66ab6e1d3cf2bf57bdb375.jpg'),
(55, 1, 'qweqwe', 'w', 'qwe', '10', 'ee59fe272c8444e8bf66ab6e1d3cf2bf57bdb375.jpg'),
(56, 1, 'qweqwe', 'w', 'qwe', '10', 'ee59fe272c8444e8bf66ab6e1d3cf2bf57bdb375.jpg'),
(57, 1, 'qweqwe', 'w', 'qwe', '10', 'ee59fe272c8444e8bf66ab6e1d3cf2bf57bdb375.jpg'),
(58, 1, 'qweqwe', 'w', 'qwe', '10', 'ee59fe272c8444e8bf66ab6e1d3cf2bf57bdb375.jpg'),
(59, 1, 'qweqwe', 'w', 'qwe', '10', 'ee59fe272c8444e8bf66ab6e1d3cf2bf57bdb375.jpg'),
(60, 1, 'qweqwe', 'w', 'qwe', '10', 'ee59fe272c8444e8bf66ab6e1d3cf2bf57bdb375.jpg'),
(61, 1, '', '', '', '', ''),
(62, 1, 'qwe', 'w', '20', '20', '3cdba658697b03e2f67d0031909aabf47559613b.jpg'),
(63, 1, 'qwe', 'w', '20', '20', '3cdba658697b03e2f67d0031909aabf47559613b.jpg'),
(64, 1, '', '', '', '', ''),
(65, 1, 'qweqwe', '', '20', '20', ''),
(66, 1, '', '', '20', '20', ''),
(67, 1, 'l', '', '20', '20', ''),
(68, 1, 'lol', '', '20', '20', ''),
(69, 1, 'lolju', '', '20', '20', ''),
(70, 1, 'w', 'w', '20', '20', ''),
(71, 1, 'ws', 'ww', '20', '20', ''),
(72, 1, 'wsw', 'ww', '20', '20', '9c30acb47b3110710c4304f8cbce41dc7da23ee2.jpg'),
(73, 1, 'wsw', 'ww', '20', '20', '9c30acb47b3110710c4304f8cbce41dc7da23ee2.jpg'),
(74, 1, 'qwe', 's', 'qwe', '20', '5dc2ac3d5ffe0507125986573046bef6b7b3a4d5.jpg'),
(75, 1, 'qwesssssss', 's', 'qwe', '20', '5dc2ac3d5ffe0507125986573046bef6b7b3a4d5.jpg'),
(76, 1, 'qweqwe', '2', '2', '2', '5681c967b3accdaba33fde1d048af3016433a376.jpg'),
(77, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(78, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(79, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(80, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(81, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(82, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(83, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(84, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(85, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(86, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(87, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(88, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(89, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(90, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(91, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(92, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(93, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(94, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(95, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(96, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(97, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(98, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(99, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(100, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(101, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(102, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(103, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(104, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(105, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(106, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(107, 1, 'qweqwe', 'a', '20', 'a', '93484ef2fbb98294c2e5cd9b75dc1a3ff878158a.jpg'),
(108, 1, '1', '1', '1', '1', 'c28eb1913f47cb784a0957afd1ed17d7aee18ffe.jpg'),
(109, 1, '11', '1', '1', '1', '207a2d10376c7e33cb59d94eaf3b151091ae7df5.jpg'),
(110, 1, '1', '1', '1', '1', '62cb99a0b28c626133242263d6f0000a8e3a9b02.jpg'),
(111, 1, '1', '1', '1', '1', '62cb99a0b28c626133242263d6f0000a8e3a9b02.jpg'),
(112, 1, '1', '1', '1', '1', '62cb99a0b28c626133242263d6f0000a8e3a9b02.jpg'),
(113, 1, 'qweqwe', '3', '2', '3', 'afad850305bc4b5befc3530e15b4031e2c4b467e.jpg'),
(114, 1, '1', '1', '1', '1', 'b6cce25ec05d2491f87588c3f48814e6f31d3a02.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cosumer_tbl`
--
ALTER TABLE `cosumer_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cosumer_tbl`
--
ALTER TABLE `cosumer_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
