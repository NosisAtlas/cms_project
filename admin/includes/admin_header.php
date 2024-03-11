<?php session_start(); ?>
<?php ob_start(); ?>
<?php include "../includes/db.php" ?>
<?php include "functions.php" ?>

<?php
    // Redirecting the users with user role 
    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'user'){
            header("Location: ../index.php");
            exit();
        }
    }else{
         // Redirect to home page or handle unauthorized access
         header("Location: ../404_page.php");
         exit();
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

    <title>CMS PHP</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- CKEDITOR script -->
    <style>.ck-editor__editable[role="textbox"] {
                /* Editing area */
                min-height: 300px;
            }</style>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
    <!-- CKEDITOR script END -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
</head>

<body>