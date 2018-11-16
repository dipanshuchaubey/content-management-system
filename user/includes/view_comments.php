<div class="table-responsive">

<!-- Bulk Options -->
<select name=>
    <option value="">         Select an option </option>
    <option value="approved"> Approve          </option>
    <option value="rejected"> Reject           </option>
    <option value="delete">   Delete           </option>
</select>

<div class="bulkOptionButtons">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
</div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <td><input type="checkbox" name="bulkOption"></td>
                <td>Id           </td>
                <td>Author       </td>
                <td>Comment      </td>
                <td>Date         </td>
                <td>Email        </td>
                <td>Status       </td>
                <td>Commented on </td>
                <td>Approve      </td>
                <td>Reject       </td>
                <td>Delete       </td>
            </tr>
        </thead>

    <?php
        /* Reading Comments From Database */

        global $connection;
        $query   =  "SELECT * FROM post_comments ";
        $result  =  mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {

            $comment_id          =  $row['comment_id'];
            $comment_author      =  $row['comment_author'];
            $comment_content     =  $row['comment_content'];
            $comment_date        =  $row['comment_date'];
            $comment_email       =  $row['comment_email'];
            $comment_status      =  $row['comment_status'];
            $commented_on        =  $row['comment_post_id'];
            $comment_post_id     =  $row['comment_post_id']; 
    ?>
        <tbody>
            <tr>
                <td><input type="checkbox" name="checkBoxArray[]" class="checkBoxes" value="<?php echo $comment_id; ?>"></td>
                
            <?php
                echo "<td>$comment_id</td>";
                echo "<td>$comment_author</td>";
                echo "<td>$comment_content</td>";
                echo "<td>$comment_date</td>";
                echo "<td>$comment_email</td>";
                echo "<td>$comment_status</td>";

                /* Reading Posts Data From Database */

                $comment_post_query  =  "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                $post_result         =  mysqli_query($connection, $comment_post_query);

                while ($row = mysqli_fetch_assoc($post_result)) 
                {
                    $comment_post_title = $row['post_title'];
                    echo "<td><a href='../post.php?read_id=$comment_post_id'>$comment_post_title</a></td>"; 
                }

                echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                echo "<td><a href='comments.php?reject=$comment_id'>Reject</a></td>"; 
                echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>"; 

                } ?>
            </tr>
        </tbody>
    </table>
</div>

<?php
    /* APPROVE, REJECT & DELETE Functions Goes Here */

    if(isset($_GET['approve'])) {

            $comment_id = $_GET['approve'];

            $query   =  "UPDATE post_comments SET comment_status = 'Approved' WHERE comment_id = {$comment_id} ";
            $result  =  mysqli_query($connection, $query);
            header("Location: comments.php");

    } elseif(isset($_GET['reject'])) {

            $comment_id = $_GET['reject'];

            $query   =  "UPDATE post_comments SET comment_status = 'Rejected' WHERE comment_id = {$comment_id} ";
            $result  =  mysqli_query($connection, $query);
            header("Location: comments.php");

    } elseif(isset($_GET['delete'])) {

            $delete_comment_id = $_GET['delete'];

            $query   =  "DELETE FROM post_comments WHERE comment_id = {$delete_comment_id} ";
            $result  =  mysqli_query($connection, $query);
            header("Location: comments.php");
    }
?>