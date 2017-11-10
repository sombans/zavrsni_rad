<?php

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
?>

   <aside class="col-sm-3 ml-sm-auto blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>Latest posts</h4>

      <?php
            $sql = "SELECT * FROM posts ORDER BY posts.Created_at LIMIT 5";
            $statement = $connection->prepare($sql);

            $statement->execute();
            
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            
            $posts = $statement->fetchAll();
            
                echo '<pre>';
                echo '</pre>';

          ?>
          


          <?php
              foreach ($posts as $post) {
          ?>

              <p><a href="single-post.php?post_id=<?php echo($post['id'])?>"><?php echo($post['Title'])?></a></p>
                <?php
              }
          ?>

          <div class="sidebar-module">
         
          </div>
      </aside><!-- /.blog-sidebar -->