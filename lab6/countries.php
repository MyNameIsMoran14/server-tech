<?php
require_once __DIR__ . '/../lib/db.php';
require_once __DIR__ . '/../lib/layout.php';

$link = init_connection();

// Одним запросом: страна -> фирма -> количество отелей этой фирмы в этой стране
$query = "SELECT country.id AS country_id, country.name AS country_name,"
    . " firm.id AS firm_id, firm.name AS firm_name, COUNT(hotel.id) AS cnt"
    . " FROM `country`"
    . " LEFT JOIN `hotel` ON hotel.country_id = country.id"
    . " LEFT JOIN `firm` ON firm.id = hotel.firm_id"
    . " GROUP BY country.id, firm.id"
    . " ORDER BY country.name, firm.name";

$rs = mysqli_query($link, $query)
    or die("Failed to retrieve data: " . mysqli_error($link));

// Группируем плоскую выборку по странам
$countries = array();
while ($row = mysqli_fetch_assoc($rs)) {
    $countryId = $row["country_id"];

    if (!isset($countries[$countryId])) {
        $countries[$countryId] = array(
            "name" => $row["country_name"],
            "firms" => array(),
        );
    }

    if ($row["firm_name"] !== null) {
        $countries[$countryId]["firms"][] = $row["firm_name"] . " (" . $row["cnt"] . ")";
    }
}

mysqli_free_result($rs);
mysqli_close($link);

render_header('Лаба 6 — отели по странам');
?>
    <h1>Лаба 6. Отели по странам</h1>
    <p class="subtitle">POST-запросы: добавление отеля с валидацией</p>

    <table>
        <tr>
            <th>Страна</th>
            <th>Фирмы (кол-во отелей)</th>
            <th></th>
        </tr>
<?php foreach ($countries as $countryId => $country) { ?>
        <tr>
            <td><?php echo $country["name"]; ?></td>
            <td>
<?php echo empty($country["firms"]) ? '<span class="hint">нет отелей</span>' : implode(", ", $country["firms"]); ?>
            </td>
            <td><a href="add_hotel.php?countryid=<?php echo $countryId; ?>">+ добавить отель</a></td>
        </tr>
<?php } ?>
    </table>
<?php
render_footer();
