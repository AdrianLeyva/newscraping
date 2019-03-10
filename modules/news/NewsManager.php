<?php
require_once("../vendor/autoload.php");
require_once("../data/database/Manager.php");
require_once("../data/models/NewObject.php");

class NewsManager {

 private $sources = array(
  "nytimes" => array("id" => "nytimes", "name" => "New York Times", "url" => "http://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml"),
  "reforma" => array("id" => "reforma", "name" => "El reforma", "url" => "https://www.reforma.com/rss/portada.xml"),
  "debate" => array("id" => "debate", "name" => "Debate", "url" => "https://www.debate.com.mx/rss/feed.xml")
 );

 private $feeds = array();

 function __construct(){
  $this->fetchAllNews();
  $this->buildNews();
 }

 private function fetchAllNews() {
  error_reporting(0); 
  $databaseManager = new Manager();
  $api = new SimplePie();

  foreach((array) $this->sources as $source) {
   $api->set_feed_url($source["url"]);
   $api->enable_cache();
   $api->init();

   $quantity = $api->get_item_quantity();
   for($i = 0; $i < $quantity; $i++) {
    $no = $this->countRows() + 1;
    $id = $source["id"];
    $title = $api->get_item($i)->get_title();
    $content = $api->get_item($i)->get_description();
    $imageUrl = "";
    $author = $api->get_item($i)->get_author()->get_name();
    $date = $api->get_item($i)->get_date();
    $QUERY = "INSERT INTO News (no, id, title, content, imageUrl, author, date) VALUES ('$no', '$id', '$title', '$content', '$imageUrl', '$author', '$date')";
    $databaseManager->insert($QUERY);
   }
  }
 }

 private function buildNews() {
  $databaseManager = new Manager();
  $QUERY = "SELECT * FROM News";
  $result = $databaseManager->select($QUERY);
  return $this->getFeedsByQuery($this->feeds, $result);
 }

 private function countRows() {
  $databaseManager = new Manager();
  $QUERY = "SELECT * FROM News";
  $result = $databaseManager->select($QUERY);
  return $result->num_rows;
 }

 public function getAllNews() {
  return $this->feeds;
 }

 public function getNewsBySource($source) {
  $databaseManager = new Manager();
  $QUERY = "SELECT * FROM News WHERE id = '$source'";
  $result = $databaseManager->select($QUERY);
  $newsArray = array();
  return $this->getFeedsByQuery($newsArray, $result);
 }

 public function getNewByTitle($title) {
  $databaseManager = new Manager();
  $QUERY = "SELECT * FROM News WHERE title = '$title'";
  $result = $databaseManager->select($QUERY);
  return $this->getFeedByQuery($result);
 }

 public function getNewByNo($no) {
  $databaseManager = new Manager();
  $QUERY = "SELECT * FROM News WHERE no = '$no'";
  $result = $databaseManager->select($QUERY);
  return $this->getFeedByQuery($result);
 }

 private function getFeedByQuery($result) {
  if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    return new NewObject(
     $row["no"],
     $row["id"],
     $row["title"],
     $row["content"],
     $row["imageUrl"],
     $row["author"],
     $row["date"]
    );
   }
 }

 private function getFeedsByQuery($array, $result) {
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      array_push($array, new NewObject(
      $row["no"],
      $row["id"],
      $row["title"],
      $row["content"],
      $row["imageUrl"],
      $row["author"],
      $row["date"]
     ));
   }
    return $array;
   }
 }

}