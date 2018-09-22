
<form method="post">
    <h3>Update Menu</h3>
    <div class="form-group">

    <?php
    
    if(isset($_GET['update_menu']))
    {

    $update_id = $_GET['update_menu'];
    $query = "SELECT * FROM category WHERE category_id = $update_id ";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {

        $update_id = $row['category_id'];
        $menu_title = $row['category_title'];
    ?>
    <input class="form-control" type="text" name="update_title" value="<?php if(isset($menu_title)){echo $menu_title;} ?>">
    <?php
    }
    }
    ?>

    <?php 
        if(isset($_POST['submit_update']))
        {
            $update_title = $_POST['update_title'];
            $query = "UPDATE category SET category_title = '$update_title' WHERE category_id = {$update_id}";
            $result = mysqli_query($connection, $query);
            header("Location: category.php");
        }
    ?>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit_update" value="Update category">
    </div>
</form>