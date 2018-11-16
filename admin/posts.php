
<?php include "includes/header.php" ?>
<?php include "functions.php" ?>

<body>

    <div id="wrapper">

    <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!--Navbar-->
            <?php include "includes/navigation.php" ?>
            <!--Sidebar-->
            <?php include "includes/sidebar.php" ?>
    <!--navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Posts
                            <small>CMS</small>
                        </h1>
                    </div>
                </div>
                <img src="">

                <!-- Posts table-->

                <?php 
                if (isset($_GET['action'])) {
                        $action = $_GET['action'];
                    } else {
                        $action = "";
                    }
                    switch ($action) {

                        case 'add_post':
                            include "includes/add_posts.php";
                            break;

                        case 'edit_post':
                            include "includes/edit_posts.php";
                            break;
                        
                        default:
                            include "includes/view_posts.php";
                            break;
                    }

                ?>
            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


<?php include 'includes/footer.php'; ?>