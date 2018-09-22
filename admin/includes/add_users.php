<?php
    if(isset($_POST['add_user'])) {

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];

        $username = mysqli_real_escape_string($connection, $username);
        $user_password = mysqli_real_escape_string($connection, $user_password);

        $hash = "$2y$10$";
        $salt = "heyiwasdoingjustfunbeforeimetyou";
        $hashandsalt = $hash . $salt;
        $user_password = crypt($user_password, $hashandsalt);

        $add_user_query = "INSERT INTO users(user_firstname, user_lastname, user_email, user_role, username, user_password) ";
        
        $add_user_query .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_role}', '{$username}', '{$user_password}')";

        $add_user_result = mysqli_query($connection, $add_user_query);

        if($add_user_result) {
            echo "User Added !";
        } else {
            echo "Query Failed !" . mysqli_error($connection);
        }
    }
?>

<form action="" method="post">

    <h4>First Name</h4>
    <div class="form-group">
        <input class="form-control" type="text" name="user_firstname">
    </div>

    <h4>Last Name</h4>
    <div class="form-group">
        <input class="form-control" type="text" name="user_lastname">
    </div>

    <h4>User Email</h4>
    <div class="form-group">
        <input class="form-control" type="email" name="user_email">
    </div>

    <div class="form-group">
        <h4>User Role</h4>
        <select name="user_role">
            <option value="subscriber">Select Option</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <h4>Username</h4>
    <div class="form-group">
        <input class="form-control" type="text" name="username">
    </div>

    <h4>Password</h4>
    <div class="form-group">
        <input class="form-control" type="password" name="user_password">
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_user" value="Add User">
    </div>

</form>