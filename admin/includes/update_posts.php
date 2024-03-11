<?php 
    // Check if the update_post form was submitted
    if(isset($_POST['update_post'])){
        // Get the form data
        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];

        // Getting image
        $post_img = $_FILES['image']['name'];
        $post_img_temp = $_FILES['image']['tmp_name'];

        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        $post_status = $_POST['post_status'];
        $post_category_id = $_POST['post_category'];

        // Processing img
        move_uploaded_file($post_img_temp, "../imgs/$post_img");

        // If no new image uploaded, retain the old image
        if(empty($post_img)){
            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $select_img = mysqli_query($connection, $query);
            while($row = mysqli_fetch_array($select_img)){
                $post_img = $row['post_img'];
            }
        }

        // Updating post data query
        $query = "UPDATE posts SET ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_title = '{$post_title}',";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_img = '{$post_img}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_status = '{$post_status}' ";
        $query .= "WHERE post_id = {$post_id}";

        // Execute the update query
        $update_post_query = mysqli_query($connection, $query);
        checkQuery($update_post_query);

        // Check if the query was successful
        if($update_post_query) {
            // Display success message with a link to the updated post
            echo "<div class='alert alert-success' role='alert'>
                    Post updated successfully! <a href='../post.php?post_id={$post_id}' class='btn btn-success'>View post</a>Or<a href='posts.php' class='btn btn-secondary'>Edit more posts</a>
                </div>";
        } else {
            // Display error message
            echo "<div class='alert alert-danger' role='alert'>
                    Failed to update post. Please try again.
                </div>";
        }
    }
?>

<?php 
    // Fetch the post data to pre-fill the form fields
    $query = "SELECT * FROM posts WHERE post_id = '{$post_id}'";
    $select_post_by_id = mysqli_query($connection, $query);
    // Displaying post data
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
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <!-- Post Title -->
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input class="form-control" type="text" value="<?php echo $post_title; ?>" name="post_title">
    </div>
    <!-- Post Category -->
    <div class="form-group">
        <label for="post_category">Post Category</label><br>
        <select class="form-select form-control" name="post_category" id="post_category">
            <?php 
                $query = "SELECT * FROM categories";
                $select_categs = mysqli_query($connection, $query);
                checkQuery($select_categs);
                // Displaying category data
                while($row = mysqli_fetch_assoc($select_categs)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
            ?>
                <option value="<?php echo $cat_id; ?>" <?php if($cat_id == $post_category_id) echo 'selected'; ?>><?php echo $cat_title; ?></option>
            <?php } ?>
        </select>
    </div>
    <!-- Post Author -->
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <select class="form-select form-control" name="post_author" id="post_author">
            <?php 
                $query = "SELECT * FROM users";
                $select_users = mysqli_query($connection, $query);
                checkQuery($select_users);
                // Displaying category data
                while($row = mysqli_fetch_assoc($select_users)){
                    $user_id = $row['user_id'];
                    $user_username = $row['username'];
            ?>
                <option value="<?php echo $user_username; ?>" <?php if($user_username === $post_author) echo 'selected'; ?>><?php echo $user_username; ?></option>
            <?php } ?>
        </select>
    </div>
    <!-- Post Status -->
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select class="form-select form-control" name="post_status" id="post_status">
            <option value="<?php echo $post_status; ?>" selected><?php echo $post_status; ?></option>
            <?php 
                if($post_status == 'draft'){
                    echo "<option value='published'>published</option>";
                }else{
                    echo "<option value='draft'>draft</option>";
                }
            ?>
        </select>
    </div>
    <!-- Post Old Image Preview -->
    <div class="form-group">
        <img class='img-fluid img-thumbnail' width='100' src="../imgs/<?php echo $post_img; ?>" alt="">
    </div>
    <!-- Post Image -->
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input class="form-control" type="file" name="image">
    </div>
    <!-- Post Tags -->
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input class="form-control" type="text" value="<?php echo $post_tags; ?>" name="post_tags">
    </div>
    <!-- Post Content -->
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" id="content" cols="30" rows="10" name="post_content"><?php echo $post_content; ?></textarea>
    </div>
    <!-- Submit Button -->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Update" name="update_post">
    </div>
</form>
