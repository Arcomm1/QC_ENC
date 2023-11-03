ALTER TABLE `qc_users` ADD COLUMN `can_listen` varchar(3) COLLATE utf8_unicode_ci DEFAULT 'yes';
ALTER TABLE `qc_users` ADD COLUMN `can_download` varchar(3) COLLATE utf8_unicode_ci DEFAULT 'yes';