<div id="demo">

  <div class="table-responsive-vertical shadow-z-1">
  <!-- Table starts here -->
  <table id="table" class="table table-hover table-bordered table-mc-light-blue">
      <thead>
        <tr style="font-weight: bold;">
            <td>Id</td>
            <td>Username</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Email</td>
            <td>Role</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
      </thead>
      <?php
    global $connection;

    $query = "SELECT * FROM users ";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];

    if (isset($_GET['delete_user'])) {

        $delete_id = $_GET['delete_user'];

        $delete_query = "DELETE FROM users WHERE user_id = {$delete_id} ";

        $delete_result = mysqli_query($connection, $delete_query);
        header("Location: ./users.php");
    }
    ?>
      <tbody>
        <tr>
            <tr>
            <?php
            echo "<td data-title='ID'>$user_id</td>";
            echo "<td data-title='Username'>$username</td>";
            echo "<td data-title='First Name'>$user_firstname</td>";
            echo "<td data-title='Last Name'>$user_lastname</td>";
            echo "<td data-title='Email'>$user_email</td>";
            echo "<td data-title='User Roll'>$user_role</td>";
            echo "<td data-title='Edit'><a href='users.php?action=edit_user&user_id=$user_id'>Edit</a></td>";
            echo "<td data-title='Delete'><a href='users.php?delete_user=$user_id'>Delete</a></td>";
            } ?>
        </tr>
      </tbody>
    </table>
  </div>
</div>
