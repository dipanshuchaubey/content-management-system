<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>   

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                if(isset($_GET['read_id'])) {

                    $read_id = $_GET['read_id'];
                } else {
                    header("Location: index.php");
                }
                
                $query = "SELECT * FROM posts WHERE post_id = $read_id ";
                $result = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($result)) {

                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_status = $row['post_status'];
                        $post_content = $row['post_content'];

                if ($post_status == 'published') {

                ?>


                <!-- First Blog Post -->
                <h1 style="text-align: center;">
                    <?php echo $post_title; ?>
                </h1>
                <hr>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span>Published On <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="admin/images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>

            <?php } } ?>

                <!-- Blog Comments -->
                <?php
                
                if(isset($_POST['post_comment'])) {

                    $comment_author_name = $_POST['comment_author_name'];
                    $comment_author_email = $_POST['comment_author_email'];
                    $comment_content = $_POST['comment_content'];

                    $comment_query = "INSERT INTO post_comments(comment_post_id ,comment_author, comment_date, comment_content, comment_status, comment_email) ";
                    $comment_query .= "VALUES('{$read_id}' ,'{$comment_author_name}', now(), '{$comment_content}', 'Rejected', '{$comment_author_email}' )";

                    $comment_result = mysqli_query($connection, $comment_query);
                    if(! $comment_result) {
                        echo "Error" . mysqli_error($connection);
                    } else {
                        $query_comment_count = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                        $query_comment_count .= "WHERE post_id = $read_id ";

                        $result = mysqli_query($connection, $query_comment_count);
                    }
                }

                global $post_status;
                if ($post_status == 'published') {
                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment</h4>
                    <form action="" method="post" role="form">

                        <div class="form-group">
                            <label>Name</label>
                            <input name="comment_author_name" type="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="comment_author_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="post_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php 
                $query = "SELECT * FROM post_comments WHERE comment_post_id = $read_id ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY comment_id DESC ";

                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    
                    $comment_author = $row['comment_author'];
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                
                ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

            <?php } } else {

                echo "<h1>Sorry No Such Post !</h1>";
            }
            ?>
                <!-- Comment -->

            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<!-- Footer -->
<?php include "includes/footer.php"; ?>