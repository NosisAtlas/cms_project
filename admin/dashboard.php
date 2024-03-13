<?php include 'includes/admin_header.php' ?>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include 'includes/admin_navigation.php' ?>

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin DASHBOARD
                            <small>
                                <?php 
                                    if(isset($_SESSION['username'])){
                                        echo strtoupper($_SESSION['username']);
                                    }; 
                                ?>
                            </small>
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->

                       
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            // Count posts
                                            $query = "SELECT* FROM posts";
                                            $select_all_posts = mysqli_query($connection, $query);
                                            $posts_count = mysqli_num_rows($select_all_posts);
                                        ?>
                                    <div class='huge'><?php echo $posts_count ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            // Count comments
                                            $query = "SELECT* FROM comments";
                                            $select_all_comments = mysqli_query($connection, $query);
                                            $comments_count = mysqli_num_rows($select_all_comments);
                                        ?>
                                        <div class='huge'><?php echo $comments_count ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            // Count users
                                            $query = "SELECT* FROM users";
                                            $select_all_users = mysqli_query($connection, $query);
                                            $users_count = mysqli_num_rows($select_all_users);
                                        ?>
                                        <div class='huge'><?php echo $users_count ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            // Count categories
                                            $query = "SELECT* FROM categories";
                                            $select_all_categories = mysqli_query($connection, $query);
                                            $categories_count = mysqli_num_rows($select_all_categories);
                                        ?>
                                        <div class='huge'><?php echo $categories_count ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <?php
                    // Count draft posts
                    $query = "SELECT* FROM posts WHERE  post_status = 'draft'";
                    $select_all_draft_posts = mysqli_query($connection, $query);
                    $posts_draft_count = mysqli_num_rows($select_all_draft_posts);
                    // Count published posts
                    $query = "SELECT* FROM posts WHERE  post_status = 'published'";
                    $select_all_published_posts = mysqli_query($connection, $query);
                    $posts_published_count = mysqli_num_rows($select_all_published_posts);
                    // Count unapproved comments
                    $query = "SELECT* FROM comments WHERE  comment_status = 'unapproved'";
                    $select_all_unapproved_comments = mysqli_query($connection, $query);
                    $comments_unapproved_count = mysqli_num_rows($select_all_unapproved_comments);
                    // Count users with role user
                    $query = "SELECT* FROM users WHERE  user_role = 'user'";
                    $select_all_user_users = mysqli_query($connection, $query);
                    $users_user_count = mysqli_num_rows($select_all_user_users);
                ?>
                <div class="row">
                    <!-- Google Chart Js script -->
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php 
                                //
                                $element_txt = ['All Posts', 'Draft Posts', 'Published Posts', 'Comments', 'Pending Comments', 'Users', 'users Role User', 'Categories'];
                                $element_count = [$posts_count, $posts_draft_count, $posts_published_count, $comments_count, $comments_unapproved_count, $users_count, $users_user_count, $categories_count];
                                for($i = 0; $i < count($element_txt); $i++ ){
                                    echo "['{$element_txt[$i]}'" . "," . "{$element_count[$i]}],";
                                }
                            ?>
                            ]);

                            var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <!-- Google Chart Js script END -->
                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include "includes/admin_footer.php" ?>
