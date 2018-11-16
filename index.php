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
                $post_count_query = "SELECT * FROM posts";
                $post_count_result = mysqli_query($connection, $post_count_query);
                $get_post_count = mysqli_num_rows($post_count_result);
                $get_post_count = $get_post_count / 5;
                $post_count = ceil($get_post_count);

                if (isset($_GET['page'])) {
                    $pageNumber = $_GET['page'];
                } else {
                    $pageNumber = "";
                }

                if ($pageNumber == "" || $pageNumber == 1) {
                    $page = 0;
                } else {
                    $page = ($pageNumber * 5) - 5;
                }

                $query = "SELECT * FROM posts LIMIT $page,5";
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
                    by <a href="author.php?author=<?php echo strtok($post_author, ' ') ; ?>"><?php echo $post_author; ?></a>
                </p>

                <p>
                    <span class="glyphicon glyphicon-time"></span>Published On <?php echo $post_date; ?>
                </p>

                <hr>
                    <a href="post.php?read_id=<?php echo $post_id ?>"><img class="img-responsive" src="admin/images/<?php echo $post_image; ?>" alt=""></a>
                <hr>

                <p>
                    <?php echo $post_content; ?>     
                </p>

                <a class="btn btn-primary" href="post.php?read_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php } } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <!-- Pagination -->
        <div class="text-center">
            <ul class="pagination pagination-lg">
                <?php
                    for ($i=1; $i <= $post_count ; $i++) { 
                        echo "<li><a href='index.php?page=$i'>$i</a></li>";
                     } 
                ?>
                
            </ul>
        </div>

        <hr>

<!-- Footer -->
<?php include "includes/footer.php"; ?>