
<?php include "includes/connect_db.php"; ?>
<?php session_start() ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Blog Posts</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php

                global $connection;

                $query = "SELECT * FROM category";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)) {

                    $category_title = $row['category_title'];
                    $category_url = $row['category_url'];
                    
                    echo "<li><a href='{$category_url}'>{$category_title}</a></li>";
                }

                ?>
                
            </ul>
        </div>

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>