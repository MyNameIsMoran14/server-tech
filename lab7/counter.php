<?php
require_once __DIR__ . '/lib/auth.php';
require_once __DIR__ . '/../lib/layout.php';

require_login();
$user = current_user();

$link = init_connection();
$pageName = 'counter.php';

// Сколько раз пользователь уже заходил на эту страницу до текущего захода
$query = "SELECT COUNT(*) AS cnt FROM lab7_visits"
    . " WHERE user_id = " . intval($user['id'])
    . " AND page_name = '" . mysqli_real_escape_string($link, $pageName) . "'";
$rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));
$row = mysqli_fetch_assoc($rs);
mysqli_free_result($rs);
$previousCount = (int) $row['cnt'];

// Фиксируем текущий заход
$insertQuery = "INSERT INTO lab7_visits (user_id, page_name, visit_time) VALUES ("
    . intval($user['id']) . ", '" . mysqli_real_escape_string($link, $pageName) . "', NOW())";
mysqli_query($link, $insertQuery) or die("Query failed: " . mysqli_error($link));

mysqli_close($link);

$count = $previousCount + 1;

render_header('Лаба 7 — счётчик посещений');
?>
    <h1>Привет, <?php echo htmlspecialchars($user['login']); ?>!</h1>
    <p>Вы посетили данную страницу <?php echo $count; ?> раз.</p>
    <p>
        <a href="stats.php">Статистика по всем пользователям</a>
        &middot;
        <a href="logout.php">Выйти</a>
    </p>
<?php
render_footer();
