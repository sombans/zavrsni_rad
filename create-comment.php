<?php
    header("Location: single-post.php?Post_id={$_POST['Post_id']}");
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

if(!empty($_POST['name']) && !empty($_POST['text']) && !empty($_POST['Post_id'])) {   
$createComment = "INSERT INTO comments (Author,Text, Post_id) VALUES ('{$_POST['name']}', '{$_POST['text']}', '{$_POST['Post_id']}')";
       $statement = $connection->prepare($createComment);
       $statement->execute();
     }
else {
      header("Location: single-post.php?Post_id={$_POST['Post_id']}&error=true");
}        
?>
