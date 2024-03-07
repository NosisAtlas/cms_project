<?php include 'includes/admin_header.php' ?>
<?php
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_user_profile_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($select_user_profile_query)){
            // fetching data
            $user_id = $row['user_id'];
            $user_img = $row['user_img'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
        }
    }
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/admin_navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin Users
                            <small><?php
                                if(isset($_SESSION['username'])){
                                    echo strtoupper($_SESSION['username']);
                                } ?>
                            </small>
                        </h1>
                       <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control" type="text" value="<?php echo $username; ?>" name="username">
                            </div>
                            <!-- Password -->
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input class="form-control" type="password" name="user_password">
                            </div>
                            <!-- Firstname -->
                            <div class="form-group">
                                <label for="user_firstname">Firstname</label>
                                <input class="form-control" type="text" value="<?php echo $user_firstname; ?>" name="user_firstname">
                            </div>
                            <!-- Lastname -->
                            <div class="form-group">
                                <label for="user_lastname">Lastname</label>
                                <input class="form-control" type="text" value="<?php echo $user_lastname; ?>" name="user_lastname">
                            </div>
                            <!-- User email -->
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input class="form-control" type="email" value="<?php echo $user_email; ?>" name="user_email">
                            </div>
                            <!-- Post old image preview -->
                            <div class="form-group">
                                <img class='img-fluid img-thumbnail' width='100' src="../admin/imgs/<?php echo $user_img; ?>" alt="">
                            </div>
                            <!-- User image -->
                            <div class="form-group">
                                <label for="user_image">Profile image</label>
                                <input class="form-control" type="file" name="image">
                            </div>

                            <!-- Submit btn -->
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Update profile" name="update_profile">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include "includes/admin_footer.php" ?>

  <?php 
    
    // Updating user data query
    if(isset($_POST['update_profile'])){
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];

        // Checking if password is provided
        if(!empty($user_password)) {
            // Hash the password
            $hashFormat = "$2y$10$";
            $salt = "iusesomeordinarypasss24";
            $hashFandSalt = $hashFormat . $salt;
            $encriptPassword = crypt($user_password, $hashFandSalt);
            // Include password update in the query
            $password_update = "user_password = '{$encriptPassword}', ";
        }else if(empty($user_password)){
            $password_update = "";
        }

        // Check if new image uploaded
        if(!empty($_FILES['image']['name'])) {
            $user_img = $_FILES['image']['name'];
            $user_img_temp = $_FILES['image']['tmp_name'];
            move_uploaded_file($user_img_temp, "../admin/imgs/$user_img");
        }

        // Updating user data query
        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= $password_update;
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_img = '{$user_img}' ";
        $query .= "WHERE user_id = {$user_id}";

        $update_user_query = mysqli_query($connection, $query);
        checkQuery($update_user_query);
        // Setting the new session data
        $new_username = $username;
        $new_user_firstname = $user_firstname;
        $new_user_lastname = $user_lastname;
        // Setting sessions
        $_SESSION['username'] =$new_username;
        $_SESSION['user_firstname'] =$new_user_firstname;
        $_SESSION['user_lastname'] =$new_user_lastname;
        // Check if the user role is being changed to "user"
        if(isset($_SESSION['username'])){
            $user_role = $_SESSION['user_role'];
            if($user_role == 'user') {
                // Destroy the session
                session_destroy();
                // Redirect the user to the index page
                header("Location: ../index.php");
                exit(); // Stop further execution
            }else if($user_role == 'admin'){
                header("Location: ./");
            }
        }
    }
?>
