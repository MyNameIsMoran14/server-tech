<?php
require_once __DIR__ . '/lib/auth.php';
require_once __DIR__ . '/../lib/layout.php';

$error = '';
$login = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($login === '' || $password === '') {
        $error = 'Заполните логин и пароль';
    } elseif (attempt_login($login, $password)) {
        header('Location: counter.php');
        die();
    } else {
        $error = 'Неверный логин или пароль';
    }
}

render_header('Лаба 7 — вход');
?>
    <h1>Вход</h1>
    <p class="subtitle">Сессии: авторизация и счётчик посещений</p>

    <form method="post" action="login.php">
        <label for="login">Логин</label>
        <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($login); ?>">

        <label for="password">Пароль</label>
        <input type="password" id="password" name="password">

<?php if ($error) { ?>
        <div class="error"><?php echo $error; ?></div>
<?php } ?>

        <button type="submit">Войти</button>
    </form>

    <p class="hint">Тестовый пользователь: <b>student</b> / <b>qwerty123</b></p>
<?php
render_footer();
