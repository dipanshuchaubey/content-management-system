<?php
    if(isset($_GET['edit_id'])) {
        $edit_post_id = $_GET['edit_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id = $edit_post_id ";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_category_id = $row['post_category_id'];
        $post_content = $row['post_content'];
        $post_date = $row['post_date'];

    }

    if(isset($_POST['update_post'])) { 

        $updated_title = $_POST['updated_post_title'];
        $updated_author = $_POST['updated_post_author'];
        $updated_status = $_POST['updated_post_status'];
        $updated_image = $_FILES['updated_post_image']['name'];
        $updated_image_tmp = $_FILES['updated_post_image']['tmp_name'];
        $updated_tags = $_POST['updated_post_tags'];
        $update_post_category_id = $_POST['post_category'];
        $updated_content = $_POST['updated_post_content'];

        move_uploaded_file($updated_image_tmp, "./images/$updated_image");

        if(empty($updated_image)) {

            $query = "SELECT * FROM posts WHERE post_id = $edit_post_id ";
            $select_image = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_image)) {
                $updated_image = $row['post_image'];
            }
        }

        $update_query = "UPDATE posts SET ";
        $update_query .= "post_title = '$updated_title', ";
        $update_query .= "post_author = '$updated_author', ";
        $update_query .= "post_date = now(), ";
        $update_query .= "post_image = '$updated_image', ";
        $update_query .= "post_content = '$updated_content', ";
        $update_query .= "post_status = '$updated_status', ";
        $update_query .= "post_category_id = '$update_post_category_id', ";
        $update_query .= "post_tags = '$updated_tags' ";
        $update_query .= "WHERE post_id = $edit_post_id ";

        $update_post = mysqli_query($connection, $update_query);
        header("Location: posts.php?action=edit_post&edit_id=$edit_post_id");
        exit();
        if(! $update_post) {
            echo "Error " . mysqli_error($connection);
        }
    }
?>
<form action="" method="post" enctype="multipart/form-data">

    <h4>Post Title</h4>
    <div class="form-group">
        <input class="form-control" value="<?php echo $post_title; ?>" type="text" name="updated_post_title">
    </div>

    <h4>Post Id</h4>
    <div class="form-group">
        <input class="form-control" value="<?php echo $post_id; ?>" readonly type="number" name="updated_post_id">
    </div>

    <h4>Post Author</h4>
    <div class="form-group">
        <input class="form-control" value="<?php echo $post_author; ?>" type="text" name="updated_post_author">
    </div>

    <div class="form-group">
        <select name="post_category" id="">
            <?php
                $category_query = "SELECT * FROM blog_category";
                $category_result = mysqli_query($connection, $category_query);

                while ($row = mysqli_fetch_assoc($category_result)) {
                    $category_id = $row['category_id'];
                    $category_title = $row['category_title'];

                    echo "<option value='$category_id'>$category_title</option>";
                }
            ?>
        </select>
    </div>

    <h4>Post Status</h4>
    <div class="form-group">
        <select name="updated_post_status" id="">
            <option value='<?php $post_status ?>'><?php echo "$post_status" ?></option>
            <?php 
            if ($post_status == 'draft') {

                echo "<option value='published'>Published</option>";

            } elseif ($post_status == 'published') {

                echo "<option value='draft'>Draft</option>";
            }
            ?>
        </select>
    </div>

<!-- $post_status_query = "SELECT * FROM posts WHERE post_id = $edit_post_id ";
            $post_status_result = mysqli_query($connection, $post_status_query);

            while ($status_row = mysqli_fetch_assoc($post_status_result)) {
                
                $read_post_status = $status_row['post_status'];
            } -->
    <h4>Post Image</h4>
    <div class="form-group">
        <img class="img-responsive" style="width: 100px;" src="./images/<?php echo $post_image; ?>">
        <br>
        <input type="file" name="updated_post_image">
    </div>

    <h4>Post Tags</h4>
    <div class="form-group">
        <input class="form-control" value="<?php echo $post_tags; ?>" type="text" name="updated_post_tags">
    </div>

    <h4>Post Content</h4>
    <div class="form-group">
        <textarea class="form-control" cols="30" rows="10" type="text" name="updated_post_content"><?php echo $post_content; ?></textarea>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>

</form>