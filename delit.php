<?php
        $servername = "127.0.0.1";
        $username = "root";
        $password = "vivifi";
        $dbname = "blog";
    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
   catch(PDOException $e)
   {
       echo $e->getMessage();
   }
header("location:single-post.php?Post_id={$_POST['Post_id']}");
              $deliteComment = "DELETE FROM comments WHERE Id = {$_POST['Id']}";
              $statement = $connection->prepare($deliteComment);
              $statement->execute();    
?>