<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <!-- Search form -->
    <form action="search.php" method="post">
        <div class="input-group">
            <input type="text" class="form-control" name="search">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit" name="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
        <!-- /.input-group -->
    </form>
    <!-- Search form -->
</div>

<!-- Login form -->
<div class="well">
    <?php if(isset($_SESSION['user_role'])): ?>
        <h4>Logged in as <?php echo $_SESSION['username']; ?></h4>
        <a href="includes/logout.php" class="btn btn-primary" name="logout" type="submit">Logout</a>
    <?php else: ?>
        <h4>Login</h4>
    <!-- Search form -->
    <form action="includes/login.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Enter username...">
        </div>
        <div class="input-group">
            <input type="password" class="form-control" name="password" placeholder="************">
            <span class="input-group-btn">
                <button class="btn btn-primary" name="login" type="submit">Submit</button>
            </span>
        </div>
        <!-- /.input-group -->
    </form>
    <!-- Search form -->
    <?php endif; ?>
    
</div>

<!-- Blog Categories Well -->
<div class="well">
    <?php 
        $query = "SELECT * FROM categories LIMIT 4";
        $select_categs_sidebar = mysqli_query($connection, $query);
    ?>   
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php 
                    while($row = mysqli_fetch_assoc($select_categs_sidebar)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];

                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                ?>
            </ul>
        </div>
       
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include 'widget.php'; ?>

</div>