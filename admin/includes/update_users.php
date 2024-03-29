<?php 
    $query = "SELECT * FROM users WHERE user_id = '{$user_id}'";
    $select_user_by_id = mysqli_query($connection, $query);
    // Displaying categ data
    while($row = mysqli_fetch_assoc($select_user_by_id)){
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_img = $row['user_img'];
        $user_role = $row['user_role'];
        $user_randSalt = $row['randSalt'];

?>
<?php 
    }
    // Updating user data query
    if(isset($_POST['update_user'])){
        $post_username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

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
        $query .= "username = '{$post_username}', ";
        $query .= $password_update;
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_img = '{$user_img}', ";
        $query .= "user_role = '{$user_role}' ";
        $query .= "WHERE user_id = {$user_id}";

        $update_user_query = mysqli_query($connection, $query);
        checkQuery($update_user_query);
        // Check if the user connected data is being changed
        if(isset($_SESSION['user_role'])){
            $user_session_role = $_SESSION['user_role'];
            $user_session_id = $_SESSION['user_id'];
            if($user_session_role == 'admin' && $user_session_id == $user_id) {
                // Setting the new session data
                $new_username = $post_username;
                $new_user_firstname = $user_firstname;
                $new_user_lastname = $user_lastname;
                $new_user_role = $user_role;
                // setting sessions
                $_SESSION['username'] = "";
                $_SESSION['username'] = $new_username;
                $_SESSION['user_firstname'] = $new_user_firstname;
                $_SESSION['user_lastname'] = $new_user_lastname;
                $_SESSION['user_role'] = $new_user_role; 
                if($new_user_role == "admin"){
                    header("Location: users.php?source=edit_user&user_id=2");
                }else if($new_user_role == "user"){
                    // echo "logout";
                header("Location: ../includes/logout.php");
                }
                echo "<div class='alert alert-success' role='alert'>
                        Your user data updated successfully !  <a href='users.php' class='btn btn-success'>View users</a>
                        </div>"; 
                
            }else if($user_role == 'user' && $user_session_id !== $user_id){
                echo "<div class='alert alert-success' role='alert'>
                        User updated successfully !  <a href='users.php' class='btn btn-success'>View users</a>
                        </div>";
            }
        }
        
    }
?>

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
    <!-- User role -->
    <div class="form-group">
        <label for="user_role">User role</label>
        <select class="form-select form-control" name="user_role" id="user_role">
            <option value="<?php echo $user_role; ?>" selected><?php echo $user_role; ?></option>
            <?php 
                if($user_role == 'admin'){
                    echo "<option value='user'>user</option>";
                }else{
                    echo "<option value='admin'>admin</option>";
                }
            ?>
        </select>
    </div>

    <!-- Submit btn -->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Update user" name="update_user">
    </div>
</form>

