CREATE TABLE IF NOT EXISTS `firm` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS `country` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS `hotel` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL,
    `price` INT(11) NOT NULL,
    `country_id` INT(11) NOT NULL,
    `firm_id` INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`firm_id`) REFERENCES `firm` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS `auto` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL,
    `year` INT(11) NOT NULL,
    `power` INT(11) NOT NULL,
    `firm_id` INT(11) NOT NULL,
    `country_id` INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`firm_id`) REFERENCES `firm` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `login` VARCHAR(50) NOT NULL,
    `password_hash` VARCHAR(32) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `login_unique` (`login`)
) ENGINE = InnoDB CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS `visits` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `page_name` VARCHAR(100) NOT NULL,
    `visit_time` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET = utf8mb4;
