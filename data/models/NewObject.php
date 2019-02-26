<?php

class NewObject {

 private $no = "";

 private $id = "";

 private $title = "";

 private $content = "";

 private $imageUrl = "";

 private $author = "";

 private $date = "";


 function __construct($no, $id, $title, $content, $imageUrl, $author, $date){
  $this->no = $no;
  $this->id = $id;
  $this->title = $title;
  $this->content = $content;
  $this->imageUrl = $imageUrl;
  $this->author = $author;
  $this->date = $date;
 }

 public function getNo() {
  return $this->no;
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

 public function getAuthor() {
  return $this->author;
 }

 public function getDate() {
  return $this->date;
 }

}