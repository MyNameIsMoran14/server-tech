CREATE TABLE `firm` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8mb4;

CREATE TABLE `country` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8mb4;

CREATE TABLE `auto` (
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
