<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate blog post object
  $post = new Post();

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  //set id to update
  $post->id = $data->id;

  // Create post
  if($post->delete()) {

    echo json_encode(
      array(
        "status" => 200,
        "error" => false,
        "errormessage" => null,
        "response" => 'Post deleted'
      )
    );

  } else {

    echo json_encode(
      array(
        "status" => 400,
        "error" => true,
        "errormessage" => 'post not deleted',
        "response" => null
      )
    );

  }
