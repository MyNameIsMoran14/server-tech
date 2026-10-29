INSERT INTO `firm` (`id`, `name`) VALUES
    (1, 'Ford'),
    (2, 'Mercedes');

INSERT INTO `country` (`id`, `name`) VALUES
    (1, 'USA'),
    (2, 'Germany');

INSERT INTO `hotel` (`name`, `price`, `country_id`, `firm_id`) VALUES
    ('Grand Plaza', 120, 1, 1),
    ('Ocean View', 95, 1, 2),
    ('Alpen Resort', 150, 2, 2);

INSERT INTO `auto` (`name`, `year`, `power`, `firm_id`, `country_id`) VALUES
    ('Focus', 2010, 110, 1, 1),
    ('Mustang', 2018, 460, 1, 1),
    ('C-Class', 2015, 190, 2, 2),
    ('S-Class', 2020, 320, 2, 2);

-- Тестовый пользователь: логин "student", пароль "qwerty123" (MD5 без соли)
INSERT INTO `users` (`login`, `password_hash`) VALUES
    ('stud', MD5('qwerty123'));
