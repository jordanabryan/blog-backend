<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate blog post object
  $post = new Post();

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $post->title = $data->title;
  $post->body = $data->body;
  $post->author = $data->author;
  $post->category_id = $data->category_id;

  // Create post
  if($post->create()) {

    echo json_encode(
      array(
        "status" => 200,
        "error" => false,
        "errormessage" => null,
        "response" => 'Post created'
      )
    );

  } else {

    echo json_encode(
      array(
        "status" => 400,
        "error" => true,
        "errormessage" => 'Post not created',
        "response" => null
      )
    );

  }
