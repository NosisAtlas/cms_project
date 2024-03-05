
<?php insertPosts(); ?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input class="form-control" type="text" name="post_title">
    </div>
    <!-- Post category -->
    <div class="form-group">
        <label for="post_category_id">Post Category Id</label>
        <input class="form-control" type="text" name="post_category_id">
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