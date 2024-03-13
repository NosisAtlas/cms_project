
<?php insertPosts(); ?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input class="form-control" type="text" name="post_title">
    </div>
    <!-- Post category -->
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select class="form-select form-control" name="post_category_id" id="post_category">
            <?php 
                $query = "SELECT * FROM categories";
                $select_categs = mysqli_query($connection, $query);
                checkQuery($select_categs);
                // Displaying categ data
                while($row = mysqli_fetch_assoc($select_categs)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
            ?>
                <option value="<?php echo $cat_id; ?>">
                    <?php echo $cat_title; ?>
                </option>


            <?php } ?>
        </select>
    </div>
    <!-- Post author -->
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <select class="form-select form-control" name="post_author" id="post_author">
            <?php 
                $query = "";
                if(is_admin()){
                    $query = "SELECT * FROM users";
                }else{
                    $query = "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}";
                }
                $select_users = mysqli_query($connection, $query);
                checkQuery($select_users);
                // Displaying categ data
                while($row = mysqli_fetch_assoc($select_users)){
                    $user_id = $row['cat_id'];
                    $user_username = $row['username'];
            ?>
                <option value="<?php echo $user_username; ?>">
                    <?php echo $user_username; ?>
                </option>


            <?php } ?>
        </select>
    </div>
    <!-- Post status -->
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select class="form-select form-control" name="post_status" id="post_status">
            <option value="draft">draft</option>
            <option value="published">published</option>
        </select>
    </div>
    <!-- Post image -->
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input class="form-control" type="file" name="image">
    </div>
    <!-- Post tags -->
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input class="form-control" type="text" name="post_tags">
    </div>
    <!-- Post content -->
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" id="content" cols="30" rows="10" name="post_content"></textarea>
    </div>
    <!-- Submit btn -->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Publish" name="create_post">
    </div>
</form>

