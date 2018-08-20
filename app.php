<?php

require("config.php");
require("comments.class.php");
try{
$dbcon = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
}catch(PDOexception $e){
    echo "Connection failed: " . $e->getMessage();
}


$comment = new comments($dbcon);


$error = "";
$success = "";

if(isset($_POST['form_name']) && isset($_POST['form_email']) && isset($_POST['form_message'])){
  
    $name = $_POST['form_name'];
    $email = $_POST['form_email'];
    $message = $_POST['form_message'];
    
     if(strlen($name) < 3){
       $error = "Name must longer than 3 characters!";
     }
     if(strlen($message) < 5){
        $error = "Message must longer than 5 characters!";
      }
      if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "E-mail address is not valid!.";
      }

      if(! $error){
        $comment->create($name, $email, $message);
        $success = "Comment has been submited successfully!";
      }

  }else{
    $name = "";
    $email = "";
    $message = "";
  }




?>