<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Labaratornaya 7 — статистика</title>
</head>
<body>
<?php
$link = mysqli_connect("localhost", "root", "", "den_db")
    or die("Failed to connect: " . mysqli_connect_error());
mysqli_set_charset($link, "utf8mb4");

$query = "SELECT users.login, visits.page_name, COUNT(*) AS cnt"
    . " FROM visits"
    . " JOIN users ON users.id = visits.user_id"
    . " GROUP BY visits.user_id, visits.page_name"
    . " ORDER BY users.login";

$rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));

echo "<ol>";
while ($row = mysqli_fetch_assoc($rs)) {
    echo "<li>Пользователь " . $row["login"] . " заходил на страницу "
        . $row["page_name"] . " " . $row["cnt"] . " раз</li>";
}
echo "</ol>";

mysqli_free_result($rs);
mysqli_close($link);
?>
</body>
</html>
