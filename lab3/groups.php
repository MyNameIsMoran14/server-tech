<?php
// Соединение с базой и выборка данных
require_once __DIR__ . '/lib/db.php';

$link = init_connection();

$query = "SELECT name FROM `groups` ORDER BY name";
$rs = mysqli_query($link, $query)
    or die("Failed to retrieve data: " . mysqli_error($link));

$groups = array();
while ($row = mysqli_fetch_assoc($rs)) {
    $groups []= $row["name"];
}

mysqli_free_result($rs);
mysqli_close($link);
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Список групп</title>
</head>
<body>
    <ul>
<?php foreach ($groups as $name) { ?>
        <li><?php echo $name; ?></li>
<?php } ?>
    </ul>
</body>
</html>
