<?php

require_once __DIR__ . '/../../lib/db.php';

function ensure_session() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function current_user() {
    ensure_session();
    return $_SESSION['lab7_user'] ?? null;
}

// Если пользователь не авторизован, переводим его на страницу входа
function require_login() {
    if (current_user() === null) {
        header('Location: login.php');
        die();
    }
}

// Проверяет логин/пароль по базе (MD5 с солью) и, если верны,
// запускает сессию для этого пользователя
function attempt_login($login, $password) {
    $link = init_connection();

    $loginEscaped = mysqli_real_escape_string($link, $login);
    $query = "SELECT id, login, password_hash, salt FROM lab7_users WHERE login = '$loginEscaped'";
    $rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));
    $user = mysqli_fetch_assoc($rs);

    mysqli_free_result($rs);
    mysqli_close($link);

    if (empty($user)) {
        return false;
    }

    $hash = md5($user['salt'] . $password);
    if ($hash !== $user['password_hash']) {
        return false;
    }

    ensure_session();
    $_SESSION['lab7_user'] = array('id' => $user['id'], 'login' => $user['login']);

    return true;
}

function logout_user() {
    ensure_session();
    $_SESSION = array();
    session_destroy();
}
