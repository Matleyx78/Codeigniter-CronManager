CREATE TABLE `ci_cron_job` (
`id_ci_cj` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`cicj_name` varchar(100) DEFAULT NULL,
`cicj_command` varchar(255) NOT NULL,
`cicj_minute` varchar(30) NOT NULL,
`cicj_hour` varchar(30) NOT NULL,
`cicj_day_of_month` varchar(30) NOT NULL,
`cicj_month` varchar(30) NOT NULL,
`cicj_week_day` varchar(30) NOT NULL,
`cicj_interval_sec` int(10) NOT NULL,
`cicj_last_run_at` datetime DEFAULT NULL,
`cicj_next_run_at` datetime DEFAULT NULL,
`cicj_is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
