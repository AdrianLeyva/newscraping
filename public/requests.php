<?php
require_once("../modules/news/NewsManager.php");

$newsManager = new NewsManager();
$newsArray = $newsManager->getAllNews();
$titlesArray = array();

foreach((array) $newsArray as $new) {
 array_push($titlesArray, $new->getTitle());
}

header('Content-Type: application/json');
echo json_encode($titlesArray);