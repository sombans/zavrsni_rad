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
?>
<!DOCTYPE html>
<html>
<head>
    <title> single-post </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
    
</head>

<body>
    <?php require('header.php') ?>



<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">
            <?php
                if (isset($_GET['Post_id'])) {

                    
                    $sql = "SELECT * FROM posts WHERE posts.id = {$_GET['Post_id']};";
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $singlePost = $statement->fetch();

                    // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                    //   echo '<pre>';
                    //   var_dump($singlePost);
                    //   echo '</pre>';

            ?>

              <div class="blog-post">
              <h2 class="blog-post-title"><a href="single-post.php?Post_id="<?php echo($singlePost['Id']) ?>><?php echo($singlePost['Title']) ?></a></h2>

              <p class="blog-post-meta"><?php echo($singlePost['Created_at']) ?><?php echo($singlePost['Author']) ?></a></p>

              <p><?php echo($singlePost['Body']) ?></p>
                  <form action="delit-post.php" method="post">
                      <button class="btn-primary" onclick="return confirm('Do you really want to delete this post')" type="submit"  >Delete post</button><br>
                      <input type="Hidden" name="Post_id" value="<?php echo($_GET['Post_id']);?>">
                  </form>
                <hr>
               
           </div>

           

            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>


            <?php
                } else {
                    echo('post_id nije prosledjen kroz $_GET');
                }
            ?>
          <?php if(isset($_GET['error'])){
               echo "<div class=\"alert alert-danger\" >
           <strong>ERROR</strong> Moraju se popuniti sva polja!
            </div>";
          };
               ?> 

        <form class="form" action="create-comment.php" method="post" >
            <h5>add comment</h5>
            
                name:<input type="text" class="form-control" id="name" name="name"/></br></br>
                date:<input type="date" class="form-control" id="date"></br></br>
                body:<textarea type="text" class="form-control" rows="5" col="50" id="bodyText" name="text"></textarea></br>

            <input type="submit" id="addComment" value="Add comment" ></br></br>
            <input type="Hidden" name="Post_id" value="<?php echo ($_GET['Post_id']); ?>">
        </form>



            <button id="HideShow" onclick="myFunction()"><script type="text/javascript"></script>Hide comment</button>


    <div id="hide" class="comments">

                
                <h3>comments</h3>

                <?php 

          $sql = "SELECT *FROM comments WHERE comments.Post_id = {$_GET['Post_id']} ORDER BY comments.Id DESC LIMIT 10";
          $statement = $connection->prepare($sql);
          $statement->execute();
          $statement->setFetchMode(PDO::FETCH_ASSOC);
          $comments = $statement->fetchAll();  
          ?>

           <?php
              foreach ($comments as $postComm) {
          ?>
      
          <ul >
                <li><?php echo($postComm['Text']) ?></li>

                <li>autor:<?php echo($postComm['Author']) ?></li>
        <form action="delit.php" method="post">
                <button class="del_btn" type="submit"  >Delete comment</button><br>
                <input type="Hidden" name="Id" value="<?php echo $postComm['Id']; ?>">
                <input type="Hidden" name="Post_id" value="<?php echo$postComm['Post_id'];?>">
        </form>
                <hr>
          </ul>
      
           <?php
               }
          ?>

    </div>

        </div><!-- /.blog-main -->
<?php 
    include ('sidebar.php'); 
?>
    </div><!-- /.row -->

</main><!-- /.container -->

<?php include('footer.php'); ?>
<script src="zavrsni.js"></script>

</body>
</html>