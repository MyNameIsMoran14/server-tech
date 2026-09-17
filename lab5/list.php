<?php
require_once __DIR__ . '/../lib/db.php';
require_once __DIR__ . '/../lib/layout.php';

$link = init_connection();

$query = "SELECT id, name FROM `auto` ORDER BY name";
$rs = mysqli_query($link, $query)
    or die("Failed to retrieve data: " . mysqli_error($link));

$autos = array();
while ($row = mysqli_fetch_assoc($rs)) {
    $autos []= $row;
}

mysqli_free_result($rs);
mysqli_close($link);

render_header('Лаба 5 — каталог автомобилей');
?>
    <h1>Лаба 5. Каталог автомобилей</h1>
    <p class="subtitle">GET-запросы: список &rarr; детальная страница</p>

    <ul>
<?php foreach ($autos as $auto) { ?>
        <li>
            <a href="show.php?id=<?php echo $auto["id"]; ?>"><?php echo $auto["name"]; ?></a>
        </li>
<?php } ?>
    </ul>
<?php
render_footer();
