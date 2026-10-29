-- Таблицы street/address уже созданы в лабе 4 (IF NOT EXISTS — безопасно
-- выполнить повторно, если база разворачивается с нуля на новом месте)
CREATE TABLE IF NOT EXISTS `street` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS `address` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `street_id` INT(11) NOT NULL,
    `house` VARCHAR(20) NOT NULL,
    `apartment` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`street_id`) REFERENCES `street` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET = utf8mb4;
