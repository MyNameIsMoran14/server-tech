<?php
require_once __DIR__ . '/../lib/db.php';
require_once __DIR__ . '/../lib/layout.php';

$link = init_connection();

$query = "SELECT id, name FROM street ORDER BY name";
$rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));

$streets = array();
while ($row = mysqli_fetch_assoc($rs)) {
    $streets []= $row;
}

mysqli_free_result($rs);
mysqli_close($link);

render_header('Лаба 10 — улицы');
?>
    <h1>Лаба 10. Улицы</h1>
    <p class="subtitle">GET + POST вместе: список &rarr; просмотр &rarr; добавление</p>

    <table>
        <tr><th>Название</th><th></th></tr>
<?php foreach ($streets as $street) { ?>
        <tr>
            <td><?php echo htmlspecialchars($street['name']); ?></td>
            <td><a href="view_street.php?id=<?php echo $street['id']; ?>">Просмотр</a></td>
        </tr>
<?php } ?>
    </table>

    <p><a href="add_street.php">+ Добавить улицу</a></p>
<?php
render_footer();
