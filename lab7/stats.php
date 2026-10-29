<?php
require_once __DIR__ . '/../lib/db.php';
require_once __DIR__ . '/../lib/layout.php';

$link = init_connection();

$query = "SELECT lab7_users.login, lab7_visits.page_name, COUNT(*) AS cnt"
    . " FROM lab7_visits"
    . " JOIN lab7_users ON lab7_users.id = lab7_visits.user_id"
    . " GROUP BY lab7_visits.user_id, lab7_visits.page_name"
    . " ORDER BY lab7_users.login";

$rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));

$stats = array();
while ($row = mysqli_fetch_assoc($rs)) {
    $stats []= $row;
}

mysqli_free_result($rs);
mysqli_close($link);

render_header('Лаба 7 — статистика');
?>
    <h1>Статистика посещений</h1>
    <ol>
<?php foreach ($stats as $row) { ?>
        <li>
            Пользователь <?php echo htmlspecialchars($row['login']); ?>
            заходил на страницу <?php echo htmlspecialchars($row['page_name']); ?>
            <?php echo $row['cnt']; ?> раз
        </li>
<?php } ?>
<?php if (empty($stats)) { ?>
        <li class="hint">Пока нет данных — зайдите на страницу счётчика хотя бы раз.</li>
<?php } ?>
    </ol>
<?php
render_footer('login.php', '&larr; к авторизации');
