<?php

class NewObject {

 private $no = "";

 private $id = "";

 private $title = "";

 private $content = "";

 private $imageUrl = "";

 function __construct($no, $id, $title, $content, $imageUrl){
  $this->no = $no;
  $this->id = $id;
  $this->title = $title;
  $this->content = $content;
  $this->imageUrl = $imageUrl;
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

}