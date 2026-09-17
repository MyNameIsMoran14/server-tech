<?php
require_once __DIR__ . '/../lib/db.php';
require_once __DIR__ . '/../lib/layout.php';

// Ключ страны обязателен и должен приходить как при GET (первый заход),
// так и при POST (повторная отправка формы после ошибки валидации)
$countryId = $_POST['countryid'] ?? $_GET['countryid'] ?? null;
if (empty($countryId)) {
    die("The parameter 'countryid' is not specified");
}
$countryId = intval($countryId);

$link = init_connection();

// Проверяем контракт: такая страна действительно существует
$query = "SELECT name FROM `country` WHERE id = " . $countryId;
$rs = mysqli_query($link, $query)
    or die("Failed to select country: " . mysqli_error($link));
$country = mysqli_fetch_assoc($rs);
mysqli_free_result($rs);

if (empty($country)) {
    mysqli_close($link);
    die("The country with id $countryId does not exist");
}

// Список фирм для выпадающего списка
$query = "SELECT id, name FROM `firm` ORDER BY name";
$rs = mysqli_query($link, $query)
    or die("Failed to select firms: " . mysqli_error($link));
$firms = array();
while ($row = mysqli_fetch_assoc($rs)) {
    $firms []= $row;
}
mysqli_free_result($rs);

// Значения полей формы по умолчанию (для повторного отображения после ошибки)
$name = '';
$price = '';
$selectedFirmId = $firms[0]['id'] ?? null;
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $selectedFirmId = intval($_POST['firmid'] ?? 0);

    if ($name === '') {
        $errors['name'] = 'Поле не может быть пустым';
    } elseif (mb_strlen($name) > 150) {
        $errors['name'] = 'Превышена допустимая длина (150 символов)';
    }

    if ($price === '') {
        $errors['price'] = 'Поле не может быть пустым';
    } elseif (!ctype_digit($price) || intval($price) <= 0) {
        $errors['price'] = 'Стоимость должна быть положительным целым числом';
    }

    if (empty($errors)) {
        $insertQuery = "INSERT INTO `hotel` (name, price, country_id, firm_id)"
            . " VALUES ('" . mysqli_real_escape_string($link, $name) . "', "
            . intval($price) . ", " . $countryId . ", " . $selectedFirmId . ")";

        mysqli_query($link, $insertQuery)
            or die("Failed to add hotel: " . mysqli_error($link));

        mysqli_close($link);

        header("Location: countries.php");
        die();
    }
}

mysqli_close($link);

render_header('Добавление отеля');
?>
    <h1>Добавление отеля для страны: <?php echo $country["name"]; ?></h1>

    <form method="post" action="add_hotel.php">
        <label for="name">Название отеля</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
<?php if (isset($errors['name'])) { ?>
        <div class="error"><?php echo $errors['name']; ?></div>
<?php } ?>

        <label for="price">Стоимость (в сутки)</label>
        <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>">
<?php if (isset($errors['price'])) { ?>
        <div class="error"><?php echo $errors['price']; ?></div>
<?php } ?>

        <label for="firmid">Фирма-владелец</label>
        <select id="firmid" name="firmid">
<?php foreach ($firms as $firm) { ?>
            <option value="<?php echo $firm['id']; ?>" <?php echo $firm['id'] == $selectedFirmId ? 'selected' : ''; ?>>
                <?php echo $firm['name']; ?>
            </option>
<?php } ?>
        </select>

        <input type="hidden" name="countryid" value="<?php echo $countryId; ?>">

        <button type="submit">Добавить</button>
    </form>
<?php
render_footer('countries.php', '&larr; назад к странам');
