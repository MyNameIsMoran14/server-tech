<?php
require_once __DIR__ . '/../lib/db.php';
require_once __DIR__ . '/../lib/layout.php';

// id улицы приходит через GET при первом заходе и через скрытое
// POST-поле при повторной отправке формы после ошибки валидации
$streetId = $_POST['id'] ?? $_GET['id'] ?? null;
if (empty($streetId)) {
    die("Параметр 'id' не указан");
}
$streetId = intval($streetId);

$link = init_connection();

$query = "SELECT name FROM street WHERE id = $streetId";
$rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));
$street = mysqli_fetch_assoc($rs);
mysqli_free_result($rs);

if (empty($street)) {
    mysqli_close($link);
    die("Улица с id $streetId не найдена");
}

$house = '';
$apartment = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $house = trim($_POST['house'] ?? '');
    $apartment = trim($_POST['apartment'] ?? '');

    if ($house === '' || $apartment === '') {
        $error = 'Номер дома и квартиры не могут быть пустыми';
    } elseif (mb_strlen($house) > 20 || mb_strlen($apartment) > 20) {
        $error = 'Слишком длинное значение (максимум 20 символов)';
    } else {
        $houseEscaped = mysqli_real_escape_string($link, $house);
        $apartmentEscaped = mysqli_real_escape_string($link, $apartment);
        $checkQuery = "SELECT id FROM address WHERE street_id = $streetId"
            . " AND house = '$houseEscaped' AND apartment = '$apartmentEscaped'";
        $rs = mysqli_query($link, $checkQuery) or die("Query failed: " . mysqli_error($link));
        if (mysqli_fetch_assoc($rs)) {
            $error = 'Такой адрес на этой улице уже есть';
        }
        mysqli_free_result($rs);
    }

    if ($error === '') {
        $insertQuery = "INSERT INTO address (street_id, house, apartment) VALUES ("
            . $streetId . ", '" . mysqli_real_escape_string($link, $house) . "', '"
            . mysqli_real_escape_string($link, $apartment) . "')";
        mysqli_query($link, $insertQuery) or die("Query failed: " . mysqli_error($link));
        mysqli_close($link);

        header("Location: view_street.php?id=$streetId");
        die();
    }
}

mysqli_close($link);

render_header('Добавление адреса');
?>
    <h1>Добавление адреса для улицы: <?php echo htmlspecialchars($street['name']); ?></h1>

    <form method="post" action="add_address.php">
        <label for="house">Номер дома</label>
        <input type="text" id="house" name="house" value="<?php echo htmlspecialchars($house); ?>">

        <label for="apartment">Номер квартиры</label>
        <input type="text" id="apartment" name="apartment" value="<?php echo htmlspecialchars($apartment); ?>">

<?php if ($error) { ?>
        <div class="error"><?php echo $error; ?></div>
<?php } ?>

        <input type="hidden" name="id" value="<?php echo $streetId; ?>">
        <button type="submit">Добавить</button>
    </form>
<?php
render_footer('view_street.php?id=' . $streetId, '&larr; назад к улице');
