<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Labaratornaya 6 — добавление отеля</title>
</head>
<body>
<?php
$countryId = $_POST['countryid'] ?? $_GET['countryid'] ?? null;
if (empty($countryId)) {
    die("The parameter 'countryid' is not specified");
}
$countryId = intval($countryId);

$link = mysqli_connect("localhost", "root", "", "den_db")
    or die("Failed to connect: " . mysqli_connect_error());
mysqli_set_charset($link, "utf8mb4");

$query = "SELECT name FROM country WHERE id = " . $countryId;
$rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));
$country = mysqli_fetch_assoc($rs);
mysqli_free_result($rs);

if (empty($country)) {
    mysqli_close($link);
    die("The country with id $countryId does not exist");
}

$query = "SELECT id, name FROM firm ORDER BY name";
$rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));
$firms = array();
while ($row = mysqli_fetch_assoc($rs)) {
    $firms []= $row;
}
mysqli_free_result($rs);

$name = '';
$price = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $firmId = intval($_POST['firmid'] ?? 0);

    if ($name === '') {
        $error = 'Название не может быть пустым';
    } elseif (!ctype_digit($price) || intval($price) <= 0) {
        $error = 'Стоимость должна быть положительным целым числом';
    } else {
        $insertQuery = "INSERT INTO hotel (name, price, country_id, firm_id) VALUES ('"
            . mysqli_real_escape_string($link, $name) . "', " . intval($price) . ", "
            . $countryId . ", " . $firmId . ")";
        mysqli_query($link, $insertQuery) or die("Query failed: " . mysqli_error($link));
        mysqli_close($link);

        header("Location: lab6den_countries.php");
        die();
    }
}

mysqli_close($link);
?>
<h1>Добавление отеля для страны: <?php echo $country["name"]; ?></h1>
<form method="post" action="lab6den_add.php">
    Название отеля: <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"><br>
    Стоимость: <input type="text" name="price" value="<?php echo htmlspecialchars($price); ?>"><br>
    Фирма:
    <select name="firmid">
<?php foreach ($firms as $firm) { ?>
        <option value="<?php echo $firm['id']; ?>"><?php echo $firm['name']; ?></option>
<?php } ?>
    </select><br>
<?php if ($error) { ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php } ?>
    <input type="hidden" name="countryid" value="<?php echo $countryId; ?>">
    <input type="submit" value="Отправить">
</form>
</body>
</html>
