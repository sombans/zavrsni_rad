<?php
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
?>
<!DOCTYPE html>
<html>
<head>
    <title> creatr posts </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
    
</head>

<body>
    <?php require('header.php'); ?>

        <main role="main" class="container">

            <div class="row">

                <div class="col-sm-8 blog-main">

                     <?php if(isset($_GET['error'])){
                            echo "<div class=\"alert alert-danger\" >
                            <strong>ERROR</strong> Moraju se popuniti sva polja!
                            </div>";
                            };
                        ?> 
                    <form class="form" action="create-posts.php" method="post" >

                        <h5>CREATE POST</h5>

                       
                
                            Title:<input type="text" class="form-control" id="Title" name="Title"/></br></br>
                            date:<input type="date" class="form-control" id="Created_at" name="Created_at"></br></br>
                            Author:<input type="text" class="form-control" id="Author" name="Author"/></br></br>
                            Text:<textarea type="text" class="form-control" rows="5" col="50" id="Body" name="Body"></textarea></br>
                            <input type="submit" class="button" value="Save">
                            <input type="hidden" name="action" value="submit">

                    </form>
                </div>
            </div>
        </main>
    <?php include('footer.php'); ?>    
</body>
</html>