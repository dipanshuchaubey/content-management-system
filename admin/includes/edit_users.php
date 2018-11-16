<?php
    if (isset($_GET['user_id'])) {

        $edit_user_id = $_GET['user_id'];
    }

    $query = "SELECT * FROM users WHERE user_id = $edit_user_id ";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
    }

    if(isset($_POST['update_user'])) {

        $edit_user_firstname = $_POST['edit_user_firstname'];
        $edit_user_lastname = $_POST['edit_user_lastname'];
        $edit_user_email = $_POST['edit_user_email'];
        $edit_user_role = $_POST['edit_user_role'];
        $edit_username = $_POST['edit_username'];

        $edit_user_query = "UPDATE users SET ";
        $edit_user_query .= "user_firstname = '{$edit_user_firstname}', ";
        $edit_user_query .= "user_lastname = '{$edit_user_lastname}', ";
        $edit_user_query .= "user_email = '{$edit_user_email}', "; 
        $edit_user_query .= "user_role = '{$edit_user_role}', "; 
        $edit_user_query .= "username = '{$edit_username}' "; 
        $edit_user_query .= "WHERE user_id = {$edit_user_id} ";
        
        $edit_user_result = mysqli_query($connection, $edit_user_query);

        if(!$edit_user_result)
        {
            echo "Failed To Edit User" . mysqli_error($connection);
        } else {
            echo "<h4>User Updated !</h4>";
            header("Location: users.php?action=edit_user&user_id={$edit_user_id}");
        }
    }
?>

<form action="" method="post">

    <h4>First Name</h4>
    <div class="form-group">
        <input class="form-control" type="text" name="edit_user_firstname" value="<?php echo $user_firstname; ?>">
    </div>

    <h4>Last Name</h4>
    <div class="form-group">
        <input class="form-control" type="text" name="edit_user_lastname" value="<?php echo $user_lastname; ?>">
    </div>
    
    <h4>User Email</h4>
    <div class="form-group">
        <input class="form-control" type="email" name="edit_user_email" value="<?php echo $user_email; ?>">
    </div>

    <div class="form-group">
        <h4>User Role</h4>
        <select name="edit_user_role">
            <option value='<?php echo $user_role; ?>'><?php echo $user_role; ?></option>
            <?php 
            if ($user_role == 'admin') {
                echo "<option value='subscriber'>Subscriber</option>";
            } else {
                echo "<option value='admin'>Admin</option>";
            }
            ?>
        </select>
    </div>

    <h4>Username</h4>
    <div class="form-group">
        <input class="form-control" type="text" name="edit_username" value="<?php echo $username; ?>">
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_user" value="Submit Changes">
    </div>

</form>