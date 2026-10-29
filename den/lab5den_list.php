<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Labaratornaya 5</title>
</head>
<body>
<table border="1">
<tr><th>Название</th><th>Просмотр</th></tr>
<?php
$link = mysqli_connect("localhost", "root", "", "den_db")
    or die("Failed to connect: " . mysqli_connect_error());
mysqli_set_charset($link, "utf8mb4");

$query = "SELECT id, name FROM auto ORDER BY name";
$rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));

while ($row = mysqli_fetch_assoc($rs)) {
    echo "<tr><td>" . $row["name"] . "</td>"
        . "<td><a href=\"lab5den_show.php?id=" . $row["id"] . "\">Просмотр</a></td></tr>";
}

mysqli_free_result($rs);
mysqli_close($link);
?>
</table>
</body>
</html>
