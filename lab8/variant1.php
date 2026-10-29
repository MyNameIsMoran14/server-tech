<?php
require_once __DIR__ . '/../lib/layout.php';

render_header('Лаба 8 ');
?>
    <h1>Лаба 8.</h1>
    <p class="subtitle">Генерация таблицы циклами, без БД</p>

    <table>
        <tr>
<?php for ($i = 1; $i <= 5; $i++) { ?>
            <th>Header <?php echo $i; ?></th>
<?php } ?>
        </tr>
<?php for ($row = 1; $row <= 10; $row++) {
    $isEven = $row % 2 === 0;
    $isItalic = $row % 3 === 0;
    $rowStyle = $isEven ? ' style="background-color: Aqua;"' : '';
    $openTag = $isItalic ? '<i>' : '';
    $closeTag = $isItalic ? '</i>' : '';
?>
        <tr<?php echo $rowStyle; ?>>
            <td><?php echo $openTag . $row . $closeTag; ?></td>
<?php for ($col = 2; $col <= 5; $col++) { ?>
            <td><?php echo $openTag . '#' . $closeTag; ?></td>
<?php } ?>
        </tr>
<?php } ?>
    </table>
<?php
render_footer();
