-- Тестовый пользователь: логин "student", пароль "qwerty123"
-- password_hash = md5(salt . password)
INSERT INTO `lab7_users` (`login`, `password_hash`, `salt`) VALUES
    ('student', '45e752577f1f0a83a2e360c82051b6b1', 'aB3dE9fK');
