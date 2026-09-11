<html>
<head>
    <title>Вариант 10</title>
</head>
<body>
<ul>
<?php
$months = [
    1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля',
    5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа',
    9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря',
];

$dayOffset = 0;

for ($i = 1; $i <= 10; $i++) {
    if ($i % 2 == 0) {
        $timestamp = strtotime("+{$dayOffset} day");
        $formatOne = date('d-m-Y', $timestamp);
        $day = date('j', $timestamp);
        $month = $months[(int) date('n', $timestamp)];
        $year = date('Y', $timestamp);

        echo "<li>test<ol>";
        echo "<li>{$formatOne}.</li>";
        echo "<li>{$day} {$month} {$year}.</li>";
        echo "</ol></li>\n";

        $dayOffset++;
    } else {
        echo "<li>test</li>\n";
    }
}
?>
</ul>
</body>
</html>
