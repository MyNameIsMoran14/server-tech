INSERT INTO `street` (`id`, `name`) VALUES
    (1, 'Ленина'),
    (2, 'Мира'),
    (3, 'Гагарина');

INSERT INTO `address` (`street_id`, `house`, `apartment`) VALUES
    (1, '10', '5'),
    (1, '10', '12'),
    (1, '25', '3'),
    (2, '7', '1'),
    (2, '7', '2'),
    (3, '1', '100');
