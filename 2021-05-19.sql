-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.0.20-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for file
DROP DATABASE IF EXISTS `file`;
CREATE DATABASE IF NOT EXISTS `file` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `file`;

-- Dumping structure for table file.employees
DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table file.employees: ~1 rows (approximately)
DELETE FROM `employees`;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`id`, `name`, `address`, `salary`) VALUES
	(9, 'Dinuka Dilshan Ekanayake', 'Midellawa B Koswaththa', 100000),
	(14, 'Dinuka Ekanayake', 'Midellawa B Koswaththa', 15);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;

-- Dumping structure for table file.registration
DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Reference_number` varchar(20) DEFAULT NULL,
  `Received_number` varchar(100) DEFAULT '-',
  `Date_of_receipt` date DEFAULT NULL,
  `How_received` varchar(50) DEFAULT NULL,
  `Referred_Division` varchar(25) DEFAULT NULL,
  `S_Title_of_the_Letters` varchar(250) DEFAULT '-',
  `E_Title_of_the_Lettere` varchar(250) DEFAULT '-',
  `file` varchar(50) DEFAULT NULL,
  `Issue_Date` date DEFAULT NULL,
  `Calender_Date` date DEFAULT NULL,
  `Calender_For_DIG` date DEFAULT NULL,
  `Officer_Name` varchar(250) DEFAULT '-',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- Dumping data for table file.registration: 28 rows
DELETE FROM `registration`;
/*!40000 ALTER TABLE `registration` DISABLE KEYS */;
INSERT INTO `registration` (`id`, `Reference_number`, `Received_number`, `Date_of_receipt`, `How_received`, `Referred_Division`, `S_Title_of_the_Letters`, `E_Title_of_the_Lettere`, `file`, `Issue_Date`, `Calender_Date`, `Calender_For_DIG`, `Officer_Name`) VALUES
	(10, 'DOC/JAN/10', '-', '2021-03-30', 'Letter', 'Colombo', '-', 'Prime Offenses', 'file-16192717949013.pdf', '2021-05-22', '2021-05-12', '2021-05-17', 'ajith niroshan'),
	(28, 'DAC/2020/31', '-', '2021-04-16', 'Letter', 'Akkaraipattu', '-', '-', 'file-16192714528521.pdf', '2021-04-20', '2021-05-12', '2021-05-16', 'ajith niroshan'),
	(27, 'DAC/2020/30', '-', '2021-04-19', 'Letter', 'Maradana', '-', 'Crime', 'file-16189115399424.pdf', '2021-04-19', '2021-05-12', '2021-05-16', 'PC 65842 Saman Kumara'),
	(26, 'DAC/2020/28', '-', '2021-04-19', 'Letter', 'Colombo', '-', 'Crime', 'file-16188131893350.pdf', '2021-04-19', '2021-05-12', '2021-05-25', 'ajith niroshan'),
	(15, 'DOC/JAN/15', '-', '2021-03-25', 'Fax', 'Maradana', 'පාස්කු ප්‍රහාරයට සම්බන්ද චුදිතයන්ට ආදී චෝදනා ගොනු කිරීම', '-', 'file-16192726869413.pdf', '2021-03-31', '2021-05-12', '2021-05-19', 'ajith niroshan'),
	(17, 'DOC/JAN/18', '-', '2021-04-01', 'Fax', 'Colombo', 'පාස්කු ප්‍රහාරයට සම්බන්ද චුදිතයන්ට දඩුවම් දීම', '-', 'file-16192723757464.pdf', '2021-04-14', '2021-05-12', '2021-05-19', 'ajith niroshan'),
	(24, 'DAC/2021/26', '-', '2021-04-19', 'Letter', 'Maradana', 'අපරාධ පිළිබඳ අපරාධ', '-', 'file-16188024064243.pdf', '2021-04-20', '2021-05-10', '2021-05-07', 'ajith niroshan'),
	(32, 'DAC/2020/33', 'OUT/2021/37', '2021-04-21', 'Fax', 'Colombo North', '-', 'Task of the Covid', 'file-16196781626501.pdf', '2021-04-21', '2021-05-10', '2021-05-19', 'PC 65842 Saman Kumara'),
	(23, 'DAC/2020/25', '-', '2021-04-16', 'Letter', 'Grandpass', 'රථ වාහන රාජකාරි සදහා පොලිස් නිලදාරීන් යෙදවීම.', '-', 'file-16192717722038.pdf', '2021-04-19', '2021-05-12', '2021-05-09', 'ajith niroshan'),
	(29, 'DAC/2020/30', '-', '2021-04-19', 'Letter', 'Colombo', '-', 'Minor Offences', 'file-16189822791935.pdf', '2021-04-20', '2021-05-10', '2021-05-07', 'PC 65842 Saman Kumara'),
	(30, 'DAC/2020/32', '-', '2021-04-16', 'Fax', 'Seeduwa', 'කොරෝනා සම්බන්ධ දත්ත යාවත්කාලින කිරීම.', '-', 'file-16192722757530.pdf', '2021-04-19', '2021-05-09', '2021-05-04', 'ajith niroshan'),
	(31, 'DAC/2020/33', '-', '2021-04-20', 'Letter', 'Colombo', 'බල අපරාද මර්දනය කිරීමට කටයුතු සිදු කිරීම.', '-', 'file-16192721581607.pdf', '2021-04-20', '2021-05-09', '2021-05-05', 'ajith niroshan'),
	(33, 'DAC/2020/34', '-', '2021-04-23', 'Fax', 'Colombo', '-', 'Effect Covid Virus', 'file-16192709707894.pdf', '2021-04-23', '2021-05-10', '2021-05-04', 'ajith niroshan'),
	(34, 'DC04/විවිධ/455/2021', '-', '2021-04-19', 'Letter', 'Discipline & Conduct', 'විනය හා කල්ක්‍රියා කොට්ඨාසයේ ලිපි ගනුදෙනු සම්බන්ධ යවනු ලබන එවනු ලබන ලේඛනයට අදාළ මෘදුකාංගයක් සකස් කර ගැනිම සදහා', '-', 'file-16195995423149.pdf', '2021-04-26', '2021-05-05', '2021-05-05', 'ajith niroshan'),
	(35, 'DAC/2021/34', 'DAC/2021/31', '2021-04-27', 'Letter', 'Akmeemana', '-', '-', 'file-16196769379650.pdf', '2021-04-28', '2021-05-10', '2021-05-03', 'ajith niroshan'),
	(36, 'DAC/2020/33', 'DAC/2021/33', '2021-04-20', 'Letter', 'Akkaraipattu', '-', '-', 'file-16197638345201.pdf', '2021-04-30', '2021-05-12', '2021-05-15', 'ajith niroshan'),
	(37, 'DAC/2021/31', 'DAC/2021/33', '2021-04-28', 'Fax', 'Agalawatta', '-', '-', 'file-16197688815180.pdf', '2021-04-29', '2021-05-10', '2021-05-08', 'ajith niroshan'),
	(38, 'DAC/2021/55', 'DAC/2021/32', '2021-04-21', 'Letter', 'Aithimalaya', '-', 'Mark of the reader', 'file-16197763525928.pdf', '2021-04-28', '2021-05-07', '2021-05-09', 'ajith niroshan'),
	(39, 'DAC/202/34', 'OUT/2021/34', '2021-04-28', 'Letter', 'WP North Crime Division', '-', 'Reducing child abuse.', 'file-16197775745958.pdf', '2021-04-27', '2021-05-06', '2021-05-22', 'ajith niroshan'),
	(40, 'DAC/2020/27', 'OUT/2021/34', '2021-04-26', 'Letter', 'Akkaraipattu', '-', 'Increase the PCR Test', 'file-16198408338398.pdf', '2021-04-29', '2021-05-16', '2021-05-10', 'ajith niroshan'),
	(41, 'DAC/2021/35', 'OUT/2021/35', '2021-04-29', 'Letter', 'Bemmulla', 'PCR පරීක්ෂණය වැඩි කරන්න', 'Increase the PCR Test', 'file-16198788395556.pdf', '2021-04-26', '2021-04-28', '2021-05-10', 'ajith niroshan'),
	(42, 'DAC/2021/35', 'OUT/2021/36', '2021-05-01', 'Fax', 'Arachchikattuwa', 'පොලිස් නිලදරින්ට උසස් වීමි ලබා දිම.', '-', 'file-16198819427892.pdf', '2021-05-04', '2021-05-07', '2021-05-09', 'ajith niroshan'),
	(43, 'DAC/2021/36', 'OUT/2021/36', '2021-04-30', 'Letter', 'Dambulla', '-', 'Close to the Economic Center', 'file-16198821018663.pdf', '2021-05-11', '2021-05-13', '2021-05-26', 'ajith niroshan'),
	(44, 'DAC/2021/37', 'OUT/2021/37', '2021-05-01', 'Letter', 'Katunayaka', '-', 'Regarding Air Port', 'file-16198824034792.pdf', '2021-05-10', '2021-05-11', '2021-05-09', 'PC 65842 Saman Kumara'),
	(45, 'DAC/2021/37', 'OUT/2021/37', '2021-05-01', 'Letter', 'Bambalapitiya', '-', 'Avoid to the quarantine law', 'file-16198828345622.pdf', '2021-05-06', '2021-05-04', '2021-05-06', 'PC 65842 Saman Kumara'),
	(46, 'DC04/විවිධ/456/2021', 'OUT/2021/37', '2021-05-02', 'Letter', 'Ambanpola', '-', 'Increase the Security Protection', 'file-16200124554690.pdf', '2021-05-05', '2021-05-05', '2021-05-06', 'PC 65842 Saman Kumara'),
	(47, 'DIG/OUT/253/21', '-', '2021-05-06', 'None', 'Select Division or Police', '-', 'Progress report on crime prevention mission on 04/05/2021', 'file-16203600523914.pdf', '2021-05-18', '2021-05-16', '2021-05-19', 'PC 65842 Saman Kumara'),
	(48, '25252', '59855598', '2021-05-01', 'Letter', 'Ampara', '522982552982589529', '52525252', 'file-16213139227131.jpg', '2021-05-01', '2021-05-01', '2021-05-01', 'PC1001-Dimuthu Dasanayake');
/*!40000 ALTER TABLE `registration` ENABLE KEYS */;

-- Dumping structure for table file.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `pass_reset_on` varchar(250) DEFAULT NULL,
  `pass_reset_by` varchar(250) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6),
  `user_type` int(11) NOT NULL DEFAULT '0',
  `loged_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `log_out_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `log_state` int(1) DEFAULT '0',
  `is_active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table file.users: 4 rows
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `pass_reset_on`, `pass_reset_by`, `created_at`, `user_type`, `loged_on`, `log_out_on`, `log_state`, `is_active`) VALUES
	(3, 'admin', '$2y$10$SUovfANbYUcA8POeEPF5B.eHRkHUsKh5YRbKMJr/2MXZ..adurIfy', '2021-05-17 13:00:44', 'ADMIN', '2021-05-15 12:15:30.623297', 1, '2021-05-18 02:33:24', '2021-05-18 02:33:20', 1, 1),
	(2, 'qwe', '$2y$10$KhnQWnXq7vMvjd1RBvVIh.TjryuBhE1akBgpJEmKJCH.lavigTKtK', '2021-05-17 13:00:44', 'ADMIN', '2021-04-09 10:31:49.839719', 0, '2021-05-17 13:01:41', '2021-05-16 11:21:50', 0, 0),
	(8, 'dinuka', '$2y$10$oLrGDRgxHqRJXekchnRZ6OyE3GLU4yNbT2UPKz4vpFkjeMzYTg8wO', '2021-05-18 00:24:16', 'ADMIN', '2021-05-16 06:14:44.813118', 0, '2021-05-18 00:25:59', '2021-05-18 00:26:03', 0, 1),
	(9, 'waruna', '$2y$10$2YIDJX1Xx9G1BIZaCyTQK.1PJBnOP/JM1Z0Z0QU6g.xj3KrUPrDgK', '2021-05-18 10:43:35', 'ADMIN', '2021-05-18 00:21:09.690971', 0, '2021-05-18 14:27:02', '2021-05-18 14:24:54', 0, 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
