<?php 
    $query = "SELECT * FROM posts WHERE post_id = '{$post_id}'";
    $select_post_by_id = mysqli_query($connection, $query);
    // Displaying categ data
    while($row = mysqli_fetch_assoc($select_post_by_id)){
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_date = $row['post_date'];
        $post_img = $row['post_img'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
        $post_comment_count = $row['post_comment_count'];
        $post_category_id = $row['post_category_id'];

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input class="form-control" type="text" value="<?php echo $post_title; ?>" name="post_title">
    </div>
    <!-- Post category -->
    <div class="form-group">
        <label for="post_category">Post Category</label><br>
        <select class="form-select form-control" name="post_category" id="post_category">
            <?php 
                $query = "SELECT * FROM categories";
                $select_categs = mysqli_query($connection, $query);
                checkQuery($select_categs);
                // Displaying categ data
                while($row = mysqli_fetch_assoc($select_categs)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
            ?>
                <option value="<?php echo $cat_id; ?>" 
                    <?php if($cat_id == $post_category_id) echo 'selected'; ?>>
                    <?php echo $cat_title; ?>
                </option>


            <?php } ?>
        </select>
    </div>
    <!-- Post author -->
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input class="form-control" type="text" value="<?php echo $post_author; ?>" name="post_author">
    </div>
    <!-- Post status -->
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select class="form-select form-control" name="post_status" id="post_status">
            <option value="draft">draft</option>
            <option value="published">published</option>
        </select>
    </div>
    <!-- Post old image preview -->
    <div class="form-group">
        <img class='img-fluid img-thumbnail' width='100' src="../imgs/<?php echo $post_img; ?>" alt="">
    </div>
    <!-- Post image -->
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input class="form-control" type="file" name="image">
    </div>
    <!-- Post tags -->
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input class="form-control" type="text" value="<?php echo $post_tags; ?>" name="post_tags">
    </div>
    <!-- Post content -->
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" id="" cols="30" rows="10" name="post_content"><?php echo $post_content; ?></textarea>
    </div>
<?php
}
?>
    <!-- Submit btn -->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Update" name="update_user">
    </div>
</form>

<?php 
    // Updating categs query
    if(isset($_POST['update_post'])){
        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];
        $post_date = date('d-m-y');

        // Getting image
        $post_img = $_FILES['image']['name'];
        $post_img_temp = $_FILES['image']['tmp_name'];

        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        $post_status = $_POST['post_status'];
        $post_comment_count = 7;
        $post_category_id = $_POST['post_category'];

        // Processing img
        move_uploaded_file($post_img_temp, "../imgs/$post_img");

        if(empty($post_img)){
            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $select_img = mysqli_query($connection, $query);
            while($row = mysqli_fetch_array($select_img)){
                $post_img = $row['post_img'];
            }
        }

        // Validating data
        if($username == "" || empty($username) ||
        $user_password == "" || empty($user_password) ||
        $user_email == "" || empty($user_email) 
        ){
        echo "The fields should not be empty. You must at least insert username, password and email!";
    }else{
        // Validating pass
        if(strlen($user_password)<= 6 || strlen($user_password) > 15){
            echo "<p>Password must not be less than 6 or more than 15</p>";
        }else{
            $hashFormat = "$2y$10$";
            $salt = "iusesomeordinarypasss24";
            $hashFandSalt = $hashFormat . $salt;
            $encriptPassword = crypt($user_password, $hashFandSalt);

            //Query for insert users
            $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_img, user_role, randSalt)";
            $query .= "VALUES('{$username}','{$encriptPassword}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_img}','{$user_role}','{$user_randSalt}')";
            $create_user_query = mysqli_query($connection, $query);
            checkQuery($create_user_query);                
            header("Location: users.php");
        }
    }
    }
?>