--
-- Table structure for table `notification`
--
CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `service` varchar(20) DEFAULT NULL,
  `icon` varchar(20) DEFAULT NULL COMMENT 'Materialize icon class',
  `text` varchar(255) NOT NULL,
  `read` timestamp NULL DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL COMMENT 'Request JSON',
  `alert` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Alerts will be highlighted',
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to` (`to`);

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;