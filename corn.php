<?php

require("config.php");
require("comments.class.php");
try{
$dbcon = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
}catch(PDOexception $e){
    echo "Connection failed: " . $e->getMessage();
}


$comment = new comments($dbcon);


$BADWORDS = array('baddd','badddd');

$comment->AutoCheck($BADWORDS);



?>