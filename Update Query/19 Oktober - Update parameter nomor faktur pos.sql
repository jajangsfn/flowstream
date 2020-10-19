CREATE TABLE `m_parameter_nomor_faktur` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `branch_id` int(11) NOT NULL,
 `invoice_code` varchar(50) NOT NULL,
 `flag` int(11) NULL DEFAULT NULL,
 `created_by` int(11) NOT NULL,
 `updated_by` int(11) NOT NULL,
 `created_date` datetime NOT NULL,
 `updated_date` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4