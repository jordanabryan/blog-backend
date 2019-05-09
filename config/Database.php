<?php

  include "autoload.php";

  class Database {
    // DB Params
    private $host = env('DB_HOST');
    private $db_name = env('DB_NAME');
    private $username = env('DB_USERNAME');
    private $password = env('DB_PASSWORD');
    private $port = env('DB_PORT');
    private $conn;
    private $query;
    private $stmt;
    private $row;

    private static $instance;

    /**
      *
      * public method of getting the database connection
      *
      * @return object
      */
    public function connect() {
      $this->conn = null;

      try {
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }


    /**
      *
      * public static method of getting the database connection
      *
      * @return self
      */
    public static function getInstance() {
        // If no instance then make one
        if (!self::$instance) {
            self::$instance =  new self();
        }
        return self::$instance;
    }


    /**
      *
      * return the last inserted id
      *
      * @return int
      */
    public function getInsertedId() {
        return $this->conn->lastInsertId();
    }


/* TESTS */


    public function setQuery($query){
      $this->stmt = $this->conn->prepare($query);
    }

    public function bindParam($key, $value){
      $this->stmt->bindParam($key, $value);
    }

    public function bindParams($params){
      if(is_array($params)){
        foreach ($params as $key => $value) {
          $this->bindParam($key, $value);
        }
      }
      return true;
    }

    public function cleanData($value){

      if(is_array($value)){

        $return = array();

        foreach ($value as $key => $value) {
          $return[$key] = htmlspecialchars(strip_tags($value));
        }

      } else {
        $return = htmlspecialchars(strip_tags($value));
      }

      return $return;
    }

    public function query(){

      $result = $this->stmt->execute();

      if($this->stmt->rowCount() === 1) {
        return true;
      } else {
        return false;
      }
    }


    public function getDBArray(){
      $this->stmt->execute();
      $returnArr = array();
      while($row = $this->stmt->fetchAll(PDO::FETCH_ASSOC)) {
        $returnArr = $row;
      }
      return $returnArr;
    }

    public function getDBObject(){
      $this->stmt->execute();
      $returnArr = array();
      while($row = $this->stmt->fetchAll(PDO::FETCH_OBJ)) {
        $returnArr = $row;
      }
      return $returnArr;
    }

    public function getDBRow(){
      // Execute query
      if($this->stmt->execute()) {
        $this->row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $this->row;
      }
      return false;
    }

    public function getRowCount(){
      return $row->rowCount();
    }

}
