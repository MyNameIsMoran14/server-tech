<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Labaratornaya 6 — страны</title>
</head>
<body>
<?php
$link = mysqli_connect("localhost", "root", "", "den_db")
    or die("Failed to connect: " . mysqli_connect_error());
mysqli_set_charset($link, "utf8mb4");

$query = "SELECT country.id AS country_id, country.name AS country_name, hotel.name AS hotel_name"
    . " FROM country"
    . " LEFT JOIN hotel ON hotel.country_id = country.id"
    . " ORDER BY country.name, hotel.name";

$rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));

$countries = array();
while ($row = mysqli_fetch_assoc($rs)) {
    $id = $row["country_id"];
    if (!isset($countries[$id])) {
        $countries[$id] = array("name" => $row["country_name"], "hotels" => array());
    }
    if ($row["hotel_name"] !== null) {
        $countries[$id]["hotels"][] = $row["hotel_name"];
    }
}

mysqli_free_result($rs);
mysqli_close($link);
?>
<table border="1">
<tr><th>Страна</th><th>Отели</th><th></th></tr>
<?php foreach ($countries as $id => $country) { ?>
<tr>
    <td><?php echo $country["name"]; ?></td>
    <td><?php echo empty($country["hotels"]) ? "нет отелей" : implode(", ", $country["hotels"]); ?></td>
    <td><a href="lab6den_add.php?countryid=<?php echo $id; ?>">Добавить отель</a></td>
</tr>
<?php } ?>
</table>
</body>
</html>
