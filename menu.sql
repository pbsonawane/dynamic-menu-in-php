-- Database: `menu`
--

-- --------------------------------------------------------

--
-- Table structure for table `ms_product`
--

DROP TABLE IF EXISTS `ms_product`;
CREATE TABLE IF NOT EXISTS `ms_product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `link` text CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `parentid` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `pravin` (`title`),
  FULLTEXT KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `ms_product`
--

INSERT INTO `ms_product` (`id`, `title`, `link`, `parentid`) VALUES
(1, 'Category 1', 'http://www.category1.com', 0),
(2, 'Category 2', 'http://www.category2.com', 0),
(3, 'Category 3', 'http://www.category3.com', 0),
(4, 'Category 4', 'http://www.category4.com', 0),
(5, 'Category 1 - 1', 'http://www.category11.com', 1),
(6, 'Category 1 - 2', 'http://www.category12.com', 1),
(7, 'Category 1 - 2 - 1', 'http://www.category121.com', 6),
(8, 'Category 1 - 2 - 2', 'http://www.category122.com', 6),
(9, 'Category 1 - 2 - 2 - 1', 'http://www.category1221.com', 8),
(10, 'Category 1 - 2 - 2 - 2', 'http://www.category1222.com', 8),
(11, 'Category 3 - 1', 'http://www.category31.com', 3),
(12, 'Category 3 - 2', 'http://www.category32.com', 3),
(13, 'Category 3 - 3', 'http://www.category33.com', 3),
(14, 'Category 3 - 4', 'http://www.category34.com', 3),
(15, 'Category 3 - 5', 'http://www.category35.com', 3),
(16, 'Category 3 - 6', 'http://www.category36.com', 3);
