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

<?php 
    }
    
    // Updating user data query
    if(isset($_POST['update_user'])){
        $username = $_POST['username'];
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
        $query .= "user_password = '{$encriptPassword}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_img = '{$user_img}', ";
        $query .= "user_role = '{$user_role}' ";
        $query .= "WHERE user_id = {$user_id}";

        $update_user_query = mysqli_query($connection, $query);
        checkQuery($update_user_query);
        header("Location: users.php");
    }
?>