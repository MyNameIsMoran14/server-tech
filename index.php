<?php
$labs = array(
    array('num' => '01', 'title' => 'HTML', 'desc' => 'теги, списки, ссылки', 'href' => '/lab1/variant10.html', 'tag' => 'статика'),
    array('num' => '02', 'title' => 'PHP', 'desc' => 'циклы, условия, вывод', 'href' => '/lab2/variant10.php', 'tag' => 'без БД'),
    array('num' => '03', 'title' => 'Знакомство с AMP', 'desc' => 'первое подключение к БД', 'href' => '/lab3/groups.php', 'tag' => 'БД, демо'),
    array('num' => '04', 'title' => 'Базы данных', 'desc' => 'улицы и адреса', 'href' => '/lab4/display.php', 'tag' => 'MySQL'),
    array('num' => '05', 'title' => 'GET-запросы', 'desc' => 'каталог автомобилей', 'href' => '/lab5/list.php', 'tag' => 'список + деталка'),
    array('num' => '06', 'title' => 'POST-запросы', 'desc' => 'отели по странам', 'href' => '/lab6/countries.php', 'tag' => 'форма + валидация'),
);

$done = count($labs);
$total = 15;
$progress = round($done / $total * 100);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/assets/landing.css">
    <title>Учебный сайт — веб-программирование</title>
</head>
<body>
    <nav class="nav">
        <a class="nav-logo" href="/index.php">&#9670; учебный сайт</a>
        <a class="nav-link" href="#labs">лабы &darr;</a>
    </nav>

    <section class="hero">
        <pre id="ascii-cloud-left" class="ascii-cloud ascii-cloud-left" aria-hidden="true"></pre>
        <pre id="ascii-cloud-right" class="ascii-cloud ascii-cloud-right" aria-hidden="true"></pre>

        <div class="hero-content">
            <p class="eyebrow">основы web-программирования &middot; лабораторный практикум</p>
            <h1>
                <span class="muted">Собираем</span><br>
                <span class="glitch" data-text="один сайт из пятнадцати лаб.">один сайт из пятнадцати лаб.</span>
            </h1>
            <p class="hero-subtitle">
                HTML &rarr; PHP &rarr; MySQL &rarr; сессии &rarr; файлы &rarr; AJAX.<br>
                Каждая лаба &mdash; новый кусочек одного и того же проекта.
            </p>
            <a class="cta" href="#labs">Смотреть лабы &darr;</a>

            <div class="progress-wrap">
                <div class="progress-track">
                    <div class="progress-fill" style="width: <?php echo $progress; ?>%"></div>
                </div>
                <span class="progress-label"><?php echo $done; ?> / <?php echo $total; ?> лаб готово</span>
            </div>
        </div>
    </section>

    <section id="labs" class="labs">
        <h2>Лабораторные работы</h2>
        <div class="lab-grid">
<?php foreach ($labs as $lab) { ?>
            <a class="lab-card" href="<?php echo $lab['href']; ?>">
                <span class="lab-card-num">[<?php echo $lab['num']; ?>]</span>
                <span class="lab-card-title"><?php echo $lab['title']; ?></span>
                <span class="lab-card-desc"><?php echo $lab['desc']; ?></span>
                <span class="lab-card-tag"><?php echo $lab['tag']; ?></span>
            </a>
<?php } ?>
        </div>
    </section>

    <script src="/assets/ascii.js"></script>
</body>
</html>
