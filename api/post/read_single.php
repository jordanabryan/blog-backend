<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate blog post object
  $post = new Post();

  //get id from url
  $post->id = isset($_GET['id']) ? intval($_GET['id']) : null;

  //get post
  $content = $post->read_single();

  //
  echo json_encode(
    array(
      "status" => 200,
      "error" => false,
      "errormessage" => null,
      "response" => $content
    )
  );

?>
