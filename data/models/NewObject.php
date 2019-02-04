<?php

class NewObject {

 private $id = "";

 private $title = "";

 private $content = "";

 private $imageUrl = "";

 function __construct($id, $title, $content, $imageUrl){
  $this->id = $id;
  $this->title = $title;
  $this->content = $content;
  $this->imageUrl = $imageUrl;
 }

 public function getId() {
  return $this->id;
 }

 public function getTitle() {
  return $this->title;
 }

 public function getContent() {
  return $this->content;
 }

 public function getImageUrl() {
  return $this->imageUrl;
 }

}