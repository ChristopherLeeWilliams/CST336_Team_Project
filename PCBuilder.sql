-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2017 at 02:29 AM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `PCBuilder`
--

-- --------------------------------------------------------

--
-- Table structure for table `Case`
--

CREATE TABLE IF NOT EXISTS `Case` (
  `caseName` varchar(80) NOT NULL,
  `caseId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `caseFFId` tinyint(3) unsigned NOT NULL,
  `maxGPULengthInches` decimal(6,2) unsigned NOT NULL,
  `caseNum25Bays` tinyint(4) unsigned NOT NULL,
  `caseNum35Bays` tinyint(4) unsigned NOT NULL,
  `casePrice` decimal(7,2) unsigned NOT NULL,
  PRIMARY KEY (`caseId`),
  KEY `formFactorId` (`caseFFId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Case`
--

INSERT INTO `Case` (`caseName`, `caseId`, `caseFFId`, `maxGPULengthInches`, `caseNum25Bays`, `caseNum35Bays`, `casePrice`) VALUES
('Corsair 760T Black ATX Full Tower Case', 1, 3, '17.72', 4, 6, '159.99'),
('Fractal Design Define R4 w/Window (Black Pearl) ATX Mid Tower Case', 2, 3, '11.61', 2, 8, '114.88'),
('NZXT Phantom 530 (White) ATX Full Tower Case', 3, 3, '12.20', 0, 6, '109.99'),
('Phanteks Enthoo Pro ATX Full Tower Case', 4, 3, '13.66', 1, 6, '97.98'),
('Thermaltake Level 10 GT Snow Edition ATX Full Tower Case', 5, 3, '14.17', 0, 5, '174.48'),
('Corsair 750D ATX Full Tower Case', 6, 3, '13.39', 4, 6, '130.99');

-- --------------------------------------------------------

--
-- Table structure for table `CPU`
--

CREATE TABLE IF NOT EXISTS `CPU` (
  `cpuId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `cpuName` varchar(60) NOT NULL,
  `cpuBaseClock` varchar(10) NOT NULL,
  `cpuNumCores` tinyint(4) unsigned NOT NULL,
  `cpuTDP` smallint(5) unsigned NOT NULL,
  `cpuPrice` decimal(7,2) unsigned NOT NULL,
  `cpuSocketId` tinyint(3) unsigned NOT NULL,
  `cpuManufacturer` varchar(50) NOT NULL,
  PRIMARY KEY (`cpuId`),
  KEY `socketId` (`cpuSocketId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `CPU`
--

INSERT INTO `CPU` (`cpuId`, `cpuName`, `cpuBaseClock`, `cpuNumCores`, `cpuTDP`, `cpuPrice`, `cpuSocketId`, `cpuManufacturer`) VALUES
(1, 'Intel Core i7-6700K 4.0GHz Quad-Core Processor', '4.0GHz', 4, 91, '316.98', 17, 'Intel'),
(2, 'Intel Xeon E3-1231 V3 3.4GHz Quad-Core Processor', '3.4GHz', 4, 80, '239.99', 16, 'Intel'),
(3, 'AMD FX-8350 4.0GHz 8-Core Processor', '4.0GHz', 8, 125, '127.96', 3, 'AMD'),
(4, 'AMD RYZEN 7 1800X 3.6GHz 8-Core Processor', '3.6GHz', 8, 95, '492.99', 5, 'AMD'),
(5, 'Intel Core i7-4790K 4.0GHz Quad-Core Processor', '4.0GHz', 4, 88, '334.99', 16, 'Intel'),
(6, 'AMD 5350 2.05GHz Quad-Core Processor', '2.50GHz', 4, 25, '55.00', 1, 'AMD'),
(7, 'AMD Phenom II X6 1090T Black 3.2GHz 6-Core Process', '3.2GHz', 6, 125, '134.99', 2, 'AMD'),
(8, 'AMD Phenom II X4 965 Black 3.4GHz Quad-Core Processor', '3.4GHz', 4, 125, '109.36', 4, 'AMD'),
(9, 'AMD Opteron 4386 3.1GHz 8-Core Processor', '3.1GHz', 8, 95, '384.99', 9, 'AMD'),
(10, 'AMD A8-3850 2.9GHz Quad-Core Processor', '2.9GHz', 4, 100, '208.46', 10, 'AMD'),
(11, 'AMD A10-6800K 4.1GHz Quad-Core Processor', '4.1GHz', 4, 100, '152.05', 11, 'AMD'),
(12, 'AMD Athlon X4 860K 3.7GHz Quad-Core Processor', '3.7GHz', 4, 95, '99.89', 12, 'AMD'),
(13, 'AMD Opteron 6328 3.2GHz 8-Core Processor', '3.2GHz', 8, 115, '544.99', 13, 'AMD'),
(14, 'Intel Core 2 Extreme QX9775 3.2GHz Quad-Core Processor', '3.2GHz', 4, 150, '885.00', 14, 'Intel'),
(15, 'Intel Core 2 Quad Q6600 2.4GHz Quad-Core', '2.4GHz', 4, 100, '68.99', 15, 'Intel'),
(16, 'Intel Core i5-4690K 3.5GHz Quad-Core Processor', '3.5GHz', 4, 88, '235.99', 16, 'Intel'),
(17, 'Intel Core i7-7700K 4.2GHz Quad-Core Processor', '4.2GHz', 4, 91, '327.49', 17, 'Intel'),
(18, 'Intel Core i5-2500K 3.3GHz Quad-Core Processor', '3.3GHz', 4, 95, '262.75', 18, 'Intel'),
(19, 'Intel Core i3-540 3.06GHz Dual-Core Processor', '3.06GHz', 2, 73, '102.30', 19, 'Intel'),
(20, 'Intel Core i7-960 3.2GHz Quad-Core Processor', '3.2GHz', 4, 130, '112.00', 20, 'Intel'),
(21, 'Intel Core i7-4930K 3.4GHz 6-Core Processor', '3.4GHz', 6, 130, '626.01', 21, 'Intel'),
(22, 'Intel Xeon E5-2620 V4 2.1GHz 8-Core Processor', '3.0GHz', 8, 85, '407.89', 22, 'Intel');

-- --------------------------------------------------------

--
-- Table structure for table `GPU`
--

CREATE TABLE IF NOT EXISTS `GPU` (
  `gpuId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `gpuName` varchar(50) NOT NULL,
  `gpuManufacturer` varchar(20) NOT NULL,
  `gpuBaseClock` varchar(15) NOT NULL,
  `gpuMemSize` varchar(15) NOT NULL,
  `gpuTDP` smallint(5) unsigned NOT NULL,
  `gpuLengthInches` decimal(6,2) unsigned NOT NULL,
  `gpuPrice` decimal(7,2) unsigned NOT NULL,
  PRIMARY KEY (`gpuId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `GPU`
--

INSERT INTO `GPU` (`gpuId`, `gpuName`, `gpuManufacturer`, `gpuBaseClock`, `gpuMemSize`, `gpuTDP`, `gpuLengthInches`, `gpuPrice`) VALUES
(1, 'GeForce GTX 1080 Ti	', 'NVIDIA', '1.48GHz', '11GB', 250, '10.51', '698.99'),
(2, 'GeForce GTX 1060 6GB', 'NVIDIA', '1.51GHz', '6GB', 120, '10.91', '269.49'),
(3, 'GeForce GTX 1070', 'NVIDIA', '1.51GHz ', '8GB', 150, '10.98', '399.99'),
(4, 'Radeon RX 470', 'AMD', '0.926GHz', '4GB', 120, '9.69', '162.99'),
(5, 'Radeon RX 480', 'AMD', '1.21GHz ', '8GB', 225, '9.45', '219.98'),
(6, 'Radeon RX 460', 'AMD', '1.09GHz', '2GB', 75, '7.52', '73.98'),
(7, 'GeForce GTX 1080', 'NVIDIA', '1.61GHz', '8GB', 180, '10.51', '549.99'),
(8, 'GeForce GTX 970', 'NVIDIA', '1.14GHz', '4GB', 145, '10.59', '369.00'),
(9, 'Radeon R9 Fury', 'AMD', '1.05GHz', '4GB', 275, '12.09', '256.98');

-- --------------------------------------------------------

--
-- Table structure for table `MBFormFactors`
--

CREATE TABLE IF NOT EXISTS `MBFormFactors` (
  `mbFFId` tinyint(3) unsigned NOT NULL,
  `mbFFType` varchar(15) NOT NULL,
  PRIMARY KEY (`mbFFId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `MBFormFactors`
--

INSERT INTO `MBFormFactors` (`mbFFId`, `mbFFType`) VALUES
(1, 'Mini-ITX'),
(2, 'Micro-ATX'),
(3, 'Standard-ATX');

-- --------------------------------------------------------

--
-- Table structure for table `Motherboard`
--

CREATE TABLE IF NOT EXISTS `Motherboard` (
  `mbId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `mbName` varchar(60) NOT NULL,
  `mbSocketId` tinyint(3) unsigned NOT NULL,
  `mbFFId` tinyint(3) unsigned NOT NULL,
  `mbNumRamSlots` tinyint(4) unsigned NOT NULL,
  `maxRamGB` smallint(4) unsigned NOT NULL,
  `mbRamTypeId` tinyint(3) unsigned NOT NULL,
  `mbNumSata3Ports` tinyint(4) unsigned NOT NULL,
  `mbPrice` decimal(7,2) unsigned NOT NULL,
  PRIMARY KEY (`mbId`),
  KEY `socketId` (`mbSocketId`),
  KEY `ramTypeId` (`mbRamTypeId`),
  KEY `formFactorId` (`mbFFId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `Motherboard`
--

INSERT INTO `Motherboard` (`mbId`, `mbName`, `mbSocketId`, `mbFFId`, `mbNumRamSlots`, `maxRamGB`, `mbRamTypeId`, `mbNumSata3Ports`, `mbPrice`) VALUES
(1, 'ASRock AM1H-ITX Mini ITX AM1 Motherboard', 1, 1, 2, 16, 2, 4, '53.99'),
(2, 'MSI 880GMA-E45 Micro ATX AM3 Motherboard', 2, 2, 4, 16, 2, 6, '114.26'),
(3, 'Asus Sabertooth 990FX R2.0 ATX AM3+ Motherboard', 3, 3, 4, 32, 2, 8, '176.99'),
(4, 'Gigabyte GA-970A-D3P ATX AM3+/AM3 Motherboard', 4, 3, 4, 32, 2, 6, '81.89'),
(5, 'MSI X370 GAMING PRO CARBON ATX AM4 Motherboard', 5, 3, 4, 64, 3, 6, '178.89'),
(6, 'Asus F1A55-M LX PLUS Micro ATX FM1 Motherboard', 10, 2, 2, 32, 2, 6, '68.99'),
(7, 'MSI FM2-A75MA-E35 Micro ATX FM2 Motherboard', 11, 2, 2, 16, 2, 6, '59.99'),
(8, 'ASRock FM2A88X+ Killer ATX FM2+ Motherboard', 12, 3, 4, 64, 2, 8, '84.99'),
(9, 'Gigabyte GA-G41MT-S2PT Micro ATX LGA775 Motherboard', 15, 2, 2, 8, 2, 4, '75.55'),
(10, 'Asus Maximus VI Impact Mini ITX LGA1150 Motherboard', 16, 1, 2, 16, 2, 4, '336.89'),
(11, 'Asus Sabertooth Z87 ATX LGA1150 Motherboard', 16, 3, 4, 32, 2, 8, '181.00'),
(12, 'Asus Z170I PRO GAMING Mini ITX LGA1151 Motherboard', 17, 1, 2, 32, 3, 2, '151.99'),
(13, 'Asus ROG MAXIMUS VIII HERO ALPHA ATX LGA1151 Motherboard', 17, 3, 4, 64, 3, 6, '251.98'),
(14, 'MSI Z77 MPOWER ATX LGA1155 Motherboard', 18, 3, 4, 32, 2, 2, '189.99'),
(15, 'MSI P55-GD65 USB3 ATX LGA1156 Motherboard', 19, 3, 4, 16, 2, 0, '66.00'),
(16, 'Gigabyte GA-X58A-UD3R ATX LGA1366 Motherboard', 20, 3, 6, 24, 2, 2, '219.00'),
(17, 'Asus P9X79 LE ATX LGA2011 Motherboard', 21, 3, 8, 64, 2, 2, '245.00'),
(18, 'ASRock Fatal1ty X99X Killer ATX LGA2011-3 Motherboard', 22, 3, 8, 128, 3, 10, '226.98'),
(19, 'Asus X99-DELUXE/U3.1 ATX LGA2011-3 Motherboard', 22, 3, 8, 64, 3, 8, '466.88'),
(20, 'MSI Z97S SLI Krait Edition ATX LGA1150 Motherboard', 16, 3, 4, 32, 2, 4, '123.99');

-- --------------------------------------------------------

--
-- Table structure for table `PSU`
--

CREATE TABLE IF NOT EXISTS `PSU` (
  `psuId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `psuName` varchar(50) NOT NULL,
  `psuWatts` smallint(6) unsigned NOT NULL,
  `psuModularity` varchar(10) NOT NULL,
  `psuEfficiency` varchar(20) NOT NULL,
  `psuPrice` decimal(7,2) unsigned NOT NULL,
  PRIMARY KEY (`psuId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `PSU`
--

INSERT INTO `PSU` (`psuId`, `psuName`, `psuWatts`, `psuModularity`, `psuEfficiency`, `psuPrice`) VALUES
(1, 'EVGA SuperNOVA 650', 650, 'Full', '80+ Gold', '77.88'),
(2, 'Corsair CX550M', 550, 'Semi', '80+ Bronze', '43.98'),
(3, 'SeaSonic M12II 520 Bronze', 520, 'Full', '80+ Bronze', '52.89'),
(4, 'Corsair AX1500i', 1500, 'Full', '80+ Titanium', '394.99'),
(5, 'Thermaltake TPX-1375M', 1375, 'Semi', '80+ Gold', '388.31'),
(6, 'Corsair RM650x', 650, 'Full', '80+ Gold', '104.98'),
(7, 'EVGA 500B', 500, 'No', '80+ Bronze', '45.49'),
(8, 'Corsair HX1000i', 1000, 'Full', '80+ Platinum', '188.99');

-- --------------------------------------------------------

--
-- Table structure for table `RAM`
--

CREATE TABLE IF NOT EXISTS `RAM` (
  `ramId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `ramName` varchar(50) NOT NULL,
  `ramTypeId` tinyint(3) unsigned NOT NULL,
  `ramSpeed` varchar(15) NOT NULL,
  `ramCas` tinyint(3) unsigned NOT NULL,
  `ramSizeGB` smallint(4) unsigned NOT NULL,
  `ramPrice` decimal(7,2) unsigned NOT NULL,
  PRIMARY KEY (`ramId`),
  KEY `ramTypeId` (`ramTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `RAM`
--

INSERT INTO `RAM` (`ramId`, `ramName`, `ramTypeId`, `ramSpeed`, `ramCas`, `ramSizeGB`, `ramPrice`) VALUES
(1, 'Corsair Vengeance LPX', 3, '3000MHz', 15, 16, '109.99'),
(2, 'G.Skill Ripjaws V Series', 3, '2666MHz', 15, 16, '99.97'),
(4, 'Kingston HyperX Fury Black', 3, '2133MHz', 14, 8, '67.99'),
(5, 'Corsair Vengeance Pro', 2, '1866MHz', 11, 8, '49.99'),
(6, 'G.Skill Sniper', 2, '1600MHz', 9, 8, '58.99'),
(7, 'Crucial Ballistix Sport', 2, '1600MHz', 9, 16, '106.77'),
(8, 'G.Skill Ripjaws X Series', 2, '1866MHz', 9, 4, '31.98'),
(9, 'Kingston ValueRAM', 1, '800MHz', 6, 2, '18.50');

-- --------------------------------------------------------

--
-- Table structure for table `RamType`
--

CREATE TABLE IF NOT EXISTS `RamType` (
  `ramTypeId` tinyint(3) unsigned NOT NULL,
  `ramType` varchar(15) NOT NULL,
  PRIMARY KEY (`ramTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `RamType`
--

INSERT INTO `RamType` (`ramTypeId`, `ramType`) VALUES
(1, 'DDR2'),
(2, 'DDR3'),
(3, 'DDR4');

-- --------------------------------------------------------

--
-- Table structure for table `Socket`
--

CREATE TABLE IF NOT EXISTS `Socket` (
  `socketId` tinyint(3) unsigned NOT NULL,
  `socketType` varchar(15) NOT NULL,
  PRIMARY KEY (`socketId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Socket`
--

INSERT INTO `Socket` (`socketId`, `socketType`) VALUES
(1, 'AM1'),
(2, 'AM3'),
(3, 'AM3+'),
(4, 'AM3/AM2+'),
(5, 'AM4'),
(6, 'BGA413'),
(7, 'BGA559'),
(8, 'BGA1023'),
(9, 'C32'),
(10, 'FM1'),
(11, 'FM2'),
(12, 'FM2+'),
(13, 'G34'),
(14, 'LGA771'),
(15, 'LGA775'),
(16, 'LGA1150'),
(17, 'LGA1151'),
(18, 'LGA1155'),
(19, 'LGA1156'),
(20, 'LGA1366'),
(21, 'LGA2011'),
(22, 'LGA2011-3'),
(23, 'PGA988');

-- --------------------------------------------------------

--
-- Table structure for table `Storage`
--

CREATE TABLE IF NOT EXISTS `Storage` (
  `storageId` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `storageName` varchar(50) NOT NULL,
  `storageSize` varchar(10) NOT NULL,
  `storageType` varchar(20) NOT NULL,
  `storageRPM` varchar(15) NOT NULL,
  `storageCache` varchar(15) NOT NULL,
  `storageFFId` tinyint(3) unsigned NOT NULL,
  `storagePrice` decimal(7,2) unsigned NOT NULL,
  PRIMARY KEY (`storageId`),
  KEY `formFactorId` (`storageFFId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `Storage`
--

INSERT INTO `Storage` (`storageId`, `storageName`, `storageSize`, `storageType`, `storageRPM`, `storageCache`, `storageFFId`, `storagePrice`) VALUES
(1, 'Western Digital WD10EZEX', '1TB', 'HDD', '7200RPM', '64MB', 2, '49.33'),
(2, 'Samsung MZ-75E250B/AM', '250GB', 'SSD', 'SSD', 'N/A', 1, '99.88'),
(3, 'Seagate ST2000DM001', '2TB', 'HDD', '7200RPM', '64MB', 2, '69.99'),
(4, 'Sandisk SDSSDA-240G-G26', '240GB', 'SSD', 'SSD', 'N/A', 1, '79.00'),
(5, 'Seagate ST1000DM003', '1TB', 'HDD', '7200RPM', '64MB', 2, '53.89'),
(6, 'Samsung MZ-75E1T0B/AM', '1TB', 'SSD', 'SSD', 'N/A', 1, '324.99'),
(7, 'Western Digital WD10EURX', '1TB', 'HDD', '5400RPM', '64MB', 2, '58.99');

-- --------------------------------------------------------

--
-- Table structure for table `StorageFormFactors`
--

CREATE TABLE IF NOT EXISTS `StorageFormFactors` (
  `storageFFId` tinyint(3) unsigned NOT NULL,
  `storageFFType` varchar(15) NOT NULL,
  PRIMARY KEY (`storageFFId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `StorageFormFactors`
--

INSERT INTO `StorageFormFactors` (`storageFFId`, `storageFFType`) VALUES
(1, '2.5 inches'),
(2, '3.5 inches');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Case`
--
ALTER TABLE `Case`
  ADD CONSTRAINT `Case_ibfk_1` FOREIGN KEY (`caseFFId`) REFERENCES `MBFormFactors` (`mbFFId`);

--
-- Constraints for table `CPU`
--
ALTER TABLE `CPU`
  ADD CONSTRAINT `CPU_ibfk_1` FOREIGN KEY (`cpuSocketId`) REFERENCES `Socket` (`socketId`);

--
-- Constraints for table `Motherboard`
--
ALTER TABLE `Motherboard`
  ADD CONSTRAINT `Motherboard_ibfk_1` FOREIGN KEY (`mbSocketId`) REFERENCES `Socket` (`socketId`),
  ADD CONSTRAINT `Motherboard_ibfk_2` FOREIGN KEY (`mbFFId`) REFERENCES `MBFormFactors` (`mbFFId`),
  ADD CONSTRAINT `Motherboard_ibfk_3` FOREIGN KEY (`mbRamTypeId`) REFERENCES `RamType` (`ramTypeId`);

--
-- Constraints for table `RAM`
--
ALTER TABLE `RAM`
  ADD CONSTRAINT `RAM_ibfk_1` FOREIGN KEY (`ramTypeId`) REFERENCES `RamType` (`ramTypeId`);

--
-- Constraints for table `Storage`
--
ALTER TABLE `Storage`
  ADD CONSTRAINT `Storage_ibfk_1` FOREIGN KEY (`storageFFId`) REFERENCES `StorageFormFactors` (`storageFFId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
