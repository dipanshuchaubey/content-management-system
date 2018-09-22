<?php
    if(isset($_POST['publish_post']))
        {

            $post_title = $_POST['add_post_title'];
            $post_author = $_POST['add_post_author'];
            $post_status = $_POST['add_post_status'];
            $post_tags = $_POST['add_post_tags'];
            $post_content = $_POST['add_post_content'];
            $post_category_id = $_POST['add_post_category'];
            $post_image = $_FILES['add_post_image']['name'];
            $post_image_temp = $_FILES['add_post_image']['tmp_name'];
            move_uploaded_file($post_image_temp, "./images/$post_image");

            $post_date = date('d-m-y');
            $post_comment_count = 0;


            $query = "INSERT INTO posts( post_title, post_author, post_date, post_image, post_content, post_tags, post_category_id, post_comment_count, post_status) ";

            $query .= "VALUES('{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_category_id}', '{$post_comment_count}', '{$post_status}' ) ";
            
            $result = mysqli_query($connection, $query);

            if(!$result)
            {
                echo "Failed To Publish Post" . mysqli_error($connection);
            } else {
                echo "<h4>Post Published</h4>";
            }
        }
?>
<form action="" method="post" enctype="multipart/form-data">

    <h4>Post Title</h4>
    <div class="form-group">
        <input class="form-control" type="text" name="add_post_title">
    </div>

    <h4>Post Author</h4>
    <div class="form-group">
        <input class="form-control" type="text" name="add_post_author">
    </div>

    <h4>Post Category</h4>
    <div class="form-group">
        <select name="add_post_category" id="">
            <?php
                $query = "SELECT * FROM blog_category";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $category_id = $row['category_id'];
                    $category_title = $row['category_title'];

                    echo "<option value='$category_id'>$category_title</option>";
                }
            ?>
        </select>
    </div>

    <h4>Post Status</h4>
    <div class="form-group">
        <select name="add_post_status" id="">
            <option value='draft'>select post status</option>
            <option value='draft'>Draft</option>
            <option value='published'>Publish</option>
        </select>
    </div>

    <h4>Post Image</h4>
    <div class="form-group">
        <input type="file" name="add_post_image">
    </div>

    <h4>Post Tags</h4>
    <div class="form-group">
        <input class="form-control" type="text" name="add_post_tags">
    </div>

    <h4>Post Content</h4>
    <div class="form-group">
        <textarea class="form-control" cols="30" rows="10" type="text" name="add_post_content"></textarea>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="publish_post" value="Publish Post">
    </div>

</form>