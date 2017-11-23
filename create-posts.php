<?php
    header("Location: posts.php?refresh");
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "blog";
    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
   catch(PDOException $e)
   {
       echo $e->getMessage();
   }

if(!empty($_POST['Title']) && !empty($_POST['Body']) && !empty($_POST['Author']) && !empty($_POST['Created_at'])) {   
$createPosts = "INSERT INTO posts (Title,Body,Author,Created_at) VALUES ('{$_POST['Title']}', '{$_POST['Body']}', '{$_POST['Author']}', '{$_POST['Created_at']}')";
      $statement = $connection->prepare($createPosts);
      $statement->execute();
      $statement->setFetchMode(PDO::FETCH_ASSOC);
      $posts = $statement->fetchAll();
     }
else {
      header("Location: create.php?Post_id={$_POST['Post_id']}&error=true");
}        
?>
