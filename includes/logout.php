<?php session_start(); ?>

<?php
    // Unsetting sessions
    $_SESSION['username'] = null;
    $_SESSION['user_firstname'] = null;
    $_SESSION['user_lastname'] = null;
    $_SESSION['user_role'] = null;
    // unset();
    header("Location: ../index.php");
?>
