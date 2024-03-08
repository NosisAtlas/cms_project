<?php  include "includes/header.php"; ?>
<?php 
        if(isset($_SESSION['user_id'])){
            
?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    

    <?php 
        if(isset($_POST['register'])){
            $username = $_POST['username'];
            $user_email = $_POST['email'];
            $user_password = $_POST['password'];

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
                    $query = "SELECT randSalt from users";
                    $selected_randsalt = mysqli_query($connection, $query);
                    checkQuery($selected_randsalt);
                    while($row = mysqli_fetch_array($selected_randsalt)){
                        $salt = $row['randSalt'];
                        echo $salt;
                    }
                    $encriptPassword = crypt($user_password, $salt);

                    //Query for insert users
                    $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_img, user_role, randSalt)";
                    $query .= "VALUES('{$username}','{$encriptPassword}',' ',' ','{$user_email}',' ',' ','{$salt}')";
                    $create_user_query = mysqli_query($connection, $query);
                    checkQuery($create_user_query);        
                    checkQuery($create_user_query);        
                    if(isset($_SESSION['user_role'])){
                        if($_SESSION['user_role'] == 'admin'){
                            echo    "<div class='alert alert-success' role='alert'>
                            User created successfully !  <a href='admin/users.php' class='btn btn-success'>View users</a>
                            </div>";  
                        }else{
                            echo    "<div class='alert alert-success' role='alert'>
                                User created successfully !  <a href='index.php' class='btn btn-success'>Log in to your account</a>
                            </div>";  
                        }
                    }
                       
                }
            }
        }
    ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
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



<?php include "includes/footer.php";?>
<?php
    }else{
        header('Location: index.php');
    }
?>