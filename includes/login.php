<?php include 'db.php'; ?>
<?php session_start(); ?>

<?php

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $db_password = $row['user_password'];

            // Verify password
            if(password_verify($password, $db_password)) {
                // Password is correct
                $db_user_id = $row['user_id'];
                $db_username = $row['username'];
                $db_user_firstname = $row['user_firstname'];
                $db_user_lastname = $row['user_lastname'];
                $db_user_role = $row['user_role'];
                $db_user_password = $row['user_password'];
                // Setting sessions
                $_SESSION['user_id'] = $db_user_id;
                $_SESSION['username'] =$db_username;
                $_SESSION['user_firstname'] =$db_user_firstname;
                $_SESSION['user_lastname'] =$db_user_lastname;
                $_SESSION['user_role'] =$db_user_role;


                // Heading users to specific page by role
                if($_SESSION['user_role'] == 'admin'){
                    // echo "To admin";
                    header('Location: ../admin/index.php');
                    exit(); // Stop further execution
                } else if($_SESSION['user_role'] == 'user'){
                    // echo "To front";
                    header('Location: ../index.php');
                    exit(); // Stop further execution
                }else{
                    //
                }
            }
        }else{
            header('Location: ../login_error_page.php');
            exit(); // Stop further execution
        }
        
        // If username or password is incorrect, redirect to index.php
        // echo "Denied";
        header('Location: ../index.php');
        exit(); // Stop further execution
    }
?>
