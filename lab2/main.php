<html>
<head><title>Вариант 10</title></head>
<body>
<ol>
<?php
for ($i = 1; $i <= 10; $i++) {
    if ($i % 2 != 0) {
        // нечётный элемент
        echo "<li><b>Laptop</b></li>\n";
    } else {
        // чётный элемент
        echo "<li>Apple:";
        echo "<ol>";
        echo "<li><i>iPhone</i></li>";
        echo "<li><i>iPad</i></li>";
        echo "</ol>";
        echo "</li>\n";
    }
}
?>
</ol>
</body>
</html>
