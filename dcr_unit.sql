-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2021 at 08:39 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcr_unit`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `address`, `salary`) VALUES
(9, 'Dinuka Dilshan Ekanayake', 'Midellawa B Koswaththa', 100000),
(14, 'Dinuka Ekanayake', 'Midellawa B Koswaththa', 15);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
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
  `Officer_Name` varchar(250) DEFAULT '-'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registration`
--

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
(47, 'DIG/OUT/253/21', '-', '2021-05-06', 'Letter', 'Colombo Central', '-', 'Progress report on crime prevention mission on 04/05/2021', 'file-16203600523914.pdf', '2021-05-18', '2021-05-16', '2021-05-19', 'PC 65842 Saman Kumara'),
(49, 'MOH/S/Corona/QC', '-', '2021-05-31', 'Letter', 'Seeduwa', 'දින 14ක් නිවස තුළ නිරෝධායනය', '-', 'file-16225854668087.jpg', '2021-06-01', '0000-00-00', '0000-00-00', 'IT Administrator office'),
(50, 'D/IT/Out/942/2021', '-', '2021-03-18', 'Letter', 'Maradana', 'රථවාහන අනතුරු සම්බන්ධව තොරතුරු පරිගණක ගත කිරිමේ දත්ත පද්ධතියක් නිර්මාණය කිරීම සදහා අධ්‍යනයක් සිදු කිරීම.', '-', 'file-16226010508633.jpeg', '2021-05-05', '2021-05-31', '2021-06-01', 'OIC -Maradana'),
(51, 'DC04/විවිධ/456/2021', '-', '2021-05-25', 'Letter', 'Arachchikattuwa', '-', 'Increase to the Quarantine law', 'file-16231052231746.pdf', '2021-05-28', '2021-05-30', '2021-06-07', 'SI Gunasinha');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `pass_reset_on` varchar(250) DEFAULT NULL,
  `pass_reset_by` varchar(250) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT current_timestamp(6),
  `user_type` int(11) NOT NULL DEFAULT 0,
  `loged_on` timestamp NULL DEFAULT current_timestamp(),
  `log_out_on` timestamp NULL DEFAULT current_timestamp(),
  `log_state` int(1) DEFAULT 0,
  `is_active` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `pass_reset_on`, `pass_reset_by`, `created_at`, `user_type`, `loged_on`, `log_out_on`, `log_state`, `is_active`) VALUES
(3, 'admin', '$2y$10$SUovfANbYUcA8POeEPF5B.eHRkHUsKh5YRbKMJr/2MXZ..adurIfy', '2021-05-17 13:00:44', 'ADMIN', '2021-05-15 19:15:30.623297', 1, '2021-05-18 09:33:24', '2021-05-18 09:33:20', 1, 1),
(2, 'qwe', '$2y$10$zdXaEY/vgAp9h8k71tJxwu8fQ3jbz8Abpr4lG//EbYg0qEEV.GIaG', '2021-06-01 00:12:31', 'ADMIN', '2021-04-09 17:31:49.839719', 0, '2021-06-09 17:23:59', '2021-06-09 17:24:16', 0, 1),
(8, 'Administrator', '$2y$10$oLrGDRgxHqRJXekchnRZ6OyE3GLU4yNbT2UPKz4vpFkjeMzYTg8wO', '2021-05-18 00:24:16', 'ADMIN', '2021-05-16 13:14:44.813118', 1, '2021-08-26 08:52:46', '2021-08-26 09:00:36', 0, 1),
(9, 'waruna', '$2y$10$tCILlAx3LxCabX.GtDmEMuX63qDg0Xk8sIrTP6LidQ.rlAfT5v.Qu', '2021-06-09 10:25:51', 'ADMIN', '2021-05-18 07:21:09.690971', 0, '2021-08-02 15:57:57', '2021-06-11 15:46:25', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
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
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
