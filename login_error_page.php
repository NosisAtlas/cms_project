<?php include 'includes/header.php' ?>

 <!-- Navigation -->
<?php include 'includes/navigation.php' ?>
   
    <!-- Page Content -->
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    Wrong credentials !</h2>
                <div class="error-details">
                    Sorry, wrong credentials has occured, couldn't login using the submitted credentials!
                </div>
                <div class="error-actions">
                    <a href="loggin.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                        Try login again </a><a href="registration.php" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-user"></span> Register </a>
                </div>
            </div>
        </div>
    </div>

        <hr>
        
<?php include 'includes/footer.php' ?>