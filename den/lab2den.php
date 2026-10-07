<html>
<head><title>Вариант 9</title></head>
<body>
<ol>
<?php
for ($i = 1; $i <= 10; $i++) {
    if ($i %2 !== 0) {
        echo "<li>Laptop</li>";
} else {
    echo "<li>Apple:";
    echo "<ol>";
    echo "<li>iPhone</li>";
    echo "<li>iPad</li>";
    echo "</ol>";
    echo "</li>";

    }
}
?>
</ol>
</body>
</html>