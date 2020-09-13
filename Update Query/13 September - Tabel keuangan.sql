CREATE TABLE `m_parameter_ikhtisar_saldo` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `acc_code` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `m_parameter_kode_rekening_saldo` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `acc_code` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `m_parameter_neraca_saldo` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `acc_code` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `t_pembayaran_hutang` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `invoice_no` varchar(255) NOT NULL,
 `total_bill` float NOT NULL,
 `jurnal_no` varchar(255) DEFAULT NULL,
 `payment` float DEFAULT NULL,
 `payment_date` datetime DEFAULT NULL,
 `created_date` datetime NOT NULL DEFAULT current_timestamp(),
 `flag` tinyint(4) NOT NULL DEFAULT 0,
 `created_by` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4

ALTER TABLE `m_parameter_ikhtisar_saldo`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `m_parameter_kode_rekening_saldo`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `m_parameter_neraca_saldo`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `m_parameter_ikhtisar_saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `m_parameter_kode_rekening_saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `m_parameter_neraca_saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
INSERT INTO `m_journal_mapping` (`ID`, `JOURNAL_CD`, `JOURNAL_TYPE`, `SEQ_LINE`, `ACCOUNT_CODE`, `FLAG`, `BRANCH_ID`, `BRANCH_NAME`, `CREATED_BY`) VALUES
(7, 'P', '12', '1', '2-1.8.01.000', 'Y', 1, 'Main', 'SYSADMIN'),
(8, 'P', '12', '2', '2-1.8.01.000', 'Y', 1, 'Main', 'SYSADMIN');

