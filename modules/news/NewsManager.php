<?php
require_once("/Users/adrianleyvasanchez/Documents/Development/VIACCE/newscraping/vendor/autoload.php");
require_once("/Users/adrianleyvasanchez/Documents/Development/VIACCE/newscraping/data/database/Manager.php");
require_once("/Users/adrianleyvasanchez/Documents/Development/VIACCE/newscraping/data/models/NewObject.php");

class NewsManager {

 private $sources = array(
  "nytimes" => array("id" => "nytimes", "name" => "New York Times", "url" => "http://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml"),
  "universal" => array("id" => "universal", "name" => "The universal", "url" => "http://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml")
 );

 private $feeds = array();
 

 function __construct(){
  $this->fetchAllNews();
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
    $id = $source["id"];
    $title = $api->get_item($i)->get_title();
    $content = $api->get_item($i)->get_description();
    $imageUrl = "";
    $QUERY = "INSERT INTO News (id, title, content, imageUrl) VALUES ('$id', '$title', '$content', '$imageUrl')";
    $databaseManager->insert($QUERY);
   }
  }
 }

 public function getAllFeeds() {
  $databaseManager = new Manager();
  $QUERY = "SELECT * FROM News";
  $result = $databaseManager->select($QUERY);

  if($result->num_rows > 0) {
   while($row = $result->fetch_assoc()) {
    array_push($this->feeds, new NewObject(
     $row["id"],
     $row["title"],
     $row["content"],
     $row["imageUrl"]
    ));
   }
   return $this->feeds;
  }
 }

 public function getFeedBySource($source) {
  $feedsBySource = array();
  foreach($this->feeds as $feed) {
   if($feed->getId() == $source) {
    array_push($feedsBySource, $feed);
   }
  }
  return $feedsBySource;
 }

}