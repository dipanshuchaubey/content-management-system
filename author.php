<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>   

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                if(isset($_GET['author'])) {

                    $authorName  =  $_GET['author'];
                
                    $query       =  "SELECT * FROM users WHERE user_firstname = '$authorName' ";
                    $result      =  mysqli_query($connection, $query);
                    if(! $result) {
                        echo "Error". mysqli_error($connection);
                    }

                        while ($row = mysqli_fetch_assoc($result)) {

                            $user_lastname     =  $row['user_lastname'];
                            $user_email        =  $row['user_email'];
                            $user_role         =  $row['user_role'];
                            $username          =  $row['username'];
                ?>


                <!-- First Blog Post -->
                <h1 style="text-align: center;">
                    <?php echo $authorName ." ".$user_lastname ; ?>
                </h1>
                <hr>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Published On <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="admin/images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>

            <?php 
                } } else {
                    header("Location: index.php");
                } 
            ?>

            </div>

        </div>
        <!-- /.row -->

        <hr>

<!-- Footer -->
<?php include "includes/footer.php"; ?>