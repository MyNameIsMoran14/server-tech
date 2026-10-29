<?php
require_once __DIR__ . '/../lib/db.php';
require_once __DIR__ . '/../lib/layout.php';

$link = init_connection();

// Одним запросом получаем улицы вместе с их адресами
$query = "SELECT street.id AS street_id, street.name AS street_name,"
    . " address.house, address.apartment"
    . " FROM street"
    . " LEFT JOIN address ON address.street_id = street.id"
    . " ORDER BY street.name, address.house, address.apartment";

$rs = mysqli_query($link, $query)
    or die("Failed to retrieve data: " . mysqli_error($link));

$streets = array();
while ($row = mysqli_fetch_assoc($rs)) {
    $streetId = $row["street_id"];

    if (!isset($streets[$streetId])) {
        $streets[$streetId] = array(
            "name" => $row["street_name"],
            "addresses" => array(),
        );
    }

    if ($row["house"] !== null) {
        $streets[$streetId]["addresses"][] = $row["house"] . ", кв. " . $row["apartment"];
    }
}

mysqli_free_result($rs);
mysqli_close($link);

render_header('Лаба 9 — взаимодействие с базой');
?>
    <h1>Лаба 9. Улицы и адреса</h1>
    <p class="subtitle">Полный набор SQL-скриптов: schema / data / flush / drop</p>

    <ul>
<?php foreach ($streets as $street) { ?>
        <li>
            <?php echo $street["name"]; ?>
            <ul>
<?php foreach ($street["addresses"] as $address) { ?>
                <li><?php echo $address; ?></li>
<?php } ?>
            </ul>
            <span class="hint">Всего адресов: <?php echo count($street["addresses"]); ?></span>
        </li>
<?php } ?>
    </ul>
<?php
render_footer();
