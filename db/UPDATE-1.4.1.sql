CREATE TABLE `qc_device_aliases` (
  `user_id` int(5) NOT NULL,
  `device_id` varchar(80) NOT NULL,
  `alias` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
