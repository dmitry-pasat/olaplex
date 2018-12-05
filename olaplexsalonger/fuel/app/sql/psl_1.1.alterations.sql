
--- stores table alterations
ALTER TABLE `stores` ADD `website` VARCHAR(255) NULL AFTER `email`;
ALTER TABLE `stores` ADD INDEX(`website`);
ALTER TABLE `stores` ADD `image` VARCHAR(255) NULL , ADD `twitter` VARCHAR(255) NULL , ADD `youtube` VARCHAR(255) NULL , ADD `googleplus` VARCHAR(255) NULL , ADD `linkedin` VARCHAR(255) NULL , ADD `pinterest` VARCHAR(255) NULL , ADD `instagram` VARCHAR(255) NULL ;



--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext,
  `sort_num` int(11) DEFAULT NULL,
  `locked` char(1) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `parent_id`, `title`, `description`, `sort_num`, `locked`, `icon`, `key`, `type`) VALUES
  (5, 93, 'Categories', NULL, NULL, '1', 'fa fa-tags', 'categories', 'category'),
  (93, NULL, 'Categories & Service Categories', NULL, NULL, '1', 'fa fa-tags', 'catindex', ''),
  (94, 93, 'Service Categories', NULL, NULL, '1', 'fa fa-tags', 'services', NULL),
  (95, 5, 'Grocery Store', NULL, NULL, NULL, 'fa fa-shopping-cart', NULL, 'category'),
  (96, 5, 'Coffee Shope', NULL, NULL, NULL, 'fa fa-coffee', NULL, 'category'),
  (97, 5, 'Bar/Pub', NULL, NULL, NULL, 'fa fa-beer', NULL, 'category'),
  (98, 5, 'Legal Services', NULL, NULL, NULL, 'fa fa-briefcase', NULL, 'category'),
  (99, 5, 'Restaurant', NULL, NULL, NULL, 'fa fa-cutlery', NULL, 'category'),
  (100, 94, 'Deli & Bakery', NULL, NULL, NULL, 'fa fa-cutlery', NULL, NULL),
  (101, 94, 'Pharmacy', NULL, NULL, NULL, 'fa fa-clipboard', NULL, NULL),
  (102, 94, 'Clinic', NULL, NULL, NULL, 'fa fa-user-md', NULL, NULL),
  (103, 94, 'Tire & Auto', NULL, NULL, NULL, 'fa fa-truck', NULL, NULL),
  (104, 94, 'ATM Available ', NULL, NULL, NULL, 'fa fa-money', NULL, NULL);


--
-- Constraints for dumped tables
--

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `content` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Table structure for table `content_to_stores`
--


CREATE TABLE `content_to_stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `content_parent_id` int(11) DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`),
  KEY `content_parent_id` (`content_parent_id`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `content_to_stores;`
--
ALTER TABLE `content_to_stores`
ADD CONSTRAINT `content_to_stores_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `content_to_stores_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;