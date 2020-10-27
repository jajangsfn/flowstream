DROP TABLE IF EXISTS `t_pembayaran_piutang`;
CREATE TABLE `t_pembayaran_piutang` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `total_bill` float NOT NULL,
  `jurnal_no` varchar(255) DEFAULT NULL,
  `payment` float DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `flag` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `t_pembayaran_piutang`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `t_pembayaran_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `t_checksheet` ADD `old_quantity` INT NOT NULL AFTER `order_request_detail_id`;

INSERT INTO `s_reference` (`id`, `branch_id`, `group_data`, `detail_data`, `flag`, `updated_by`, `created_date`, `updated_date`) VALUES (NULL, '1', 'DEFAULT_PASSWORD', 'parahiangan', '1', NULL, current_timestamp(), current_timestamp());