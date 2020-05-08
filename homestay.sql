-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2020 at 05:48 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homestay`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingNo` int(4) NOT NULL,
  `userId` int(4) NOT NULL,
  `bookingDateTime` datetime NOT NULL,
  `bookingTotal` decimal(8,2) NOT NULL DEFAULT '0.00',
  `bookingStatus` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingNo`, `userId`, `bookingDateTime`, `bookingTotal`, `bookingStatus`) VALUES
(21, 3, '2020-04-28 17:27:49', '11550.00', 'Booked'),
(22, 4, '2020-04-28 19:23:07', '5700.00', 'Booked'),
(23, 4, '2020-04-28 19:23:30', '6600.00', 'Booked'),
(24, 3, '2020-04-30 19:35:04', '0.00', 'Booked'),
(25, 3, '2020-04-30 19:36:42', '0.00', 'Booked'),
(26, 3, '2020-04-30 19:41:55', '0.00', 'Booked'),
(27, 3, '2020-04-30 19:42:56', '0.00', 'Booked'),
(28, 3, '2020-04-30 19:44:24', '0.00', 'Booked'),
(29, 3, '2020-04-30 19:44:59', '56350.00', 'Booked'),
(30, 3, '2020-04-30 21:34:40', '12950.00', 'Booked'),
(31, 3, '2020-05-05 15:45:14', '41800.00', 'Booked'),
(32, 3, '2020-05-05 15:45:56', '20900.00', 'Booked'),
(33, 3, '2020-05-05 15:50:39', '16000.00', 'Booked'),
(34, 2, '2020-05-05 15:52:24', '32000.00', 'Booked'),
(35, 2, '2020-05-05 15:52:51', '24000.00', 'Booked'),
(36, 3, '2020-05-07 21:34:45', '22000.00', 'Booked'),
(37, 3, '2020-05-07 23:12:25', '1850.00', 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `booking_line`
--

CREATE TABLE `booking_line` (
  `bookingLineId` int(4) NOT NULL,
  `bookingNo` int(4) NOT NULL,
  `homestayId` int(4) NOT NULL,
  `RommsBooked` int(4) NOT NULL,
  `ArrivalDate` date NOT NULL,
  `DepartureDate` date NOT NULL,
  `NoOfPeople` int(11) NOT NULL,
  `subTotal` decimal(8,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_line`
--

INSERT INTO `booking_line` (`bookingLineId`, `bookingNo`, `homestayId`, `RommsBooked`, `ArrivalDate`, `DepartureDate`, `NoOfPeople`, `subTotal`) VALUES
(10, 21, 1, 3, '2020-04-02', '2020-04-04', 3, '5550.00'),
(11, 21, 3, 3, '2020-04-02', '2020-04-21', 4, '6000.00'),
(12, 22, 2, 3, '2020-04-01', '2020-04-08', 4, '5700.00'),
(13, 23, 4, 3, '2020-04-02', '2020-04-04', 5, '6600.00'),
(14, 29, 1, 1, '2020-04-15', '2020-04-22', 3, '12950.00'),
(15, 29, 4, 3, '2020-04-15', '2020-04-22', 2, '15400.00'),
(16, 29, 3, 2, '2020-04-01', '2020-04-15', 3, '28000.00'),
(17, 30, 1, 1, '2020-04-15', '2020-04-22', 4, '12950.00'),
(18, 31, 2, 2, '2020-05-07', '2020-05-29', 4, '41800.00'),
(19, 32, 2, 2, '2020-06-09', '2020-06-20', 5, '20900.00'),
(20, 33, 3, 1, '2020-05-08', '2020-05-16', 4, '16000.00'),
(21, 34, 3, 2, '2020-05-15', '2020-05-31', 5, '32000.00'),
(22, 35, 3, 1, '2020-06-12', '2020-06-24', 5, '24000.00'),
(23, 36, 4, 3, '2020-05-13', '2020-05-23', 5, '22000.00'),
(24, 37, 1, 3, '2020-05-19', '2020-05-20', 5, '1850.00');

-- --------------------------------------------------------

--
-- Table structure for table `factor`
--

CREATE TABLE `factor` (
  `factorID` int(11) NOT NULL,
  `factor` text NOT NULL,
  `PercentageImpacted` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `factor`
--

INSERT INTO `factor` (`factorID`, `factor`, `PercentageImpacted`) VALUES
(1, 'Culture', '66.88'),
(2, 'Medical', '61.02'),
(3, 'Weather', '52.52');

-- --------------------------------------------------------

--
-- Table structure for table `fluctuation`
--

CREATE TABLE `fluctuation` (
  `month` text NOT NULL,
  `currentPrice` float NOT NULL,
  `newDay` text NOT NULL,
  `newPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluctuation`
--

INSERT INTO `fluctuation` (`month`, `currentPrice`, `newDay`, `newPrice`) VALUES
('7-5-2020', 1850, '14-5-2020', 1757.5);

-- --------------------------------------------------------

--
-- Table structure for table `homestay`
--

CREATE TABLE `homestay` (
  `homestayId` int(4) NOT NULL,
  `colombo` int(11) NOT NULL,
  `homestayName` varchar(30) NOT NULL,
  `homestayPic` varchar(100) NOT NULL,
  `homestayDescription` varchar(1000) NOT NULL,
  `homestayRooms` int(11) NOT NULL,
  `homestayPrice` decimal(6,2) NOT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `homestayCulture` float NOT NULL,
  `homestayMedical` float NOT NULL,
  `homestayWeather` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homestay`
--

INSERT INTO `homestay` (`homestayId`, `colombo`, `homestayName`, `homestayPic`, `homestayDescription`, `homestayRooms`, `homestayPrice`, `emailAddress`, `homestayCulture`, `homestayMedical`, `homestayWeather`) VALUES
(1, 1, 'Coast Homestay', '1.jfif', 'A modern newly built twin house located at Boralasgamuwa adjacent to Maharagama - Dehiwala road, 7 km away from Central Colombo, owned by a university academic and a teacher with two sons who are undergraduates. Located in a calm and quite, highly residential area with homely and friendly environment. Within easy access to Maharagama Nugegoda and Boralasgamuwa towns. Five mints walk to supermarkets, banks and to obtain other basic needs. 6 Kms away from Mt.Lavinia beach and 4 Km to the National Zoological Garden. Sinhala, Japanese & English speaking family.', 4, '1850.00', 'mohammed.2017313@iit.ac.lk', 81, 67, 80),
(2, 1, 'Kingsinn Homestay', '2.jfif', 'House is situated in a highly residential area with high security and the most beautiful thing is from the sitting dinning and from the master bed room you see the Indian ocean.', 5, '1900.00', 'mohammed.2017313@iit.ac.lk', 77.7, 64, 70.2),
(3, 2, 'Lustrio Inn HomeStay', '3.jfif', 'Miniâ€™s Residence has private access from the main road and offers a lovely cozy room with a wall mounted fan, Air Conditioner and a spacious en-suite attached bathroom with a hot water shower.', 3, '2000.00', 'codemade7@gmail.com', 45, 97, 24.4),
(4, 3, 'Moss View Homestay', '4.jfif', 'We have single or double rooms with or without ACJust walking distance to all amenities like RestaurantsBanksGardens Jogging track and walking path Bus stopSupermarketseasy access to Colombo city etc Im a pioneer industrialist now retired from business Having travelled extensively we have first hand experience of travellers needs', 4, '2200.00', 'j@gmail.com', 89, 81.2, 86.5),
(5, 4, 'Agoura HomeStay', '5.jfif', 'Our HomestayBreeze of Paradise is located in Colombo South in a township called Nugegoda  Its only two minutes walk from our house to High Level Road which connects all important places of Colomob ', 4, '2500.00', 'aasiffiraz179@gmail.com', 66.21, 82.48, 76.91),
(8, 6, 'Grizzly HomeStay', '6.jfif', 'This is an apartment with 2 bedrooms with balcony (which I am residing alone in one of the two), shared living room and shared kitchen. Situated in the heart of capital Sri Jayawardenapura Kotte with the city view from the balcony. Fully equipped with kitchen items, laundry and all the rooms are air conditioned.', 3, '2450.00', 'aasiffiraz179@gmail.com', 66.21, 82.48, 76.91),
(9, 7, 'Gallery House HomeStay', '7.jfif', 'Gallery House so called as it has a collection of art pieces, sculptures, batiks etc. from which you can collect a souvenir at your choice to take home.', 5, '3000.00', 'z@gmail.com', 69.78, 68.22, 51.22),
(10, 6, 'Waterfall Inn HomeStay', '8.jfif', 'This is an apartment with 2 bedrooms with balcony (which I am residing alone in one of the two), shared living room and shared kitchen. Situated in the heart of capital Sri Jayawardenapura Kotte with the city view from the balcony. Fully equipped with kitchen items, laundry and all the rooms are air conditioned.', 5, '3000.00', 'g@gmail.com', 78.38, 70.75, 76.13),
(11, 7, 'Hills HomeStay', '1.jpg', 'This is a homestay in the hills of colombo 7', 4, '2450.00', 'mohammed.2017313@iit.ac.lk', 66.88, 61.02, 52.52);

-- --------------------------------------------------------

--
-- Table structure for table `occupancy`
--

CREATE TABLE `occupancy` (
  `month` text NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `occupancy`
--

INSERT INTO `occupancy` (`month`, `value`) VALUES
('6-2020', 1),
('7-2020', 1),
('8-2020', 3),
('9-2020', 3),
('10-2020', 3),
('11-2020', 3),
('12-2020', 2),
('1-2021', 4),
('2-2021', 2),
('3-2021', 4),
('4-2021', 3),
('5-2021', 4);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `month` text NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`month`, `price`) VALUES
('6-2021', 24606.5),
('7-2021', 24101.3),
('8-2021', 24235.6),
('9-2021', 22345.3),
('10-2021', 22100.2),
('11-2021', 23173.9),
('12-2021', 23154.2),
('1-2021', 22322.9),
('2-2021', 23195.2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userType` int(4) DEFAULT NULL,
  `userFname` varchar(1) NOT NULL,
  `userSname` varchar(50) NOT NULL,
  `userAddress` varchar(50) NOT NULL,
  `userPostCode` varchar(50) NOT NULL,
  `userTelNo` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userType`, `userFname`, `userSname`, `userAddress`, `userPostCode`, `userTelNo`, `userEmail`, `userPassword`) VALUES
(1, 0, 'A', 'Firaz', '123/3 Anderson Road', '10350', '0112737624', 'mohammed.2017313@iit.ac.lk', '1234'),
(2, 0, 'T', 'hamad', '123/3 Anderson Road', '10350', '1123456', 'codemade7@gmail.com', '1234'),
(3, 1, 'k', 'Ramzie', '123/3 Anderson Road', '10350', '1123456', 'k@gmail.com', '1234'),
(4, 1, 'H', 'Firaz', '123/3 Anderson Road', '10350', '1123456', 'hamdantheguy@gmail.com', '1234'),
(5, 0, 'j', 'nill', '123/3 Anderson Road', '10350', '1123456', 'j@gmail.com', '1234'),
(6, 0, 'A', 'Firaz', '123/3 Anderson Road', '10350', '1123456', 'aasiffiraz179@gmail.com', '1234'),
(7, 0, 'z', 'as', '123/3 Anderson Road', '10350', '1123456', 'z@gmail.com', '1234'),
(8, 0, 'g', 'v', '123/3 Anderson Road', '10350', '1123456', 'g@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingNo`),
  ADD KEY `INDEX` (`userId`);

--
-- Indexes for table `booking_line`
--
ALTER TABLE `booking_line`
  ADD PRIMARY KEY (`bookingLineId`),
  ADD KEY `INDEX` (`bookingNo`),
  ADD KEY `bookingNumber` (`bookingNo`),
  ADD KEY `homestayId` (`homestayId`);

--
-- Indexes for table `factor`
--
ALTER TABLE `factor`
  ADD PRIMARY KEY (`factorID`);

--
-- Indexes for table `homestay`
--
ALTER TABLE `homestay`
  ADD PRIMARY KEY (`homestayId`),
  ADD UNIQUE KEY `prodName` (`homestayName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingNo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `booking_line`
--
ALTER TABLE `booking_line`
  MODIFY `bookingLineId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `homestay`
--
ALTER TABLE `homestay`
  MODIFY `homestayId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
