<?php 
    // Include delete modal
    include("delete_modal.php");
    // Check the box array
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
                case 'clone' :
                    $query = "SELECT * FROM posts WHERE post_id ={$post_value_id}";
                    $select_post_to_clone = mysqli_query($connection, $query);
                    checkQuery($select_post_to_clone);
                    while($row = mysqli_fetch_array($select_post_to_clone)){
                        $post_id = $row['post_id'];
                        $post_category_id = $row['post_category_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = date('d-m-y');
                        $post_img = $row['post_img'];
                        $post_content = $row['post_content'];
                        $post_tags = $row['post_tags'];
                        $post_status = 'draft';
                    }
                    $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_comment_count, post_status) ";
                    $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_img}', '{$post_content}', '{$post_tags}', 0, '{$post_status}')";


                    $create_post_query = mysqli_query($connection, $query);
                    checkQuery($create_post_query);
                    echo    "<div class='alert alert-success' role='alert'>
                                    Post cloned successfully !  <a href='../post.php?post_id={$post_id}' class='btn btn-success'>View cloned post</a>
                                </div>"; 
                    break;
                    case 'resetPostViews' :
                        // Updating the view post count
                        $view_post_query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$post_value_id}";
                        $send_update_post_views_query = mysqli_query($connection, $view_post_query);
                        checkQuery($send_update_post_views_query);
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
                    <option value="clone">Clone</option>
                    <option value="resetPostViews">Reset Post Views</option>
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
                                    <th>Views</th>   
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