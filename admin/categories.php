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

                        <!-- Form for adding categs -->
                        <div class="col-xs-6">
                            <?php 
                                // Inserting categs
                                insertCategories();
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                            <!-- Form for Editing the categs -->
                            <?php 
                                // Editing the categs
                                updateCategory();
                            ?>
                        </div>

                        <!--  -->
                        <div class="col-xs-6"> 
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Update</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    // Finding all categs query
                                    findAllCategories();
                                ?>

                            <?php 
                                // Deleting categs
                                deleteCategory();                 
                            ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include "includes/admin_footer.php" ?>
