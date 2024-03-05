
<?php insertPosts(); ?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input class="form-control" type="text" name="post_title">
    </div>
    <!-- Post category -->
    <div class="form-group">
        <label for="post_category">Post Category</label><br>
        <select class="form-select" name="post_category_id" id="post_category">
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
        <input class="form-control" type="text" name="post_author">
    </div>
    <!-- Post status -->
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input class="form-control" type="text" name="post_status">
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
        <textarea class="form-control" id="" cols="30" rows="10" name="post_content"></textarea>
    </div>
    <!-- Submit btn -->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Publish" name="create_post">
    </div>
</form>