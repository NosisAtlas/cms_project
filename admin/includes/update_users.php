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
        <input class="btn btn-primary" type="submit" value="Update" name="update_post">
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

        if($post_title == "" || empty($post_title) ||
                $post_author == "" || empty($post_author) ||
                $post_date == "" || empty($post_date) ||
                // $post_img == "" || empty($post_img) ||
                $post_content == "" || empty($post_content) ||
                $post_tags == "" || empty($post_tags) ||
                $post_status == "" || empty($post_status) ||
                $post_comment_count == "" || empty($post_comment_count) ||
                $post_category_id == "" || empty($post_category_id)
            ){
                echo "The fields should not be empty";
            }else{
                $query = "UPDATE posts SET ";
                $query .= "post_title = '{$post_title}', ";
                $query .= "post_category_id = '{$post_category_id}', ";
                $query .= "post_date = now(), ";
                $query .= "post_author = '{$post_author}', ";
                $query .= "post_status = '{$post_status}', ";
                $query .= "post_tags = '{$post_tags}', ";
                $query .= "post_content = '{$post_content}', ";
                $query .= "post_img = '{$post_img}' ";
                $query .= "WHERE post_id = {$post_id}";


                $update_post_query = mysqli_query($connection, $query);
                checkQuery($update_post_query);
                header("Location: posts.php");
            }

    }
?>