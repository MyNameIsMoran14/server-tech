<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Labaratornaya 5 — детальные сведения</title>
</head>
<body>
<?php
$id = $_GET['id'] ?? null;
if (empty($id)) {
    die("The required param 'id' not specified");
}
$id = intval($id);

$link = mysqli_connect("localhost", "root", "", "den_db")
    or die("Failed to connect: " . mysqli_connect_error());
mysqli_set_charset($link, "utf8mb4");

$query = "SELECT auto.name, auto.year, auto.power, firm.name AS firm_name, country.name AS country_name"
    . " FROM auto"
    . " JOIN firm ON firm.id = auto.firm_id"
    . " JOIN country ON country.id = auto.country_id"
    . " WHERE auto.id = " . $id;

$rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));
$auto = mysqli_fetch_assoc($rs);
mysqli_free_result($rs);
mysqli_close($link);

if (empty($auto)) {
    die("The record with key $id does not exist");
}
?>
<h1>Детальные сведения</h1>
<ul>
    <li>Название - <?php echo $auto["name"]; ?>.</li>
    <li>Год выпуска - <?php echo $auto["year"]; ?>.</li>
    <li>Мощность двигателя - <?php echo $auto["power"]; ?> л.с.</li>
    <li>Фирма - <?php echo $auto["firm_name"]; ?>.</li>
    <li>Страна - <?php echo $auto["country_name"]; ?>.</li>
</ul>
</body>
</html>
