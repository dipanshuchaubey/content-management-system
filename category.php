<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>   

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                 <h1 class="page-header">
                    Posts
                    <small></small>
                </h1>

                <?php

                if(isset($_GET['category'])) {
                    
                    $category_id = $_GET['category'];
                }

                $query = "SELECT * FROM posts WHERE post_category_id = $category_id ";
                $result = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($result)) {

                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0,200);

                if ($post_status == 'published') {               
                ?>
        
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?read_id=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span>Published On <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="admin/images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?read_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php } } ?>

            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<!-- Footer -->
<?php include "includes/footer.php"; ?>