-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2020 at 09:18 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prominent`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `albumId` int(11) NOT NULL,
  `albumName` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`albumId`, `albumName`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'munjurina', 'active', '2020-07-22 15:22:14', '2020-07-23 10:11:49', 1, 1),
(2, 'sakib', 'active', '2020-07-23 10:02:29', NULL, 1, NULL),
(3, 'shuvo', 'active', '2020-07-23 10:15:04', NULL, 1, NULL),
(4, 'adnan', 'active', '2020-07-23 10:15:12', '2020-08-14 07:07:32', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `applicationId` int(11) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `passportNumber` varchar(45) DEFAULT NULL,
  `passportValidity` date DEFAULT NULL,
  `contactNumber` varchar(20) DEFAULT NULL,
  `whatsAppNumber` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mailingAddress` varchar(2000) DEFAULT NULL,
  `emc_name` varchar(45) DEFAULT NULL,
  `emc_contactNumber` varchar(45) DEFAULT NULL,
  `ieltsOverrallScore` varchar(45) DEFAULT NULL,
  `Reading` varchar(45) DEFAULT NULL,
  `Writing` varchar(45) DEFAULT NULL,
  `Listening` varchar(45) DEFAULT NULL,
  `Speaking` varchar(45) DEFAULT NULL,
  `toeflOverrallScore` varchar(45) DEFAULT NULL,
  `pteOverrallScore` varchar(45) DEFAULT NULL,
  `durationOfStudyGap` varchar(100) DEFAULT NULL,
  `activitiesInStudyGap` varchar(2000) DEFAULT NULL,
  `courseLevel` varchar(1000) DEFAULT NULL,
  `course` varchar(100) NOT NULL,
  `preferredSubject` varchar(1000) DEFAULT NULL,
  `preferredCountry` varchar(1000) DEFAULT NULL,
  `visaRefused` enum('Yes','No') DEFAULT NULL,
  `attachmentOfrejectionLetter` varchar(1000) DEFAULT NULL,
  `previousOverseasTravelHistroy` enum('Yes','No') DEFAULT NULL,
  `previousOverseasTravelName` varchar(1000) DEFAULT NULL,
  `CriminalRecords` enum('Yes','No') DEFAULT NULL,
  `CriminalRecordsDetails` varchar(1000) DEFAULT NULL,
  `spouseOrAnyDepend` varchar(1000) NOT NULL,
  `cvattachmnt` varchar(1000) DEFAULT NULL,
  `passportCopyAttachment` varchar(1000) DEFAULT NULL,
  `ieltsCopyAttachment` varchar(1000) DEFAULT NULL,
  `peferStudyAbroad` varchar(1000) NOT NULL,
  `ApplyDate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`applicationId`, `firstName`, `lastName`, `dob`, `gender`, `passportNumber`, `passportValidity`, `contactNumber`, `whatsAppNumber`, `email`, `mailingAddress`, `emc_name`, `emc_contactNumber`, `ieltsOverrallScore`, `Reading`, `Writing`, `Listening`, `Speaking`, `toeflOverrallScore`, `pteOverrallScore`, `durationOfStudyGap`, `activitiesInStudyGap`, `courseLevel`, `course`, `preferredSubject`, `preferredCountry`, `visaRefused`, `attachmentOfrejectionLetter`, `previousOverseasTravelHistroy`, `previousOverseasTravelName`, `CriminalRecords`, `CriminalRecordsDetails`, `spouseOrAnyDepend`, `cvattachmnt`, `passportCopyAttachment`, `ieltsCopyAttachment`, `peferStudyAbroad`, `ApplyDate`) VALUES
(2, 'Imran', NULL, '1992-10-12', NULL, '15454362566', '2020-08-22', '016546895656', NULL, 'munjurinaazam@yahoo.com', 'Mohakhali', 'mother', '01968569565', '8', NULL, NULL, NULL, NULL, NULL, NULL, '5', '6', '3', 'ielts', 'english', 'China', 'No', NULL, 'No', NULL, 'No', NULL, 'unmarried', '3631.jpg', '9782.jpg', '9665.jpg', 'yes', '6/12/2020'),
(3, 'Munjurina', 'Azam', '1996-01-18', NULL, NULL, '2020-08-29', '01969042459', NULL, 'munjurinaazam@gmail.com', NULL, NULL, NULL, NULL, '6', '9', '6', '7', NULL, NULL, '5', '9', '2', 'pte', 'Law', 'China', 'No', NULL, 'No', NULL, 'No', NULL, 'single', '4718.jpg', '2880.jpg', '1008.jpg', 'no', '22/12/2020'),
(5, 'Ahad', NULL, '2020-08-14', NULL, '12645632', '2020-08-29', '45849459', NULL, NULL, NULL, NULL, NULL, NULL, '9', '8', '7', '6', NULL, NULL, '5', '8', '6', 'pte', '2', 'SRILANKA', 'No', NULL, 'No', NULL, 'No', NULL, 'NO', '9279.png', '4230.png', '7825.png', 'YES', '22/12/2020'),
(6, 'Habib', 'Rahman', '2015-12-02', NULL, '32565485552', '2020-09-05', '15245421323', NULL, 'munjurinaazam@yahoo.com', 'Cumilla', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', '2', '3', 'ielts', 'machine learning', 'China', 'No', NULL, 'No', NULL, 'No', NULL, 'single', '3964.webp', '2556.webp', '9899.webp', 'yes', '5/12/2020');

-- --------------------------------------------------------

--
-- Table structure for table `application_education`
--

CREATE TABLE `application_education` (
  `application_educationId` int(11) NOT NULL,
  `qualification` varchar(45) DEFAULT NULL,
  `passingYear` date DEFAULT NULL,
  `institutionName` varchar(200) DEFAULT NULL,
  `location` varchar(1000) DEFAULT NULL,
  `grade` varchar(45) DEFAULT NULL,
  `fkapplicationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentId` int(11) NOT NULL,
  `preferredDate` date DEFAULT NULL,
  `preferredTime` varchar(45) DEFAULT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `contactNo` varchar(100) DEFAULT NULL,
  `nationality` varchar(45) DEFAULT NULL,
  `alternateContact` varchar(45) DEFAULT NULL,
  `additionalInfo` varchar(2000) DEFAULT NULL,
  `callBackRequest` varchar(100) DEFAULT NULL,
  `applydate` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentId`, `preferredDate`, `preferredTime`, `firstName`, `lastName`, `contactNo`, `nationality`, `alternateContact`, `additionalInfo`, `callBackRequest`, `applydate`, `status`) VALUES
(2, '2020-08-19', '12:00', 'Munjurina', 'Ema', '01925531501', 'Bangladesh', NULL, 'Mohakhali', 'yes', NULL, 'done'),
(4, '2020-08-27', '10', 'mun', NULL, '2452', 'Bangladesh', NULL, NULL, NULL, NULL, 'requested'),
(5, '2020-08-21', '2', 'mun', 'mun', '0123456', 'Bangladesh', NULL, NULL, 'no', NULL, 'requested');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `countryId` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `flag` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`countryId`, `name`, `flag`) VALUES
(1, 'USA', '1flagImage.jpg'),
(2, 'UK', '2flagImage.jpg'),
(3, 'CANADA', '3flagImage.jpg'),
(4, 'CHAINA', '4flagImage.jpg'),
(5, 'GERMANY', '5flagImage.jpg'),
(6, 'INDIA', '6flagImage.jpg'),
(7, 'AUSTRALIA', '7flagImage.png'),
(8, 'MALASIYA', '8flagImage.jpg'),
(9, 'DENMARK', '9flagImage.jpg'),
(10, 'NEWZELAND', '10flagImage.png');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventId` int(11) NOT NULL,
  `eventTitle` varchar(500) DEFAULT NULL,
  `evenDetails` mediumtext DEFAULT NULL,
  `fkcountryId` int(11) NOT NULL,
  `eventStartDate` date DEFAULT NULL,
  `eventEndDate` date DEFAULT NULL,
  `eventTime` varchar(45) DEFAULT NULL,
  `eventCoverPhoto` varchar(100) DEFAULT NULL,
  `eventThumpImage` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_reg_qus_set`
--

CREATE TABLE `event_reg_qus_set` (
  `event_reg_qus_setId` int(11) NOT NULL,
  `setName` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_uni_list`
--

CREATE TABLE `event_uni_list` (
  `event_uni_listId` int(11) NOT NULL,
  `uniName` varchar(500) DEFAULT NULL,
  `fkeventId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackId` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `imageLink` varchar(45) DEFAULT NULL,
  `uni_name` varchar(45) DEFAULT NULL,
  `fkCountryId` int(11) NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `details` mediumtext DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `home` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackId`, `name`, `imageLink`, `uni_name`, `fkCountryId`, `courseName`, `details`, `status`, `home`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(20, 'hasib Ahmed', '20feedbackImage.png', 'new jerssy university tt', 1, 'MSc in Software Engineering', '<p>dsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdf&nbsp;dsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdfdsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdfdsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdfdsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdfdsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdfdsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdfdsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdfdsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdfdsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdfdsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdfdsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdfdsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdfdsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdfdsf asdfadf adsf sdfsdf dsaf asdf dsafdsfas fa dfda ddf daf df sdf</p>', 'active', 1, '2020-08-07 03:22:05', '2020-08-14 05:27:49', 1, 1),
(21, 'Nazmul Kabir', '21feedbackImage.png', 'sjklhfsfh', 2, 'shfslsflksdfjsf', '<p>&nbsp;dsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsddsf sadfsd</p>', 'active', 1, '2020-08-07 03:41:46', NULL, 1, NULL),
(22, 'Jyotica Tangri', '22feedbackImage.png', 'dsfsdjkfsjdhfjkshf shf', 3, 'sdkjksf jskj fslkjsdfkj', '<p>asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;asdfsf sfsdh fjsdjfhsdfhsjdfhsjfhs djfhsfhskfh sjfhsf jkhhjshfs jfhsjdfh sfjkh&nbsp;</p>', 'active', 1, '2020-08-07 03:44:16', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuId` int(11) NOT NULL,
  `menuName` varchar(45) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `fkpageId` int(11) DEFAULT NULL,
  `menuType` enum('top','mainmenu','footer') DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `serial` int(10) DEFAULT NULL,
  `menuOrgin` enum('static','dynamic') NOT NULL DEFAULT 'dynamic',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuId`, `menuName`, `parent`, `fkpageId`, `menuType`, `status`, `serial`, `menuOrgin`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 'HOME', NULL, NULL, 'mainmenu', 'active', 1, 'static', '2020-08-15 12:38:51', NULL, 1, NULL),
(3, 'ABOUT US', NULL, NULL, 'mainmenu', 'active', 2, 'static', '2020-08-15 12:44:07', NULL, 1, NULL),
(4, 'Reasons to Choose us', 3, NULL, 'mainmenu', 'active', 2, 'static', '2020-08-15 12:45:49', NULL, 1, NULL),
(5, 'Contact', 3, NULL, 'mainmenu', 'active', 4, 'static', '2020-08-15 12:48:31', NULL, 1, NULL),
(6, 'Message from Chief Executive', 3, NULL, 'mainmenu', 'active', 5, 'static', '2020-08-15 12:50:56', NULL, 1, NULL),
(7, 'Gallery', 3, NULL, 'mainmenu', 'active', 6, 'static', '2020-08-15 12:53:01', NULL, 1, NULL),
(8, 'STUDY DESTINATIONS', NULL, NULL, 'mainmenu', 'active', 7, 'static', '2020-08-15 12:57:14', NULL, 1, NULL),
(9, 'FIND MY COURSE', NULL, NULL, 'mainmenu', 'active', 8, 'static', '2020-08-15 13:04:06', NULL, 1, NULL),
(10, 'PARTNER INSTITUTIONS', NULL, NULL, 'mainmenu', 'active', 11, 'static', '2020-08-15 13:04:32', '2020-08-15 13:55:31', 1, 1),
(11, 'BECOME OUR PARTNERS', NULL, NULL, 'mainmenu', 'active', 10, 'static', '2020-08-15 13:05:05', NULL, 1, NULL),
(12, 'FOR STUDENTS', NULL, NULL, 'mainmenu', 'active', 9, 'static', '2020-08-15 13:54:41', NULL, 1, NULL),
(14, 'test menu', 3, 2, 'mainmenu', 'active', 12, 'dynamic', '2020-08-16 07:34:08', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsId` int(11) NOT NULL,
  `title` varchar(2000) DEFAULT NULL,
  `details` longtext DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `thumbnail` varchar(1000) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `pageId` int(11) NOT NULL,
  `pageTitle` varchar(200) DEFAULT NULL,
  `pageDetails` longtext DEFAULT NULL,
  `fkmenuId` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`pageId`, `pageTitle`, `pageDetails`, `fkmenuId`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 'test page', '<p>How To Use Our Placeholders Just specify the image size after our URL (https://via.placeholder.com/) and you&rsquo;ll get a placeholder image. So the image URL should look this:- https://via.placeholder.com/150 You can use the images in your HTML or CSS, like this:&nbsp;<a href=\"https://placeholder.com/\"><img src=\"https://via.placeholder.com/150\" /></a>&nbsp;(Be sure to check out our HTML &amp; CSS tutorials at HTML.com, our sister site, if you&rsquo;re rusty) There are a few simple rules before you use them. How To Set Image Size Specify the width first, then height. Height is optional: if no height is specified, your placeholder image will be a square. So this example&hellip; https://via.placeholder.com/150 &hellip;generates a 150 pixel square dummy image:- NB: Size must be the first folder specified in the URL How To Set Image Formats Image format is optional &ndash; the default is a .GIF. You can use the following image file extensions&hellip; .GIF .JPG .JPEG .PNG Adding an image file extension will render the image in the correct format. JPG &amp; JPEG are identical. The image extension can go at the end of any option in the URL, like this:- https://via.placeholder.com/300.png/09f/fff https://via.placeholder.com/300/09f.png/fff https://via.placeholder.com/300/09f/fff.png How To Set Custom Text You can specify text for your image by using a query string at the very end of the URL. So this URL&hellip; https://via.placeholder.com/728x90.png?text=Visit+WhoIsHostingThis.com+Buyers+Guide &hellip;produces this 728&times;90 sized image (ie, leaderboard ad dimensions):- Text is optional. The default is the image dimensions in pixels. You can use A-Z characters, upper or lowercase, numbers, and most symbols. Spaces are specified with a plus sign (+). For example&hellip; https://via.placeholder.com/468x60?text=Visit+Blogging.com+Now &hellip;will produces this placeholder banner ad plus the text (complete with spaces):- (PS. Looking for dummy text? We now have lorem ipsum &amp; more placeholder text to download). How To Set Background &amp; Text Color By default, text is black and the background grey. Colors are represented as hex codes after the dummy image dimensions. For example, #FF0000 is red. Colors must follow the dimensions. So this image URL&hellip; https://via.placeholder.com/150/0000FF/808080 ?Text=Digital.com https://via.placeholder.com/150/FF0000/FFFFFF?Text=Down.com https://via.placeholder.com/150/FFFF00/000000?Text=WebsiteBuilders.com https://via.placeholder.com/150/000000/FFFFFF/?text=IPaddress.net &hellip;produces images in the shape of 125&times;125 button ad:- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The first color is always the background color, and the second color is the text color.<br />\r\n<br />\r\nC/O https://placeholder.com/</p>', NULL, 'active', '2020-08-16 07:09:52', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `partner_institutions`
--

CREATE TABLE `partner_institutions` (
  `partner_institutionsId` int(11) NOT NULL,
  `fkcountryId` int(11) NOT NULL,
  `uni_name` varchar(200) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  `location` varchar(1000) DEFAULT NULL,
  `backgroudImage` varchar(45) DEFAULT NULL,
  `uni_link` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partner_institutions`
--

INSERT INTO `partner_institutions` (`partner_institutionsId`, `fkcountryId`, `uni_name`, `logo`, `location`, `backgroudImage`, `uni_link`) VALUES
(13, 1, 'kent university', '13partnerLogo.png', 'fdssfdfsfsdfsfssffsfd', '13backgroundImage.png', 'ssddfddfdsdfsf'),
(14, 2, 'Bristol University', '14partnerLogo.png', 'briston university', '14backgroundImage.jpg', 'https://www.bristol.ac.uk/');

-- --------------------------------------------------------

--
-- Table structure for table `partner_logo`
--

CREATE TABLE `partner_logo` (
  `partner_logoId` int(11) NOT NULL,
  `logoName` varchar(45) DEFAULT NULL,
  `imageLink` varchar(45) DEFAULT NULL,
  `link` varchar(100) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partner_logo`
--

INSERT INTO `partner_logo` (`partner_logoId`, `logoName`, `imageLink`, `link`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(4, 'malayshi', '4logoImage.png', 'https://www.facebook.com/MUACbd2014/', 'active', '2020-08-09 12:46:11', NULL, 1, NULL),
(5, 'india', '5logoImage.png', 'https://www.facebook.com/IUACBangladesh/', 'active', '2020-08-09 12:46:57', NULL, 1, NULL),
(6, 'europe', '6logoImage.png', 'https://www.facebook.com/europeapplicationcentre/', 'active', '2020-08-09 12:47:23', NULL, 1, NULL),
(7, 'canada', '7logoImage.png', 'https://www.facebook.com/CCUABangladesh/', 'active', '2020-08-09 12:47:58', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `partner_uni_logo`
--

CREATE TABLE `partner_uni_logo` (
  `partner_logoId` int(11) NOT NULL,
  `uni_name` varchar(200) DEFAULT NULL,
  `image_logo` varchar(500) DEFAULT NULL,
  `uni_link` varchar(1000) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partner_uni_logo`
--

INSERT INTO `partner_uni_logo` (`partner_logoId`, `uni_name`, `image_logo`, `uni_link`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(7, 'metropolitan university', '7universityLogoImage.png', 'http://metrouni.edu.bd/', 'active', '2020-08-09 17:48:54', NULL, 1, NULL),
(8, 'centennial college', '8universityLogoImage.png', 'https://www.centennialcollege.ca/', 'active', '2020-08-09 17:50:57', NULL, 1, NULL),
(9, 'help university', '9universityLogoImage.png', 'https://help.edu.my/', 'active', '2020-08-09 17:52:00', NULL, 1, NULL),
(10, 'ibs international university', '10universityLogoImage.png', 'https://www.ibs-b.hu/', 'active', '2020-08-09 17:54:41', NULL, 1, NULL),
(11, 'infrastructure university', '11universityLogoImage.png', 'https://iukl.edu.my/', 'active', '2020-08-09 17:56:25', NULL, 1, NULL),
(12, 'inti university', '12universityLogoImage.png', 'https://newinti.edu.my/campuses/inti-international-university/', 'active', '2020-08-09 17:57:33', NULL, 1, NULL),
(13, 'mahsa university', '13universityLogoImage.png', 'https://mahsa.edu.my/', 'active', '2020-08-09 17:58:59', NULL, 1, NULL),
(14, 'multimedia university', '14universityLogoImage.png', 'https://www.mmu.edu.my/', 'active', '2020-08-09 18:00:46', NULL, 1, NULL),
(15, 'segi university', '15universityLogoImage.png', 'https://www.segi.edu.my/', 'active', '2020-08-09 18:03:57', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `photoId` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `imageLink` varchar(45) DEFAULT NULL,
  `fkalbumId` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`photoId`, `title`, `imageLink`, `fkalbumId`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'news', '1logoImage.jpeg', 1, 'active', '2020-07-22 15:25:33', '2020-08-14 06:56:32', 1, 1),
(2, 'news', '2logoImage.jpeg', 1, 'active', '2020-07-23 10:12:43', '2020-08-14 06:56:42', 1, 1),
(3, 'news', '3logoImage.jpeg', 2, 'inactive', '2020-07-23 10:12:58', '2020-08-14 06:56:52', 1, 1),
(4, 'news', '4logoImage.jpeg', 1, 'active', '2020-07-23 10:13:17', '2020-08-14 06:57:02', 1, 1),
(5, 'news', '5logoImage.jpeg', 1, 'active', '2020-07-23 10:13:32', '2020-08-14 06:57:20', 1, 1),
(6, 'df', '6logoImage.jpeg', 2, 'active', '2020-07-23 10:13:45', '2020-08-14 06:55:33', 1, 1),
(7, 'dfaaaa', '7logoImage.jpeg', 1, 'active', '2020-07-23 10:13:59', '2020-08-14 06:58:15', 1, 1),
(8, 'hjj', '8logoImage.jpeg', 1, 'active', '2020-07-23 10:14:12', '2020-08-14 06:56:14', 1, 1),
(9, 'hjj', '9logoImage.jpeg', 2, 'active', '2020-07-23 10:14:45', '2020-08-14 06:56:25', 1, 1),
(10, 'news', '10logoImage.jpeg', 3, 'active', '2020-07-23 10:15:31', '2020-08-14 07:34:23', 1, 1),
(11, 'news', '11logoImage.jpeg', 4, 'active', '2020-07-23 10:15:53', '2020-08-14 07:34:31', 1, 1),
(12, 'df', '12logoImage.jpg', 4, 'active', '2020-07-23 10:16:04', NULL, 1, NULL),
(13, 'news', '13logoImage.jpeg', 1, 'active', '2020-07-27 09:33:58', '2020-08-14 07:34:47', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `queryId` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `lastAcademicQualification` varchar(45) DEFAULT NULL,
  `preferredCountry` varchar(45) DEFAULT NULL,
  `preferredSubject` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qus_ans`
--

CREATE TABLE `qus_ans` (
  `qus_ansId` int(11) NOT NULL,
  `fkEventId` int(11) NOT NULL,
  `fkSet_qus_set_qusId` int(11) NOT NULL,
  `ans` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reasons_to_choose_us`
--

CREATE TABLE `reasons_to_choose_us` (
  `reasons_to_choose_usid` int(11) NOT NULL,
  `text` longtext DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reasons_to_choose_us`
--

INSERT INTO `reasons_to_choose_us` (`reasons_to_choose_usid`, `text`, `status`) VALUES
(1, '<p>One of the most experienced education consultants in Bangladesh has been working since 2006.</p>', 'active'),
(2, '<p>&nbsp;We have a well trained team who are skilled and experienced in service.</p>', 'active'),
(3, '<p>&nbsp;We directly represent more than 150 foreign public and private universities and colleges around the World.</p>', 'active'),
(4, '<p>&nbsp;We are around to be direct partner of more than 30 Canadian public universities and colleges.</p>', 'active'),
(5, '<p>We advise students based on their academic , English and fiancial background to choose right course, institution and country.</p>', 'active'),
(6, '<p>&nbsp;We have an expert and experienced team of visa processing &amp; guidance.</p>', 'active'),
(7, '<p>We frequently organize events where students can get opportunity to meet foreign universities directly.</p>', 'active'),
(8, '<p>&nbsp;We also organize big events like Education Expo where students can meet so many foreign universities under the same roof</p>', 'active'),
(9, '<p>&nbsp;As we are direct partner of foreign universities so students can get faster service in their admission process through us.</p>', 'active'),
(10, '<p>We always keep communications with students and parents even after completion of our total service.</p>', 'active'),
(11, '<p>&nbsp;We always put our attention to students individually.</p>', 'active'),
(12, '<p>&nbsp;The ratio of students&#39; satisfaction is truely high with Prominent Consultant.</p>', 'active'),
(13, '<p>&nbsp;We are always committed to provide accurate guidelines, transparent services to our students.</p>', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `set_qus`
--

CREATE TABLE `set_qus` (
  `set_qusId` int(11) NOT NULL,
  `qus` varchar(1000) DEFAULT NULL,
  `fkEvent_reg_qus_setId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `sliderId` int(11) NOT NULL,
  `imageLink` varchar(1000) DEFAULT NULL,
  `lineOne` varchar(1000) DEFAULT NULL,
  `lineTwo` varchar(1000) DEFAULT NULL,
  `lineThree` varchar(1000) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `study_destination`
--

CREATE TABLE `study_destination` (
  `study_destinationId` int(11) NOT NULL,
  `fkcountryId` varchar(45) DEFAULT NULL,
  `imageFlag` varchar(45) DEFAULT NULL,
  `shortDes` varchar(2000) DEFAULT NULL,
  `longDes` mediumtext DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `study_destination`
--

INSERT INTO `study_destination` (`study_destinationId`, `fkcountryId`, `imageFlag`, `shortDes`, `longDes`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(4, '2', '4studyImage.jpg', '<p>adsfasdfasd dsa fdsa fasf asdf adsf dsaf adsfdasf adf</p>', '<p>adf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhj&nbsp;adf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhj&nbsp;adf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhj&nbsp;adf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhj&nbsp; v&nbsp;adf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhj&nbsp;adf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhj v&nbsp;adf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhj&nbsp;adf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhj vadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhjadf da adf daf dsaf sda fdf df daf asdf asdfsadf adsf dfg dasfasdf asdf sdfas fadfasdfdsf df dsa hjhj hjhj</p>', 'active', '2020-07-29 05:13:19', '2020-08-08 00:56:22', 1, 1),
(5, '7', NULL, '<p>dsf asdf adsf asf asdfasdf sdaf asdf sadf adsfadsf asdf&nbsp; dsfasdfas df</p>', '<p>Australia has a population of about 21 million people and boasts 8 major cities in Adelaide, Brisbane, Canberra, Darwin, Hobart, Melbourne, Perth and Sydney. It also has many beautiful small towns along with some of the most stunning countryside and coastlines anywhere in the world. It is one country but of similar size to the whole of Europe.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The country has a very strong economy, an excellent education system, first class transport links, great weather, a high standard of living and is a cost effective option for students to embark on their international education and life experience.</p>\r\n\r\n<p><strong>&nbsp;EDUCATION SYSTEM</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"Education System\" src=\"http://www.iaec.com.au/Media/Picture/education-system.jpg\" /></p>\r\n\r\n<p>The Australian education system is internationally recognized for its excellence and is renowned for producing high quality graduates with the practical skills and knowledge demanded by employers internationally.</p>\r\n\r\n<p>Australian education boasts an excellent choice of public and private education providers throughout the country offering every discipline at all levels from Certificates and Diplomas to Doctorate courses. The high standard of the courses and teaching provide the excellent platform to embark your chosen career.</p>\r\n\r\n<p>The style of teaching and learning at Australian Colleges and Universities develop strong analytical and academic skills which encourage you to think independently and creatively. The fantastic experience will be rewarding both academically and personally preparing you for life&rsquo;s journey.</p>\r\n\r\n<p>Click here for a diagram and explanation of the Australian education system or refer to&nbsp;<a href=\"http://www.aei.gov.au/\" target=\"_blank\">www.aei.gov.au</a>&nbsp;for further details.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>&nbsp;LIFESTYLE</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"LifeStyle\" src=\"http://www.iaec.com.au/Media/Picture/lifestyle.jpg\" /></p>\r\n\r\n<p>Australians know how to make the most of their leisure time and the country has long been associated with a high standard of living and a cosmopolitan outdoor lifestyle. Many of its cities regularly feature in the most livable city awards each year and the country boasts several world heritage sites and places of natural beauty.</p>\r\n\r\n<p>The beautiful weather and emphasis on health and fitness make Australia a heaven for sports lovers. There is a real focus on sports and outdoor living due to the fantastic climate and importance of health and fitness in Australian culture.</p>\r\n\r\n<p>The cosmopolitan nature of the population make Australia a heaven for food lovers will every cuisine catered for in the thousands of caf&eacute;s, restaurants, bars, supermarkets throughout the country catering for every culture and taste.</p>\r\n\r\n<p>Australians originate from all corners of the globe and are warm friendly people. International students from all nationalities and cultures add to the rich diversity of cultures enhance the lively cosmopolitan atmosphere in and around our institutions campuses.</p>\r\n\r\n<p>Many people refer to Australia as the &lsquo;Land of Opportunity&rsquo; as it is a place that provides opportunities for those willing to work hard and invest in their future.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>&nbsp;EMPLOYMENT</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"Employment\" src=\"http://www.iaec.com.au/Media/Picture/employment.jpg\" /></p>\r\n\r\n<p>The Australian economy is the 14th largest in the world and closely linked to Asian economies. The services sector is the largest sector in the economy accounting for 72%. This is excellent for international students looking for part-time jobs as they tend to be in this sector. Examples of popular student jobs could be in restaurants, bars, hotels, shops, taxi drivers etc. Employers rely on students to fill vacancies in this and other sectors to provide the services that consumers demand. Student visa holders are permitted to work up to 20 hours part time during term time and full time during term breaks.</p>\r\n\r\n<p>The country has experienced almost 20 years of continued economic growth with modest growth expected in the coming years. The main export partners are Japan, China, South Korea, US and India, and the main import partners are US, China, Japan, Singapore, and Germany. The popularity, quality and diversity of Australia&rsquo;s international education make it the country&rsquo;s second largest export behind Mining.</p>\r\n\r\n<p>The country requires skilled migrants to fill the many vacancies in the job market that have been identified.</p>\r\n\r\n<p>Many areas of the economy have identified skill shortages (link modl / sol) and the government looks to fill these shortages by encouraging skilled migrants to migrate permanently to Australia. International students may be eligible to fill such gaps and secure permanent residency in Australia. For further information please contact our registered migration agent.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>&nbsp;LEISURE / ENTERTAINMENT</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"Leisure / Entertainment\" src=\"http://www.iaec.com.au/Media/Picture/entertainment.jpg\" /></p>\r\n\r\n<p>Australia has a plethora of leisure and entertainment options for international students. The country really does have something for everybody from the bustling thriving metropolises of Melbourne and Sydney to the extreme wilderness of Northern Territory and stunning beauty of the Great Barrier Reef. Discovering Australia is a must for any international student and their families.</p>\r\n\r\n<p>Australia is a sports lover&rsquo;s delight with Cricket, Football, Soccer, Tennis, Swimming Cycling, basketball, netball and Rugby being just some of the many sports that you can take part in through the thousands of clubs and societies or go to watch the professionals in world standard stadia.</p>\r\n\r\n<p>Explore the allies and laneways of cosmopolitan Melbourne and its huge variety of caf&eacute;&rsquo;s, restaurants, shops and live music venues. Experience the spectacular Sydney Harbour and Opera House or climb the famous Harbour Bridge and enjoy one of the most spectacular views anywhere in the world. Perth and Brisbane are great cities to base yourself and access stunning coastlines and all the recreational activities they have to offer from relaxing on beautiful white sandy beaches to surfing and sky diving.</p>\r\n\r\n<p>There are also an abundance of art galleries, museums, exhibition centres, markets, live music, festivals, cinemas and theatres to choose from throughout the country. The great thing is that a significant proportion of these activities are free.</p>\r\n\r\n<p>Great boutiques, department and chain stores are abundant in the centre and suburbs of all the main cities. You will find huge selections in Brunswick St, Fitzroy (Melbourne), Oxford St, Paddington (Sydney), Ann &amp; Brunswick Sts intersection, Fortitude Valley (Brisbane) and Oxford St, Leederville (Perth). There are often unique markets in regional towns with a distinct atmosphere with Aboriginal artifacts on sale.</p>\r\n\r\n<p>For more information on Australia please refer to the websites below</p>\r\n\r\n<ul>\r\n	<li><a href=\"http://www.australia.com/\" target=\"_blank\">www.australia.com</a></li>\r\n	<li><a href=\"http://www.visitaustralia.com/\" target=\"_blank\">www.visitaustralia.com</a></li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>&nbsp;STUDENT VISA</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"student visa\" src=\"http://www.iaec.com.au/Media/Picture/student-visa.jpg\" /></p>\r\n\r\n<p>All students who wish to study Vocational Education or Higher Education courses abroad will require a student visa for their country of choice. Prominent Consultant has a fantastic record of visa success for our students. Our extensive knowledge of the visa systems in all the countries in which we operate enables us to confidently guide and prepare students to secure a student visa.</p>\r\n\r\n<p>We meticulously guide students in terms of document preparation, financial evidence, health requirements, evidence of English language ability, any supplementary information, and in visa interview preparation where required.</p>\r\n\r\n<p>Our counselors will also make you aware of the student visa regulations in your chosen country.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We offer Bachelor &amp; Masters courses in ATMC ( Australian Technical and Management College) from the following universities:<br />\r\n&nbsp;<br />\r\nCharles Darwin University , Melbourne Campus:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>-------------------------------------------------------------------------------------------------</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Bachelor of accounting / commerce ( 3 years , tuition fees per year 19,360 AUS $)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>MBA/Master of Professional accounting ( 2 year, tuition fees per year 23,448 AUS $)<br />\r\n&nbsp;<br />\r\nFederation University, Melbourne &amp; Sydney Campus:<br />\r\n------------------------------------------------------------------------------------------------</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Bachelor of Accounting/ Business/ Information Technology/ Information technology &amp; busienss<br />\r\n( 3 years , tuition fees per year 23,000-24,000 AUS $)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>MBA/Master in Professional accounting/ Master in Software Engineering/ Master in Enterprise system<br />\r\n( 3 years , tuition fees per year 24,800-26,800 AUS $)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\nUniversity of Sun Shine Coast, Melbourne Campus:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>----------------------------------------------------------------------------------------------</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Bachelor of tourism, leisure and event management/ accounting/ information &amp; communication technology<br />\r\n( 3 years , tuition fees per year 19,800-20,400 AUS $)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>MBA/ Master of Professional accounting ( 2 year, tuition fees per year 22,800 AUS $)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We also offer undergraduate &amp; post graduate courses in IIBIT ( International Institute of Business and Technology) from the following universities:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Federation University, Sydney Campus:<br />\r\n-------------------------------------------------</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Bachelor of Business/ Accounting/ Information Technology/ Business Information Technology&nbsp;<br />\r\n( 3 years) , tuition fees per year 23,700-24,700 AUS $)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Graduate Diploma in Software Engineering/ Enterprise Systems/ Professional Accounting/ Management</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>( 1.5 years) , tuition fees per year 25,500-26,700 AUS $)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Masters in Software Engineering/ Enterprise Systems/ Professional Accounting/ Business Administration<br />\r\n( 2 years) , tuition fees per year 25,500-26,700 AUS $)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Admission requirement for Australia :</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Academic result: &nbsp;Minimum 65% marks in previous education.</li>\r\n	<li>IELTS requirement :</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>For Bachelor overall 6.0 with no band less than 6.0<br />\r\nFor Masters overall 6.5 with no band less than 6.0</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Study gap is not allowed. Student must show evidences for any study gap.</li>\r\n	<li>For bachelor course spouse is not allowed. For Masters course spouse is allowed but spouse should be graduate &amp; duration of marriage should be atleast 1 year.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Required documents:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Passport with 2 years validity</li>\r\n	<li>All academic certificates and transcripts</li>\r\n	<li>IELTS result</li>\r\n	<li>CV</li>\r\n	<li>Passport size photo with white background</li>\r\n	<li>Motivation letter</li>\r\n	<li>Work experience letter with pay slips ( If require)</li>\r\n	<li>Present studentship certificate ( If require)</li>\r\n	<li>Marriage documents &amp; academic documents of Spouse ( If require)</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>For details please contact our counselors: 01971000841/842/848/866</strong></p>', 'active', '2020-08-08 00:58:55', NULL, 1, NULL),
(6, '8', '6studyImage.jpg', '<p>ighly recognized qualification from a highly recognized international University , but at a much more affordable cost. Part scholarship opportunities in different Universities. Affordable cost of living. People are friendly. Modern Amenities. Efficient transportation. Comfortable accommodation. Great place for food lovers. Weather is very comfortable. Summer all the year round. Safe environment.Cultural diversity. Tolerant society. Credit transfer facilities to UK, USA, New Zealand, Australia and other countries. No Sponsor required.</p>', '<p><strong>: Study in Malaysia :</strong><br />\r\nGlobal hub of higher education</p>\r\n\r\n<p><strong>Why Malaysia for higher studies?</strong></p>\r\n\r\n<ul>\r\n	<li>Highly recognized qualification from a highly recognized international University , but at a much more affordable cost.</li>\r\n	<li>Part scholarship opportunities in different Universities.</li>\r\n	<li>Affordable cost of living.</li>\r\n	<li>People are friendly.</li>\r\n	<li>Modern Amenities.</li>\r\n	<li>Efficient transportation.</li>\r\n	<li>Comfortable accommodation.</li>\r\n	<li>Great place for food lovers.</li>\r\n	<li>Weather is very comfortable. Summer all the year round.</li>\r\n	<li>Safe environment.</li>\r\n	<li>Cultural diversity.</li>\r\n	<li>Tolerant society.</li>\r\n	<li>Credit transfer facilities to UK, USA, New Zealand, Australia and other countries.</li>\r\n	<li>No Sponsor required.</li>\r\n	<li>IELTS/TOEFL is not mandatory.</li>\r\n	<li>VISA is confirmed for genuine applicant.</li>\r\n</ul>\r\n\r\n<p><strong>Why you will choose Prominent Consultant for Malaysia?</strong></p>\r\n\r\n<ul>\r\n	<li>We are very much focused on Malaysian education.</li>\r\n	<li>We represent more than 30 universities and colleges from Malaysia including public universities.</li>\r\n	<li>We are skilled and experienced for admission and&nbsp; student visa process in Malaysia.</li>\r\n	<li>We offer various courses in various reputed universities and colleges in Malaysia.</li>\r\n	<li>We arrange part scholarship for brilliant students.</li>\r\n	<li>&nbsp;We offer students accommodation facilities in University Hostels.</li>\r\n	<li>We always try to provide you the correct information.</li>\r\n	<li>We are always concern about the students&rsquo; career.</li>\r\n	<li>We assist students for medical check up in Bangladesh.</li>\r\n	<li>We assist students for visa stamping and air ticket.</li>\r\n	<li>We also do pre-departure counseling session for students.</li>\r\n	<li>We provide quick service.</li>\r\n	<li>We do not have any service charge for admission and visa process for private universities and colleges.</li>\r\n	<li>We have 100% visa success.&nbsp;</li>\r\n</ul>\r\n\r\n<p><strong>Universities &amp; Colleges represented by US:</strong></p>\r\n\r\n<p>Universities:</p>\r\n\r\n<p>Public:</p>\r\n\r\n<ul>\r\n	<li>International Islamic University of Malaysia</li>\r\n	<li>University Putra Malaysia</li>\r\n	<li>University Malaysia Terengganu</li>\r\n</ul>\r\n\r\n<p>Private:</p>\r\n\r\n<ul>\r\n	<li>Taylor&rsquo;s University.</li>\r\n	<li>Asia Pacific University of Innovation &amp; Technology.</li>\r\n	<li>SEGI University.</li>\r\n	<li>MASHA University.</li>\r\n	<li>HELP University.</li>\r\n	<li>LIMKOKWING University of Creative Technology.</li>\r\n	<li>UCSI University.</li>\r\n	<li>Multimedia University.</li>\r\n	<li>Asia Metropolitan University.</li>\r\n	<li>Cyberjaya University College of Medical Sciences.</li>\r\n	<li>&nbsp;Infrastructure University Kualalumpur.</li>\r\n	<li>International University of Malaya-Wales.</li>\r\n	<li>INTI International University &amp; Colleges.</li>\r\n	<li>KDU University College.</li>\r\n	<li>Manipal International University.</li>\r\n	<li>Quest International University PERAK.</li>\r\n	<li>University of Kualalumpur.</li>\r\n	<li>University of Selangor.</li>\r\n	<li>Geomatika University College.</li>\r\n</ul>\r\n\r\n<p>Colleges:</p>\r\n\r\n<ul>\r\n	<li>FTMS Global College.</li>\r\n	<li>Westminster International College.</li>\r\n	<li>Vision College.</li>\r\n	<li>Help College of Art and Technology.</li>\r\n</ul>\r\n\r\n<p><strong>Courses:</strong></p>\r\n\r\n<ul>\r\n	<li>Foundation ( 1 Year)</li>\r\n	<li>Diploma ( 2/3 Years)</li>\r\n	<li>Bachelor ( 3 / 4 Years)</li>\r\n	<li>Masters - Courses Based ( 1/1.5 years)</li>\r\n	<li>Masters &ndash; Research ( 1-3 years)</li>\r\n	<li>PHD( 3-5 years)</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Subjects:</strong></p>\r\n\r\n<p>Business, Information Technology, Aviation, Marin, Accounting &amp; Finance, Banking, Tourism &amp; Hospitality, Culinary &amp; Hotel, Engineering, Media &amp; Communication, Journalism, Law, Pharmacy, Biotechnology, Nursing, Public Health, MBBS, Multimedia, Sports, Arts, English, Psychology, Physiotherapy and many more.</p>\r\n\r\n<p><strong>Foundation Course:</strong></p>\r\n\r\n<p>Duration:</p>\r\n\r\n<p>1 year.</p>\r\n\r\n<p>Academic progression:</p>\r\n\r\n<p>After foundation course students can directly join to any University bachelor course in Malaysia</p>\r\n\r\n<p>Entry requirement:</p>\r\n\r\n<p>SSC/DAKHIL/O-Level/Class 10 Equivalent.<br />\r\nIn O-Level: Minimum 5 credits with C.</p>\r\n\r\n<p><strong>Diploma:</strong></p>\r\n\r\n<p>Duration:</p>\r\n\r\n<p>2/3 years.</p>\r\n\r\n<p>Academic progression:</p>\r\n\r\n<p>Students can join 2nd&nbsp;year of Bachelor degree in Malaysian Universities.</p>\r\n\r\n<p>Entry Qualification:</p>\r\n\r\n<p>SSC/DAKHIL/O-Level/Class 10 Equivalent.<br />\r\nIn O-Level: Minimum 3 credits with C or lower.&nbsp;</p>\r\n\r\n<p><strong>Bachelor course:</strong></p>\r\n\r\n<p>Duration:3-4 years</p>\r\n\r\n<p>Academic progression:</p>\r\n\r\n<p>After this course students can join directly University</p>\r\n\r\n<p>Masters (course based or research based ) programmes.</p>\r\n\r\n<p>Entry Requirement:</p>\r\n\r\n<p>HSC/A-LEVEL/ALIM/CLASS 12 Equivalent</p>\r\n\r\n<p>In O-Level min 3C and in A &ndash;Level min 2C.</p>\r\n\r\n<p><strong>Masters course:</strong></p>\r\n\r\n<p>( course based &amp; research based)</p>\r\n\r\n<p>Duration:1-3 years</p>\r\n\r\n<p>Academic progression:</p>\r\n\r\n<p>After this course students can join directly University</p>\r\n\r\n<p>PHD (course based or research based ) programmes.</p>\r\n\r\n<p>Entry Requirement:</p>\r\n\r\n<p>Bachelor course in relevant field with min 50% marks.</p>\r\n\r\n<p><strong>PHD course:</strong></p>\r\n\r\n<p>( course based &amp; research based)</p>\r\n\r\n<p>Duration:1-3 years</p>\r\n\r\n<p>Entry Requirement:</p>\r\n\r\n<p>Masters course in relevant field with min 50% marks.</p>\r\n\r\n<p>Research proposal and working experience is must.</p>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>ADP (American Degree Transfer Programme)</strong></p>\r\n\r\n<p>ADP &nbsp;is one of the most popular programmes in Malaysia where students can get opportunity to study American University Degrees 2 year ( 60 Credits) in Malaysian Universities and next 2 years in Universities from USA and Canada ( Subject to visa approval). If student does not get visa for those countries can finish their final 2 years in Malaysia.</p>\r\n\r\n<p>The Following Malaysian Universities offer ADP:</p>\r\n\r\n<p>Taylor&rsquo;s University, MASHA University, HELP University, KDU University College, INTI International University, SEGI University</p>\r\n\r\n<p>Students can study the following courses under ADP:</p>\r\n\r\n<p>Business, Science, Engineering, Arts ( with different majors)</p>\r\n\r\n<p>Entry requirement:</p>\r\n\r\n<p>In O-Level : 5 C or HSC PASS.</p>\r\n\r\n<p>Average cost in Malaysia: 40,000 RM in 2 years.</p>\r\n\r\n<p><strong>Fees structure in Public and Private Universities:</strong></p>\r\n\r\n<p><strong>Public:</strong></p>\r\n\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>International Islamic University of Malaysia ( Feb, Jul, Sep)</li>\r\n			</ul>\r\n\r\n			<p>Bachelor ( Business / IT) : Total fees 40,000 RM ( Including hostel), Initial payment: 13,000 RM<br />\r\n			Bachelor ( Engineering) : Total fees 70,000 RM ( Including hostel), Initial payment: 19,000 RM<br />\r\n			Masters : Total fees 20,000 RM ( Hostel is not included), Initial payment: 10,000 RM<br />\r\n			MBA: Total fees 30,000 RM ( Hostel is not included), Initial payment: 10,000 RM<br />\r\n			English course: 600 RM ( If no IELTS or less score in IELTS)</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<ul>\r\n				<li>University Putra Malaysia ( Feb, Sep)</li>\r\n			</ul>\r\n\r\n			<p>Bachelor : Per Semester fees 5000 RM- 8125 RM. First payment: EMGS 1460 RM+ First Semester fees.<br />\r\n			English course: 2500 RM ( If no IELTS or less score in IELTS)</p>\r\n\r\n			<ul>\r\n				<li>University Malaysia Terengganu</li>\r\n			</ul>\r\n\r\n			<p>Bachelor : Per Semester fees 2500 RM.<br />\r\n			English course: 2500 RM ( If no IELTS or less score in IELTS)</p>\r\n\r\n			<p><strong>&nbsp;</strong></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>Private:</strong></p>\r\n\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>Foundation (1 year) : 3-6 Lac Taka ( Depends on colleges/Universities)<br />\r\n			Diploma ( 2/3 years): 4-9 Lac taka and initial payment: 1.4 &ndash; 4 lac taka ( Depends on colleges/Universities)<br />\r\n			Bachelor ( 3/4 years): 7-20 lac taka and initial payment: 3 &ndash; 6 lac taka ( Depends on colleges/Universities)<br />\r\n			Masters: (1/2 years) : 4-10 lac taka and initial payment: 3 &ndash; 4 lac taka ( Depends on colleges/Universities)<br />\r\n			Masters &amp; PHD ( Research) : 80,000 &ndash; 1,20,000 ( per year)</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p><strong>Diploma courses in Vision College @ 13700 RM only with exclusive offer of free air-ticket &amp; smart phone.</strong></p>\r\n\r\n			<p>Courses: Information Technology, Marketing, Accounting, Hotel Management, Mass Communication, Law Enforcement &amp; Business Administration.</p>\r\n\r\n			<p>SSC / Dakhil/ O level students can apply.&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><strong>Attractive courses in Malaysia :</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table align=\"left\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>&nbsp;</p>\r\n\r\n			<ul>\r\n				<li>At FTMS Global College, UK Bachelor @ 10 lac taka &amp; UK Masters @ 7 lac taka only.</li>\r\n				<li>At Westminster International College, UK Bachelor @ 7 Lac Taka &amp; MBA @ 5 Lac Taka Only.</li>\r\n				<li>At INTI Universities &amp; Colleges, opportunity to experience Australian &amp; UK Degree @ very affordable fees.</li>\r\n				<li>At HELP College UK business, computing &amp; Engineering degrees @ 12 lac taka only. USA bachelor is only 16 lac taka.</li>\r\n				<li>At UCSI scholarship opportunity is upto 25%.</li>\r\n				<li>At Quest University scholarship opportunity is upto 60%.</li>\r\n				<li>At International University of Malaya- Wales , you can get opportunity @ heart of KL city with very affordable fees.</li>\r\n				<li>At University of Selangor, you can experience all engineering courses @ very low fees.</li>\r\n				<li>At International Islamic college you can finish Australian bachelor just @ 11 lac taka only. After class 10 there is opportunity to finish you bachelor in just 4 years which really saves your money and time.</li>\r\n				<li>Under ADP programme, you can get opportunity to study 2 years in Malaysia and rest 2 years in USA or CANADA.</li>\r\n			</ul>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><strong>Documents required for admission and visa process:</strong></strong></p>\r\n\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>All academic certificates and transcripts.</li>\r\n				<li>Passport ( Valid for at least 1 months)</li>\r\n				<li>Medical test report.</li>\r\n				<li>Photo ( White back ground, lab print &amp; size: 35X45mm)</li>\r\n			</ul>\r\n\r\n			<p><em>Please note that all documents are required in original.</em></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>For any inquiry for higher education in Malaysia , please call to our counselors: 01971000841/842/848/866</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>MUIAC- Bangladesh, Uttara Centre ( Prominent Consultant): +8801971000841/842/848/866<br />\r\n<br />\r\n<strong>MUIAC</strong>- Bangladesh, Dhanmondi Centre ( UNIK Edcuation): +8801977706066, +8801977702022<br />\r\n<br />\r\n<strong>MUIAC</strong>-Bangladesh, Sylhet Centre ( Gate Trust): +88-01718601119</strong></p>', 'active', '2020-08-08 01:09:41', NULL, 1, NULL);
INSERT INTO `study_destination` (`study_destinationId`, `fkcountryId`, `imageFlag`, `shortDes`, `longDes`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(7, '4', NULL, '<p>sdf dsafsadf dsaf adsf dasf adsfdaf asd fadf adsf df asdf adsf ds afadsadsfd adsjhfasdjfkh sjkfhasjdfkh ajfhjdfhajkhfjafhj ahjh&nbsp;</p>', '<p><strong>: Study In CHINA with full tuition fees scholarship :</strong></p>\r\n\r\n<p>China is one of the most powerful countries in the World. Economically they are very strong now. China is now leading in technology world. So, studying is China can be a great achievement for making a successful career.</p>\r\n\r\n<p><strong>Why CHINA for higher studies?</strong></p>\r\n\r\n<ul>\r\n	<li>Opportunity to study in public universities.</li>\r\n	<li>Medium of instruction is English.</li>\r\n	<li>100% tuition fees scholarship.</li>\r\n	<li>Very affordable living expenses, same as Bangladesh.</li>\r\n	<li>International standard education.</li>\r\n	<li>Credit transfer facilities to USA, Canada and Europe.</li>\r\n	<li>IELTS is not mandatory.</li>\r\n	<li>After graduation, employment rate is very high.</li>\r\n	<li>Very good hostel facilities on Campus.</li>\r\n	<li>Universities are very big with all kind of resources.</li>\r\n	<li>Students can do research here free of cost.</li>\r\n	<li>Masters and PHD programmes can be studied by full scholarship including hostel and monthly stipend.</li>\r\n	<li>Very easy visa process and 100% visa success ratio.</li>\r\n</ul>\r\n\r\n<p><strong>Why you will choose PROMINENT CONSULTANT for CHINA?</strong></p>\r\n\r\n<ul>\r\n	<li>We have Long term experience on China education counseling and visa process.</li>\r\n	<li>We offer admission to different universities in China with full tuition fees scholarship.</li>\r\n	<li>We also offer MBBS to different medical universities in China who are BMDC approved.</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>We offer full scholarships ( Tuition + Hostel+ Monthly stipend) for Masters and PHD courses.</li>\r\n	<li>We provide very fast admission process service.</li>\r\n	<li>We make our students well trained for visa interview so that till now our visa success rate is 100%.</li>\r\n	<li>We have representative in China who helps students to receive from airport, getting hostels and other relevant issues upon arrival.</li>\r\n	<li>We have very competitive service charge.&nbsp;</li>\r\n	<li>Our students&rsquo; satisfaction rate is very high.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>100 % Tuition fee scholarship scheme: ( Session : September )</strong></p>\r\n\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p><strong>University Name &amp; Province</strong></p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p><strong>Courses under Scholarship</strong></p>\r\n\r\n			<p><strong>Bachelor only</strong></p>\r\n\r\n			<p><strong>Duration: 4 years</strong></p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p><strong>Package scheme &amp; other costs</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p><strong>China Three Gorges University</strong></p>\r\n\r\n			<p><strong>( CTGU)</strong></p>\r\n\r\n			<p>8 Daxue Rd, Xiling Qu, Yichang Shi, Hubei Sheng, China, 443001</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p><strong>** Students must pass all subjects in every year to continue the scholarship.</strong></p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Hydro Electrical Engineering</li>\r\n				<li>&Oslash; Electrical &amp; Electronics Engineering</li>\r\n				<li>&Oslash; Civil Engineering</li>\r\n				<li>&Oslash; Automation Engineering</li>\r\n				<li>&Oslash; International Relations</li>\r\n			</ul>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p><strong>Qualification:</strong></p>\r\n\r\n			<p><strong>SSC &amp; HSC: GPA 8</strong></p>\r\n\r\n			<p><strong>Study gap: Not more than 4 years.</strong></p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p><strong>Required documents to apply:</strong></p>\r\n\r\n			<p><strong>&nbsp;</strong></p>\r\n\r\n			<ul>\r\n				<li><strong>Passport.</strong></li>\r\n				<li><strong>All certificates and mark sheets.</strong></li>\r\n				<li><strong>PP size white background photo.</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p><strong>Total Package Value:</strong></p>\r\n\r\n			<p>2 Lac taka.</p>\r\n\r\n			<p><strong>Package includes:</strong></p>\r\n\r\n			<ul>\r\n				<li>&Oslash; Scholarship &amp; Admission confirmation process</li>\r\n				<li>&Oslash; Visa Process</li>\r\n				<li>&Oslash; One way air ticket.</li>\r\n			</ul>\r\n\r\n			<p><strong>Package excludes:</strong></p>\r\n\r\n			<ul>\r\n				<li>&Oslash; Embassy &amp; Medical fees: 12,000 taka.</li>\r\n				<li>&Oslash; 1 year Hostel: 50,000 taka</li>\r\n				<li>&Oslash; Other additional cost in China:20,000 taka.</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p><strong>Hozhou University</strong></p>\r\n\r\n			<p>759 2nd Ring Rd E, Wuxing Qu, Huzhou Shi, Zhejiang Sheng, China</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p><strong>** Students must carry good percentage in all subjects in every year to continue the scholarship.</strong></p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Mechanical Engineering</li>\r\n				<li>&Oslash; Computer Science</li>\r\n				<li>&Oslash; International Trade &amp; Economy</li>\r\n			</ul>\r\n\r\n			<p><strong>&nbsp;</strong></p>\r\n\r\n			<p><strong>&nbsp;</strong></p>\r\n\r\n			<p><strong>Qualification:</strong></p>\r\n\r\n			<p><strong>SSC &amp; HSC: GPA 8</strong></p>\r\n\r\n			<p><strong>Study gap: Not more than 4 years.</strong><strong>&nbsp;</strong></p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n\r\n			<p>2 Lac taka.</p>\r\n\r\n			<ul>\r\n				<li>&Oslash;&nbsp;<strong>Package includes:</strong></li>\r\n				<li>&Oslash; Scholarship &amp; Admission confirmation process</li>\r\n				<li>&Oslash; Visa Process</li>\r\n				<li>&Oslash; One way air ticket.</li>\r\n				<li>&Oslash;&nbsp;<strong>Package excludes:</strong></li>\r\n				<li>&Oslash; Embassy &amp; Medical fees: 12,000 taka.</li>\r\n				<li>&Oslash; 1 year Hostel: 65,000 taka</li>\r\n				<li>&Oslash; Other additional cost in China:20,000 taka</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p><strong>Kunming University of China</strong></p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>2 Puxin Rd, Guandu Qu, Kunming Shi, Yunnan Sheng, China, 650214</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p><strong>** Students must pass all subjects in every year to continue the scholarship.</strong></p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; BBA</li>\r\n				<li>&Oslash; Hotel Management</li>\r\n				<li>&Oslash; Computer Science &amp; Engineering</li>\r\n				<li>&Oslash; Software Engineering</li>\r\n				<li>&Oslash; Mechanical Engineering</li>\r\n				<li>&Oslash; Civil Engineering</li>\r\n				<li>&Oslash; Electrical &amp; Electronics Engineering</li>\r\n			</ul>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p><strong>Qualification:</strong></p>\r\n\r\n			<p><strong>SSC &amp; HSC: GPA 8</strong></p>\r\n\r\n			<p><strong>Study gap: Not more than 4 years.</strong></p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p><strong>Total Package Value:</strong></p>\r\n\r\n			<p>2.7 Lac taka.</p>\r\n\r\n			<p><strong>Package includes:</strong></p>\r\n\r\n			<ul>\r\n				<li>&Oslash; Scholarship &amp; Admission confirmation process</li>\r\n				<li>&Oslash; Visa Process</li>\r\n				<li>&Oslash; One way air ticket.</li>\r\n				<li>&Oslash; Embassy &amp; Medical fees: 12,000 taka.</li>\r\n				<li>&Oslash; 1 year Hostel: 65,000 taka</li>\r\n				<li>&Oslash; Other additional cost in China:20,000 taka</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p><strong>Nanjing University of Post &amp; Telecommunication</strong></p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>China, Jiangsu Sheng, Nanjing Shi, Gulou Qu</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p><strong>** Students must pass all subjects in every year to continue the scholarship.</strong></p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Electrical Information Engineering</li>\r\n				<li>&Oslash; Information &amp; Communication Engineering</li>\r\n				<li>&Oslash; BBA</li>\r\n				<li>&Oslash; Computer Engineering</li>\r\n			</ul>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p><strong>Qualification:</strong></p>\r\n\r\n			<p><strong>SSC &amp; HSC: GPA 8</strong></p>\r\n\r\n			<p><strong>Study gap: Not more than 4 years.</strong>&nbsp;&nbsp;</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n\r\n			<p>2 Lac taka.</p>\r\n\r\n			<ul>\r\n				<li>&Oslash;&nbsp;<strong>Package includes:</strong></li>\r\n				<li>&Oslash; Scholarship &amp; Admission confirmation process</li>\r\n				<li>&Oslash; Visa Process</li>\r\n				<li>&Oslash; One way air ticket.</li>\r\n				<li>&Oslash;&nbsp;<strong>Package excludes:</strong></li>\r\n				<li>&Oslash; Embassy &amp; Medical fees: 12,000 taka.</li>\r\n				<li>&Oslash; 1 year Hostel: 50,000 taka</li>\r\n				<li>&Oslash; Other additional cost in China:20,000 taka</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p><strong>Tianjin Chengjian University</strong><strong>&nbsp;</strong></p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>China, Tianjin Shi, Xiqing Qu</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p><strong>** Students must pass all subjects in every year to continue the scholarship.</strong></p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Civil Engineering</li>\r\n			</ul>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p><strong>Qualification:</strong></p>\r\n\r\n			<p><strong>SSC &amp; HSC: GPA 8</strong></p>\r\n\r\n			<p><strong>Study gap: Not more than 4 years.</strong></p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n\r\n			<p>2 Lac taka.</p>\r\n\r\n			<ul>\r\n				<li>&Oslash;&nbsp;<strong>Package includes:</strong></li>\r\n				<li>&Oslash; Scholarship &amp; Admission confirmation process</li>\r\n				<li>&Oslash; Visa Process</li>\r\n				<li>&Oslash; One way air ticket.</li>\r\n				<li>&Oslash;&nbsp;<strong>Package excludes:</strong></li>\r\n				<li>&Oslash; Embassy &amp; Medical fees: 12,000 taka.</li>\r\n				<li>&Oslash; 1 year Hostel: 75,000 taka</li>\r\n			</ul>\r\n\r\n			<p>Other additional cost in China:20,000 taka</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Full Scholarship in Masters &amp; PHD:</strong></p>\r\n\r\n<p><strong>Scholarship scheme :</strong>&nbsp;Tuition fees free, Hostel Free and monthly stipend: 20,000 taka ( Masters), 25,000 Taka ( PHD)</p>\r\n\r\n<ul>\r\n	<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n</ul>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2 Lac taka.</p>\r\n\r\n<ul>\r\n	<li>&Oslash;&nbsp;<strong>Package includes:</strong></li>\r\n	<li>&Oslash; Scholarship &amp; Admission confirmation process</li>\r\n	<li>&Oslash; Visa Process</li>\r\n	<li>&Oslash; One way air ticket.</li>\r\n	<li>&Oslash;&nbsp;<strong>Package excludes:</strong></li>\r\n	<li>&Oslash; Embassy &amp; Medical fees: 12,000 taka.</li>\r\n</ul>\r\n\r\n<p>Other additional cost in China:20,000 taka<strong>Required documents to apply:</strong></p>\r\n\r\n<p>** Complete CV<br />\r\n** All academic transcripts &amp; certificates.<br />\r\n** Any working experience letter.<br />\r\n** 2 reference letters from University professors.<br />\r\n** Study plan or SOP in 800 words.<br />\r\n** Passport<br />\r\n** Color photo ( PP size)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Subjects for Masters:</strong></p>\r\n\r\n<p>Marine Biology, Aquaculture Science, Fishery Resources, Fishing Science, Processing and Storage Engineering of Aquatic Food Science, Processing and Storage Engineering of Agricultural Products, 7.Machinery Manufacturing and Automation Crop Cultivation and Farming System , Crop Genetics and Breeding , Plant Pathology,&nbsp; Animal Genetics and Breeding ,Animal Nutrition and Feed Science, Crop Ecology , Tropical Horticultural Crop Science, Animal Production Science ,Agricultural Economy Management, Administrative Management Disciplines for professional degree, Food processing and Safety, Food Engineering, Crop Science, Breeding Science, Plant Protection Science, Rural and Regional Development,Seed Industry, Fishery Industry, Mechanical Engineering.</p>\r\n\r\n<p><strong>Subjects for PHD:</strong></p>\r\n\r\n<p>Physical Oceanography &amp; Marine Chemistry, Marine Biology,Processing and Storage Engineering of Aquatic Products,Food Science, Processing and Storage Engineering of Agricultural Products, Aquaculture Science, Fishery Resources.</p>\r\n\r\n<p><strong>MBBS in China</strong></p>\r\n\r\n<p><strong>Why MBBS in China?</strong></p>\r\n\r\n<ul>\r\n	<li>&Oslash; Medium of instruction is English.</li>\r\n	<li>&Oslash; BMDC approved.</li>\r\n	<li>&Oslash; After MBBS students can practice in Bangladesh.</li>\r\n	<li>&Oslash; IELTS is not required.</li>\r\n	<li>&Oslash; Entrance examination is not required.</li>\r\n	<li>&Oslash; No donation is required like in Bangladesh.</li>\r\n	<li>&Oslash; Very good hostel facilities.</li>\r\n	<li>&Oslash; Very affordable tuition &amp; hostel fees.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p><strong>University Name &amp; Province</strong></p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p><strong>Course name:&nbsp;</strong>MBBS</p>\r\n\r\n			<p><strong>&nbsp;entry qualification:</strong></p>\r\n\r\n			<p>SSC &amp; HSC GPA 8, in biology : GPA 4</p>\r\n\r\n			<p><strong>COST PER YEAR</strong></p>\r\n\r\n			<p><strong>&nbsp;</strong></p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p><strong>Package scheme for first year</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>China Three Gorges University</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Tuition fees:24000 RMB</li>\r\n				<li>&Oslash; Hostel Fees:3600 RMB</li>\r\n				<li>&Oslash; Others around: 1500 to 2000 RMB&nbsp;</li>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p>6.5 Lac taka.</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<ul>\r\n				<li>&Oslash;&nbsp;<strong>Package includes:</strong></li>\r\n				<li>&Oslash; Admission confirmation process</li>\r\n				<li>&Oslash; Visa Process</li>\r\n				<li>&Oslash; One way air ticket.</li>\r\n				<li>&Oslash; Embassy &amp; Medical fees: 12,000 taka.</li>\r\n				<li>&Oslash; 1 year Hostel</li>\r\n				<li>&Oslash; Other cost in China</li>\r\n				<li>&Oslash; Service charge.</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>Southern Medical University</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Tuition: 40000</li>\r\n				<li>&Oslash; RMB,Hostel:6000 RMB,</li>\r\n				<li>&Oslash; Others: Around 1500 to 2000 RMB</li>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p>8.5 Lac taka.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>Fujian Medical University</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Tuition: 30000</li>\r\n				<li>&Oslash; RMB,Hostel:4000 RMB</li>\r\n				<li>&Oslash; Others: Around 1500 to 2000 RMB</li>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p>7.0 Lac taka.</p>\r\n\r\n			<p><strong>&nbsp;</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>Xiamen University</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Tuition: 38000 RMB</li>\r\n				<li>&Oslash; Hostel:1500 RMB</li>\r\n				<li>&Oslash; Others: Around 1500 to 2000 RMB</li>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p>8.0 Lac taka.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>Liaoning Medical University</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Tuition: 32000 RMB</li>\r\n				<li>&Oslash; Hostel:5000 RMB</li>\r\n				<li>&Oslash; Others: Around 1500 to 2000 RMB</li>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p>7.5 Lac taka.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>Wuhan University</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Tuition: 32000 RMB</li>\r\n				<li>&Oslash; Hostel:7000 RMB</li>\r\n				<li>&Oslash; Others: Around 1500 to 2000 RMB</li>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p>7.5 Lac taka.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>Kunming Medical University</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Tuition: 26000 RMB</li>\r\n				<li>&Oslash; Hostel:5000 RMB</li>\r\n				<li>&Oslash; Others: Around 1500 to 2000 RMB</li>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p>7.0 Lac taka.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>Dalian Medical University</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Tuition: 40000 RMB</li>\r\n				<li>&Oslash; Hostel:8000 RMB</li>\r\n				<li>Others: Around 1500 to 2000 RMB</li>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p>9.0 Lac taka.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>Hebei Medical University</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Tuition: 35000 RMB</li>\r\n				<li>&Oslash; Hostel:4600 RMB</li>\r\n				<li>&Oslash; Others: Around 1500 to 2000 RMB</li>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p>8.0 Lac taka.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>Harbin Medical University</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Tuition: 30000 RMB</li>\r\n				<li>&Oslash; Hostel:4000 RMB,</li>\r\n				<li>&Oslash; Others: Around 1500 to 2000 RMB</li>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p>7.0 Lac taka.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>Jiangsu University</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Tuition: 30000 RMB</li>\r\n				<li>&Oslash; Hostel:7500 RMB</li>\r\n				<li>&Oslash; Others: Around 1500 to 2000 RMB</li>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p>7.5 Lac taka.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>South East University</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Tuition: 35000 RMB</li>\r\n				<li>&Oslash; Hostel:6000 RMB</li>\r\n				<li>&Oslash; Others: Around 1500 to 2000 RMB</li>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p>7.8 Lac taka.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>China Medical University</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Tuition: 35000 RMB</li>\r\n				<li>&Oslash; Hostel:5000 RMB</li>\r\n				<li>&Oslash; Others: Around 1500 to 2000 RMB</li>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p>7.8 Lac taka.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:top\">\r\n			<p>Shihezi University</p>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<ul>\r\n				<li>&Oslash; Tuition: 28000 RMB</li>\r\n				<li>&Oslash; Hostel:5000 RMB</li>\r\n				<li>&Oslash; Others: Around 1500 to 2000 RMB</li>\r\n				<li>&Oslash;&nbsp;<strong>Total Package Value:</strong></li>\r\n			</ul>\r\n			</td>\r\n			<td style=\"vertical-align:top\">\r\n			<p>7.0 Lac taka.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>** In case of visa refusal embassy fee, medical fees, and our process fees 10,000 taka are non-refundable.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>For Details:</strong></p>\r\n\r\n<p>Contact our counselor for CHINA: 01971000842/848</p>', 'active', '2020-08-08 01:11:15', NULL, 1, NULL),
(8, '10', NULL, '<p>New Zealand has a multicultural population of around 4 million people from 145 different countries. New Zealand&#39;s indigenous Maori make up around 14 percent of the population. It is a spectacularly beautiful country with vast mountains, rugged coastlines, scenic lakes, dense rainforests and steaming volcanoes. Currently New Zealand generates about 10% of its electricity geothermally from volcanic heat.</p>', '<p>New Zealand has a multicultural population of around 4 million people from 145 different countries. New Zealand&#39;s indigenous Maori make up around 14 percent of the population. It is a spectacularly beautiful country with vast mountains, rugged coastlines, scenic lakes, dense rainforests and steaming volcanoes. Currently New Zealand generates about 10% of its electricity geothermally from volcanic heat.</p>\r\n\r\n<p>New Zealand is separated into the North and South islands and is of comparable size to the United Kingdom. The main cities of Auckland, Wellington and Christchurch offer many different experiences for international students. The capital, Wellington is the most southerly capital city on the planet. One thing they all have in common is their beauty and access to stunning wilderness and outdoor pursuits.</p>\r\n\r\n<p>The country has a strong economy, an excellent education system, a high standard of living, a huge choice of outdoor pursuits, is a playground for thrill seekers and is a cost effective option for students to embark on their international education and life experience.</p>\r\n\r\n<p><strong>&nbsp;EDUCATION SYSTEM</strong></p>\r\n\r\n<p><img alt=\"Education System\" src=\"http://www.iaec.com.au/Media/Picture/education-system.jpg\" /></p>\r\n\r\n<p>New Zealand&rsquo;s Higher education system includes universities, polytechnics, colleges of education and private training institutions.</p>\r\n\r\n<p>The New Zealand education system is internationally recognized for its excellence and is renowned for producing high quality graduates with the practical skills and knowledge demanded by employers internationally.</p>\r\n\r\n<p>New Zealand education boasts an excellent choice of public and private education providers throughout the country offering every discipline at all levels from Certificates and Diplomas to Doctorate courses. The high standard of the courses and teaching provide the excellent platform to embark your chosen career.</p>\r\n\r\n<p>The graduates from New Zealand&#39;s universities who tend to earn the highest salaries are those qualified in sciences, engineering and management &amp; commerce.</p>\r\n\r\n<p>The style of teaching and learning at New Zealand Colleges and Universities develop strong analytical and academic skills which encourage you to think independently and creatively. The fantastic experience will be rewarding both academically and personally preparing you for life&rsquo;s journey.</p>\r\n\r\n<p>Click here for a diagram and explanation of the New Zealand education system or refer to link for further details.</p>\r\n\r\n<p><strong>&nbsp;LIFESTYLE</strong></p>\r\n\r\n<p><img alt=\"LifeStyle\" src=\"http://www.iaec.com.au/Media/Picture/lifestyle.jpg\" /></p>\r\n\r\n<p>New Zealand&rsquo;s South Pacific heritage can be seen in everyday life and through its numerous festivals, live music, theatre and arts events throughout the year. 22% of New Zealand&rsquo;s population were born overseas and the country enjoys a rich blend of Polynesian and British influence with many other nationalities mixed in which results cultural diversity and understanding.</p>\r\n\r\n<p>New Zealand&rsquo;s wide open spaces and uncrowded cities provide a perfect environment to learn and enjoy a relaxed lifestyle. The country is very safe, has low crime rates, has little pollution and congestion that you see in other cities around the world.</p>\r\n\r\n<p>New Zealanders are very accepting of different cultures, outlook and points of view. It is a very forward thinking modern society which welcomes and provides many opportunities for international students.</p>\r\n\r\n<p>The easy city living, stunning countryside and plethora of indoor and outdoor pursuits make New Zealand a fantastic option to embark or your educational journey. The cost of living in New Zealand is also very reasonable compared to other developed countries.</p>\r\n\r\n<ul>\r\n	<li><a href=\"http://www.immigration.govt.nz/nzopportunities/lifestyle\" target=\"_blank\">http://www.immigration.govt.nz/nzopportunities/lifestyle</a></li>\r\n</ul>\r\n\r\n<p><strong>&nbsp;EMPLOYMENT</strong></p>\r\n\r\n<p><strong><img alt=\"Employment\" src=\"http://www.iaec.com.au/Media/Picture/employment.jpg\" /></strong></p>\r\n\r\n<p><strong>N</strong>ew Zealand has a well developed economy which is the 62nd largest in the world. The sophisticated and unrestrictive business environment competes aggressively in world markets.</p>\r\n\r\n<p>Due to its stunning natural beauty New Zealand has a strong tourism industry which employs 10% of its total workforce. The services sector of the economy employs 65% of the workforce and including the tourism industry provides many opportunities for international students to secure part-time work.</p>\r\n\r\n<p>Student visa holders are permitted to work up to 20 hours part time during term time and full time during term breaks.</p>\r\n\r\n<p>The main trade partners are&nbsp;<a href=\"http://en.wikipedia.org/wiki/Australia\" target=\"_blank\">Australia</a>, the&nbsp;<a href=\"http://en.wikipedia.org/wiki/European_Union\" target=\"_blank\">European Union</a>, the&nbsp;<a href=\"http://en.wikipedia.org/wiki/United_States\" target=\"_blank\">United States</a>,&nbsp;<a href=\"http://en.wikipedia.org/wiki/China\" target=\"_blank\">China</a>&nbsp;and&nbsp;<a href=\"http://en.wikipedia.org/wiki/Japan\" target=\"_blank\">Japan</a>. The popularity, quality and diversity of Australia&rsquo;s international education makes it the country&rsquo;s second largest export behind Mining.</p>\r\n\r\n<p>The country requires skilled migrants to fill the many vacancies in the job market that have been identified</p>\r\n\r\n<p>Many areas of the economy have identified skill shortages Link govt website and the government looks to fill these shortages by encouraging skilled migrants to migrate permanently to New Zealand. International students may be eligible to fill such gaps and secure permanent residency in Australia on completion of their studies. For further information please contact our registered migration agent.</p>\r\n\r\n<ul>\r\n	<li><a href=\"http://www.immigration.govt.nz/nzopportunities/opportunities\" target=\"_blank\">http://www.immigration.govt.nz/nzopportunities/opportunities</a></li>\r\n</ul>\r\n\r\n<p><strong>&nbsp;LEISURE / ENTERTAINMENT</strong></p>\r\n\r\n<p><strong><img alt=\"Leisure / Entertainment\" src=\"http://www.iaec.com.au/Media/Picture/entertainment.jpg\" /></strong></p>\r\n\r\n<p><strong>N</strong>Z is famous for extreme sports like sky diving, bungee jumping, paragliding, abseiling and many more to scare the life out of you and your parents with photos and stories. Bungee jumpers leap from vertigo-inducing heights with only a length of rubber tied to their ankles.</p>\r\n\r\n<p>New Zealand&rsquo;s diversity of landscape and climate provides a host of summer and winter leisure and entertainment options for international students. The beautiful cultural centre&rsquo;s of Auckland and Wellington with their large-scale attractions of festivals, museums, cinemas, restaurants, shops, galleries, zoos and amusement parks provide a host of options for international students to choose from. Many of these attractions are free or inexpensive.</p>\r\n\r\n<p>Alternatively take off into the countryside and explore the stunning Highlands, glaciers, fiords and beaches. Discovering New Zealand is a must for any international student and their families.</p>\r\n\r\n<p>New Zealand also has a huge variety of sporting, arts, and music clubs and societies for students to join or go and watch. The most popular sports are Rugby, Netball, Cricket and Soccer. You can also choose from a huge array of team and individual activities and sports in all the College and University campuses.</p>\r\n\r\n<p>The cuisine is heavily influenced by that from places such as Europe, Thailand, Malaysia, Indonesia, Polynesia, Japan and Vietnam. These influences produce a rich blend of tastes and styles for students to experiment and enjoy.</p>\r\n\r\n<p>The music scene in the cities of Auckland, Wellington, Christchurch, Dunedin and other cities is thriving with live bands and DJ&rsquo;s playing most evenings. You will find music to cater for all tastes from Jazz to Pop.</p>\r\n\r\n<p>Great boutiques, markets, department and chain stores are abundant in the centre and suburbs of all the main cities.</p>\r\n\r\n<p>For more information on New Zealand please refer to the websites below</p>\r\n\r\n<ul>\r\n	<li><a href=\"http://www.newzealand.com/travel/about-nz/key-facts/key-facts-visitor-information.cfm\" target=\"_blank\">http://www.newzealand.com/travel/about-nz/key-facts/key-facts-visitor-information.cfm</a></li>\r\n</ul>\r\n\r\n<p><strong>&nbsp;STUDENT VISA</strong></p>\r\n\r\n<p><strong><img alt=\"student visa\" src=\"http://www.iaec.com.au/Media/Picture/student-visa.jpg\" /></strong></p>\r\n\r\n<p><strong>A</strong>ll students who wish to study Vocational Education or Higher Education courses abroad will require a student visa for their country of choice. Prominent Consultant has a fantastic record of student visa success. Our extensive knowledge of the visa systems in all the countries in which we operate enables us to confidently guide and prepare students to secure a student visa.</p>\r\n\r\n<p>We meticulously guide students in terms of document preparation, financial evidence, health requirements, evidence of English language ability, any supplementary information, and in visa interview preparation where required.</p>\r\n\r\n<p>Our counselors will also make you aware of the student visa regulations in your chosen country. Please contact your nearest counselor or complete an enquiry form for further details.</p>\r\n\r\n<p><strong>Now choosing Prominent Consultant might rise as a question. Why will you choose us?</strong></p>\r\n\r\n<p>We are certified, trained agent from Education New Zealand and we are here to help you process your admission. We are working for the following universities:</p>\r\n\r\n<p><strong>Universities:</strong></p>\r\n\r\n<p>1)&nbsp;&nbsp;&nbsp; Auckland University Of Technology</p>\r\n\r\n<p>2)&nbsp;&nbsp;&nbsp; Lincoln University</p>\r\n\r\n<p>3)&nbsp;&nbsp;&nbsp; Massey University</p>\r\n\r\n<p>4)&nbsp;&nbsp;&nbsp; Canterbury University</p>\r\n\r\n<p>5)&nbsp;&nbsp;&nbsp; Victoria University Of Auckland</p>\r\n\r\n<p><strong>Government Institutions:</strong></p>\r\n\r\n<p>1)&nbsp;&nbsp;&nbsp; Nelson Marlborough Institute Of Technology</p>\r\n\r\n<p>2)&nbsp;&nbsp;&nbsp; Toi Ohomai Institute Of Technology</p>\r\n\r\n<p>3)&nbsp;&nbsp;&nbsp; Manukau Institute Of Technology</p>\r\n\r\n<p>4)&nbsp;&nbsp;&nbsp; Wellington Institute Of Technology</p>\r\n\r\n<p>5)&nbsp;&nbsp;&nbsp; Unitech Institute Of Technology</p>\r\n\r\n<p>6)&nbsp;&nbsp;&nbsp; Southern Institute Of Techonoloy</p>\r\n\r\n<p><strong>Private Institutions:</strong></p>\r\n\r\n<p>1)&nbsp;&nbsp;&nbsp; Aspire2international</p>\r\n\r\n<p>2)&nbsp;&nbsp;&nbsp; Edenz College</p>\r\n\r\n<p>3)&nbsp;&nbsp;&nbsp; Royal Business College</p>\r\n\r\n<p>4)&nbsp;&nbsp;&nbsp; AIS St Helens</p>\r\n\r\n<p>5)&nbsp;&nbsp;&nbsp; ICL Business School</p>\r\n\r\n<p>Currently we are highlighting two institutions, &ldquo;<strong>Aspire 2 International</strong>&rdquo; and &ldquo;<strong>Toi Ohomai Institute Of Technology</strong>&rdquo;</p>\r\n\r\n<p><strong>Semester Intakes:</strong></p>\r\n\r\n<p>1)&nbsp;&nbsp;&nbsp; Summer - 3rd&nbsp;April,</p>\r\n\r\n<p>2)&nbsp;&nbsp;&nbsp; Fall - 7th&nbsp;August,</p>\r\n\r\n<p>3)&nbsp;&nbsp;&nbsp; Winter - 6th&nbsp;November, 4th&nbsp;December</p>\r\n\r\n<p><strong>Entry Requirements:</strong></p>\r\n\r\n<p>1)&nbsp;&nbsp;&nbsp; For Level &ndash; 5&amp;6 &agrave; Diploma ( first 2 years of Bachelor)<br />\r\n&nbsp;SSC &ndash; GPA 3.0/&lsquo;O&rsquo; Level &ndash; Overall Grade B</p>\r\n\r\n<p>HSC &ndash; GPA 3.0/ &lsquo;A&rsquo; Level &ndash; Overall Grade C<br />\r\nIELTS &ndash; 5.5, with no individual score less than 5.0</p>\r\n\r\n<p>2)&nbsp;&nbsp;&nbsp; For Level &ndash; 7 &agrave; Final year of Bachelor or graduate diploma</p>\r\n\r\n<p>First 2 years of Bachelors<br />\r\nIELTS &ndash; 6.0, with no individual score less than 5.5</p>\r\n\r\n<p>3)&nbsp;&nbsp;&nbsp; For Level &ndash; 8 &agrave; Post Graduation Diploma<br />\r\nCompletion Of Bachelor<br />\r\nIELTS- 6.5, with no individual score less than 6.0</p>\r\n\r\n<p>4)&nbsp;&nbsp;&nbsp; For Level 9 &agrave; Final Year of Masters</p>\r\n\r\n<p>IELTS &ndash; 6.5, with no individual score less than 6.0</p>\r\n\r\n<p>For application of spouse, Level 5&amp;6 is not eligible. At Level 7 you can apply for your spouse without any working permission. However, at Level 8&amp;9 you are able to apply for your spouse with a working permission.</p>\r\n\r\n<p><strong>Estimated tuition Fees:</strong></p>\r\n\r\n<p>Tuition fees actually vary in different institutions. However the following list has an estimated value.</p>\r\n\r\n<ul>\r\n	<li>For Level 5&amp;6 &agrave; Graduate Diploma&agrave; 2 years&agrave; $25,000 - $30,000 (12 lacs &ndash; 15 lacs)</li>\r\n	<li>For Level 7&agrave; Final Year Of Bachelors&agrave; 1 Year&agrave; $15,000 - $20,000 (8 lacs &ndash; 11 lacs)</li>\r\n	<li>For Level 8&agrave; Post Graduate Diploma&agrave; 1 Year&agrave; $20,000 ( 12 lacs or more)</li>\r\n	<li>For Level 9&agrave; Final Year Of Masters&agrave; 1-1.5 Year&agrave; $27,000 ( 15 lacs or more)</li>\r\n</ul>\r\n\r\n<p><strong>About the bank solvency</strong>, it depends on three factors.&nbsp;<strong>I) Tuition fees for one year, ii) Accommodation of one year, iii) Travelling expense of one year</strong>, which is approximately, $38,000 - $42,000. In BDT 20 lacs - 25 lacs. The amount of money should be kept at least for 6 months in bank, after taking admission.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>For details please contact our counselors: 01971000841/842/848/866</strong></p>', 'active', '2020-08-08 01:27:15', NULL, 1, NULL);
INSERT INTO `study_destination` (`study_destinationId`, `fkcountryId`, `imageFlag`, `shortDes`, `longDes`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(9, '9', NULL, '<p>asjdhfjashfjkashf jsahdf jsafdhjshjsdfh sjadfhasdjfhasjkdf asjdfh jdfhasjdfhasj dfhajsfhasjfh sdjhjshf</p>', '<p>DENMARK has a multicultural population of around 4 million people from 145 different countries. New Zealand&#39;s indigenous Maori make up around 14 percent of the population. It is a spectacularly beautiful country with vast mountains, rugged coastlines, scenic lakes, dense rainforests and steaming volcanoes. Currently New Zealand generates about 10% of its electricity geothermally from volcanic heat.</p>\r\n\r\n<p>New Zealand is separated into the North and South islands and is of comparable size to the United Kingdom. The main cities of Auckland, Wellington and Christchurch offer many different experiences for international students. The capital, Wellington is the most southerly capital city on the planet. One thing they all have in common is their beauty and access to stunning wilderness and outdoor pursuits.</p>\r\n\r\n<p>The country has a strong economy, an excellent education system, a high standard of living, a huge choice of outdoor pursuits, is a playground for thrill seekers and is a cost effective option for students to embark on their international education and life experience.</p>\r\n\r\n<p><strong>&nbsp;EDUCATION SYSTEM</strong></p>\r\n\r\n<p><img alt=\"Education System\" src=\"http://www.iaec.com.au/Media/Picture/education-system.jpg\" /></p>\r\n\r\n<p>New Zealand&rsquo;s Higher education system includes universities, polytechnics, colleges of education and private training institutions.</p>\r\n\r\n<p>The New Zealand education system is internationally recognized for its excellence and is renowned for producing high quality graduates with the practical skills and knowledge demanded by employers internationally.</p>\r\n\r\n<p>New Zealand education boasts an excellent choice of public and private education providers throughout the country offering every discipline at all levels from Certificates and Diplomas to Doctorate courses. The high standard of the courses and teaching provide the excellent platform to embark your chosen career.</p>\r\n\r\n<p>The graduates from New Zealand&#39;s universities who tend to earn the highest salaries are those qualified in sciences, engineering and management &amp; commerce.</p>\r\n\r\n<p>The style of teaching and learning at New Zealand Colleges and Universities develop strong analytical and academic skills which encourage you to think independently and creatively. The fantastic experience will be rewarding both academically and personally preparing you for life&rsquo;s journey.</p>\r\n\r\n<p>Click here for a diagram and explanation of the New Zealand education system or refer to link for further details.</p>\r\n\r\n<p><strong>&nbsp;LIFESTYLE</strong></p>\r\n\r\n<p><img alt=\"LifeStyle\" src=\"http://www.iaec.com.au/Media/Picture/lifestyle.jpg\" /></p>\r\n\r\n<p>New Zealand&rsquo;s South Pacific heritage can be seen in everyday life and through its numerous festivals, live music, theatre and arts events throughout the year. 22% of New Zealand&rsquo;s population were born overseas and the country enjoys a rich blend of Polynesian and British influence with many other nationalities mixed in which results cultural diversity and understanding.</p>\r\n\r\n<p>New Zealand&rsquo;s wide open spaces and uncrowded cities provide a perfect environment to learn and enjoy a relaxed lifestyle. The country is very safe, has low crime rates, has little pollution and congestion that you see in other cities around the world.</p>\r\n\r\n<p>New Zealanders are very accepting of different cultures, outlook and points of view. It is a very forward thinking modern society which welcomes and provides many opportunities for international students.</p>\r\n\r\n<p>The easy city living, stunning countryside and plethora of indoor and outdoor pursuits make New Zealand a fantastic option to embark or your educational journey. The cost of living in New Zealand is also very reasonable compared to other developed countries.</p>\r\n\r\n<ul>\r\n	<li><a href=\"http://www.immigration.govt.nz/nzopportunities/lifestyle\" target=\"_blank\">http://www.immigration.govt.nz/nzopportunities/lifestyle</a></li>\r\n</ul>\r\n\r\n<p><strong>&nbsp;EMPLOYMENT</strong></p>\r\n\r\n<p><strong><img alt=\"Employment\" src=\"http://www.iaec.com.au/Media/Picture/employment.jpg\" /></strong></p>\r\n\r\n<p><strong>N</strong>ew Zealand has a well developed economy which is the 62nd largest in the world. The sophisticated and unrestrictive business environment competes aggressively in world markets.</p>\r\n\r\n<p>Due to its stunning natural beauty New Zealand has a strong tourism industry which employs 10% of its total workforce. The services sector of the economy employs 65% of the workforce and including the tourism industry provides many opportunities for international students to secure part-time work.</p>\r\n\r\n<p>Student visa holders are permitted to work up to 20 hours part time during term time and full time during term breaks.</p>\r\n\r\n<p>The main trade partners are&nbsp;<a href=\"http://en.wikipedia.org/wiki/Australia\" target=\"_blank\">Australia</a>, the&nbsp;<a href=\"http://en.wikipedia.org/wiki/European_Union\" target=\"_blank\">European Union</a>, the&nbsp;<a href=\"http://en.wikipedia.org/wiki/United_States\" target=\"_blank\">United States</a>,&nbsp;<a href=\"http://en.wikipedia.org/wiki/China\" target=\"_blank\">China</a>&nbsp;and&nbsp;<a href=\"http://en.wikipedia.org/wiki/Japan\" target=\"_blank\">Japan</a>. The popularity, quality and diversity of Australia&rsquo;s international education makes it the country&rsquo;s second largest export behind Mining.</p>\r\n\r\n<p>The country requires skilled migrants to fill the many vacancies in the job market that have been identified</p>\r\n\r\n<p>Many areas of the economy have identified skill shortages Link govt website and the government looks to fill these shortages by encouraging skilled migrants to migrate permanently to New Zealand. International students may be eligible to fill such gaps and secure permanent residency in Australia on completion of their studies. For further information please contact our registered migration agent.</p>\r\n\r\n<ul>\r\n	<li><a href=\"http://www.immigration.govt.nz/nzopportunities/opportunities\" target=\"_blank\">http://www.immigration.govt.nz/nzopportunities/opportunities</a></li>\r\n</ul>\r\n\r\n<p><strong>&nbsp;LEISURE / ENTERTAINMENT</strong></p>\r\n\r\n<p><strong><img alt=\"Leisure / Entertainment\" src=\"http://www.iaec.com.au/Media/Picture/entertainment.jpg\" /></strong></p>\r\n\r\n<p><strong>N</strong>Z is famous for extreme sports like sky diving, bungee jumping, paragliding, abseiling and many more to scare the life out of you and your parents with photos and stories. Bungee jumpers leap from vertigo-inducing heights with only a length of rubber tied to their ankles.</p>\r\n\r\n<p>New Zealand&rsquo;s diversity of landscape and climate provides a host of summer and winter leisure and entertainment options for international students. The beautiful cultural centre&rsquo;s of Auckland and Wellington with their large-scale attractions of festivals, museums, cinemas, restaurants, shops, galleries, zoos and amusement parks provide a host of options for international students to choose from. Many of these attractions are free or inexpensive.</p>\r\n\r\n<p>Alternatively take off into the countryside and explore the stunning Highlands, glaciers, fiords and beaches. Discovering New Zealand is a must for any international student and their families.</p>\r\n\r\n<p>New Zealand also has a huge variety of sporting, arts, and music clubs and societies for students to join or go and watch. The most popular sports are Rugby, Netball, Cricket and Soccer. You can also choose from a huge array of team and individual activities and sports in all the College and University campuses.</p>\r\n\r\n<p>The cuisine is heavily influenced by that from places such as Europe, Thailand, Malaysia, Indonesia, Polynesia, Japan and Vietnam. These influences produce a rich blend of tastes and styles for students to experiment and enjoy.</p>\r\n\r\n<p>The music scene in the cities of Auckland, Wellington, Christchurch, Dunedin and other cities is thriving with live bands and DJ&rsquo;s playing most evenings. You will find music to cater for all tastes from Jazz to Pop.</p>\r\n\r\n<p>Great boutiques, markets, department and chain stores are abundant in the centre and suburbs of all the main cities.</p>\r\n\r\n<p>For more information on New Zealand please refer to the websites below</p>\r\n\r\n<ul>\r\n	<li><a href=\"http://www.newzealand.com/travel/about-nz/key-facts/key-facts-visitor-information.cfm\" target=\"_blank\">http://www.newzealand.com/travel/about-nz/key-facts/key-facts-visitor-information.cfm</a></li>\r\n</ul>\r\n\r\n<p><strong>&nbsp;STUDENT VISA</strong></p>\r\n\r\n<p><strong><img alt=\"student visa\" src=\"http://www.iaec.com.au/Media/Picture/student-visa.jpg\" /></strong></p>\r\n\r\n<p><strong>A</strong>ll students who wish to study Vocational Education or Higher Education courses abroad will require a student visa for their country of choice. Prominent Consultant has a fantastic record of student visa success. Our extensive knowledge of the visa systems in all the countries in which we operate enables us to confidently guide and prepare students to secure a student visa.</p>\r\n\r\n<p>We meticulously guide students in terms of document preparation, financial evidence, health requirements, evidence of English language ability, any supplementary information, and in visa interview preparation where required.</p>\r\n\r\n<p>Our counselors will also make you aware of the student visa regulations in your chosen country. Please contact your nearest counselor or complete an enquiry form for further details.</p>\r\n\r\n<p><strong>Now choosing Prominent Consultant might rise as a question. Why will you choose us?</strong></p>\r\n\r\n<p>We are certified, trained agent from Education New Zealand and we are here to help you process your admission. We are working for the following universities:</p>\r\n\r\n<p><strong>Universities:</strong></p>\r\n\r\n<p>1)&nbsp;&nbsp;&nbsp; Auckland University Of Technology</p>\r\n\r\n<p>2)&nbsp;&nbsp;&nbsp; Lincoln University</p>\r\n\r\n<p>3)&nbsp;&nbsp;&nbsp; Massey University</p>\r\n\r\n<p>4)&nbsp;&nbsp;&nbsp; Canterbury University</p>\r\n\r\n<p>5)&nbsp;&nbsp;&nbsp; Victoria University Of Auckland</p>\r\n\r\n<p><strong>Government Institutions:</strong></p>\r\n\r\n<p>1)&nbsp;&nbsp;&nbsp; Nelson Marlborough Institute Of Technology</p>\r\n\r\n<p>2)&nbsp;&nbsp;&nbsp; Toi Ohomai Institute Of Technology</p>\r\n\r\n<p>3)&nbsp;&nbsp;&nbsp; Manukau Institute Of Technology</p>\r\n\r\n<p>4)&nbsp;&nbsp;&nbsp; Wellington Institute Of Technology</p>\r\n\r\n<p>5)&nbsp;&nbsp;&nbsp; Unitech Institute Of Technology</p>\r\n\r\n<p>6)&nbsp;&nbsp;&nbsp; Southern Institute Of Techonoloy</p>\r\n\r\n<p><strong>Private Institutions:</strong></p>\r\n\r\n<p>1)&nbsp;&nbsp;&nbsp; Aspire2international</p>\r\n\r\n<p>2)&nbsp;&nbsp;&nbsp; Edenz College</p>\r\n\r\n<p>3)&nbsp;&nbsp;&nbsp; Royal Business College</p>\r\n\r\n<p>4)&nbsp;&nbsp;&nbsp; AIS St Helens</p>\r\n\r\n<p>5)&nbsp;&nbsp;&nbsp; ICL Business School</p>\r\n\r\n<p>Currently we are highlighting two institutions, &ldquo;<strong>Aspire 2 International</strong>&rdquo; and &ldquo;<strong>Toi Ohomai Institute Of Technology</strong>&rdquo;</p>\r\n\r\n<p><strong>Semester Intakes:</strong></p>\r\n\r\n<p>1)&nbsp;&nbsp;&nbsp; Summer - 3rd&nbsp;April,</p>\r\n\r\n<p>2)&nbsp;&nbsp;&nbsp; Fall - 7th&nbsp;August,</p>\r\n\r\n<p>3)&nbsp;&nbsp;&nbsp; Winter - 6th&nbsp;November, 4th&nbsp;December</p>\r\n\r\n<p><strong>Entry Requirements:</strong></p>\r\n\r\n<p>1)&nbsp;&nbsp;&nbsp; For Level &ndash; 5&amp;6 &agrave; Diploma ( first 2 years of Bachelor)<br />\r\n&nbsp;SSC &ndash; GPA 3.0/&lsquo;O&rsquo; Level &ndash; Overall Grade B</p>\r\n\r\n<p>HSC &ndash; GPA 3.0/ &lsquo;A&rsquo; Level &ndash; Overall Grade C<br />\r\nIELTS &ndash; 5.5, with no individual score less than 5.0</p>\r\n\r\n<p>2)&nbsp;&nbsp;&nbsp; For Level &ndash; 7 &agrave; Final year of Bachelor or graduate diploma</p>\r\n\r\n<p>First 2 years of Bachelors<br />\r\nIELTS &ndash; 6.0, with no individual score less than 5.5</p>\r\n\r\n<p>3)&nbsp;&nbsp;&nbsp; For Level &ndash; 8 &agrave; Post Graduation Diploma<br />\r\nCompletion Of Bachelor<br />\r\nIELTS- 6.5, with no individual score less than 6.0</p>\r\n\r\n<p>4)&nbsp;&nbsp;&nbsp; For Level 9 &agrave; Final Year of Masters</p>\r\n\r\n<p>IELTS &ndash; 6.5, with no individual score less than 6.0</p>\r\n\r\n<p>For application of spouse, Level 5&amp;6 is not eligible. At Level 7 you can apply for your spouse without any working permission. However, at Level 8&amp;9 you are able to apply for your spouse with a working permission.</p>\r\n\r\n<p><strong>Estimated tuition Fees:</strong></p>\r\n\r\n<p>Tuition fees actually vary in different institutions. However the following list has an estimated value.</p>\r\n\r\n<ul>\r\n	<li>For Level 5&amp;6 &agrave; Graduate Diploma&agrave; 2 years&agrave; $25,000 - $30,000 (12 lacs &ndash; 15 lacs)</li>\r\n	<li>For Level 7&agrave; Final Year Of Bachelors&agrave; 1 Year&agrave; $15,000 - $20,000 (8 lacs &ndash; 11 lacs)</li>\r\n	<li>For Level 8&agrave; Post Graduate Diploma&agrave; 1 Year&agrave; $20,000 ( 12 lacs or more)</li>\r\n	<li>For Level 9&agrave; Final Year Of Masters&agrave; 1-1.5 Year&agrave; $27,000 ( 15 lacs or more)</li>\r\n</ul>\r\n\r\n<p><strong>About the bank solvency</strong>, it depends on three factors.&nbsp;<strong>I) Tuition fees for one year, ii) Accommodation of one year, iii) Travelling expense of one year</strong>, which is approximately, $38,000 - $42,000. In BDT 20 lacs - 25 lacs. The amount of money should be kept at least for 6 months in bank, after taking admission.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>For details please contact our counselors: 01971000841/842/848/866</strong></p>', 'active', '2020-08-08 01:28:01', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `success_story`
--

CREATE TABLE `success_story` (
  `success_storyId` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `videoLink` varchar(1000) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `success_story`
--

INSERT INTO `success_story` (`success_storyId`, `name`, `videoLink`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(4, NULL, 'www.youtube.com', 'inactive', '2020-07-27 09:24:07', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `teamId` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `degisnation` varchar(45) DEFAULT NULL,
  `imageLink` varchar(100) DEFAULT NULL,
  `contactNumber` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `contactShow` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`teamId`, `name`, `degisnation`, `imageLink`, `contactNumber`, `status`, `contactShow`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(8, 'Allan Donald', 'Designer', '8teamImage.png', '021212124546', 'active', 'No', '2020-08-15 02:01:27', NULL, 1, NULL),
(9, 'Astley Fletcher', 'Founder', '9teamImage.png', '00121344646', 'active', 'No', '2020-08-15 02:02:09', NULL, 1, NULL),
(10, 'Mark Thomas', 'Designer', '10teamImage.png', '0121346464', 'active', 'No', '2020-08-15 02:02:53', NULL, 1, NULL),
(11, 'Richard Anto', 'Manager', '11teamImage.png', '014234646464', 'active', 'No', '2020-08-15 02:03:19', NULL, 1, NULL),
(12, 'Richard Antony', 'Manager', '12teamImage.png', '014321646164', 'active', 'No', '2020-08-15 02:04:11', NULL, 1, NULL),
(13, 'Rich Bairstow', 'President', '13teamImage.png', '03143464654', 'active', 'No', '2020-08-15 02:04:36', NULL, 1, NULL),
(14, 'Venanda Joye', 'President', '14teamImage.png', '0213464646', 'active', 'No', '2020-08-15 02:05:01', NULL, 1, NULL),
(15, 'afsadf', 'sdafsafd', '15teamImage.png', 'sadfsadfsdf', 'active', 'Yes', '2020-08-15 03:05:17', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `fullName` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `rememberToken` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `fk_user_typeId` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `fullName`, `email`, `password`, `created_at`, `update_at`, `rememberToken`, `status`, `fk_user_typeId`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$pZ3YYAlxHfg5n6q1YnkTjeJEKbiWpg24.m32GDFFkcIdUmnt/eI6O', NULL, NULL, NULL, NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_typeId` varchar(10) NOT NULL,
  `user_typeName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_typeId`, `user_typeName`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `web_options`
--

CREATE TABLE `web_options` (
  `optionsId` int(11) NOT NULL,
  `optionsName` varchar(45) DEFAULT NULL,
  `optionsValue` mediumtext DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_options`
--

INSERT INTO `web_options` (`optionsId`, `optionsName`, `optionsValue`, `updated_at`, `updated_by`) VALUES
(1, 'ceoMessage', '<p>&quot;Study Abroad &amp; Global Career- The most important journey in your life. You may challenges, you may fail sometimes. But don&#39;t loose your confidence and keep trusting in your potentiality. Go ahead and don&#39;t look back. I promise success will come to you for sure. Because success always comes to confident, honest &amp; hardworking soul. Prominent Consultant is a successful organization has been service since 2006. Be with Prominent Consultant &amp; Be successful.&quot;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Best Wishes</p>', '2020-08-15 03:25:21', 1),
(2, 'ceoVideoLink', 'https://youtu.be/DrWjdmrGKas', '2020-08-15 03:26:26', 1),
(3, 'fbLink', NULL, '2020-07-23 09:58:08', 1),
(4, 'twitLink', NULL, NULL, NULL),
(5, 'instaLink', NULL, NULL, NULL),
(6, 'youtubeLink', 'www.youtube.com', '2020-07-23 10:23:25', 1),
(7, 'email', 'munjurinaa@gmail.com', '2020-07-25 14:40:24', 1),
(8, 'phone', NULL, '2020-07-23 10:23:28', 1),
(9, 'address', NULL, NULL, NULL),
(10, 'ceoMessageLong', '<p>Study Abroad is an opportunity which can change your life. It is something which can represent you to the whole World. it can make you unique , exceptional and through it you can discover yourself apart from the crowd.<br />\r\n<br />\r\nStudy Abroad is such platform where you can experience international platform for higher study. You can meet different people from different nations, you can enjoy multicultural atmosphere. You can achieve globally recognized degrees. You can build strong communication skills and network.<br />\r\n<br />\r\nSo when you have a chance for study abroad , please don&#39;t miss to grab it. This is a unique opportunity and never waits for anyone.<br />\r\n<br />\r\nProminent Consultant is a name , a brand has been working since long as an education consultant. As i founder of Prominent Consultant , I would like to inform you that I also have a great experience of study abroad which really gave me a lot and I have been working as an education consultant since 2006.<br />\r\n<br />\r\nNow we can tell we are one of the top education consultants in Bangladesh . We are well renowned and popular to our students and these have been possible as we always give preference to our clients satisfaction. We have qualified and experienced team who are committed to give you proper guideline.<br />\r\n<br />\r\nWe don&#39;t bother about the number of students , but we bother about the quality service we can provide to them. We directly represent more than 150 foreign public and private institutions in different countries around the world so students can get opportunity to choose right destination based on their profile . Our policy is to advise students about their study destination based on their academic,English and financial background.</p>\r\n\r\n<p>We can proudly announce that we are direct partners of more than 30 Canadian public institutions that very few companies really have in our country. We are also proud to be official partner of France Embassy , Dhaka , Bangladesh to represent Campus France Bangladesh. So we are promoting higher education in France officially with partnership with France Embassy Dhaka.<br />\r\n<br />\r\nThat&#39;s very true , we cannot guarantee your success but we can grantee our honest and transparent guidelines, best support by our skilled and experienced team which can lead you towards your success.<br />\r\nSo if you are planning to study abroad , please try to make your dream journey with us I believe we won&#39;t make you disappointed.<br />\r\nFor details, you can visit our website www.prominentconsultantbd.com and Face book pages . You can also subscribe our youtube channel to get regular uopdates of our activities and sucess stories.<br />\r\n<br />\r\nYou can also make an appointment to visit our office or you can directly apply through our website. There is an option of live chat in our website , you can also talk to our counselor for the best advise.<br />\r\nSo be with Prominent and make your journey safe and hassle free.<br />\r\n<br />\r\nBest Regards,<br />\r\nSyed Yousuf Ali<br />\r\nChief Executive &amp; Founder<br />\r\nProminent Consultant</p>', '2020-08-15 03:26:09', 1),
(11, 'FooterContactAddress', NULL, NULL, NULL),
(12, 'FooterCallUs', NULL, NULL, NULL),
(13, 'FooterSendMail', NULL, NULL, NULL),
(14, 'FooterMessageUnderLogo', NULL, NULL, NULL),
(15, 'aboutUs', NULL, '2020-07-29 00:53:24', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`albumId`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`applicationId`);

--
-- Indexes for table `application_education`
--
ALTER TABLE `application_education`
  ADD PRIMARY KEY (`application_educationId`),
  ADD KEY `fk_application_education_application1_idx` (`fkapplicationId`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentId`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`countryId`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventId`),
  ADD KEY `fk_event_country1_idx` (`fkcountryId`);

--
-- Indexes for table `event_reg_qus_set`
--
ALTER TABLE `event_reg_qus_set`
  ADD PRIMARY KEY (`event_reg_qus_setId`);

--
-- Indexes for table `event_uni_list`
--
ALTER TABLE `event_uni_list`
  ADD PRIMARY KEY (`event_uni_listId`),
  ADD KEY `fk_event_uni_list_event1_idx` (`fkeventId`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackId`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuId`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsId`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`pageId`),
  ADD KEY `fk_page_menu1_idx` (`fkmenuId`);

--
-- Indexes for table `partner_institutions`
--
ALTER TABLE `partner_institutions`
  ADD PRIMARY KEY (`partner_institutionsId`),
  ADD KEY `fk_partner_institutions_country1_idx` (`fkcountryId`);

--
-- Indexes for table `partner_logo`
--
ALTER TABLE `partner_logo`
  ADD PRIMARY KEY (`partner_logoId`);

--
-- Indexes for table `partner_uni_logo`
--
ALTER TABLE `partner_uni_logo`
  ADD PRIMARY KEY (`partner_logoId`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`photoId`),
  ADD KEY `fk_photo_album1_idx` (`fkalbumId`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD PRIMARY KEY (`queryId`);

--
-- Indexes for table `qus_ans`
--
ALTER TABLE `qus_ans`
  ADD PRIMARY KEY (`qus_ansId`),
  ADD KEY `fk_qus_ans_event1_idx` (`fkEventId`),
  ADD KEY `fk_qus_ans_set_qus1_idx` (`fkSet_qus_set_qusId`);

--
-- Indexes for table `reasons_to_choose_us`
--
ALTER TABLE `reasons_to_choose_us`
  ADD PRIMARY KEY (`reasons_to_choose_usid`);

--
-- Indexes for table `set_qus`
--
ALTER TABLE `set_qus`
  ADD PRIMARY KEY (`set_qusId`),
  ADD KEY `fk_set_qus_event_reg_qus_set1_idx` (`fkEvent_reg_qus_setId`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`sliderId`);

--
-- Indexes for table `study_destination`
--
ALTER TABLE `study_destination`
  ADD PRIMARY KEY (`study_destinationId`);

--
-- Indexes for table `success_story`
--
ALTER TABLE `success_story`
  ADD PRIMARY KEY (`success_storyId`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`teamId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `fk_user_user_type_idx` (`fk_user_typeId`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_typeId`);

--
-- Indexes for table `web_options`
--
ALTER TABLE `web_options`
  ADD PRIMARY KEY (`optionsId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `albumId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `applicationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `application_education`
--
ALTER TABLE `application_education`
  MODIFY `application_educationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `countryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_reg_qus_set`
--
ALTER TABLE `event_reg_qus_set`
  MODIFY `event_reg_qus_setId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_uni_list`
--
ALTER TABLE `event_uni_list`
  MODIFY `event_uni_listId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `partner_institutions`
--
ALTER TABLE `partner_institutions`
  MODIFY `partner_institutionsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `partner_logo`
--
ALTER TABLE `partner_logo`
  MODIFY `partner_logoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `partner_uni_logo`
--
ALTER TABLE `partner_uni_logo`
  MODIFY `partner_logoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `photoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `query`
--
ALTER TABLE `query`
  MODIFY `queryId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qus_ans`
--
ALTER TABLE `qus_ans`
  MODIFY `qus_ansId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reasons_to_choose_us`
--
ALTER TABLE `reasons_to_choose_us`
  MODIFY `reasons_to_choose_usid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `set_qus`
--
ALTER TABLE `set_qus`
  MODIFY `set_qusId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `sliderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `study_destination`
--
ALTER TABLE `study_destination`
  MODIFY `study_destinationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `success_story`
--
ALTER TABLE `success_story`
  MODIFY `success_storyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `teamId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `web_options`
--
ALTER TABLE `web_options`
  MODIFY `optionsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application_education`
--
ALTER TABLE `application_education`
  ADD CONSTRAINT `fk_application_education_application1` FOREIGN KEY (`fkapplicationId`) REFERENCES `application` (`applicationId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_event_country1` FOREIGN KEY (`fkcountryId`) REFERENCES `country` (`countryId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `event_uni_list`
--
ALTER TABLE `event_uni_list`
  ADD CONSTRAINT `fk_event_uni_list_event1` FOREIGN KEY (`fkeventId`) REFERENCES `event` (`eventId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `fk_page_menu1` FOREIGN KEY (`fkmenuId`) REFERENCES `menu` (`menuId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `partner_institutions`
--
ALTER TABLE `partner_institutions`
  ADD CONSTRAINT `fk_partner_institutions_country1` FOREIGN KEY (`fkcountryId`) REFERENCES `country` (`countryId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `fk_photo_album1` FOREIGN KEY (`fkalbumId`) REFERENCES `album` (`albumId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `qus_ans`
--
ALTER TABLE `qus_ans`
  ADD CONSTRAINT `fk_qus_ans_event1` FOREIGN KEY (`fkEventId`) REFERENCES `event` (`eventId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_qus_ans_set_qus1` FOREIGN KEY (`fkSet_qus_set_qusId`) REFERENCES `set_qus` (`set_qusId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `set_qus`
--
ALTER TABLE `set_qus`
  ADD CONSTRAINT `fk_set_qus_event_reg_qus_set1` FOREIGN KEY (`fkEvent_reg_qus_setId`) REFERENCES `event_reg_qus_set` (`event_reg_qus_setId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_user_type` FOREIGN KEY (`fk_user_typeId`) REFERENCES `user_type` (`user_typeId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
