<?php

class Manager
{
    private $DATABASE = array(
    "SERVER_NAME" => "localhost:8889",
    "NAME" => "my_shop",
    "USERNAME" => "root",
    "PASSWORD" => "root"
    );

    function __construct(){
    }

    public function insert($sql){
        $conn = $this->createConnection();
        if ($conn->query($sql) === true) {
            $conn->close();
            return true;
        }
        else {
            $conn->close();
            return false;
        }
    }

    public function select($sql){
        $conn = $this->createConnection();
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function exist($sql){
        $conn = $this->createConnection();
        $result = $conn->query($sql);
        if($result->num_rows > 0)
            return true;
        else
            return false;
    }

    public function update($sql){
        $conn = $this->createConnection();
        if ($conn->query($sql) === true) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    public function delete($sql){
        $conn = $this->createConnection();
        if ($conn->query($sql) === true) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    private function createConnection(){
        $conn = new mysqli(
            $this->DATABASE["SERVER_NAME"],
            $this->DATABASE["USERNAME"],
            $this->DATABASE["PASSWORD"],
            $this->DATABASE["NAME"]
        );

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}