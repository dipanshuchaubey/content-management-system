<?php include "connect_db.php" ?>
<?php session_start() ?>
<?php

    if (isset($_POST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $hash = '$2y$10$heyiwasdoingjustfunbeforeimetyou';
        $password = crypt($password, $hash);

        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $result = mysqli_query($connection, $query);

        if (! $result) {
            die("Wrong Username or Bad connection !");
        }

        while ($row = mysqli_fetch_array($result)) {
            
            $org_username = $row['username'];
            $org_firstname = $row['user_firstname'];
            $org_lastname = $row['user_lastname'];
            $org_user_password = $row['user_password'];
            $org_user_role = $row['user_role'];
        }

        if ($username === $org_username && $password === $org_user_password) {

            $_SESSION['firstname'] = $org_firstname;
            $_SESSION['lastname'] = $org_lastname;
            $_SESSION['username'] = $org_username;
            $_SESSION['user_role'] = $org_user_role;
            $_SESSION['time_count'] = time();
            header("Location: ../admin");

        } else {
            header("Location: ../index.php");
        }
    }
?>