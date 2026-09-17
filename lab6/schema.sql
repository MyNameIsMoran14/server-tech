-- Таблицы firm и country уже созданы в лабе 5 (schema.sql) и переиспользуются здесь
CREATE TABLE `hotel` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL,
    `price` INT(11) NOT NULL,
    `country_id` INT(11) NOT NULL,
    `firm_id` INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`firm_id`) REFERENCES `firm` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET = utf8mb4;
