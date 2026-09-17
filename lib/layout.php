<?php

function render_header($title) {
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/assets/style.css">
    <title><?php echo $title; ?></title>
</head>
<body>
    <div class="site-card">
        <a class="site-logo" href="/index.php">&#9670; учебный сайт</a>
<?php
}

function render_footer($backHref = '/index.php', $backText = '&larr; на главную') {
    ?>
        <a class="back-link" href="<?php echo $backHref; ?>"><?php echo $backText; ?></a>
    </div>
</body>
</html>
<?php
}
