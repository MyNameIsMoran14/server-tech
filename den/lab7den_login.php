<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Labaratornaya 7 — вход</title>
</head>
<body>
<?php
session_start();

$error = '';
$login = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    $link = mysqli_connect("localhost", "root", "", "den_db")
        or die("Failed to connect: " . mysqli_connect_error());
    mysqli_set_charset($link, "utf8mb4");

    $loginEscaped = mysqli_real_escape_string($link, $login);
    $query = "SELECT id, login, password_hash FROM users WHERE login = '$loginEscaped'";
    $rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));
    $user = mysqli_fetch_assoc($rs);
    mysqli_free_result($rs);
    mysqli_close($link);

    if (!empty($user) && md5($password) === $user['password_hash']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['login'] = $user['login'];
        header("Location: lab7den_counter.php");
        die();
    } else {
        $error = 'Неверный логин или пароль';
    }
}
?>
<h1>Вход</h1>
<form method="post" action="lab7den_login.php">
    Логин: <input type="text" name="login" value="<?php echo htmlspecialchars($login); ?>"><br>
    Пароль: <input type="password" name="password"><br>
<?php if ($error) { ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php } ?>
    <input type="submit" value="Войти">
</form>
<p>Тестовый пользователь: stud / qwerty123</p>
</body>
</html>
