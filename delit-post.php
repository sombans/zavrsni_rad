<?php
header("Location: posts.php?refresh");
        $servername = "127.0.0.1";
        $username = "root";
        $password = "vivifi";
        $dbname = "blog";
    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
    catch(PDOException $e){
    echo $e->getMessage();
}
$deliteComment = "DELETE FROM posts WHERE Id = {$_POST['Post_id']}";
              $statement = $connection->prepare($deliteComment);
              $statement->execute();