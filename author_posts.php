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
                    if(isset($_GET['post_id']) && isset($_GET['author'])){
                        $post_id_url = $_GET['post_id'];
                        $post_author_url = $_GET['author'];
                    }
                    // Displaying posts from Db 
                    $query = "SELECT * FROM posts WHERE post_author = '{$post_author_url}' ";
                    $select_all_posts_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];
                        $post_content = $row['post_content'];
                    ?>
                    

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
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

                <?php    
                    }
                ?>                
               
                <!-- Pager -->

            </div>
            
            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php' ?>


        </div>
        <!-- /.row -->

        <hr>
        
<?php include 'includes/footer.php' ?>