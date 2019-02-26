<?php
require_once("../modules/news/NewsManager.php");
$newsManager = new NewsManager();

$query = $_GET["source"];
if ($query == "" || $query == "general") {
 $newsArray = $newsManager->getAllNews();
} else {
 $newsArray = $newsManager->getNewsBySource($query);
}

//Set headers
$tabla='<html><body>';
$tabla.='<table>';
$tabla.='<tr><td>no</td><td>Title</td><td>Content</td><td>ImageUrl</td><td>Author</td><td>Date</td></tr>';
//Fill fields
foreach((array) $newsArray as $new) {
 $no = $new->getNo();
 $title = $new->getTitle();
 $content = $new->getContent();
 $imageUrl = $new->getImageUrl();
 $author = $new->getAuthor();
 $date = $new->getDate();
 $tabla.="<tr><td>$no</td><td>$title</td><td>$content</td><td>$imageUrl</td><td>$author</td><td>$date</td></tr>";
}
$tabla.='</table>';
$tabla.='</body></html>';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="newscraping.xls"');
header('Content-Transfer-Encoding: binary');
print $tabla;



