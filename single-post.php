<?php
    // ako su mysql username/password i ime baze na vasim racunarima drugaciji
    // obavezno ih ovde zamenite
    $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
    $dbname = "blog";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
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
                if (isset($_GET['post_id'])) {

                    
                    $sql = "SELECT * FROM posts WHERE posts.id = {$_GET['post_id']};";
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
                <h2 class="blog-post-title"><a href="single-post.php?post_id="<?php echo($singlePost['id']) ?>><?php echo($singlePost['Title']) ?></a></h2>

                <p class="blog-post-meta"><?php echo($singlePost['Created_at']) ?><?php echo($singlePost['Author']) ?></a></p>

                <p><?php echo($singlePost['Body']) ?></p>
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


        <form action="create-comment.php" method="POST">
            <h5>add comment</h5>
                name:<input type="text" id="name" name="name"/></br></br>
                date:<input type="date" id="date"></br></br>
                body:<textarea rows="5" col="50" id="bodyText" name="text"></textarea></br>
            <input type="submit" id="addComment" value="Add comment"></br></br>
            <input type="Hidden" name="post_id" value="<?php echo ($_GET['post_id']); ?>">
        </form>



            <button id="HideShow" onclick="myFunction()"><script type="text/javascript"></script>Hide comment</button>


            <div id="hide" class="comments">

                
                <h3>comments</h3>

                <?php 

          $sql = "SELECT *FROM comments ORDER BY comments.post_id";
          $statement = $connection->prepare($sql);
          $statement->execute();
          $statement->setFetchMode(PDO::FETCH_ASSOC);
          $comments = $statement->fetchAll();  
          ?>

           <?php
              foreach ($comments as $post) {
          ?>

            <ul >
               <li><?php echo($post['Text']) ?></li>

               <li>autor:<?php echo($post['Author']) ?></li>

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