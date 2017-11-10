<?php
 header("Location: single-post.php?post_id={$_POST['post_id']}");
  $servername = "127.0.0.1";
   $username = "root";
   $password = "vivify";
   $dbname = "blog";
  try {
       $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
       $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
   catch(PDOException $e)
   {
       echo $e->getMessage();
   }

   
  $createComment = "INSERT INTO comments (Author,Text, post_id) VALUES ('{$_POST['name']}', '{$_POST['text']}', '{$_POST['post_id']}')";
       $statement = $connection->prepare($createComment);
       $statement->execute();
                
?>
