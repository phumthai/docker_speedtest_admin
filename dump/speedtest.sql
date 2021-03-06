CREATE TABLE IF NOT EXISTS `speedtest_users` (
	`id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ispinfo` text,
    `extra` text,
    `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `ip` text NOT NULL,
    `ua` text NOT NULL,
    `lang` text NOT NULL,
    `dl` text,
    `ul` text,
    `ping` text,
    `jitter` text,
    `log` longtext,
    `userid` text NULL,
    `subnet` text NULL,
    `apname` text,
    `mac` text,
    `testcode` text,
    `utilize24` text,
    `utilize5` text,
    `clientnum24` text,
    `clientnum5` text
)
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `snmp` (
	`id` text,
    `apname` text,
    `utilize24` text,
    `utilize5` text,
    `clientnum24` text,
    `clientnum5` text
)
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;