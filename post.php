<?php include 'includes/header.php' ?>

 <!-- Navigation -->
<?php include 'includes/navigation.php' ?>

<?php 
    if(isset($_POST['liked'])){
        $post_id_ajax = $_POST['post_id'];
        // Step 1: Fetching the right post
        $searchPostQuery = "SELECT * FROM posts WHERE post_id = $post_id_ajax";
        $postResult = mysqli_query($connection, $searchPostQuery);
        $postData = mysqli_fetch_array($postResult);
        $likes = $postData['likes'];
    
        // Check if the query was successful
        if(mysqli_num_rows($postResult) >= 1){
            echo $postData['post_id'];
        } else {
            echo "Error fetching post data: " . mysqli_error($connection);
        }

        // Step 2: Updating the likes of the specific posts
        mysqli_query($connection, "UPDATE posts SET likes = likes + 1 WHERE post_id = $post_id_ajax");
    }
?>
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <?php 
                    if(isset($_GET['post_id'])){
                        $post_id_url = $_GET['post_id']; 
                        // Updating the view post count
                        $view_post_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$post_id_url}";
                        $send_update_post_views_query = mysqli_query($connection, $view_post_query);
                        checkQuery($send_update_post_views_query);
                    
                    // Displaying posts from Db 
                    $query = "SELECT * FROM posts WHERE post_id = $post_id_url";
                    $select_all_posts_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];
                        $post_content = $row['post_content'];
                        $post_likes = $row['likes'];
                    ?>
                    

                <!-- First Blog Post -->
                <h2>
                    <?php echo $post_title ?>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author ?>&post_id=<?php echo $post_id ?>"><?php echo $post_author . " "; ?></a>
                    <?php 
                        if(isset($_SESSION['user_id'])){
                            if($_SESSION['user_role'] == "admin"){
                                if(isset($_GET['post_id'])){
                                    $url_post_id = $_GET['post_id'];
                                    echo "<a href='admin/posts.php?source=edit_post&post_id={$url_post_id}' class='btn btn-warning'>Edit</a>";
                                }
                            }
                        }
                    ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="imgs/<?php echo $post_img ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>
                <div class="container-fluid">
                    <div class="row">
                        <p class="pull-right"><a class="like" href="#"><span class="glyphicon glyphicon-thumbs-up"></span> Like</a></p>
                    </div>
                    <div class="row">
                        <p class="pull-right">Like: <?php echo $post_likes ?></p>
                    </div>
                </div>
                

                <?php    
                    }
                ?>

                 <!-- Blog Comments -->
                 <?php
                    // Inserting Comments 
                    insertComments(); 
                 ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" role="form" method="post">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input class="form-control" type="text" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input class="form-control" type="email" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Content</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Comment</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php 
                    }else{
                        header('Location: index.php');
                    }
                    $post_id_url;
                    if(isset($_GET['post_id'])){
                        $post_id_url = $_GET['post_id']; 
                    }
                    displayAllCommentsPost($post_id_url); 
                    // var_dump(displayAllCommentsPost());
                ?>
                
               
                <!-- Pager -->

            </div>
            
            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php' ?>


        </div>
        <!-- /.row -->

        <hr>
        
<?php include 'includes/footer.php' ?>
<script>
   $(document).ready(function(){
    var post_id = <?php echo $post_id_url; ?>;
    var user_id = 2;
    $(".like").click(function(){
        $.ajax({
            url: "post.php?post_id=<?php echo $post_id_url; ?>",
            type: "post",
            data: {
                'liked': 1,
                'post_id': post_id,
                'user_id': user_id,
            },
            success: function(response) {
                // Handle the response here, such as updating the like count or UI
                console.log(user_id);
            }
        });
    });
});

</script>