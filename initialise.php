<?php
	include('dbconnect.php');
	if(!$conn){
		die('Error establishing connection to the server');
	}
	else
	{
		$sql="CREATE DATABASE IF NOT EXISTS vent";
		mysqli_query($conn,$sql);
		mysqli_select_db($conn,"vent");

	$sql="CREATE TABLE IF NOT EXISTS `comment` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `EventID` int(11) NOT NULL,
  `AccountNum` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `CommentTime` timestamp NOT NULL,
  PRIMARY KEY (`CommentID`),
  KEY `EventID` (`EventID`),
  KEY `AccountNum` (`AccountNum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`CommentID`, `EventID`, `AccountNum`, `Comment`, `CommentTime`) VALUES
(1, 58, 16, 'This event shot!', '2016-04-19 17:58:49'),
(2, 58, 16, 'For real', '2016-04-19 18:02:31'),
(3, 58, 20, 'Cant wait for this event to come!!', '2016-04-19 18:04:15'),
(4, 61, 20, 'Clean and Classy me haffi reach', '2016-04-19 18:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `user_one`, `user_two`) VALUES
(2, 16, 15),
(3, 16, 18),
(4, 16, 17),
(5, 0, 16),
(6, 16, 19),
(7, 16, 20);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `EventID` int(11) NOT NULL AUTO_INCREMENT,
  `EventName` varchar(255) NOT NULL,
  `EventType` varchar(255) NOT NULL,
  `EventLocation` varchar(255) NOT NULL,
  `Latitude` varchar(20) NOT NULL,
  `Longitude` varchar(20) NOT NULL,
  `StartDate` date NOT NULL,
  `StartTime` varchar(7) NOT NULL,
  `EndDate` date NOT NULL,
  `EndTime` varchar(7) NOT NULL,
  `EventImage` varchar(255) NOT NULL,
  `EventDesc` longtext NOT NULL,
  `EventCost` varchar(6) NOT NULL,
  `OrganizerID` int(11) NOT NULL,
  PRIMARY KEY (`EventID`),
  KEY `organizer` (`OrganizerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `EventName`, `EventType`, `EventLocation`, `Latitude`, `Longitude`, `StartDate`, `StartTime`, `EndDate`, `EndTime`, `EventImage`, `EventDesc`, `EventCost`, `OrganizerID`) VALUES
(55, 'GET THERE FRIDAYS', '3', 'Confidence Ave, Mandeville, Jamaica', '18.048127631171912', '-77.5048836853195', '2016-04-22', '09:00 P', '2016-04-23', '05:00 A', 'event/eventImages/GET THERE FRIDAYS1461064751.jpg', 'GET THERE FRIDAYS is an weekly event fused with a high energy vibe like no other. This week''s staging features ZJ Chrome, GSnop from Kilamanjaro and FYAH Bird. Admission Free\r\n#GetThere #CloudNine', 'Free', 16),
(56, 'Famous Explosion', '3', 'Ward Ave, Mandeville, Jamaica', '18.03905110973207', '-77.51486686727293', '2016-08-12', '09:00 P', '2016-08-13', '04:30 A', 'event/eventImages/1461065226.jpg', 'Famous Explosion Second Anniversary will be held at Stars Among Stars, 33 Ward Avenue, Mandevile. This year''s staging will features top djs from all over Jamaica with high energy vibes like no other. Follow the event and contact the promoter to get more information. #LiveFamous', '1000', 16),
(57, 'Dinner in the Dark', '5', 'Jamaica Pegasus Hotel, Kingston, Jamaica', '18.0025', '-76.78777780000001', '2016-10-26', '04:30 P', '2016-10-26', '09:00 P', 'event/eventImages/Dinner in the Dark1461068330.jpg', 'We will serve up traditional three-course menus or for smaller groups try our indulgent feasting menu, served to the middle of the table. Optional extras include an amuse-bouche, palette cleansers or an additional cheese course. This dinner will be held at the Jamaica Pegasus Hotel at 4:30PM. Follow the event or contact the organizer for more info!', '3000', 15),
(58, 'Family Shabbat Dinner', '5', 'DeCarteret Rd, Mandeville, Jamaica', '18.041254612891215', '-77.49628452321775', '2016-04-20', '08:00 P', '2016-04-20', '10:00 P', 'event/eventImages/1461069243.jpg', 'We serve up traditional three-course menus or for smaller groups try our indulgent feasting menu, served to the middle of the table. Optional extras include an amuse-bouche, palette cleansers or an additional cheese course.Will be held at Belair High School at 8PM. Follow this event or contact me below for more info', 'Free', 15),
(59, 'Summer Camp', '1', 'Church St, Treasure Beach, Jamaica', '17.885098128897628', '-77.76852532228997', '2016-07-20', '06:00 A', '2016-07-30', '05:00 P', 'event/eventImages/1461070834.jpg', 'So youâ€™ve got your essentials down pat.  Tent, check.  Sleeping bag, check. Camp stove, check.  What else goes in the trunk?  Making camping doable requires relatively few items, but making camping enjoyable relies upon a couple more things.  After all, surviving in the woods is not that much fun in itself. Come on out for this week long adventure. Contact me or follow me for more information.', '3000', 15),
(60, 'Promotion Meeting', '6', 'A1, Runaway Bay, Jamaica', '18.462918178087573', '-77.3313768725219', '2016-04-22', '12:30 P', '2016-04-22', '02:00 P', 'event/eventImages/1461072472.jpg', 'As a college professor, grief researcher, and author, I have given numerous presentations and lectures. I believe presentations and seminars must be engaging, relevant, practical, and useful. Each seminar can be tailored to the needs of your business and staff. Please contact me if you have questions about how my seminars can help you and your staff provide better service for your clients/families.Contact me for more information', 'Free', 17),
(61, 'Clean and Classy', '3', 'Mineral Hieghts Blvd, Sandy Bay, Jamaica', '17.943077', '-77.23433019999999', '2016-05-28', '10:00 P', '2016-05-29', '05:30 A', 'event/eventImages/1461076731.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Follow me or contact me below', '300', 19);

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `AccountNum` int(11) DEFAULT NULL,
  `EventID` int(11) DEFAULT NULL,
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`fid`),
  KEY `EventID` (`EventID`),
  KEY `AccountNum` (`AccountNum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`AccountNum`, `EventID`, `fid`) VALUES
(18, 60, 59),
(18, 57, 60),
(19, 58, 61),
(19, 55, 62),
(19, 61, 63),
(16, 61, 64),
(16, 59, 65),
(20, 55, 66),
(20, 61, 67);

-- --------------------------------------------------------

--
-- Table structure for table `followuser`
--

CREATE TABLE IF NOT EXISTS `followuser` (
  `AccountNum` int(11) NOT NULL,
  `FollowAccountNum` int(11) NOT NULL,
  `FID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`FID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `followuser`
--

INSERT INTO `followuser` (`AccountNum`, `FollowAccountNum`, `FID`) VALUES
(18, 17, 15);

-- --------------------------------------------------------

--
-- Table structure for table `guestlist`
--

CREATE TABLE IF NOT EXISTS `guestlist` (
  `GuestListID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountNum` int(11) NOT NULL,
  `EventID` int(11) NOT NULL,
  PRIMARY KEY (`GuestListID`),
  KEY `EventID` (`EventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `guestlist`
--

INSERT INTO `guestlist` (`GuestListID`, `AccountNum`, `EventID`) VALUES
(33, 16, 58);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `logID` int(110) NOT NULL AUTO_INCREMENT,
  `AccountNum` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `Clock` timestamp NOT NULL,
  PRIMARY KEY (`logID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`logID`, `AccountNum`, `Comment`, `Clock`) VALUES
(1, 11, 'Sucessfully logged out', '2016-04-19 09:57:44'),
(2, 1, 'Unsucessful login attempt', '2016-04-19 10:35:57'),
(3, 16, 'Sucessfully logged in', '2016-04-19 10:36:04'),
(4, 16, 'Sucessfully logged out', '2016-04-19 12:04:52'),
(5, 15, 'Sucessfully logged in', '2016-04-19 12:05:11'),
(6, 15, 'Sucessfully logged out', '2016-04-19 13:08:29'),
(7, 17, 'Sucessfully logged in', '2016-04-19 13:08:39'),
(8, 17, 'Sucessfully logged out', '2016-04-19 14:11:58'),
(9, 18, 'Sucessfully logged in', '2016-04-19 14:16:23'),
(10, 18, 'Gordon Tomlin followed Event Promotion Meeting', '2016-04-19 14:17:51'),
(11, 18, 'Gordon Tomlin followed Event Dinner in the Dark', '2016-04-19 14:17:55'),
(12, 18, 'Gordon Tomlin followed Event Suzan Borrows', '2016-04-19 14:20:24'),
(13, 18, 'Sucessfully logged out', '2016-04-19 14:32:55'),
(14, 19, 'Sucessfully logged in', '2016-04-19 14:33:09'),
(15, 19, 'Mari Silva followed Event Family Shabbat Dinner', '2016-04-19 14:33:39'),
(16, 19, 'Mari Silva followed Event GET THERE FRIDAYS', '2016-04-19 14:33:43'),
(17, 19, 'Mari Silva followed Event Clean and Classy', '2016-04-19 14:39:01'),
(18, 19, 'Sucessfully logged out', '2016-04-19 14:45:23'),
(19, 1, 'Unsucessful login attempt', '2016-04-19 14:45:26'),
(20, 16, 'Sucessfully logged in', '2016-04-19 14:45:31'),
(21, 16, 'Sucessfully logged out', '2016-04-19 14:45:50'),
(22, 1, 'Unsucessful login attempt', '2016-04-19 14:45:54'),
(23, 16, 'Sucessfully logged in', '2016-04-19 14:46:01'),
(24, 16, 'Sucessfully logged out', '2016-04-19 14:46:11'),
(25, 16, 'Sucessfully logged in', '2016-04-19 14:46:15'),
(26, 16, 'Demarey Baker followed Event Clean and Classy', '2016-04-19 14:49:48'),
(27, 16, 'Demarey Baker followed Event Summer Camp', '2016-04-19 14:49:58'),
(28, 16, ' sent a message to John Allen', '2016-04-19 16:22:23'),
(29, 16, ' sent a message to Gordon Tomlin', '2016-04-19 16:23:24'),
(30, 16, 'Sucessfully logged out', '2016-04-19 18:02:50'),
(31, 20, 'Sucessfully logged in', '2016-04-19 18:03:25'),
(32, 20, 'Teejay Brown followed Event GET THERE FRIDAYS', '2016-04-19 18:03:51'),
(33, 20, 'Teejay Brown followed Event Clean and Classy', '2016-04-19 18:03:54'),
(34, 20, 'Sucessfully logged out', '2016-04-19 18:23:22'),
(35, 16, 'Sucessfully logged in', '2016-04-19 19:14:04'),
(36, 16, ' sent a message to Demarey Baker', '2016-04-19 19:16:24'),
(37, 0, ' sent a message to  ', '2016-04-19 19:17:00'),
(38, 0, ' sent a message to  ', '2016-04-19 19:17:41'),
(39, 1, 'Unsucessful login attempt', '2016-04-19 19:17:46'),
(40, 15, 'Sucessfully logged in', '2016-04-19 19:18:13'),
(41, 15, ' sent a message to John Allen', '2016-04-19 19:18:25'),
(42, 15, ' sent a message to Demarey Baker', '2016-04-19 19:20:31'),
(43, 15, ' sent a message to John Allen', '2016-04-19 19:20:59'),
(44, 15, ' sent a message to John Allen', '2016-04-19 19:21:27'),
(45, 16, 'Demarey Baker is now on the guestlist of Family Shabbat Dinner', '2016-04-19 19:24:47'),
(46, 1, 'Admin logged in', '2016-04-19 19:28:02'),
(47, 1, 'Admin logged out', '2016-04-19 19:29:10'),
(48, 16, 'Sucessfully logged in', '2016-04-19 19:29:13'),
(49, 16, 'Sucessfully logged out', '2016-04-19 19:47:22'),
(50, 15, 'Sucessfully logged out', '2016-04-19 19:47:34'),
(51, 16, 'Sucessfully logged in', '2016-04-19 19:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `message` text NOT NULL,
  `SendTime` timestamp NOT NULL,
  `Status` varchar(6) NOT NULL DEFAULT 'Unread',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `user_from`, `user_to`, `message`, `SendTime`, `Status`) VALUES
(1, 2, 16, 15, 'Good', '2016-04-19 16:22:23', 'Unread'),
(2, 3, 16, 18, 'h', '2016-04-19 16:23:24', 'Unread'),
(3, 0, 16, 16, 'Test, Yo wah ', '2016-04-19 19:16:24', 'Unread'),
(4, 5, 0, 16, 'Yow', '2016-04-19 19:17:00', 'Unread'),
(5, 0, 0, 0, 'Mad', '2016-04-19 19:17:40', 'Unread'),
(6, 0, 15, 0, 'Hey Entertainmedz I', '2016-04-19 19:18:25', 'Unread'),
(7, 2, 15, 16, 'Yo', '2016-04-19 19:20:31', 'Unread'),
(8, 2, 15, 16, 'Good thing', '2016-04-19 19:20:59', 'Unread'),
(9, 2, 15, 16, 'HEavy', '2016-04-19 19:21:27', 'Unread');

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE IF NOT EXISTS `organizer` (
  `OrganizerID` int(11) NOT NULL,
  `OrganizerName` varchar(255) DEFAULT NULL,
  `OrganizerDesc` text,
  `OrganizerImage` varchar(300) DEFAULT NULL,
  `FLink` varchar(60) DEFAULT NULL,
  `TLink` varchar(60) DEFAULT NULL,
  `OtherLnk` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`OrganizerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organizer`
--

INSERT INTO `organizer` (`OrganizerID`, `OrganizerName`, `OrganizerDesc`, `OrganizerImage`, `FLink`, `TLink`, `OtherLnk`) VALUES
(15, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'EntertainMedz1', 'We bring to you the best events. Events with a difference. Medz on Entertainmedz', 'organizer/organizerImages/bakerdemar1@gmail.com1461077342.png', 'facebook.com/entertainmedz', 'twitter.com/entertainmedz', ''),
(17, 'Susan', '', 'organizer/organizerImages/susanborrows@gmail.com1461071339.jpg', 'facebook.com/sussieb', 'twitter.com/sussieb', ''),
(19, 'Mari Promotions', '', 'organizer/organizerImages/marisilva22@gmail.com1461076979.jpg', 'facebook.com/marisilva', 'twitter.com/marisilva', '');

-- --------------------------------------------------------

--
-- Table structure for table `reason`
--

CREATE TABLE IF NOT EXISTS `reason` (
  `AccountNum` int(11) NOT NULL,
  `HardToUse` tinyint(1) DEFAULT '0',
  `Boring` tinyint(1) DEFAULT '0',
  `DontRememberSigning` tinyint(1) DEFAULT '0',
  `OtherComments` text,
  PRIMARY KEY (`AccountNum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `AccountNum` int(11) NOT NULL AUTO_INCREMENT,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Gender` varchar(7) NOT NULL,
  `PhoneNo` varchar(15) NOT NULL,
  `OrganizerID` int(11) DEFAULT NULL,
  `AcctType` varchar(10) NOT NULL,
  `ProfilePicBig` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`AccountNum`),
  KEY `evnt` (`OrganizerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`AccountNum`, `Password`, `Email`, `FirstName`, `LastName`, `Gender`, `PhoneNo`, `OrganizerID`, `AcctType`, `ProfilePicBig`, `thumb`) VALUES
(1, '5299c3462d158ea560d4e7ce492e9a09', 'admin@vent.com', '', '', '', '', NULL, 'Admin', NULL, NULL),
(15, '38b1b473b222ce894ebcf80d70f7a980', 'johnallen@gmail.com', 'John', 'Allen', 'Male', '8762254565', 15, 'Normal', 'account/photo/johnallen@gmail.com1461067574.jpg', 'account/photo/profile_pictures/thumb_johnallen@gmail.com1461067574.jpg'),
(16, 'c4ca4238a0b923820dcc509a6f75849b', 'bakerdemar1@gmail.com', 'Demarey', 'Baker', 'Male', '8478596455', 16, 'Normal', 'account/photo/bakerdemar1@gmail.com1461062235.jpg', 'account/photo/profile_pictures/thumb_bakerdemar1@gmail.com1461062235.jpg'),
(17, 'ac575e3eecf0fa410518c2d3a2e7209f', 'susanborrows@gmail.com', 'Suzan', 'Borrows', 'Female', '8768894456', 17, 'Normal', 'account/photo/susanborrows@gmail.com1461071339.jpg', 'account/photo/profile_pictures/thumb_susanborrows@gmail.com1461071339.jpg'),
(18, '8fb744b51a1f14e5e8cda4e4aec68e2f', 'gordon10@yahoo.com', 'Gordon', 'Tomlin', 'Male', '3478895568', NULL, 'Normal', 'account/photo/gordon10@yahoo.com1461075446.jpg', 'account/photo/profile_pictures/thumb_gordon10@yahoo.com1461075446.jpg'),
(19, 'b77291f2819079cea0f1535ac1d6df5a', 'marisilva22@gmail.com', 'Mari', 'Silva', 'Male', '8764459198', 19, 'Normal', 'account/photo/marisilva22@gmail.com1461076408.jpg', 'account/photo/profile_pictures/thumb_marisilva22@gmail.com1461076408.jpg'),
(20, 'baba327d241746ee0829e7e88117d4d5', 'tjayb@gmail.com', 'Teejay', 'Brown', 'Male', '8765357115', NULL, 'Normal', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`AccountNum`) REFERENCES `user` (`AccountNum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`OrganizerID`) REFERENCES `organizer` (`OrganizerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`AccountNum`) REFERENCES `user` (`AccountNum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guestlist`
--
ALTER TABLE `guestlist`
  ADD CONSTRAINT `guestlist_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`OrganizerID`) REFERENCES `organizer` (`OrganizerID`) ON DELETE NO ACTION ON UPDATE CASCADE;";
		//runs query
		mysqli_multi_query($conn,$sql);
		mysqli_close($conn);
	}
?>
