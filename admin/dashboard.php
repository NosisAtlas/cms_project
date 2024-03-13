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
                            Welcome to user DASHBOARD
                            <small>
                                <?php 
                                    get_username();
                                ?>
                            </small>
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->

                       
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            // Count posts
                                            $posts_count = count_records(get_all_user_posts());
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
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            // Count comments
                                            $comments_count = count_records(get_all_user_comments());
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
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            // Count categories
                                            $categories_count = count_records(get_all_user_categories());
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
                    $query = "SELECT * FROM posts WHERE post_status = 'draft' AND post_user_id = {$_SESSION['user_id']}";
                    $select_all_draft_posts = mysqli_query($connection, $query);
                    $posts_draft_count = mysqli_num_rows($select_all_draft_posts);
                    // Count published posts
                    $query = "SELECT * FROM posts WHERE post_status = 'published' AND post_user_id = {$_SESSION['user_id']}";

                    $select_all_published_posts = mysqli_query($connection, $query);
                    $posts_published_count = mysqli_num_rows($select_all_published_posts);
                    // Count unapproved comments
                    $comments_approved_count = count_records(get_all_user_approved_posts_comments());
                    $comments_unapproved_count = count_records(get_all_user_unapproved_posts_comments());
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
                                $element_txt = ['All Posts', 'Draft Posts', 'Published Posts', 'Comments', 'Pending Comments', 'Categories'];
                                $element_count = [$posts_count, $posts_draft_count, $posts_published_count, $comments_approved_count, $comments_unapproved_count, $categories_count];
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
