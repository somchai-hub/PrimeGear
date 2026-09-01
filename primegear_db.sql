-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 01, 2026 at 08:55 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `primegear_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int NOT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `username`, `email`, `password`) VALUES
(1, 'admin1234', '69319100017@fve.ac.th', '$2a$12$Z5wiqiplzMutf1SxmkV4p.idHs8UfkI2nC5aeNmiYnWrtcUT0PRwK');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `Device_ID` int NOT NULL,
  `Brand` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Model_Name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`Device_ID`, `Brand`, `Model_Name`, `Type`) VALUES
(1, 'Apple', 'iPhone 17 Pro Max', 'SmartPhone'),
(2, 'Apple', 'iPhone 17 Pro', 'SmartPhone'),
(3, 'Samsung', 'S24 Ultra', 'SmartPhone'),
(4, 'Samsung', 'S25 Ultra', 'SmartPhone'),
(5, 'Vivo', 'X300 Pro', 'SmartPhone'),
(6, 'Vivo', 'X200 Pro', 'SmartPhone');

-- --------------------------------------------------------

--
-- Table structure for table `pdm`
--

CREATE TABLE `pdm` (
  `mapping_id` int NOT NULL,
  `product_id` int NOT NULL,
  `device_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Product_ID` int NOT NULL,
  `product_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Brand` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Catagory` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product_ID`, `product_code`, `Name`, `Image`, `Brand`, `Description`, `Catagory`, `Price`) VALUES
(1, 'PCK-1', 'Armor Case Pro', 'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'None', 'เคสใสกันกระแทกยอดนิยม รองรับชาร์จไร้สายแม่เหล็ก ขอบยาง TPU ยืดหยุ่นสูง ป้องกันการตกกระแทกได้ถึง 3 เมตร', 'เคส', 890),
(2, 'PCK-2', 'GaN Ultra 65W', 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'None', 'หัวชาร์จเทคโนโลยี GaN ขนาดเล็กพกพาง่าย จ่ายไฟสูงสุด 65W ชาร์จ MacBook หรือสมาร์ตโฟนได้อย่างรวดเร็ว ไม่ร้อน', 'หัวชาร์จ', 1290),
(3, 'PCK-3', 'UGREEN สายชาร์จ Type-C To Type-C 100W 1M Grey (Alu Nylon-65862)', 'https://img.advice.co.th/cdn-cgi/image/format=auto,width=180,quality=82,fit=contain/images_nas/pic_product4/A0185224/A0185224OK_BIG_1.jpg', 'UGREEN', 'Charge : Cable Type-C To Type-C\\nOutput : 20V5A 100W Max.\\nMaterial : Braided nylon\\nLength : 1m.', 'สายชาร์จ', 349),
(4, 'PCK-4', 'Eloop E33ALine 10000mAh PowerBank (12W) - Black', 'https://www.425degree.com/media/catalog/product/cache/76f48791e4b0a6cf07f7f7957767c58a/e/l/eloop_eloop_e33aline_10000mah_powerbank_black_1.png', 'undefined', 'พาวเวอร์แบงก์ Eloop E33ALine ความจุ 10,000mAh สุดคุ้ม มาพร้อมสายชาร์จ USB-C และ Lightning ในตัว พกพาสะดวกไม่ต้องพกสายเพิ่ม\r\nรองรับการจ่ายไฟออกสูงสุด 12W (ผ่านสายในตัวและ 2 พอร์ต USB-A) และชาร์จไฟเข้าสูงสุด 10W (ผ่าน Micro USB และ USB-C)', 'พาวเวอร์แบงค์', 319),
(5, 'PCK-5', 'Veger VPC15-02PD Pro PowerBank (PD | 20W) - Coffee', 'https://www.425degree.com/media/catalog/product/cache/76f48791e4b0a6cf07f7f7957767c58a/v/e/veger_veger_vpc15_02pd_pro_powerbank_coffee_1.png', 'VEGER', 'VPC15-02PD PRO แบตสำรอง (Powerbank) พกพาง่าย ความจุ 15,000mAh พร้อมชาร์จเร็วสูงสุด 20W แถมมีฟังก์ชันครบ จบในตัวเดียว พร้อมสีสันโทนสดใสน่ารัก จากแบรนด์ VEGER', 'พาวเวอร์แบงค์', 990),
(6, 'PCK-6', 'Anker Nano PowerBank 10K (PD | PPS | QC | 45W) - Green', 'https://www.425degree.com/media/catalog/product/cache/76f48791e4b0a6cf07f7f7957767c58a/a/n/anker_anker_nano_powerbank_10k_green_1.png', 'ANKER', 'Nano Power Bank 10K 45W แบตสำรองขนาดกะทัดรัด ความจุแบตเตอรี่ 10,000mAh พร้อมหน้าจอสุดล้ำและสายชาร์จในตัว จากแบรนด์ผู้เชี่ยวชาญด้านอุปกรณ์ชาร์จโทรศัพท์มือถืออย่าง Anker', 'พาวเวอร์แบงค์', 1999),
(7, 'PCK-7', 'Commy PB-B001 10000mAh PowerBank (PD | 22.5W) - Cream', 'https://www.425degree.com/media/catalog/product/cache/76f48791e4b0a6cf07f7f7957767c58a/c/o/commy_commy_pb_b001_10000_mah_powerbank_cream_1.png', 'COMMY', 'Commy PB-B001 10000 mAh Power Bank แบตสำรองดีไซน์เท่ ขนาดกะทัดรัด พร้อมสายชาร์จที่ทำหน้าที่เป็นสายคล้องในตัว จากแบรนด์ผู้เชี่ยวชาญด้านแบตเตอรี่อย่าง Commy', 'พาวเวอร์แบงค์', 890),
(8, 'PCK-8', 'Anker 25K PowerBank (PD | QC | 165W) - Silver', 'https://www.425degree.com/media/catalog/product/cache/76f48791e4b0a6cf07f7f7957767c58a/a/n/anker_anker_25k_powerbank_pd_qc_165w_silver_12.png', 'ANKER', '25K Power Bank 165W แบตสำรองฟังก์ชันล้ำ ทรงแท่ง ความจุแบตเตอรี่สูง 25,000mAh พร้อมหน้าจอสุดล้ำและสายชาร์จคู่ในตัว จากแบรนด์ผู้เชี่ยวชาญด้านอุปกรณ์ชาร์จโทรศัพท์มือถืออย่าง Anker', 'พาวเวอร์แบงค์', 3799),
(9, 'PCK-9', 'AlphaX ALC-GaN USB-C Adapter (1USB-C | PD | PPS | GaN | 33W) - Gray', 'https://www.425degree.com/media/catalog/product/cache/76f48791e4b0a6cf07f7f7957767c58a/a/l/alphax_alphax_alc_gan_33w_9.png', 'ALPHAX', 'ALC-GAN33W หัวชาร์จเร็วขนาดเล็ก ทรงลูกบาศก์ ดีไซน์มีเอกลักษณ์ พกพาง่าย จากแบรนด์ AlphaX\\nมาพร้อมช่อง USB-C จำนวน 1 ช่อง จ่ายไฟสูงสุดที่ 33W มาตรฐาน PD, PPS', 'หัวชาร์จ', 590),
(10, 'PCK-10', 'เคสผ้า TechWoven พร้อม MagSafe สำหรับ iPhone 17 Pro Max - สีเขียว', 'https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/MGFD4?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=alYrcXl2ZXZVTWFJclVqTWcyZFZ1Z2tuVHYzMERCZURia3c5SzJFOTlPZ3JTRTZ5Yi94UDBnUUhiU2ZvQ2ZITkNWMTErZWdaS0Fwa3k5K2Y1YmtzM3c', 'Apple', 'เคสผ้า TechWoven พร้อม MagSafe ได้รับการออกแบบโดย Apple เพื่อปกป้องและทำให้ iPhone 17 Pro Max เป็นสไตล์ของคุณอย่างสวยงาม', 'เคส', 2390);

-- --------------------------------------------------------

--
-- Table structure for table `product_device_mapping`
--

CREATE TABLE `product_device_mapping` (
  `product_id` int NOT NULL,
  `device_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `Variant_ID` int NOT NULL,
  `Color` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Length` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Wattage` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`Device_ID`);

--
-- Indexes for table `pdm`
--
ALTER TABLE `pdm`
  ADD PRIMARY KEY (`mapping_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_ID`);

--
-- Indexes for table `product_device_mapping`
--
ALTER TABLE `product_device_mapping`
  ADD PRIMARY KEY (`product_id`,`device_id`),
  ADD KEY `device_id` (`device_id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`Variant_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `Device_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `Variant_ID` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_device_mapping`
--
ALTER TABLE `product_device_mapping`
  ADD CONSTRAINT `product_device_mapping_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`Product_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_device_mapping_ibfk_2` FOREIGN KEY (`device_id`) REFERENCES `devices` (`Device_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
