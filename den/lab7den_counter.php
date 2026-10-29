<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Labaratornaya 7 — счётчик</title>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: lab7den_login.php");
    die();
}

$userId = $_SESSION['user_id'];
$pageName = 'lab7den_counter.php';

$link = mysqli_connect("localhost", "root", "", "den_db")
    or die("Failed to connect: " . mysqli_connect_error());
mysqli_set_charset($link, "utf8mb4");

$query = "SELECT COUNT(*) AS cnt FROM visits WHERE user_id = " . intval($userId)
    . " AND page_name = '" . mysqli_real_escape_string($link, $pageName) . "'";
$rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));
$row = mysqli_fetch_assoc($rs);
mysqli_free_result($rs);
$previousCount = (int) $row['cnt'];

$insertQuery = "INSERT INTO visits (user_id, page_name, visit_time) VALUES ("
    . intval($userId) . ", '" . mysqli_real_escape_string($link, $pageName) . "', NOW())";
mysqli_query($link, $insertQuery) or die("Query failed: " . mysqli_error($link));
mysqli_close($link);

$count = $previousCount + 1;
?>
<p>Привет, <?php echo htmlspecialchars($_SESSION['login']); ?>!</p>
<p>Вы посетили данную страницу <?php echo $count; ?> раз.</p>
<p><a href="lab7den_stats.php">Статистика по всем пользователям</a></p>
</body>
</html>
