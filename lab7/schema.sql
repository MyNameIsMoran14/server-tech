CREATE TABLE IF NOT EXISTS `lab7_users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `login` VARCHAR(50) NOT NULL,
    `password_hash` VARCHAR(32) NOT NULL,
    `salt` VARCHAR(8) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `login_unique` (`login`)
) ENGINE = InnoDB CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS `lab7_visits` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `page_name` VARCHAR(100) NOT NULL,
    `visit_time` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `lab7_users` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET = utf8mb4;
