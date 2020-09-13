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
COMMIT;