<?php
require_once __DIR__ . '/../lib/db.php';
require_once __DIR__ . '/../lib/layout.php';

$id = $_GET['id'] ?? null;
if (empty($id)) {
    die("Параметр 'id' не указан");
}
$id = intval($id);

$link = init_connection();

$query = "SELECT name FROM street WHERE id = $id";
$rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));
$street = mysqli_fetch_assoc($rs);
mysqli_free_result($rs);

if (empty($street)) {
    mysqli_close($link);
    die("Улица с id $id не найдена");
}

$query = "SELECT house, apartment FROM address WHERE street_id = $id ORDER BY house, apartment";
$rs = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));

$addresses = array();
while ($row = mysqli_fetch_assoc($rs)) {
    $addresses []= $row;
}

mysqli_free_result($rs);
mysqli_close($link);

render_header('Улица: ' . $street['name']);
?>
    <h1><?php echo htmlspecialchars($street['name']); ?></h1>

    <ul>
<?php foreach ($addresses as $address) { ?>
        <li>д. <?php echo htmlspecialchars($address['house']); ?>, кв. <?php echo htmlspecialchars($address['apartment']); ?></li>
<?php } ?>
<?php if (empty($addresses)) { ?>
        <li class="hint">Пока нет адресов</li>
<?php } ?>
    </ul>

    <p><a href="add_address.php?id=<?php echo $id; ?>">+ Добавить адрес</a></p>
<?php
render_footer('streets.php', '&larr; назад к списку улиц');
