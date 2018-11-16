<?php include "includes/header.php" ?>
<?php include "functions.php" ?>

<body>

    <div id="wrapper">

    <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!--Navbar-->
            <?php include "includes/navigation.php" ?>
            <!--Sidebar-->
            <?php include "includes/sidebar.php" ?>
    <!--navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Users
                            <small>CMS</small>
                        </h1>
                    </div>
                </div>
                <img src="">

                <!-- Posts table-->

<?php
    if (isset($_SESSION['username'])) {

        $username = $_SESSION['username'];
    }

    $profile_query = "SELECT * FROM users WHERE username = '$username' ";
    $profile_result = mysqli_query($connection, $profile_query);

    while ($row = mysqli_fetch_array($profile_result)) {
        
        $user_password    =  $row['user_password'];
        $user_firstname   =  $row['user_firstname'];
        $user_lastname    =  $row['user_lastname'];
        $user_email       =  $row['user_email'];
        $user_role        =  $row['user_role'];
    }

    if(isset($_POST['update_user_profile'])) {

        $edit_user_firstname   =  $_POST['edit_user_firstname'];
        $edit_user_lastname    =  $_POST['edit_user_lastname'];
        $edit_user_email       =  $_POST['edit_user_email'];
        $edit_user_role        =  $_POST['edit_user_role'];
        $edit_username         =  $_POST['username'];

        $edit_user_query   =  "UPDATE users SET ";
        $edit_user_query  .=  "user_firstname = '{$edit_user_firstname}', ";
        $edit_user_query  .=  "user_lastname = '{$edit_user_lastname}', ";
        $edit_user_query  .=  "user_email = '{$edit_user_email}', "; 
        $edit_user_query  .=  "user_role = '{$edit_user_role}' "; 
        $edit_user_query  .=  "WHERE username = '{$edit_username}' ";
        
        $edit_user_result = mysqli_query($connection, $edit_user_query);

        if(!$edit_user_result)
        {
            echo "Failed To Edit User" . mysqli_error($connection);
        } else {
            echo "<h4>User Updated !</h4>";
            header("Location: profile.php");
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
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
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
        <input class="form-control" type="text" name="username" value="<?php echo $username; ?>" readonly>
    </div>

    <h4>Password</h4>
    <div class="form-group">
        <a href="profile.php?reset_password">Reset Password</a>
    </div>

    <?php 
    if(isset($_GET['reset_password'])) {

        $randstring = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $string = substr(str_shuffle($randstring), 0,40);

        $message = "<html>
                    <head>
                        
                    </head>
                    <body style='background-color: #f8f8f8; font-family: sans-serif; margin: auto 40px auto 40px;'>
                        <div class='head'>
                            <img class='img-responsive' src='http://cdn.onlinewebfonts.com/svg/img_118308.png' style='display: block; margin: 30px auto 30px auto; width: 25%'>
                        </div>
                        <div class='container' style='padding: 25px 0 25px 0; border-radius: 10px 10px; text-align: center; background-color: white; line-height: 3.0;'>
                            <h1>Reset Password</h1>
                            <p>It seems like you forgot your password for your CMS account, click below to reset your password.</p>

                            <a href='http://localhost/cms/reset_password.php?user=$username&reset_password=$string'><button style='display: inline-block;
                      font-weight: 400;
                      text-align: center;
                      white-space: nowrap;
                      vertical-align: middle;
                      -webkit-user-select: none;
                      -moz-user-select: none;
                      -ms-user-select: none;
                      user-select: none;
                      border: 1px solid transparent;
                      padding: 0.375rem 0.75rem;
                      font-size: 1rem;
                      line-height: 1.5;
                      border-radius: 0.25rem;
                      transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;' class='btn'>Reset My Password</button></a>

                            <p>If you did not forgot your password you can safely ignore this email.</p>
                        </div>

                        <div class='footer' style='margin-top: 30px; line-height: 0.2; color: grey; text-align: center; font-size: 13px;'>
                            <p>CMS Inc. | Nagpur | M.H | IN</p>
                            <p>Didn't like this mail? <a href='#'>unsubscribe</a></p>

                            <p><span style='line-height: 2.5;
                    '>Powered by CMS by Dipanshu Chaubey</span></p>
                        </div>

                    </body>
                    </html>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        if (mail($user_email, "Password Reset", $message, $headers)) {

            echo "A link has been sent to your registered email";
            $ref_key_query = "UPDATE users SET ref_key = '$string' WHERE username = '$username' ";
            $ref_key_result = mysqli_query($connection, $ref_key_query);
        }
    }
    ?>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_user_profile" value="Update Profile">
    </div>

</form>


            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include 'includes/footer.php'; ?>