
<div id="demo">

  <div class="table-responsive-vertical shadow-z-1">
  <!-- Table starts here -->
  <table id="table" class="table table-hover table-bordered table-mc-light-blue">
      <thead>
        <tr style="font-weight: bold;">
            <td>Id</td>
            <td>Author</td>
            <td>Category</td>
            <td>Title</td>
            <td>Image</td>
            <td>Date</td>
            <td>Content</td>
            <td>Tags</td>
            <td>Comment Count</td>
            <td>Status</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
      </thead>

      <?php
        global $connection;
        $query = "SELECT * FROM posts ";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_image = $row['post_image'];
            $post_date = $row['post_date'];
            $post_content = substr($row['post_content'], 0,50);
            $post_tags = $row['post_tags'];
            $post_category_id = $row['post_category_id'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];

     ?>

      <tbody>
        <tr>
            <?php
                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";

                $category_query = "SELECT * FROM blog_category WHERE category_id = $post_category_id";
                $select_category = mysqli_query($connection, $category_query);

                while ($row = mysqli_fetch_assoc($select_category)) {
                    $view_category_id = $row['category_id'];
                    $view_category_title = $row['category_title'];

                echo "<td>$view_category_title</td>"; 
                }

                echo "<td>$post_title</td>";  
                echo "<td><img class='img-responsive' width=50px src='./images/$post_image'></td>";   
                echo "<td>$post_date</td>";
                echo "<td>$post_content</td>";    
                echo "<td>$post_tags</td>";    
                echo "<td>$post_comment_count</td>";    
                echo "<td>$post_status</td>";    
                echo "<td><a href='posts.php?action=edit_post&edit_id=$post_id' class='glyphicon glyphicon-pencil'></a></td>";
                echo "<td><a href='posts.php?delete=$post_id' class='glyphicon glyphicon-trash'></a></td>";    
                } 
            ?>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<?php
if(isset($_GET['delete']))
        {
            $post_id = $_GET['delete'];

            $query = "DELETE FROM posts WHERE post_id = {$post_id} ";
            $result = mysqli_query($connection, $query);
            header("Location: posts.php");

            if($result)
            {
                echo "Post Deleted !";
            } else {
                echo "Failed to delete post " . mysqli_error($connection);
            }
        }
?>