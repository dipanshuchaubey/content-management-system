
<div id="demo">

  <div class="table-responsive-vertical shadow-z-1">
  <!-- Table starts here -->

<form method="post">
    <?php 
        if(isset($_POST['checkBoxArray'])) {
            foreach($_POST['checkBoxArray'] as $checkBoxValue) {
                $bulkOptions = $_POST['bulkOptions'];
                
                switch($bulkOptions) {

                    case 'published' :
                        $bulkPublishQuery  =  "UPDATE posts SET post_status = '$bulkOptions' WHERE post_id = $checkBoxValue ";
                        $bulkPublishResult =  mysqli_query($connection, $bulkPublishQuery);
                        break;

                    case 'draft' :
                        $bulkDraftQuery   =  "UPDATE posts SET post_status = '$bulkOptions' WHERE post_id = $checkBoxValue ";
                        $bulkDraftResult  =  mysqli_query($connection, $bulkDraftQuery);
                        break;
                    
                    // case 'delete' :
                    //     $bulkDeleteQuery  =  "DELETE FROM posts WHERE post_id = $checkBoxValue ";
                    //     $bulkDeleteResult =  mysqli_query($connection, $bulkDeleteQuery);
                    //     break;

                    case 'clone' :
                        $cloneFetchQuery  = "SELECT * FROM posts WHERE post_id = $checkBoxValue ";
                        $cloneFetchResult =  mysqli_query($connection, $cloneFetchQuery);

                        while($row = mysqli_fetch_assoc($cloneFetchResult)) {

                            $post_author          =   $row['post_author'];
                            $post_title           =   $row['post_title'];
                            $post_image           =   $row['post_image'];
                            $post_date            =   $row['post_date'];
                            $post_content         =   $row['post_content'];
                            $post_tags            =   $row['post_tags'];
                            $post_category_id     =   $row['post_category_id'];
                            $post_status          =   $row['post_status'];
                        }

                        $bulkCloneQuery   =  "INSERT INTO posts( post_title, post_author, post_date, post_image, post_content, post_tags, post_category_id, post_status) ";
                        $bulkCloneQuery  .=  "VALUES('{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_category_id}', '{$post_status}' ) ";
                        $bulkCloneResult  =  mysqli_query($connection, $bulkCloneQuery);
                        break;

                    default:
                        echo "Error !";
                        break;
                }
            }
        }
    ?>

    <div id="bulkOptionContainer" class="col-xs-4">
        <select class="form-control" name="bulkOptions">
            <option value="">Select an option</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="clone">Clone</option>
            <option value="delete">Delete</option>
        </select>
    </div>

    <div id="bulkOptionButtons" class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="posts.php?action=add_post" class="btn btn-primary">Add New</a>
    </div>

  <table class="table table-striped table-hover">

      <thead>
        <tr style="font-weight: bold;">
            <td><input id="selectAllBoxes" type="checkbox"></td>
            <td>Id</td>
            <td>Author</td>
            <td>Category</td>
            <td>Title</td>
            <td>Image</td>
            <td>Date</td>
            <td>Content</td>
            <td>Tags</td>
            <td>Comment Count</td>
            <td>Views Count</td>
            <td>Status</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
      </thead>

      <?php
        $posts_count_query    =   "SELECT * FROM posts";
        $posts_count_result   =   mysqli_query($connection, $posts_count_query);
        $posts_count          =   mysqli_num_rows($posts_count_result);
        $posts_count          =   ceil($posts_count) / 10;

        if (isset($_GET['page'])) {
            $page_no = $_GET['page'];

        } else {
            $page_no = "";
        }

        if ($page_no == "" || $page_no == 1) {
            $page_no = 0;
        } else {
            $page_no = ($page_no * 10) - 10; 
        }

        global $connection;
        $query   =  "SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_no,10 ";
        $result  =  mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {

            $post_id              =   $row['post_id'];
            $post_author          =   $row['post_author'];
            $post_title           =   $row['post_title'];
            $post_image           =   $row['post_image'];
            $post_date            =   $row['post_date'];
            $post_content         =   substr($row['post_content'], 0,50);
            $post_tags            =   $row['post_tags'];
            $post_category_id     =   $row['post_category_id'];
            $post_comment_count   =   $row['post_comment_count'];
            $post_views_count     =   $row['post_views_count'];
            $post_status          =   $row['post_status'];
     ?>

      <tbody>
        <tr>
            <td><input type="checkbox" name="checkBoxArray[]" class="checkBoxes" value="<?php echo $post_id; ?>"></td>
            <?php
                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";

                $category_query   =  "SELECT * FROM blog_category WHERE category_id = $post_category_id";
                $select_category  =  mysqli_query($connection, $category_query);

                while ($row = mysqli_fetch_assoc($select_category)) {

                    $view_category_id     =  $row['category_id'];
                    $view_category_title  =  $row['category_title'];

                echo "<td>$view_category_title</td>"; 
                }

                echo "<td>$post_title</td>";  
                echo "<td><img class='img-responsive' src='../common/images/$post_image'></td>";   
                echo "<td>$post_date</td>";
                echo "<td>$post_content</td>";    
                echo "<td>$post_tags</td>";    
                echo "<td>$post_comment_count</td>";    
                echo "<td>$post_views_count</td>";    
                echo "<td>$post_status</td>";    
                

                $post_author_name = $_SESSION['firstname'] ." ". $_SESSION['lastname'];
                if($post_author == $post_author_name) {

                    echo "<td><a href='posts.php?action=edit_post&edit_id=$post_id' class='btn btn-danger glyphicon glyphicon-pencil'></a></td>";
                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?'); \" href='posts.php?delete=$post_id' class='btn btn-danger glyphicon glyphicon-trash'></a></td>";

                    if(isset($_GET['delete'] ))
                    {
                        $post_id  =  $_GET['delete'];

                        $query    =  "DELETE FROM posts WHERE post_id = {$post_id} ";
                        $result   =  mysqli_query($connection, $query);
                        header("Location: posts.php");

                        if($result)
                        {
                            echo "Post Deleted !";
                        } else {
                            echo "Failed to delete post " . mysqli_error($connection);
                        }
                    }
                } else {

                    echo "<td><button disabled href='#' class='btn btn-warning glyphicon glyphicon-pencil'></button></td>";
                    echo "<td><button disabled href='#' class='btn btn-warning glyphicon glyphicon-trash'></button></td>";
                }
                    
                } 
            ?>
        </tr>
      </tbody>
    </table>
</form>
  </div>

  <div class="text-center">
    <ul class="pagination pagination-lg">
        <?php
            for ($i=1; $i <=$posts_count ; $i++) { 
                echo "<li><a href='posts.php?page=$i'>$i</a></li>";
            }
        ?>
    </ul>
  </div>

</div>