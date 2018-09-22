<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <form action="search.php" method="post">
        <h4>Blog Search</h4>
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
    </div>
        <!-- input-group -->

    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">

            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username">
            </div>

            <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" name="login">Login</button>
                </span>
            </div>

        </form>
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    
                    <?php

                        global $connection;
                    
                        $query = "SELECT * FROM blog_category";
                        $result = mysqli_query($connection, $query);

                        while ($row = mysqli_fetch_assoc($result)) {

                        $category_id = $row['category_id'];
                        $category_title = $row['category_title'];

                        echo "<li><a href='category.php?category=$category_id'>{$category_title}</a></li>";
                    } 
                    
                    
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <li><a href="#"></a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>About</h4>
        
        <?php

        global $connection;
        
                    
        $query = "SELECT * FROM blog_category";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {

        $widget = $row['widget'];

        echo "<p>{$widget}</p>";
        
        }              
        ?>
        
    </div>
</div>