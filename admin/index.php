<?php include "includes/header.php" ?>
<body>

    <div id="wrapper">

    <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!--Navbar-->
            <?php include "includes/navigation.php" ?>
            <!--Sideba-->
            <?php include "includes/sidebar.php" ?>
    <!--navbar-collapse -->

     <!-- Time Counter -->
        <?php 
        // if (time() - $_SESSION['time_count'] > 60*5) {
        //     header("Location: ../includes/logout.php");
        // } else {
        //     $_SESSION['time_count'] = time();
        // }
        ?>
    <!--Time Counter -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin Section
                            <small><?php echo $_SESSION['firstname']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $post_count_query         =  "SELECT * FROM posts ";
                                        $post_count_result        =  mysqli_query($connection, $post_count_query);
                                        $post_count               =  mysqli_num_rows($post_count_result);

                                        $draft_post_count_query   =  "SELECT * FROM posts WHERE post_status = 'draft' ";
                                        $draft_post_count_result  =  mysqli_query($connection, $draft_post_count_query);
                                        $draft_post_count         =  mysqli_num_rows($draft_post_count_result);

                                        echo "<div class='huge'>$post_count</div>";
                                        ?>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                     <?php
                                        $comment_count_query            =  "SELECT * FROM post_comments ";
                                        $comment_count_result           =  mysqli_query($connection, $comment_count_query);
                                        $comment_count                  =  mysqli_num_rows($comment_count_result);

                                        $rejected_comment_count_query   =  "SELECT * FROM post_comments WHERE comment_status = 'Rejected' ";
                                        $rejected_comment_count_result  =  mysqli_query($connection, $rejected_comment_count_query);
                                        $rejected_comment_count         =  mysqli_num_rows($rejected_comment_count_result);

                                        echo "<div class='huge'>$comment_count</div>";
                                     ?>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                        $users_count_query   =  "SELECT * FROM users ";
                                        $users_count_result  =  mysqli_query($connection, $users_count_query);
                                        $users_count         =  mysqli_num_rows($users_count_result);

                                        echo "<div class='huge'>$users_count</div>";
                                    ?>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $category_count_query   =  "SELECT * FROM blog_category ";
                                            $category_count_result  =  mysqli_query($connection, $category_count_query);
                                            $category_count         =  mysqli_num_rows($category_count_result);

                                            echo "<div class='huge'>$category_count</div>";
                                        ?>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="category.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Active', 'Pending'],

                          <?php 
                            $count_data = ['Posts', 'Comments', 'Users', 'Category'];
                            $count_value1 = [$post_count, $comment_count, $users_count, $category_count];

                            $count_value2 = [$draft_post_count, $rejected_comment_count, $users_count, $category_count];

                            for ($i = 0; $i < 4; $i++) {
                                echo "['$count_data[$i]'" . "," . "$count_value1[$i]" . "," . "$count_value2[$i]],";
                            }
                          ?>  
            
                        ]);

                        var options = {
                          chart: {
                            title: 'Page Performance',
                            subtitle: '',
                          }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                      }
                    </script>

                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include 'includes/footer.php'; ?>