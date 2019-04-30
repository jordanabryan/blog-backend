<?php

class Category{

  private $conn;
  private $table = 'categories';

  // category Properties
  public $id;
  public $name;
  public $created_at;

  // Constructor with DB
  public function __construct($db) {
    $this->conn = $db;
  }

  //get categories
  public function read(){

    //create query
    $query = 'SELECT id, name FROM ' . $this->table . ' ORDER BY id DESC';

    //prepare statement
    $stmt = $this->conn->prepare($query);

    //execute query
    $stmt->execute();

    return $stmt;

  }


}

 ?>
