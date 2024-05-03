-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 05:18 PM
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
-- Database: `cafedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintbl`
--

CREATE TABLE `admintbl` (
  `id` int(11) NOT NULL,
  `admin` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admintbl`
--

INSERT INTO `admintbl` (`id`, `admin`, `password`) VALUES
(1, 'hayal', '*97531.Hayal');

-- --------------------------------------------------------

--
-- Table structure for table `bannertbl`
--

CREATE TABLE `bannertbl` (
  `BannerPage` varchar(25) NOT NULL,
  `BannerTitle` varchar(65) NOT NULL,
  `BannerDesc` varchar(300) NOT NULL,
  `BannerImage` varchar(200) DEFAULT NULL,
  `BannerID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bannertbl`
--

INSERT INTO `bannertbl` (`BannerPage`, `BannerTitle`, `BannerDesc`, `BannerImage`, `BannerID`) VALUES
('HakkımızdaSayfası', 'Bizi Ziyaret Edin!', 'Lezzetli sıcak içecekleri ve daha nicesiyle samimi ve şirin bir kafe olan Sükut-u Hayal\'e hoş geldiniz.', 'fincan.jpg', 1),
('MenüSayfası', 'İçeceklerimizin ve Tatlılarımızın Tadına Bakın!\r\n', 'Lezzetli sıcak içecekleri ve daha nicesiyle samimi bir kafe olan Sükut-u Hayal\'e hoş geldiniz.', 'vector.jpg', 2),
('GaleriSayfası', 'Resim Galerimiz', 'Experience the Retro Ambiance and Delicious Hot Drinks...', NULL, 3),
('KonumSayfası', 'Bizi Ziyaret Edin!', 'Lorem ipsum dolor sit amet, adisipcing elit...', 'kahve.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `businesstbl`
--

CREATE TABLE `businesstbl` (
  `InfoName` varchar(20) NOT NULL,
  `InfoTitle` varchar(25) DEFAULT NULL,
  `InfoDesc` varchar(120) DEFAULT NULL,
  `Info` varchar(120) NOT NULL,
  `InfoIcon` varchar(150) NOT NULL,
  `InfoID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `businesstbl`
--

INSERT INTO `businesstbl` (`InfoName`, `InfoTitle`, `InfoDesc`, `Info`, `InfoIcon`, `InfoID`) VALUES
('E-posta', 'E-Postamız', '', 'hello@guest.com', 'email.png', 1),
('Instagram', '', 'sukutuhayalcafe01', 'https://www.instagram.com/sukutuhayalcafe01', 'instagram.png', 2),
('Telefon', 'Telefonumuz', NULL, '+1 (555) 000 0000', 'telephone.png', 3),
('Adres', 'Kafemiz', 'Beyazevler, Beyazevler Cd. 16 A, 01170 Çukurova/Adana', 'https://maps.app.goo.gl/DkRZLyJDc2T4pQmU6', 'cafe.png', 4),
('Foursquare', NULL, NULL, 'https://4sq.com/2ZunRhZ', 'foursquare.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `commenttbl`
--

CREATE TABLE `commenttbl` (
  `Name` varchar(20) NOT NULL,
  `Caption` varchar(20) DEFAULT NULL,
  `Photo` varchar(120) NOT NULL,
  `Comment` varchar(150) NOT NULL,
  `Stars` int(1) NOT NULL,
  `CommentID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commenttbl`
--

INSERT INTO `commenttbl` (`Name`, `Caption`, `Photo`, `Comment`, `Stars`, `CommentID`) VALUES
('Selami Tümer', 'Gezisever', '660fe62db54d89.38591378.jpg', 'Memnuniyetle tercih edilebilecek bir yer mükemmel bir yer...', 4, 5),
('Hazal Kaya', 'Yerel Rehber', '660ef3b01a76c2.18464208.jpg', 'Sükut-u Hayal\'in ambiyansı tek kelimeyle muhteşem. Rahat ve retro bir atmosfere zamanda geri adım atmak gibi.', 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `imagetbl`
--

CREATE TABLE `imagetbl` (
  `ImageURL` varchar(150) NOT NULL,
  `ImageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `imagetbl`
--

INSERT INTO `imagetbl` (`ImageURL`, `ImageID`) VALUES
('red-beetle-car-6.jpg', 19),
('red-beetle-car-8.jpg', 20),
('inner-decorations-12.jpg', 21),
('inner-decorations-14.jpg', 22),
('inner-decorations-13.jpg', 23),
('coffees-and-cakes-1.jpg', 24),
('coffees-and-cakes-2.jpg', 25),
('coffees-and-cakes-5.jpg', 26),
('sodas-1.jpg', 27),
('coffees-and-cakes-7.jpg', 28),
('inner-decorations-16.jpg', 29),
('inner-decorations-19.jpg', 30),
('blackboard-decoration-2.jpg', 31),
('coffees-and-cakes-3.jpg', 32),
('sodas-5.jpg', 34),
('sodas-6.jpg', 35),
('tea.jpg', 36),
('sodas-7.jpg', 37),
('sodas-11.jpg', 38);

-- --------------------------------------------------------

--
-- Table structure for table `menucategoriestbl`
--

CREATE TABLE `menucategoriestbl` (
  `CategoryName` varchar(50) NOT NULL,
  `CategoryID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menucategoriestbl`
--

INSERT INTO `menucategoriestbl` (`CategoryName`, `CategoryID`) VALUES
('Sıcak İçecekler', 1),
('Tatlılar', 2),
('Soğuk İçecekler', 5);

-- --------------------------------------------------------

--
-- Table structure for table `menutbl`
--

CREATE TABLE `menutbl` (
  `ProductCategory` varchar(25) NOT NULL,
  `ProductTitle` varchar(25) NOT NULL,
  `ProductDescription` varchar(120) DEFAULT NULL,
  `ProductPrice` int(10) DEFAULT NULL,
  `ProductImage` varchar(150) NOT NULL,
  `ProductID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menutbl`
--

INSERT INTO `menutbl` (`ProductCategory`, `ProductTitle`, `ProductDescription`, `ProductPrice`, `ProductImage`, `ProductID`) VALUES
('Sıcak İçecekler', 'Caffe Macchiato', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit.', 45, 'macchiato.png', 7),
('Sıcak İçecekler', 'Sıcak Çikolata', 'İçinizi ısıtacak...', 50, 'hot_choco.png', 8),
('Sıcak İçecekler', 'Caffe Latte', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit...', 55, 'latte.png', 9),
('Sıcak İçecekler', 'Espresso Macchiato', 'Ayılmak isteyenlere...', 40, 'espresso.png', 10),
('Soğuk İçecekler', 'Limonata', 'Taze sıkılmış...', 40, 'lemonde.jpg', 11),
('Soğuk İçecekler', 'Frappe', 'Buz gibi bir seçenek arayanlara özel...', 45, 'frappe.jpg', 12),
('Soğuk İçecekler', 'Çeşitli Gazozlar', 'Lorem ipsum, dolor sit amet consectetur adipisicing.', 35, 'soda.jpg', 13),
('Soğuk İçecekler', 'Soğuk Kahveler', 'Lorem ipsum dolor sit amet consectetur.', 50, 'iced-coffee.jpg', 14),
('Tatlılar', 'Portakallı Tart', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit.', 55, 'tart.jpg', 15),
('Tatlılar', 'Çikolatalı Tart', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum...', 60, 'tart-2.jpg', 16),
('Tatlılar', 'Donut', 'Her zevke uygun çeşitli aromalara sahip donutlar...', 40, 'donut.jpg', 17),
('Tatlılar', 'Krep', 'Lorem ipsum dolor sit amet consectetur...', 45, 'crep.jpg', 18);

-- --------------------------------------------------------

--
-- Table structure for table `sectiontbl`
--

CREATE TABLE `sectiontbl` (
  `SectionName` varchar(25) NOT NULL,
  `SectionTitle` varchar(60) NOT NULL,
  `SectionSubtitle` varchar(50) DEFAULT NULL,
  `SectionDesc` varchar(400) NOT NULL,
  `SectionBackground` varchar(120) DEFAULT NULL,
  `SectionID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sectiontbl`
--

INSERT INTO `sectiontbl` (`SectionName`, `SectionTitle`, `SectionSubtitle`, `SectionDesc`, `SectionBackground`, `SectionID`) VALUES
('AnaBölüm', 'Sükut-u Hayal\'in Retro Ortamını Deneyimleyin', NULL, 'Nostaljinin modern konforla buluştuğu Sükut-u Hayal kafenin sıcak ve samimi ortamını keşfedin.', 'red-beetle-car-9.jpg', 4),
('HakkımızdaBölümü', 'Sükut-u Hayal Kafe\'nin Büyüsünü Hissedin', 'Sihirli...', 'Lezzetli sıcak içecekleri ve daha nicesiyle samimi ve şirin bir kafe olan Sükut-u Hayal\'e hoş geldiniz. Retro ambiyansı ve sıcak atmosferi ile gevşemek ve en sevdiğiniz içeceğin tadını çıkarmak için mükemmel bir yerdir. İster bir kahve düşkünü ister bir çay triyakisi olun, içeceklerimiz ve menümüz isteklerinizi karşılamak için çeşitli içecekler ve yiyecekler sunmaktadır.', NULL, 6),
('MiniGaleriBölümü', 'Resim Galerimiz...', NULL, 'Sıcak Atmosferimizi Ziyaret Edin ve İçecek Sunumlarımızın Tadına Bakın!', NULL, 7),
('TanıtımBölümü', 'Sıcak İçeceklerimizi ve Retro Atmosferimizi Keşfedin', NULL, 'Sükut-u Hayal\'de, damak tadınıza hitap edecek çok çeşitli sıcak içecekler sunmaktan gurur duyuyoruz. Kahvelerimizden özel çaylarımıza ve yiyeceklerimize herkes için bir seçeneğimiz var. Bizi diğer kafelerden ayıran ortamımızı ve içeceklerimizin özel karışımını deneyimleyin.', 'inner-decorations-16.jpg', 8),
('MiniTanıtımBölümü1', 'Özel İçecekler', NULL, 'Her seferinde mükemmellik için ustalıkla demlenen zengin ve aromatik içeceklerimizin tadını çıkarın.', 'latte-art.png', 9),
('MiniTanıtımBölümü2', 'Retro Ortam', NULL, 'Sizi geçmişe götüren ve hayallere daldıran samimi ve sıcak ortamımızda keyfinize bakın :)', 'cassette.png', 10),
('MenüBölümü', 'Nefis Menümüzü Keşfedin', NULL, 'Rahat ortamımızı deneyimleyin ve lezzetli sıcak içeceklerimizle kendinizi şımartın. Sükut-u Hayal de sizlere sunduğumuz menümüzü linke tıklayarak inceleyebilirsiniz!\r\n', 'soda-caps-2.jpg', 11),
('İletişimBölümü', 'Bizimle İletişime Geçin', 'Çekinmeyin...', 'Herhangi merak ettiğiniz konuda bize ulaşabilir ve kafemizi ziyaret edebilirsiniz.', NULL, 12),
('MottoBölümü', '—Joe Hamilton, Yapımcı', NULL, 'İyi Fikirler Beyin Fırtınasıyla Bulunur,\r\nMükemmel Fikirler De Kahveyle..', NULL, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintbl`
--
ALTER TABLE `admintbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bannertbl`
--
ALTER TABLE `bannertbl`
  ADD PRIMARY KEY (`BannerID`);

--
-- Indexes for table `businesstbl`
--
ALTER TABLE `businesstbl`
  ADD PRIMARY KEY (`InfoID`);

--
-- Indexes for table `commenttbl`
--
ALTER TABLE `commenttbl`
  ADD PRIMARY KEY (`CommentID`);

--
-- Indexes for table `imagetbl`
--
ALTER TABLE `imagetbl`
  ADD PRIMARY KEY (`ImageID`);

--
-- Indexes for table `menucategoriestbl`
--
ALTER TABLE `menucategoriestbl`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `menutbl`
--
ALTER TABLE `menutbl`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `sectiontbl`
--
ALTER TABLE `sectiontbl`
  ADD PRIMARY KEY (`SectionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admintbl`
--
ALTER TABLE `admintbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bannertbl`
--
ALTER TABLE `bannertbl`
  MODIFY `BannerID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `businesstbl`
--
ALTER TABLE `businesstbl`
  MODIFY `InfoID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `commenttbl`
--
ALTER TABLE `commenttbl`
  MODIFY `CommentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `imagetbl`
--
ALTER TABLE `imagetbl`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `menucategoriestbl`
--
ALTER TABLE `menucategoriestbl`
  MODIFY `CategoryID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menutbl`
--
ALTER TABLE `menutbl`
  MODIFY `ProductID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sectiontbl`
--
ALTER TABLE `sectiontbl`
  MODIFY `SectionID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
