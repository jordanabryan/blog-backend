<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate blog post object
  $post = new Post();

  // Blog post query
  $result = $post->read();

  // Check if any posts
  if($result) {

    //turn to JSON and output
    echo json_encode($result);

  } else {
    //no posts
    echo json_encode(
        array('message' => 'no posts found')
    );

  }

?>
