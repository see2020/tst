CREATE TABLE IF NOT EXISTS `ifora_form` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`ifora_fio` varchar(255) NOT NULL DEFAULT '' COMMENT '',
	`ifora_phone` varchar(20) NOT NULL DEFAULT '' COMMENT '',
	`ifora_email` varchar(60) NOT NULL DEFAULT '' COMMENT '',
	`ifora_date` varchar(10) NOT NULL DEFAULT '0000-00-00' COMMENT '',
	`ifora_time` varchar(5) NOT NULL DEFAULT '00:00' COMMENT '',
	`ifora_dt` int(20) NOT NULL DEFAULT '0' COMMENT '',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='';