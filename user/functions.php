
<?php

    function usersOnline() {

        if(isset($_GET['onlineusers'])) {

        global $connection;
        if(!$connection) {

            session_start();
            include("../includes/connect_db.php");

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if($count == NULL) {

                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");

            } else {
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }

            $users_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $count_user    =  mysqli_num_rows($users_online_query);

       }
    }
}
usersOnline();


    function addMenu() 
    {
    global $connection;
    if(isset($_POST['submit_menu'])) 
    {
    
    $menu_name = $_POST['menu_name'];

        $query = "INSERT INTO category(category_title) VALUES ('$menu_name')";
        $result = mysqli_query($connection, $query);

            if ($result) {
                echo "Menu Added";
            } else {
                echo "Failed to add Menu !" . mysqli_error($connection);
            }
        }
    }

    function addCategory() 
    {
    global $connection;
    if(isset($_POST['submit_category'])) 
    {
    
    $menu_name = $_POST['category_name'];

        $query = "INSERT INTO blog_category(category_title) VALUES ('$menu_name')";
        $result = mysqli_query($connection, $query);

            if ($result) {
                echo "Category Added";
            } else {
                echo "Failed to add Category !" . mysqli_error($connection);
            }
        }
    }


    function readCategory()
    {
        global $connection;
        $query = "SELECT * FROM blog_category";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {

            $category_id = $row['category_id'];
            $category_title = $row['category_title'];
            
            echo "<tr>";
            echo "<td>$category_id</td>";
            echo "<td>$category_title</td>";
            echo "<td><a href='category.php?update_category={$category_id}'>edit</a> / <a href='category.php?delete_category={$category_id}'>delete</a></td>";
            echo "</tr>";
        }
    }

    function deleteCategory()
    {
        global $connection;
        if(isset($_GET['delete_category']))
        {
            $delete_category = $_GET['delete_category'];
            $query = "DELETE FROM blog_category WHERE category_id = {$delete_category} ";
            $result = mysqli_query($connection, $query);
            header("Location: category.php");
        }
    }

    function readMenu()
    {
        global $connection;
        $query = "SELECT * FROM category";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {

            $category_id = $row['category_id'];
            $category_title = $row['category_title'];
            
            echo "<tr>";
            echo "<td>$category_id</td>";
            echo "<td>$category_title</td>";
            echo "<td><a href='category.php?update_menu={$category_id}'>edit</a> / <a href='category.php?delete_menu={$category_id}'>delete</a></td>";
            echo "</tr>";
        }
    }

    function deleteMenu()
    {
        global $connection;
        if(isset($_GET['delete_menu']))
        {
            $delete_category = $_GET['delete_menu'];
            $query = "DELETE FROM category WHERE category_id = {$delete_category} ";
            $result = mysqli_query($connection, $query);
            header("Location: category.php");
        }
    }

    function addPosts() 
    {
        global $connection;
        if(isset($_POST['publish_post']))
        {

            $post_title = $_POST['add_post_title'];
            $post_author = $_POST['add_post_author'];
            $post_status = $_POST['add_post_status'];
            $post_tags = $_POST['add_post_tags'];
            $post_content = $_POST['add_post_content'];

            $post_image = $_FILES['add_post_image']['name'];
            $post_image_temp = $_FILES['add_post_image']['tmp_name'];
            move_uploaded_file($post_image_temp, "./images/$post_image");

            $post_date = date('d-m-y');
            $post_comment_count = 4;


            $query = "INSERT INTO posts( post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";

            $query .= "VALUES('{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}' ) ";
            
            $result = mysqli_query($connection, $query);

            if(!$result)
            {
                echo "Failed To Publish Post" . mysqli_error($connection);
            } else {
                echo "<h4>Post Published</h4>";
            }
        }
    }

    function deletePosts() 
    {
        global $connection;
        if(isset($_GET['delete']))
        {
            $post_id = $_GET['delete'];

            $query = "DELETE FROM posts WHERE post_id = {$post_id} ";
            $result = mysqli_query($connection, $query);
            header("Location: all_posts.php");

            if($result)
            {
                echo "Post Deleted !";
            } else {
                echo "Failed to delete post " . mysqli_error($connection);
            }
        }
    }
?>