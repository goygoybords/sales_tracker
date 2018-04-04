-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2018 at 05:30 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `alternate_contact_number` varchar(15) NOT NULL,
  `country_id` int(11) NOT NULL,
  `shipping_address` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` varchar(8) NOT NULL,
  `state_id` int(11) NOT NULL,
  `same` tinyint(1) NOT NULL DEFAULT '0',
  `billing_country_id` int(11) NOT NULL,
  `billing_address` varchar(100) NOT NULL,
  `billing_city` varchar(50) NOT NULL,
  `billing_zip` varchar(8) NOT NULL,
  `billing_state_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `firstname`, `lastname`, `email`, `contact_number`, `alternate_contact_number`, `country_id`, `shipping_address`, `city`, `zip`, `state_id`, `same`, `billing_country_id`, `billing_address`, `billing_city`, `billing_zip`, `billing_state_id`, `created_by`, `status`) VALUES
(1, 'Kevin ', 'Kane', 'john.flashpark@gmail.com', '6541230', '', 106, 'Sun Valley Updated', 'Cebu Queen City of the south', '55555', 16, 1, 106, 'Sun Valley Updated', 'Sun Valley Updated', '55555', 16, 12, 0),
(11, 'Brock ', 'Lesnar', 'brock@wwe.com', '123123', '', 230, 'asdasd', 'asdsad', '123123', 5, 1, 230, '', 'asdasd', '123123', 5, 12, 0),
(12, 'Paul ', 'Heyman', 'kevinseankho@gmail.com', '12354545', '34343434', 211, 'asdasdasd', 'updated', '123123', 6, 0, 174, 'Cebu City', 'Cebu City', '123213', 19, 13, 0),
(13, 'david', 'cook', 'david@gmail.com', '123123', '567567567', 230, 'ghjghj', 'ghjhgj', '45656', 2, 0, 230, 'asdasd', 'ghjhgj', '2313', 59, 15, 1),
(14, 'wing', 'chun', 'wing@gmail.com', '123', '456456', 230, 'gfjghjhg', 'ghjghj', '6767', 2, 1, 230, 'gfjghjhg', 'ghjghj', '6767', 2, 15, 1),
(15, 'bruce', 'lee', 'brucelee@gmail.com', '12312', '123', 230, 'asdasd', 'asd', '123123', 5, 1, 230, 'asdasd', 'asd', '123123', 5, 15, 1),
(16, 'asdasdas', 'asdsad', 'asd@gmail.com', '123123', '', 230, 'asd', 'asd', '123213', 2, 1, 230, 'asd', 'asd', '123213', 2, 1, 1),
(17, 'CC', 'CCF ', 'ccf@gmail.com', '123213', '', 230, 'asdsad', 'sad', '123213', 4, 1, 230, 'asdsad', 'sad', '123213', 4, 1, 1),
(18, 'Jose ', 'Chan', 'josemari@gmail.com', '12312434234', '', 230, 'address', 'cebu', '6000', 5, 0, 17, 'billing updated', 'sokbu', '56565', 19, 19, 0),
(19, 'Peter', 'Lim', 'peterlim@gmail.com', '123123', '45454545', 229, 'updatesdfsd343434', '43534fgfdg', '5454fghg', 1, 1, 229, 'updatesdfsd343434', 'updatesdfsd343434', '5454fghg', 1, 1, 1),
(20, 'David ', 'Lim', 'davidlim@gmail.com', '12312321323', '', 174, 'Maria luisa', 'Cebu', '6000', 3, 1, 174, 'Maria luisa', 'Staples Center', '6000', 3, 1, 1),
(21, 'Ming Si', 'dao', 'kkkkk@yahoo.com', '12345', '12345', 230, 'Staples Center', 'san fran', '90011', 6, 1, 230, 'Staples Center', 'Staples Center', '90011', 6, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment_methods`
--

CREATE TABLE `customer_payment_methods` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_method` tinyint(1) NOT NULL,
  `card_type` varchar(15) NOT NULL,
  `card_number` varchar(30) NOT NULL,
  `card_name` varchar(50) NOT NULL,
  `expiry_date` varchar(6) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `check_number` varchar(15) NOT NULL,
  `account_number` int(3) NOT NULL,
  `bank_name` varchar(30) NOT NULL,
  `routing_number` int(3) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_payment_methods`
--

INSERT INTO `customer_payment_methods` (`id`, `customer_id`, `payment_method`, `card_type`, `card_number`, `card_name`, `expiry_date`, `cvv`, `check_number`, `account_number`, `bank_name`, `routing_number`, `status`) VALUES
(1, 1, 2, '', '', '', '', '', '12345', 12345, 'BDO', 123, 1),
(2, 12, 3, '', '', '', '', '', '', 1111, 'BDO', 12, 1),
(3, 21, 2, '', '', '', '', '', '111', 123123, 'RCBC', 11, 1),
(4, 13, 3, '', '', '', '', '', '', 123455, 'BDO', 123, 1),
(5, 19, 2, '', '', '', '', '', '123123', 123, 'bdo', 123, 1),
(6, 20, 1, 'MasterCard', '23232', 'bdo', '04/11', '111', '', 0, '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_refund`
--

CREATE TABLE `customer_refund` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groupings`
--

CREATE TABLE `groupings` (
  `id` int(11) NOT NULL,
  `description` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupings`
--

INSERT INTO `groupings` (`id`, `description`, `status`) VALUES
(1, 'Group 1', 1),
(2, 'Group 2', 1),
(3, 'Group 3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `date_log` datetime NOT NULL,
  `description` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `date_log`, `description`, `user_id`, `order_id`) VALUES
(1, '0000-00-00 00:00:00', 'Created a new Order', 1, 13),
(2, '0000-00-00 00:00:00', 'Approved an Order', 1, 13),
(3, '0000-00-00 00:00:00', 'Approved an Order', 1, 11),
(4, '2018-01-18 02:22:11', 'Approved an Order', 1, 12),
(5, '2018-02-05 12:40:59', 'Shipped an Order', 1, 13),
(6, '2018-02-05 12:44:08', 'Updated an Order', 1, 11),
(7, '2018-02-05 12:44:40', 'Updated an Order', 1, 11),
(8, '2018-02-05 12:45:06', 'Updated an Order', 1, 10),
(9, '2018-02-05 12:46:00', 'Updated an Order', 1, 10),
(10, '2018-02-05 12:50:37', 'Updated an Order', 1, 10),
(11, '2018-02-05 12:50:54', 'Updated an Order', 1, 10),
(12, '2018-02-05 12:51:12', 'Updated an Order', 1, 10),
(13, '2018-02-05 12:51:23', 'Updated an Order', 1, 10),
(14, '2018-02-05 12:51:34', 'Updated an Order', 1, 10),
(15, '2018-02-05 12:51:50', 'Updated an Order', 1, 10),
(16, '2018-02-05 12:51:54', 'Updated an Order', 1, 10),
(17, '2018-02-05 12:52:06', 'Updated an Order', 1, 10),
(18, '2018-02-05 12:53:43', 'Updated an Order', 1, 10),
(19, '2018-02-05 12:55:21', 'Updated an Order', 1, 10),
(20, '2018-02-05 01:27:15', 'Created a new Order', 1, 14),
(21, '2018-02-05 01:28:49', 'Updated an Order', 1, 14),
(22, '2018-02-05 01:29:03', 'Updated an Order', 1, 14),
(23, '2018-02-05 01:30:05', 'Created a new Order', 1, 15),
(24, '2018-02-05 01:31:40', 'Created a new Order', 1, 16),
(25, '2018-02-05 01:31:56', 'Updated an Order', 1, 16),
(26, '2018-02-05 01:31:58', 'Updated an Order', 1, 16),
(27, '2018-02-05 01:32:01', 'Updated an Order', 1, 16),
(28, '2018-02-05 01:32:12', 'Updated an Order', 1, 15),
(29, '2018-02-05 01:32:29', 'Updated an Order', 1, 15),
(30, '2018-02-05 01:32:37', 'Updated an Order', 1, 15),
(31, '2018-02-05 01:35:04', 'Updated an Order', 1, 12),
(32, '2018-02-05 02:40:05', 'Shipped an Order', 1, 12),
(33, '2018-02-05 02:40:11', 'Shipped an Order', 1, 11),
(34, '2018-02-05 05:51:58', 'Refunded an Order', 0, 0),
(35, '2018-02-05 05:52:23', 'Refunded an Order', 0, 0),
(36, '2018-02-05 05:57:52', 'Refunded an Order', 0, 4),
(37, '2018-02-06 12:55:46', 'Refunded an Order', 0, 11),
(38, '2018-02-06 01:30:48', 'Refunded an Order', 0, 4),
(39, '2018-02-06 02:17:59', 'Refunded an Order', 0, 4),
(40, '2018-02-07 12:31:46', 'Updated an Order', 1, 16),
(41, '2018-02-07 12:34:42', 'Updated an Order', 1, 16),
(42, '2018-02-09 01:23:47', 'Created a new Order', 1, 17),
(43, '2018-02-09 01:27:58', 'Created a new Order', 1, 18),
(44, '2018-02-09 01:38:36', 'Created a new Order', 1, 19),
(45, '2018-02-09 06:42:46', 'Created a new Order', 1, 20),
(46, '2018-02-09 06:59:48', 'Created a new Order', 1, 21),
(47, '2018-02-12 12:48:35', 'Updated an Order', 1, 19),
(48, '2018-02-12 12:49:27', 'Updated an Order', 1, 21),
(49, '2018-02-12 12:56:34', 'Updated an Order', 1, 9),
(50, '2018-02-26 12:04:02', 'Refunded an Order', 0, 11),
(51, '2018-02-26 12:04:36', 'Refunded an Order', 0, 11),
(52, '2018-02-26 12:05:19', 'Approved an Order', 1, 21),
(53, '2018-02-26 12:05:33', 'Shipped an Order', 1, 21),
(54, '2018-02-26 12:13:59', 'Created a new Order', 1, 1),
(55, '2018-02-26 12:15:56', 'Created a new Order', 2, 2),
(56, '2018-02-26 12:33:39', 'Created a new Order', 3, 3),
(57, '2018-02-26 01:02:18', 'Updated an Order', 1, 1),
(58, '2018-02-26 01:02:37', 'Approved an Order', 1, 1),
(59, '2018-02-26 01:02:42', 'Shipped an Order', 1, 1),
(60, '2018-04-03 01:31:21', 'Approved an Order', 4, 2),
(61, '2018-04-03 01:36:13', 'Added Tracking Number', 4, 1),
(62, '2018-04-03 01:39:59', 'Updated an Order', 1, 3),
(63, '2018-04-03 01:40:11', 'Updated an Order', 1, 3),
(64, '2018-04-04 02:19:57', 'Updated an Order', 4, 3),
(65, '2018-04-04 02:43:15', 'Shipped an Order', 1, 2),
(66, '2018-04-04 05:13:50', 'Created a new Order', 3, 4),
(67, '2018-04-04 05:14:17', 'Created a new Order', 3, 5),
(68, '2018-04-04 05:14:45', 'Created a new Order', 3, 6),
(69, '2018-04-04 05:15:26', 'Approved an Order', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(20) NOT NULL,
  `order_date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total` decimal(16,2) NOT NULL,
  `shipping_method_id` int(11) NOT NULL,
  `shipping_fee` decimal(16,2) NOT NULL,
  `remarks` text NOT NULL,
  `notes` text NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `merchant` varchar(50) NOT NULL,
  `prepared_by` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `date_submitted` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL,
  `tracking_number` varchar(5) NOT NULL DEFAULT '0',
  `refunded` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice_number`, `order_date`, `customer_id`, `total`, `shipping_method_id`, `shipping_fee`, `remarks`, `notes`, `payment_method_id`, `merchant`, `prepared_by`, `approved_by`, `date_submitted`, `updated_by`, `date_updated`, `tracking_number`, `refunded`, `status`) VALUES
(1, 'INV-00040001', '2018-02-26', 1, '2.00', 1, '22.00', 'remarks', 'notes', 1, 'merchant', 1, 1, '2018-02-26 00:13:59', 1, '2018-02-26 01:02:18', '12345', 0, 2),
(2, 'INV-00040004', '2018-02-26', 12, '1.00', 1, '22.00', '', '', 2, 'merchant', 2, 4, '2018-02-26 00:15:56', 0, '0000-00-00 00:00:00', '0', 0, 2),
(3, 'INV-00040005', '2018-02-27', 21, '1.00', 1, '22.00', 'remarks\r\n', 'On Hold', 3, 'merchant', 3, 1, '2018-02-26 00:33:39', 4, '2018-04-04 02:19:57', '0', 0, 1),
(4, '', '2018-04-01', 13, '3.00', 1, '22.00', 'remarks', 'notes', 4, 'merchant', 3, 0, '2018-04-04 05:13:50', 0, '0000-00-00 00:00:00', '0', 0, 0),
(5, '', '2018-04-02', 19, '1.00', 1, '22.00', 'remarks', 'notes\r\n', 5, 'mechat', 3, 0, '2018-04-04 05:14:17', 0, '0000-00-00 00:00:00', '0', 0, 0),
(6, '', '2018-04-03', 20, '1.00', 1, '22.00', '', '', 6, 'chant', 3, 0, '2018-04-04 05:14:45', 0, '0000-00-00 00:00:00', '0', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(16,2) NOT NULL,
  `unit_price` decimal(16,2) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `amount`, `status`) VALUES
(3, 2, 1, '1.00', '1.00', '1.00', 1),
(5, 1, 1, '1.00', '1.00', '1.00', 1),
(6, 1, 2, '1.00', '1.00', '1.00', 1),
(9, 3, 3, '1.00', '1.00', '1.00', 1),
(10, 4, 1, '1.00', '1.00', '1.00', 1),
(11, 4, 2, '2.00', '2.00', '2.00', 1),
(12, 5, 4, '1.00', '1.00', '1.00', 1),
(13, 6, 5, '1.00', '1.00', '1.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_send_someone`
--

CREATE TABLE `order_send_someone` (
  `id` int(11) NOT NULL,
  `send_counter` tinyint(1) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `send_name` varchar(100) NOT NULL,
  `send_contact_number` varchar(15) NOT NULL,
  `send_country_id` int(11) NOT NULL,
  `send_address` varchar(100) NOT NULL,
  `send_city` varchar(100) NOT NULL,
  `send_zip` varchar(8) NOT NULL,
  `send_state_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_send_someone`
--

INSERT INTO `order_send_someone` (`id`, `send_counter`, `order_id`, `customer_id`, `send_name`, `send_contact_number`, `send_country_id`, `send_address`, `send_city`, `send_zip`, `send_state_id`, `status`) VALUES
(1, 0, 1, 1, '', '', 230, '', '', '', 0, 1),
(2, 1, 2, 12, 'Kevin', '12345', 171, '18888', 'LA', '61247', 6, 1),
(3, 0, 3, 21, '', '', 230, '', '', '', 0, 1),
(4, 0, 4, 13, '', '', 230, '', '', '', 0, 1),
(5, 0, 5, 19, '', '', 230, '', '', '', 0, 1),
(6, 0, 6, 20, '', '', 230, '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `product_price` decimal(16,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_description`, `product_price`, `quantity`, `status`) VALUES
(1, 'GC20 Vidalista 20mg', '1.00', '0.00', 1),
(2, 'GC5 Cialis 5mg', '1.00', '0.00', 1),
(3, 'Kirkland Vitamin B', '7.00', '0.00', 1),
(4, 'test', '5.00', '0.00', 1),
(5, 'asdasdsad', '12.00', '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`id`, `description`, `price`, `status`) VALUES
(1, 'EMS', '22.00', 1),
(2, 'EPACK', '20.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `code` varchar(2) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `code`, `name`, `status`) VALUES
(1, 'AL', 'Alabama', 1),
(2, 'AK', 'Alaska', 1),
(3, 'AS', 'American Samoa', 1),
(4, 'AZ', 'Arizona', 1),
(5, 'AR', 'Arkansas', 1),
(6, 'CA', 'California', 1),
(7, 'CO', 'Colorado', 1),
(8, 'CT', 'Connecticut', 1),
(9, 'DE', 'Delaware', 1),
(10, 'DC', 'District of Columbia', 1),
(11, 'FM', 'Federated States of Micronesia', 1),
(12, 'FL', 'Florida', 1),
(13, 'GA', 'Georgia', 1),
(14, 'GU', 'Guam', 1),
(15, 'HI', 'Hawaii', 1),
(16, 'ID', 'Idaho', 1),
(17, 'IL', 'Illinois', 1),
(18, 'IN', 'Indiana', 1),
(19, 'IA', 'Iowa', 1),
(20, 'KS', 'Kansas', 1),
(21, 'KY', 'Kentucky', 1),
(22, 'LA', 'Louisiana', 1),
(23, 'ME', 'Maine', 1),
(24, 'MH', 'Marshall Islands', 1),
(25, 'MD', 'Maryland', 1),
(26, 'MA', 'Massachusetts', 1),
(27, 'MI', 'Michigan', 1),
(28, 'MN', 'Minnesota', 1),
(29, 'MS', 'Mississippi', 1),
(30, 'MO', 'Missouri', 1),
(31, 'MT', 'Montana', 1),
(32, 'NE', 'Nebraska', 1),
(33, 'NV', 'Nevada', 1),
(34, 'NH', 'New Hampshire', 1),
(35, 'NJ', 'New Jersey', 1),
(36, 'NM', 'New Mexico', 1),
(37, 'NY', 'New York', 1),
(38, 'NC', 'North Carolina', 1),
(39, 'ND', 'North Dakota', 1),
(40, 'MP', 'Northern Mariana Islands', 1),
(41, 'OH', 'Ohio', 1),
(42, 'OK', 'Oklahoma', 1),
(43, 'OR', 'Oregon', 1),
(44, 'PW', 'Palau', 1),
(45, 'PA', 'Pennsylvania', 1),
(46, 'PR', 'Puerto Rico', 1),
(47, 'RI', 'Rhode Island', 1),
(48, 'SC', 'South Carolina', 1),
(49, 'SD', 'South Dakota', 1),
(50, 'TN', 'Tennessee', 1),
(51, 'TX', 'Texas', 1),
(52, 'UT', 'Utah', 1),
(53, 'VT', 'Vermont', 1),
(54, 'VI', 'Virgin Islands', 1),
(55, 'VA', 'Virginia', 1),
(56, 'WA', 'Washington', 1),
(57, 'WV', 'West Virginia', 1),
(58, 'WI', 'Wisconsin', 1),
(59, 'WY', 'Wyoming', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_name` varchar(50) NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `user_id`, `team_name`, `group_id`, `status`) VALUES
(1, 2, 'Team 1', 1, 1),
(3, 6, 'DX', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertypeid` int(2) NOT NULL DEFAULT '1',
  `team_id` int(11) NOT NULL,
  `screen_name` varchar(100) NOT NULL,
  `datecreated` int(16) NOT NULL DEFAULT '0',
  `datelastlogin` int(16) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `lastname`, `username`, `password`, `usertypeid`, `team_id`, `screen_name`, `datecreated`, `datelastlogin`, `status`) VALUES
(1, 'admin', 'admin', 'admin', 'rEqbiBtYxeOa4ZSRiIuwkVh532h7w2Ldbgtv+UJ47ek=', 1, 0, 'Administrator', 0, 1522792800, 1),
(2, 'TL 1', 'TL 1', 'tl', 'rEqbiBtYxeOa4ZSRiIuwkVh532h7w2Ldbgtv+UJ47ek=', 4, 1, 'Team Leader 1', 1519599600, 1522792800, 1),
(3, 'Agent1', 'Agent1', 'agent', 'rEqbiBtYxeOa4ZSRiIuwkVh532h7w2Ldbgtv+UJ47ek=', 3, 1, 'Agent1', 1519599600, 1522792800, 1),
(4, 'QA', 'QA', 'qa', 'rEqbiBtYxeOa4ZSRiIuwkVh532h7w2Ldbgtv+UJ47ek=', 2, 1, 'QA 1', 1522706400, 1522792800, 1),
(5, 'Agent2', 'Agent2', 'agent2', 'rEqbiBtYxeOa4ZSRiIuwkVh532h7w2Ldbgtv+UJ47ek=', 3, 3, 'Agent2', 1522792800, 0, 1),
(6, 'TL 2', 'TL 2', 'tl2', 'rEqbiBtYxeOa4ZSRiIuwkVh532h7w2Ldbgtv+UJ47ek=', 4, 0, 'TL2', 1522792800, 1522792800, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `id` int(1) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`id`, `type`) VALUES
(1, 'Admin'),
(2, 'QA'),
(3, 'Agent'),
(4, 'Team Lead');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer_payment_methods`
--
ALTER TABLE `customer_payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_refund`
--
ALTER TABLE `customer_refund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groupings`
--
ALTER TABLE `groupings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_send_someone`
--
ALTER TABLE `order_send_someone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`username`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `customer_payment_methods`
--
ALTER TABLE `customer_payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `customer_refund`
--
ALTER TABLE `customer_refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groupings`
--
ALTER TABLE `groupings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `order_send_someone`
--
ALTER TABLE `order_send_someone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
