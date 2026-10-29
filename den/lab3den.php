<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labaratornaya 3</title>
</head>
<body>
<?php
    for ($i = 1; $i <= 10; $i++) {
        if ($i % 2 == 0) $color = "red";
        else $color = "black";
        if ($i % 3== 0) {
            echo "<li><font color = \"$color\"><i>test</i></font></li>";
        } else {
            echo "<li><font color = \"$color\">test</font></li>";
        }
        
    }
?>
</body>
</html>

