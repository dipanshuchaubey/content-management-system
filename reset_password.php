<?php include "includes/connect_db.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reset Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

  <?php
  if (isset($_GET['user'])) {

    $username = $_GET['user'];

    $query = "SELECT * FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($result)) 
    {
      $org_username = $row['username'];
      $org_ref_key = $row['ref_key'];
    }
  

  if (isset($_GET['reset_password']) && $_GET['reset_password'] == $org_ref_key) {

    $ref_key = $_GET['reset_password'];
  } else {
    header("Location: index.php");
  }

  if (isset($_POST['reset_password'])) {
    $password = $_POST['password2'];

  if ($username === $org_username && $ref_key === $org_ref_key) 
  {

    $password = mysqli_real_escape_string($connection,$password);
    $hash = "$2y$10$";
    $salt = "heyiwasdoingjustfunbeforeimetyou";
    $hashandsalt = $hash . $salt;
    $password = crypt($password, $hashandsalt);

    $post_query = "UPDATE users SET user_password = '$password' WHERE username = '$org_username' ";
    $post_result = mysqli_query($connection, $post_query);

  if ($post_result) {
    $after_post_query = "UPDATE users SET ref_key = ' ' WHERE username = '$org_username' ";
    $after_post_result = mysqli_query($connection, $after_post_query);
    header("Location: index.php");

  } else {
    echo "Failed to reset password. Try again !";
  }

  } else {

    echo "Wrong Refrence key or username !";
    header("Location: index.php");
  }
  }

  } else {
    header("Location: index.php");
  }
  ?>

<div class="container">
  <h2 style="text-align: center;">Reset Password Form</h2>
  <form class="form-horizontal" method="post">
   
    <div class="form-group">
      <label class="control-label col-sm-2">Password</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password1" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Re-enter Password</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password2" required>
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="reset_password" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>