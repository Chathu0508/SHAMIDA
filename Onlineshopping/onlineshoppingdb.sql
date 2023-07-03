-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 07:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineshoppingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `status`) VALUES
(1, 'Neckless', 'Necklaces are used for ceremonial, religious, magical, or burial purposes, as well as as symbols of wealth and rank.', 'Active Category'),
(2, 'Ear Rings', 'Earrings are accessories that are affixed to the ear by being pierced through the earlobe or another external area. People from various civilizations and eras have worn them, frequently with cultural significance.', 'Active Category'),
(3, 'Finger Rings', 'Necklaces are used for ceremonial, religious, magical, or burial purposes, as well as as symbols of wealth and rank.', 'Active Category'),
(4, 'Bangles', ' Women in Africa, the Arabian Peninsula, Southeastern Asia, and the Indian Subcontinent wear hard bracelets called bangles, while glass bangles are worn at weddings. Little girls can also wear bracelets, and toddlers enjoy bracelets made of gold or silver', 'Active Category');

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE `cost` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `rawmetiral_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `units` int(11) NOT NULL,
  `fullprice` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`id`, `supplier_id`, `rawmetiral_id`, `price`, `units`, `fullprice`, `status`) VALUES
(1, 1, 1, 9920.74, 50, 496037.00, 'Payment Complete'),
(2, 1, 2, 9094.00, 20, 181880.00, 'Payment Pending'),
(3, 1, 3, 8680.60, 50, 434030.00, 'Payment Pending'),
(4, 1, 3, 8680.60, 60, 520836.00, 'Payment Pending');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `cust_no` varchar(255) NOT NULL,
  `cusfullname` varchar(255) NOT NULL,
  `NICno` varchar(255) NOT NULL,
  `contactno` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `cust_no`, `cusfullname`, `NICno`, `contactno`, `email`, `status`) VALUES
(1, 'CCEE0001', 'Ishini Anuththara', '976373294V', 702118683, 'Ishini@gmail.com', 'Active Customer'),
(2, 'CCEE0002', 'Nalini De silva', '677000929V', 772426924, 'Mali@gmail.com', 'Active Customer'),
(3, 'CCEE0003', 'Hashini dilhara', '975320588V', 775363955, 'Hashini@gmail.com', 'Active Customer'),
(4, 'CCEE0004', 'chathuranga', '971290471V', 776270417, 'chathuranga@gmail.com', 'Active Customer'),
(5, 'CCEE0005', 'Chamari', '925465646564v', 74818572, 'Chamari@gmail.com', 'Active Customer'),
(6, 'CCEE0006', 'Poshitha karunarathne', '2001685758', 710386806, 'poshitha@gmail.com', 'Inactive Customer');

-- --------------------------------------------------------

--
-- Table structure for table `dailyleft`
--

CREATE TABLE `dailyleft` (
  `id` int(11) NOT NULL,
  `rawmetiral_id` int(11) NOT NULL,
  `rawmetiral_type` varchar(255) NOT NULL,
  `qyt` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dailyleft`
--

INSERT INTO `dailyleft` (`id`, `rawmetiral_id`, `rawmetiral_type`, `qyt`, `date`) VALUES
(1, 1, 'Gram/Biscuit', 10, '2023-05-13'),
(2, 2, 'Gram/Biscuit', 5, '2023-05-13');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `employee_no` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nic` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_no`, `name`, `nic`, `type`, `tel`, `email`, `username`, `password`, `status`) VALUES
(1, 'EMP0001', 'Chathuranga Karunarathne', '971290471V', 'Admin', '0776270417', 'chathuranga.karunarathne0508@gmail.com', 'admin', '12345', 'Active Employee'),
(2, 'EMP0002', 'Chaminda De sliva', '75849252630', 'Owner', '0776270418', 'shamin@gmail.com', 'Owner', '12345', 'Active Employee'),
(3, 'EMP0003', 'Poshitha karunarathne', '9712940471V', 'User', '0710386806', 'poshitha@gmail.com', 'user', '12345', 'Active Employee');

-- --------------------------------------------------------

--
-- Table structure for table `ordercreate`
--

CREATE TABLE `ordercreate` (
  `id` int(11) NOT NULL,
  `ordernumber` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `createdate` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordercreate`
--

INSERT INTO `ordercreate` (`id`, `ordernumber`, `customer_id`, `product_id`, `price`, `qty`, `total`, `createdate`, `status`) VALUES
(1, 'ORD0001', 1, 1, 400000.00, 1, 400000.00, '2023-05-01', 'Payment not Complete'),
(2, 'ORD0002', 2, 2, 150000.00, 1, 150000.00, '2023-05-02', 'Payment Complete '),
(3, 'ORD0003', 3, 3, 100000.00, 1, 100000.00, '2023-05-08', 'Payment not Complete'),
(4, 'ORD0004', 4, 4, 100000.00, 2, 200000.00, '2023-05-11', 'Payment not Complete'),
(5, 'ORD0005', 5, 7, 500000.00, 2, 1000000.00, '2023-05-15', 'Payment not Complete');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL,
  `product_no` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `amount_pay` decimal(10,2) NOT NULL,
  `blance_pay` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`id`, `order_id`, `payment_method`, `payment_status`, `amount_pay`, `blance_pay`, `status`) VALUES
(1, 1, 'Cash', 'Advance payment', 250000.00, 150000.00, 'Payment not Complete'),
(2, 2, 'Creadit or Debit Card', 'Full Payment ', 150000.00, 0.00, 'Payment Complete '),
(3, 3, 'Cash', 'Advance payment', 25000.00, 75000.00, 'Payment not Complete'),
(5, 4, 'Cash', 'Due Payments', 20000.00, 180000.00, 'Payment not Complete'),
(6, 5, 'Cash', 'Advance payment', 50000.00, 950000.00, 'Payment not Complete');

-- --------------------------------------------------------

--
-- Table structure for table `pricetable`
--

CREATE TABLE `pricetable` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `rawmetiral_id` int(11) NOT NULL,
  `rawmetiral_type` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pricetable`
--

INSERT INTO `pricetable` (`id`, `supplier_id`, `rawmetiral_id`, `rawmetiral_type`, `price`) VALUES
(1, 1, 1, 'Gram/Biscuit', 9920.74),
(2, 1, 2, 'Gram/Biscuit', 9094.00),
(3, 1, 3, 'Gram/Biscuit', 8680.60),
(4, 1, 4, 'Gram/Biscuit', 7440.60),
(5, 2, 8, 'Stone', 164840.83),
(6, 5, 9, 'Stone', 120000.00),
(7, 4, 9, 'Stone', 500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `printout`
--

CREATE TABLE `printout` (
  `id` int(11) NOT NULL,
  `ordernumber` varchar(50) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `custname` varchar(100) NOT NULL,
  `contactnumber` int(11) NOT NULL,
  `productno` varchar(50) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `prodoctprice` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `createdate` varchar(50) NOT NULL,
  `paymentmethod` varchar(50) NOT NULL,
  `paymentstatus` varchar(50) NOT NULL,
  `amountpay` decimal(10,2) NOT NULL,
  `blancepay` decimal(10,2) NOT NULL,
  `orderstatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `printout`
--

INSERT INTO `printout` (`id`, `ordernumber`, `customer_id`, `custname`, `contactnumber`, `productno`, `product_category`, `prodoctprice`, `qty`, `total`, `createdate`, `paymentmethod`, `paymentstatus`, `amountpay`, `blancepay`, `orderstatus`) VALUES
(1, 'ORD0001', 'CCEE0001', 'Ishini Anuththara', 702118683, 'SJL001', 'Neckless', 400000.00, 1, 400000.00, '2023-05-01', 'Cash', 'Advance payment', 250000.00, 150000.00, 'Payment not Complete'),
(2, 'ORD0004', 'CCEE0004', 'chathuranga', 776270417, 'SJE001', 'Ear Rings', 100000.00, 2, 200000.00, '2023-05-11', 'Cash', 'Due Payments', 20000.00, 180000.00, 'Payment not Complete'),
(3, 'ORD0002', 'CCEE0002', 'Nalini De silva', 772426924, 'SJL002', 'Neckless', 150000.00, 1, 150000.00, '2023-05-02', 'Creadit or Debit Card', 'Full Payment ', 150000.00, 0.00, 'Payment Complete ');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `category_id`, `status`) VALUES
(1, 'SJL001', 400000.00, 1, 'Avaible Production'),
(2, 'SJL002', 150000.00, 1, 'Avaible Production'),
(3, 'SJL003', 100000.00, 1, 'Avaible Production'),
(4, 'SJE001', 100000.00, 2, 'Avaible Production'),
(5, 'SJE002', 100000.00, 2, 'Avaible Production'),
(6, 'SJE003', 38000.00, 2, 'Avaible Production'),
(7, 'SJR001', 500000.00, 3, 'Avaible Production'),
(8, 'SJR002', 100000.00, 3, 'Avaible Production'),
(9, 'SJR003', 109000.00, 3, 'Avaible Production'),
(10, 'SJB001', 100000.00, 4, 'Sold out Production');

-- --------------------------------------------------------

--
-- Table structure for table `productionstock`
--

CREATE TABLE `productionstock` (
  `id` int(11) NOT NULL,
  `rawmetiral_id` int(11) NOT NULL,
  `rawmetiral_type` varchar(255) NOT NULL,
  `unittaken` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productionstock`
--

INSERT INTO `productionstock` (`id`, `rawmetiral_id`, `rawmetiral_type`, `unittaken`, `date`) VALUES
(1, 1, 'Gram/Biscuit', 20, '2023-05-13'),
(2, 2, 'Gram/Biscuit', 10, '2023-05-13');

-- --------------------------------------------------------

--
-- Table structure for table `raw_metiral`
--

CREATE TABLE `raw_metiral` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raw_metiral`
--

INSERT INTO `raw_metiral` (`id`, `name`, `type`, `status`) VALUES
(1, 'Gold Karat 24  ', 'Gram/Biscuit', 'Avaibale Material'),
(2, 'Gold Karat 22', 'Gram/Biscuit', 'Avaibale Material'),
(3, 'Gold Karat 21', 'Gram/Biscuit', 'Avaibale Material'),
(4, 'Gold Karat 18', 'Gram/Biscuit', 'Avaibale Material'),
(5, 'Gold Karat 14', 'Gram/Biscuit', 'Avaibale Material'),
(6, 'Gold Karat 12', 'Gram/Biscuit', 'Avaibale Material'),
(7, 'Gold Karat 10', 'Gram/Biscuit', 'Avaibale Material'),
(8, 'Diamond', 'Stone', 'Avaibale Material'),
(9, 'Sapphire', 'Stone', 'Avaibale Material'),
(10, 'Jade', 'Stone', 'Avaibale Material');

-- --------------------------------------------------------

--
-- Table structure for table `stockcall`
--

CREATE TABLE `stockcall` (
  `id` int(11) NOT NULL,
  `rawmetiral_id` int(11) NOT NULL,
  `rawmetiral_type` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stockcall`
--

INSERT INTO `stockcall` (`id`, `rawmetiral_id`, `rawmetiral_type`, `unit`) VALUES
(1, 1, 'Gram/Biscuit', 40),
(2, 2, 'Gram/Biscuit', 15),
(3, 3, 'Gram/Biscuit', 110),
(4, 4, 'Gram/Biscuit', 0),
(5, 5, 'Gram/Biscuit', 0),
(6, 6, 'Gram/Biscuit', 0),
(7, 7, 'Gram/Biscuit', 0),
(8, 8, 'Stone', 0),
(9, 9, 'Stone', 0),
(10, 10, 'Stone', 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplierdeatils`
--

CREATE TABLE `supplierdeatils` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contactnumber` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplierdeatils`
--

INSERT INTO `supplierdeatils` (`id`, `name`, `contactnumber`, `address`, `status`) VALUES
(1, 'Chathuranga Karunarathne', '0776270417', 'Yakkala ', 'Active Supplier'),
(2, 'Ahinsa Swemini', '0785605433', 'Moratuwa ', 'Active Supplier'),
(3, 'Poshitha karunarathne', '0710386806', 'Yakkala', 'Active Supplier'),
(4, 'Kasun Sudarak', '0782546658', 'No.28, Crossing RD, Raththpura , Sri lanka.', 'Active Supplier'),
(5, 'Gihan AVishka', '0789522314', 'Ja-ela rd gampha', 'Active Supplier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dailyleft`
--
ALTER TABLE `dailyleft`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordercreate`
--
ALTER TABLE `ordercreate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricetable`
--
ALTER TABLE `pricetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `printout`
--
ALTER TABLE `printout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productionstock`
--
ALTER TABLE `productionstock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_metiral`
--
ALTER TABLE `raw_metiral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockcall`
--
ALTER TABLE `stockcall`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplierdeatils`
--
ALTER TABLE `supplierdeatils`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dailyleft`
--
ALTER TABLE `dailyleft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ordercreate`
--
ALTER TABLE `ordercreate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pricetable`
--
ALTER TABLE `pricetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `printout`
--
ALTER TABLE `printout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `productionstock`
--
ALTER TABLE `productionstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `raw_metiral`
--
ALTER TABLE `raw_metiral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stockcall`
--
ALTER TABLE `stockcall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplierdeatils`
--
ALTER TABLE `supplierdeatils`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
