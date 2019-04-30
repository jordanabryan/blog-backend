<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog category object
  $category = new Category($db);

  // Blog category query
  $result = $category->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $category_arr = array();
    $category_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $category_item = array(
        'id' => $id,
        'name' => $name
      );

      //push to data
      array_push($category_arr['data'], $category_item);
    }

    //turn to JSON and output
    echo json_encode($category_arr);

  } else {
    //no posts
    echo json_encode(
        array('message' => 'no category found')
    );

  }

?>
