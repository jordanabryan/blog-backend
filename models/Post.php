<?php
  class Post {

    // DB stuff
    private $conn;
    private $table = 'posts';

    // Post Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Constructor with DB static methods
    public function __construct() {
      $this->conn = Database::getInstance()->connect();
    }

    // Get Posts
    public function read() {

      $query = 'SELECT
          c.name as category_name,
          p.id,
          p.category_id,
          p.title,
          p.body,
          p.author,
          p.created_at
        FROM ' . $this->table . ' p
        LEFT JOIN categories c
        ON p.category_id = c.id
        ORDER BY p.id DESC';

      Database::getInstance()->setQuery($query);

      $result = Database::getInstance()->getDBArray();

      return $result;

    }

    //get single post
    public function read_single(){

      $query = 'SELECT
          c.name as category_name,
          p.id,
          p.category_id,
          p.title,
          p.body,
          p.author,
          p.created_at
        FROM ' . $this->table . ' p
        LEFT JOIN categories c
        ON p.category_id = c.id
        WHERE p.id = ?
        LIMIT 1';

      Database::getInstance()->setQuery($query);

      Database::getInstance()->bindParams([1 => $this->id]);

      $result = Database::getInstance()->getDBRow();

      return $result;

    }

    //create post
    public function create() {

      // Create query
      $query = 'INSERT INTO ' . $this->table . '
        SET
          title = :title,
          body = :body,
          author = :author,
          category_id = :category_id';


      Database::getInstance()->setQuery($query);

      $cleanData = Database::getInstance()->cleanData([
        'title' => $this->title,
        'body' => $this->body,
        'author' => $this->author,
        'category_id' => $this->category_id
      ]);

      Database::getInstance()->bindParams([
        ':title' => $cleanData['title'],
        ':body' => $cleanData['body'],
        ':author' => $cleanData['author'],
        ':category_id' => $cleanData['category_id']
      ]);

      $result = Database::getInstance()->query();

      return $result;

    }

    //update post
    public function update() {

      // Create query
      $query = 'UPDATE ' . $this->table . '
        SET
        title = :title,
        body = :body,
        author = :author,
        category_id = :category_id
        WHERE id = :id';

      // Prepare statement
      Database::getInstance()->setQuery($query);

      $this->title = Database::getInstance()->cleanData($this->title);
      $this->body = Database::getInstance()->cleanData($this->body);
      $this->author = Database::getInstance()->cleanData($this->author);
      $this->category_id = Database::getInstance()->cleanData($this->category_id);
      $this->id = Database::getInstance()->cleanData($this->id);

      Database::getInstance()->bindParams([
        ':title' => $this->title,
        ':body' => $this->body,
        ':author' => $this->author,
        ':category_id' => $this->category_id,
        ':id' => $this->id
      ]);

      $result = Database::getInstance()->query();

      return $result;

    }

    //delete post
    public function delete(){

      //create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

      Database::getInstance()->setQuery($query);

      Database::getInstance()->bindParam(':id', $this->id);

      $result = Database::getInstance()->query();

      return $result;

    }

  }
