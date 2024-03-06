<?php include 'includes/header.php' ?>

 <!-- Navigation -->
<?php include 'includes/navigation.php' ?>
   
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
                    }
                    // Displaying posts from Db 
                    $query = "SELECT * FROM posts WHERE post_id = $post_id_url";
                    $select_all_posts_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];
                        $post_content = $row['post_content'];
                    ?>
                    

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="imgs/<?php echo $post_img ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>

                <?php    
                    }
                ?>

                 <!-- Blog Comments -->

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
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Comment</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php 
                    $post_id_url;
                    if(isset($_GET['post_id'])){
                        $post_id_url = $_GET['post_id']; 
                    }
                    displayAllCommentsPost($post_id_url); 
                ?>
                
               
                <!-- Pager -->

            </div>
            
            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php' ?>


        </div>
        <!-- /.row -->

        <hr>
        
<?php include 'includes/footer.php' ?>