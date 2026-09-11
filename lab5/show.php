<?php
// Проверяем контракт: страница должна получить непустой параметр id
$id = $_GET['id'] ?? null;
if (empty($id)) {
    die("The required param 'id' not specified");
}

require_once __DIR__ . '/lib/db.php';

$link = init_connection();

$query = "SELECT `auto`.name, `auto`.year, `auto`.power,"
    . " firm.name AS firm_name, country.name AS country_name"
    . " FROM `auto`"
    . " JOIN `firm` ON `auto`.firm_id = `firm`.id"
    . " JOIN `country` ON `auto`.country_id = `country`.id"
    . " WHERE `auto`.id = " . intval($id);

$rs = mysqli_query($link, $query)
    or die("Failed to retrieve data: " . mysqli_error($link));

$auto = mysqli_fetch_assoc($rs);

mysqli_free_result($rs);
mysqli_close($link);

// Проверяем, что запись с таким ключом действительно существует
if (empty($auto)) {
    die("The record with key $id does not exist");
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Детальные сведения</title>
</head>
<body>
    <h1>Детальные сведения</h1>
    <table border="1">
        <tr><th>Параметр</th><th>Значение</th></tr>
        <tr><td>Название</td><td><?php echo $auto["name"]; ?></td></tr>
        <tr><td>Год выпуска</td><td><?php echo $auto["year"]; ?></td></tr>
        <tr><td>Мощность</td><td><?php echo $auto["power"]; ?> л.с.</td></tr>
        <tr><td>Фирма</td><td><?php echo $auto["firm_name"]; ?></td></tr>
        <tr><td>Страна</td><td><?php echo $auto["country_name"]; ?></td></tr>
    </table>
    <br/>
    <a href="list.php">Назад к списку</a>
</body>
</html>
