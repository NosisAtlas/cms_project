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
                            <small>John</small>
                        </h1>
                        <?php 
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }else{
                                $source = '';
                            }

                            switch($source){
                                case '34':
                                    echo "Nice 34";
                                    break;
                                case '99':
                                    echo "Nice 99";
                                    break;
                                case '509':
                                    echo "Nice 509";
                                    break;
                                default:
                                    include "includes/view_all_posts.php";
                                    break;
                            }
                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include "includes/admin_footer.php" ?>
