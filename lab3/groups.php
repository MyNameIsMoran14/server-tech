<?php
// Соединение с базой и выборка данных
require_once __DIR__ . '/../lib/db.php';
require_once __DIR__ . '/../lib/layout.php';

$link = init_connection();

$query = "SELECT name FROM `groups` ORDER BY name";
$rs = mysqli_query($link, $query)
    or die("Failed to retrieve data: " . mysqli_error($link));

$groups = array();
while ($row = mysqli_fetch_assoc($rs)) {
    $groups []= $row["name"];
}

mysqli_free_result($rs);
mysqli_close($link);

render_header('Лаба 3 — список групп');
?>
    <h1>Лаба 3. Список групп</h1>
    <p class="subtitle">Демо-пример работы с БД (MySQL + mysqli)</p>

    <ul>
<?php foreach ($groups as $name) { ?>
        <li><?php echo $name; ?></li>
<?php } ?>
    </ul>
<?php
render_footer();
