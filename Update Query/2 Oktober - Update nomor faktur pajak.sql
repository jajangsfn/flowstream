DROP TABLE IF EXISTS `tax_no`;

CREATE TABLE `tax_no` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `branch_id` int(11) NOT NULL,
 `start_tax` varchar(255) NOT NULL,
 `end_tax` varchar(255) NOT NULL,
 `sequence` varchar(255) NOT NULL,
 `years` int(11) NOT NULL,
 `flag` int(11) NOT NULL DEFAULT 1,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4