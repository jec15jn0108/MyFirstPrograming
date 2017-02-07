<?php

require('./news_table.php');

$title = $_POST["title"];
$contents = $_POST["contents"];

$news = new NewsTable();
$news->addNews($title, $contents);

header("Location: ../news/end_post");
