<?php ob_start() ?>
<?php include "../includes/connect_db.php" ?>
<?php session_start() ?>
<?php 

if(! isset($_SESSION['user_role'])) {

    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="../common/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../common/css/sb-admin.css" rel="stylesheet">
    <link href="../common/css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../common/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- JavaScript -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- <script type="text/javascript" src="js/main.js"></script> -->
</head>