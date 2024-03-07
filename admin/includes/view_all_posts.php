<?php 
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $post_value_id) {
            $bulk_options = $_POST['bulk_options'];
            switch($bulk_options){
                case 'published' :
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$post_value_id} ";
                    $update_to_published_status_posts = mysqli_query($connection, $query);
                    checkQuery($update_to_published_status_posts);
                    break;
                case 'draft' :
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id ={$post_value_id} ";
                    $update_to_draft_status_posts = mysqli_query($connection, $query);
                    checkQuery($update_to_draft_status_posts);
                    break;
                case 'delete' :
                    $query = "DELETE FROM posts WHERE post_id ={$post_value_id}";
                    $delete_posts = mysqli_query($connection, $query);
                    checkQuery($delete_posts);
                    break;
            }
        }
    }
?>

<form action="" method="post">
<div class="table-responsive">
    <table class="table table-bordered table-hover">
            <div id="bulkOptionsContainer" class="col-xs-4">
                <select class="form-control" name="bulk_options" id="">
                    <option value="">Select Options</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <div class="col-xs-4">
                <input type="submit" name="submit" class=" btn btn-success" value="Apply">
                <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
            </div>
                            <thead>
                                <tr>
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <td>Content</td>
                                    <th>Date</th>
                                    <th>Tags</th>
                                    <th>Status</th>
                                    <th>Comments</th>   
                                    <th>Update</th>                                    
                                    <th>Actions</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php findAllPosts(); ?>
                                <?php 
                                // Deleting posts
                                deletePost();                 
                            ?>
                            </tbody>
    </table>
</div>
</form>