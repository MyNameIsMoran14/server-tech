<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Labaratornaya 4</title>
</head>
<body>
<?php
$link = mysqli_connect("localhost", "root", "", "den_db")
    or die("Failed to connect: " . mysqli_connect_error());
mysqli_set_charset($link, "utf8mb4");

$query = "SELECT country.name AS country_name, hotel.price, hotel.name AS hotel_name"
    . " FROM hotel"
    . " JOIN country ON country.id = hotel.country_id"
    . " ORDER BY country.name, hotel.price, hotel.name";

$rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));

echo "<ul>";
while ($row = mysqli_fetch_assoc($rs)) {
    echo "<li>Страна – " . $row["country_name"]
        . ". Стоимость в евро – " . $row["price"]
        . ". Название отеля – " . $row["hotel_name"] . ".</li>";
}
echo "</ul>";

mysqli_free_result($rs);
mysqli_close($link);
?>
</body>
</html>
