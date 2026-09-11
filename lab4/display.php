<?php
// Соединение с базой и выборка данных
require_once __DIR__ . '/lib/db.php';

$link = init_connection();

// Одним запросом получаем улицы вместе с их адресами (LEFT JOIN,
// чтобы улицы без адресов тоже попали в выборку)
$query = "SELECT street.id AS street_id, street.name AS street_name,"
    . " address.house, address.apartment"
    . " FROM street"
    . " LEFT JOIN address ON address.street_id = street.id"
    . " ORDER BY street.name, address.house, address.apartment";

$rs = mysqli_query($link, $query)
    or die("Failed to retrieve data: " . mysqli_error($link));

// Группируем плоскую выборку в двухуровневую структуру:
// улица -> список её адресов
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
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Улицы и адреса</title>
</head>
<body>
    <ul>
<?php foreach ($streets as $street) { ?>
        <li>
            <?php echo $street["name"]; ?>
            <ul>
<?php foreach ($street["addresses"] as $address) { ?>
                <li><?php echo $address; ?></li>
<?php } ?>
            </ul>
            Всего адресов: <?php echo count($street["addresses"]); ?>
        </li>
<?php } ?>
    </ul>
</body>
</html>
