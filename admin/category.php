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
                            Categories
                            <small>CMS</small>
                        </h1>
                    </div>
                </div>

                <div class="col-xs-6">
                    
                    <form method="post">
                        <h3>Add Menu Option</h3>
                        <div class="form-group">
                            <input class="form-control" type="text" name="menu_name" placeholder="Enter name of Menu Option">
                        </div>
                        
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit_menu" value="Add Option">
                        </div>
                    </form>

                    <?php addMenu(); ?>

                    <?php
                        if(isset($_GET['update_menu']))
                        {
                            $update_id = $_GET['update_menu'];
                            include "includes/update_menu.php";
                        }
                    ?>
                </div>                    
                
                <!-- Category table-->
                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Option Title</th>
                                <th></th>
                            </tr>
                        </thead>

                        <?php readMenu(); ?>
                        
                        <?php deleteMenu(); ?>

                    </table>
                </div>

                <!-- Menu table-->

            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <div class="container-fluid">

                <div class="col-xs-6">
                    
                    <form method="post">
                        <h3>Add Category</h3>
                        <div class="form-group">
                            <input class="form-control" type="text" name="category_name" placeholder="Enter name of category">
                        </div>
                        
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit_category" value="Add category">
                        </div>
                    </form>

                    <?php
                        if(isset($_GET['update_category']))
                        {
                            $update_id = $_GET['update_category'];
                            include "includes/update_category.php";
                        }
                    ?>

                    <?php addCategory(); ?>

                </div>
                
                <!-- Category table-->
                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Name</th>
                                <th></th>
                            </tr>
                        </thead>

                        <?php readCategory(); ?>
                        
                        <?php deleteCategory(); ?>

                    </table>
                </div>
                <!-- Category table-->

            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- FOOTER -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- END FOOTER -->

</body>

</html>