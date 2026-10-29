<?php
require_once __DIR__ . '/../lib/db.php';
require_once __DIR__ . '/../lib/layout.php';

$name = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');

    $link = init_connection();

    if ($name === '') {
        $error = 'Название не может быть пустым';
    } elseif (mb_strlen($name) > 150) {
        $error = 'Название слишком длинное (максимум 150 символов)';
    } else {
        $nameEscaped = mysqli_real_escape_string($link, $name);
        $checkQuery = "SELECT id FROM street WHERE name = '$nameEscaped'";
        $rs = mysqli_query($link, $checkQuery) or die("Query failed: " . mysqli_error($link));
        if (mysqli_fetch_assoc($rs)) {
            $error = 'Такая улица уже есть';
        }
        mysqli_free_result($rs);
    }

    if ($error === '') {
        $insertQuery = "INSERT INTO street (name) VALUES ('"
            . mysqli_real_escape_string($link, $name) . "')";
        mysqli_query($link, $insertQuery) or die("Query failed: " . mysqli_error($link));
        $newId = mysqli_insert_id($link);
        mysqli_close($link);

        header("Location: view_street.php?id=$newId");
        die();
    }

    mysqli_close($link);
}

render_header('Лаба 10 — добавление улицы');
?>
    <h1>Добавление новой улицы</h1>

    <form method="post" action="add_street.php">
        <label for="name">Название улицы</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
<?php if ($error) { ?>
        <div class="error"><?php echo $error; ?></div>
<?php } ?>
        <button type="submit">Добавить</button>
    </form>
<?php
render_footer('streets.php', '&larr; назад');
