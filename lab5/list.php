<?php
require_once __DIR__ . '/../lib/db.php';

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
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Список автомобилей</title>
</head>
<body>
    <ul>
<?php foreach ($autos as $auto) { ?>
        <li>
            <a href="show.php?id=<?php echo $auto["id"]; ?>"><?php echo $auto["name"]; ?></a>
        </li>
<?php } ?>
    </ul>
</body>
</html>
