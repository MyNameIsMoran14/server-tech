<?php
require_once __DIR__ . '/../lib/layout.php';

render_header('Лаба 2 — вариант 10');
?>
    <h1>Лаба 2. Вариант 10</h1>
    <p class="subtitle">Язык PHP — циклы, условия, вывод</p>

    <ol>
<?php
for ($i = 1; $i <= 10; $i++) {
    if ($i % 2 != 0) {
        // нечётный элемент
        echo "        <li><b>Laptop</b></li>\n";
    } else {
        // чётный элемент
        echo "        <li>Apple:\n";
        echo "            <ol>\n";
        echo "                <li><i>iPhone</i></li>\n";
        echo "                <li><i>iPad</i></li>\n";
        echo "            </ol>\n";
        echo "        </li>\n";
    }
}
?>
    </ol>
<?php
render_footer();
