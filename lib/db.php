<?php

require_once __DIR__ . '/../config.php';

function init_connection() {
    global $CFG;

    $link = mysqli_connect($CFG->host, $CFG->user, $CFG->password, $CFG->database)
        or die("Failed to connect to database. Error: " . mysqli_connect_error());

    // Без этой фигни русские буквы, полученные из базы, будут превращаться в "?"
    mysqli_set_charset($link, "utf8mb4");

    return $link;
}
