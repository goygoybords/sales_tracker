-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2016 at 04:29 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

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
-- Table structure for table `calendar_events`
--

CREATE TABLE `calendar_events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(35) NOT NULL,
  `description` varchar(50) NOT NULL,
  `start_date` int(16) NOT NULL,
  `end_date` int(16) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calendar_events`
--

INSERT INTO `calendar_events` (`id`, `event_name`, `description`, `start_date`, `end_date`, `status`) VALUES
(1, 'Order List', 'Test', 1479337200, 1479423600, 1),
(2, 'Undertaker Returns', 'the return of the deadman', 1480028400, 1480201200, 1);

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
(115, 'KP', 'Korea, Democratic People''s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People''s Democratic Republic'),
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
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `firstname`, `lastname`, `email`, `contact_number`, `alternate_contact_number`, `country_id`, `shipping_address`, `city`, `zip`, `state_id`, `same`, `billing_country_id`, `billing_address`, `billing_city`, `billing_zip`, `billing_state_id`, `status`) VALUES
(1, 'Kevin ', 'Kane', 'john.flashpark@gmail.com', '6541230', '', 124, 'Sun Valley Updated', 'Cebu Queen City of the south', '6001', 1, 0, 0, '', '', '', 0, 1),
(2, 'Kane', 'Undertaker', 'john.flashpark@gmail.com', '123123', '', 230, 'Houston', 'Death Valley', '78787', 51, 0, 0, '', '', '', 0, 1),
(3, 'Chris', 'Tomlin', 'john.flashpark@gmail.com', '123', '', 230, 'asdasd', 'cebu', '451', 3, 0, 0, '', '', '', 0, 1),
(4, 'asdasd', 'asdasdasd', 'john.flashpark@gmail.com', '123123', '', 230, 'asdasdasd', 'asdasd', '123123', 2, 0, 0, '', '', '', 0, 1),
(5, 'ghjghjhghgj', 'ghjghh', 'john.flashpark@gmail.com', '123123213', '', 230, 'asdsad', 'fdfg', '5000', 6, 0, 0, '', '', '', 0, 1),
(6, 'Test', 'Test', 'john.flashpark@gmail.com', '123123', '', 230, 'test address', 'test', '6000', 1, 0, 0, '', '', '', 0, 1),
(7, 'khkjhjhkj', 'hkjhkjhjhk', 'john.flashpark@gmail.com', '234243243', '', 230, 'kjhkjhkhj', 'jkhkjhk', '6000', 5, 0, 0, '', '', '', 0, 1),
(8, 'kari update', 'jobe update', 'john.flashpark@gmail.com', '565656', '', 212, 'update', 'asdasd update', '5656', 8, 0, 0, '', '', '', 0, 0),
(9, 'Kevin ', 'Kane', 'john.flashpark@gmail.com', '6541230', '', 124, 'Sun Valley Updated', 'Cebu Queen City of the south', '6001', 1, 0, 0, '', '', '', 0, 1),
(10, 'Bill', 'Goldberg', 'john.flashpark@gmail.com', '123123231', '', 230, 'asdsad', 'asd', '213231', 2, 0, 0, '', '', '', 0, 1),
(11, 'Brock ', 'Lesnar', 'brock@wwe.com', '123123', '', 230, 'asdasd', 'asdsad', '123123', 5, 0, 0, '', '', '', 0, 1),
(12, 'Paul ', 'Heyman', 'paulheyman@yahoo.com', '12354545', '34343434', 211, 'asdasdasd', 'updated', '123123', 6, 0, 174, 'Cebu City', 'Cebu City', '6000', 3, 1),
(13, 'david', 'cook', 'david@gmail.com', '123123', '567567567', 230, 'ghjghj', 'ghjhgj', '45656', 2, 1, 230, 'ghjghj', 'ghjhgj', '45656', 2, 1),
(14, 'wing', 'chun', 'wing@gmail.com', '123', '456456', 230, 'gfjghjhg', 'ghjghj', '6767', 2, 1, 230, 'gfjghjhg', 'ghjghj', '6767', 2, 1);

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
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_payment_methods`
--

INSERT INTO `customer_payment_methods` (`id`, `customer_id`, `payment_method`, `card_type`, `card_number`, `card_name`, `expiry_date`, `cvv`, `check_number`, `status`) VALUES
(1, 1, 1, '', '', '', '', '', '', 1),
(2, 11, 1, 'Visa', '', '', '', '', '', 1),
(3, 13, 1, 'MasterCard', '566565989456', 'DAvid D COOK', '4/20', '123', '', 1),
(4, 1, 2, 'MasterCard', '', '', '', '', '123123123213', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_date` int(16) NOT NULL,
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
  `tracking_number` varchar(5) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_date`, `customer_id`, `total`, `shipping_method_id`, `shipping_fee`, `remarks`, `notes`, `payment_method_id`, `merchant`, `prepared_by`, `approved_by`, `date_submitted`, `updated_by`, `date_updated`, `tracking_number`, `status`) VALUES
(1, 1478646000, 1, '50.00', 1, '5.00', 'Remarks updated', 'NOtes updated', 0, '', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 1),
(2, 1478646000, 2, '9.00', 1, '5.00', 'Remarks', 'Notes\r\n', 0, '', 12, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 1),
(3, 1478646000, 3, '0.00', 2, '5.00', 'sadasd', 'asdasdasd', 0, '', 12, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(4, 1478646000, 4, '30.00', 2, '5.00', 'asdasdsad', 'asdasdasdsadad', 0, '', 12, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(5, 1478818800, 5, '15.00', 1, '5.00', 'vbvbvbnbvn', 'vbnbvbnb', 0, '', 12, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(6, 1479078000, 6, '40.00', 1, '5.00', 'test remarks', 'test notes', 0, '', 13, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(7, 1479078000, 7, '15.00', 1, '5.00', 'jhgjhg', 'hjhgjgjh', 0, '', 13, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 1),
(8, 1479078000, 9, '30.00', 1, '5.00', 'kevin kane test', 'kevin kane test', 0, '', 13, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(9, 1479078000, 1, '15.00', 1, '5.00', 'sad', 'asdassad', 0, '', 13, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(10, 1479078000, 10, '30.00', 1, '5.00', 'asdasd', 'asdsadasd', 0, '', 14, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(11, 1479164400, 1, '9.00', 1, '5.00', 'New Order', 'New Order', 0, '', 15, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(12, 1479855600, 1, '29.00', 2, '5.00', 'REmarks', 'Notes', 0, 'Hillsong', 1, 0, '2016-11-23 03:11:32', 0, '0000-00-00 00:00:00', '', 0),
(13, 1479855600, 1, '15.00', 1, '5.00', 'asdasda', 'asdasdasd', 1, 'asdsad', 1, 0, '2016-11-23 03:15:54', 0, '0000-00-00 00:00:00', '', 0),
(14, 1479855600, 11, '34.00', 1, '5.00', 'fgfg', 'fgfgfgfgfgfg', 2, 'gdgfg', 1, 0, '2016-11-23 03:19:46', 0, '0000-00-00 00:00:00', '', 0),
(15, 1479855600, 13, '0.00', 1, '5.00', 'asdas', 'asdasd', 3, '', 1, 0, '2016-11-23 03:24:13', 0, '0000-00-00 00:00:00', '', 0),
(16, 1479855600, 1, '30.00', 1, '5.00', '', '', 4, 'asdasd', 1, 0, '2016-11-23 03:46:47', 0, '0000-00-00 00:00:00', '', 0);

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
(1, 1, 2, '5.00', '5.00', '25.00', 1),
(2, 1, 1, '5.00', '5.00', '25.00', 1),
(3, 2, 1, '2.00', '2.00', '4.00', 1),
(4, 3, 1, '2.00', '2.00', '0.00', 1),
(5, 4, 1, '5.00', '5.00', '25.00', 1),
(6, 5, 3, '2.00', '5.00', '10.00', 1),
(7, 6, 2, '2.00', '5.00', '10.00', 1),
(8, 6, 1, '5.00', '5.00', '25.00', 1),
(9, 7, 1, '2.00', '5.00', '10.00', 1),
(10, 8, 2, '5.00', '5.00', '25.00', 1),
(11, 9, 3, '5.00', '2.00', '10.00', 1),
(12, 10, 2, '5.00', '5.00', '25.00', 1),
(13, 11, 2, '2.00', '1.00', '2.00', 1),
(14, 11, 1, '2.00', '1.00', '2.00', 1),
(15, 12, 3, '3.00', '8.00', '24.00', 1),
(16, 13, 1, '2.00', '5.00', '10.00', 1),
(17, 14, 1, '2.00', '2.00', '4.00', 1),
(18, 14, 2, '5.00', '5.00', '25.00', 1),
(19, 16, 2, '5.00', '5.00', '25.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `product_price` decimal(16,2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_description`, `product_price`, `status`) VALUES
(1, 'GC20 Vidalista 20mg', '1.00', 1),
(2, 'GC5 Cialis 5mg', '1.00', 1),
(3, 'Kirkland Vitamin B', '7.00', 1),
(4, 'test', '5.00', 1),
(5, 'asdasdsad', '12.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`id`, `description`, `status`) VALUES
(1, 'EMS', 1),
(2, 'EPACK', 1),
(3, 'test updated', 0);

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
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `user_id`, `team_name`, `status`) VALUES
(1, 7, 'Degeneration X', 1),
(2, 10, 'LA Lakers', 1),
(3, 11, 'Cleveland Cavs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(35) NOT NULL,
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

INSERT INTO `users` (`id`, `first_name`, `lastname`, `email`, `password`, `usertypeid`, `team_id`, `screen_name`, `datecreated`, `datelastlogin`, `status`) VALUES
(1, 'Kevin Sean', 'Kho', 'kevinseankho@yahoo.com', 'c3133997b31ce266fc0663b3a8912206', 1, 0, 'Chinese Mafia', 1473717600, 1479855600, 1),
(6, 'QA', 'Kevin', 'qakevin@yahoo.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 0, '', 1479682800, 0, 1),
(7, 'Team Leader', 'Kevin', 'teamleadkevin@yahoo.com', '827ccb0eea8a706c4c34a16891f84e7b', 4, 0, '', 1479682800, 0, 1),
(8, 'agent', 'kevin', 'agentkevin@yahoo.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, 0, '', 1479682800, 0, 1),
(9, 'kobe test', 'test', 'test@gmail.com', '1f32aa4c9a1d2ea010adcf2348166a04', 2, 0, 'black mamba', 1479682800, 0, 1),
(10, 'Team Lead 2', 'Kobe', 'kbryant@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 4, 2, '', 1479769200, 1479769200, 1),
(11, 'Team Leader 3', 'Lebron', 'team_lebro@gmail.com', '1f32aa4c9a1d2ea010adcf2348166a04', 4, 3, '', 1479769200, 0, 1),
(12, 'Jordan ', 'Clarkson', 'jordanclark@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, 2, 'Jordan ', 1479769200, 1479769200, 1),
(13, 'Kyrie', 'Irving', 'kyrieirving@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, 3, 'Uncle Drew', 1479769200, 0, 1),
(14, 'D'' Angelo', 'Russell', 'druss@yahoo.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, 2, 'D Russ', 1479769200, 0, 1),
(15, 'Tristan', 'Thompson', 'tristan@yahoo.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, 3, 'tristan', 1479769200, 0, 1);

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
-- Indexes for table `calendar_events`
--
ALTER TABLE `calendar_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_payment_methods`
--
ALTER TABLE `customer_payment_methods`
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
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar_events`
--
ALTER TABLE `calendar_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `customer_payment_methods`
--
ALTER TABLE `customer_payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
