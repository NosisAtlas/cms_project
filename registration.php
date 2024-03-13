<?php  include "includes/header.php"; ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    

    <?php 
        // Setting language
        if(isset($_GET['lang'])){
            $_SESSION['lang'] = $_GET['lang'];
            if(isset($_SESSION['lang']) && $_SESSION['lang'] == $_GET['lang']){
                echo "<script type='javascript'>location.reload()</script>";
            }
        }

        if(isset($_SESSION['lang'])){
            include "icludes/languages" . $_SESSION['lang'] . ".php";
        }else{
            include "icludes/languages/en.php";
        }
        
        // Registrating
        if(isset($_POST['register'])){
            $username = $_POST['username'];
            $user_email = $_POST['email'];
            $user_password = $_POST['password'];
            $user_img = "default_image.webp";

            $username = mysqli_real_escape_string($connection, $username);
            $user_email = mysqli_real_escape_string($connection, $user_email);
            $user_password = mysqli_real_escape_string($connection, $user_password);

            // Validating data
            if($username == "" || empty($username) ||
                $user_password == "" || empty($user_password) ||
                $user_email == "" || empty($user_email) 
                ){
                echo "<div class='container alert alert-danger' role='alert'>
                        The fields should not be empty! Username, password, email should be assigned.
                    </div>";
            }else{
                // Validating pass
                if(strlen($user_password)<= 6 || strlen($user_password) > 15){
                    echo "<div class='container alert alert-danger' role='alert'>
                    Password must not be less than 6 or more than 15.
                    </div>";
                }else{
                    $hashFormat = "$2y$10$";
	                $salt = "iusesomeordinarypasss24";
                    $hashFandSalt = $hashFormat . $salt;
                    $encriptPassword = crypt($user_password, $hashFandSalt);

                    //Query for insert users
                    $query = "INSERT INTO users(username, user_password, user_email, user_img, randSalt) ";
                    $query .= "VALUES('{$username}','{$encriptPassword}','{$user_email}','{$user_img}','{$hashFandSalt}')";

                    $register_user_query = mysqli_query($connection, $query);
                    checkQuery($register_user_query);        
                    echo    "<div class='container alert alert-success' role='alert'>
                                Your registration has been sent submitted!  <a href='./loggin' class='btn btn-success'>Log in to your account</a>
                            </div>"; 
                       
                }
            }
        }
    ?>
    
 
    <!-- Page Content -->
    <div class="container">
    <form action="" method="get" class="navbar-form navbar-right" id="lang_form">
        <div class="form-group">
            <select class="form-control" name="lang" onchange="changeLang()" >
                <option value="en">English</option>
                <option value="kr">Korean</option>
            </select>
        </div>
    </form>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>

<script>
    function changeLang(){
        document.getElementById('lang_form').submit()
    }
</script>

<?php include "includes/footer.php";?>
