<?php  include "includes/header.php"; ?>

<?php 
    // Sending emails for forgot pass
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';
?>

<?php
    if(!isset($_GET['email']) && !isset($_GET['token'])){
        redirect('index');
    }
    $email = $_GET['email'];
    $token = $_GET['token'];
    if($stmt = mysqli_prepare($connection, 'SELECT username, user_email, token FROM users WHERE token = ?')){
        mysqli_stmt_bind_param($stmt, "s", $token);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $username, $user_email, $token);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        // if($_GET['token'] !== $token || $_GET['email'] !== $email){
        //     redirect('index');
        // }
        if(isset($_POST['password']) && isset($_POST['confirmPassword'])){
            $pass = $_POST['password'];
            $confirmPass = $_POST['confirmPassword'];
            if($pass === $confirmPass){
                $hashedPassword = password_hash($pass, PASSWORD_BCRYPT, array('cost' => 12));
                if($stmt = mysqli_prepare($connection, "UPDATE users SET token = '', user_password = '{$hashedPassword}' WHERE user_email = ? ")){
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    if(mysqli_stmt_affected_rows($stmt) >= 1){
                        redirect('./loggin');
                    }
                    mysqli_stmt_close($stmt);
                }
                echo "They're the same";
            }else{
                echo "They're not the same";
            }
        }
    }
?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">
                                
                            <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                                <input type="hidden" class="hide" name="token" id="token" value="">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                        <input id="password" name="password" placeholder="Enter password" class="form-control"  type="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                        <input id="confirmPassword" name="confirmPassword" placeholder="Confirm password" class="form-control"  type="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="resetPassword" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                </div>

                            </form>

                        </div><!-- Body-->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

