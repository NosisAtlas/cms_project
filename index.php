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
                    // Limiting the posts in the page
                    $per_page = 5;
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = "";
                    }
                    if($page == "" || $page == 1){
                        $page_1 = 0;
                    }else{
                        $page_1 = ($page * $per_page) - $per_page;
                    }
                    // Displayin posts in pagination
                    $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
                    $find_count = mysqli_query($connection, $query);
                    $post_count = mysqli_num_rows($find_count);
                    $post_count = ceil($post_count / $per_page);

                    // Displayin posts from db
                    $post_query_count = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $per_page";
                    $select_all_posts_query = mysqli_query($connection, $post_query_count);
                    checkQuery($select_all_posts_query);
                    if(mysqli_num_rows($select_all_posts_query) > 0) {
                        while($row = mysqli_fetch_assoc($select_all_posts_query)){
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_img = $row['post_img'];
                            $post_content = substr($row['post_content'], 0, 100);
                    ?>
                    

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author ?>&post_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?post_id=<?php echo $post_id; ?>"><img class="img-responsive" src="imgs/<?php echo $post_img ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php    
                        }
                    }else {
                        // Displaying message if no posts found
                        echo "<h4>No published posts were found.</h4>"; 
                    }
                ?>
                
               
                <!-- Pager -->

            </div>
            
            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php' ?>


        </div>
        <!-- /.row -->

        <hr>

        <ul class="pager">
            <?php 
                // Loop for displaying pagination
                // for($i = 1; $i <= $post_count; $i++ )
                // if($i == $page){
                //     echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                // }else{
                //     echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                // }

                // Loop for displaying pagination
                for($i = 1; $i <= $post_count; $i++ ) {
                    // Check if there are posts available for the current page
                    $offset = ($i - 1) * $per_page;
                    $posts_available = mysqli_query($connection, "SELECT * FROM posts WHERE post_status = 'published' LIMIT $offset, $per_page");
                    $has_posts = mysqli_num_rows($posts_available) > 0;
                    mysqli_free_result($posts_available);

                    // Display the pagination link only if there are posts available for the current page
                    if ($has_posts) {
                        if ($i == $page) {
                            echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                        } else {
                            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                        }
                    }
                }
    ?>
            
        </ul>
        
<?php include 'includes/footer.php' ?>