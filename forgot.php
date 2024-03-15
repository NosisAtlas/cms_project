<?php  include "includes/header.php"; ?>
<!-- Navigation -->    
<?php  include "includes/navigation.php"; ?>

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
    if(!isset($_GET['forgot'])){
        redirect('./');
    }

    if(ifItIsMethod('post')){
        if(isset($_POST['email'])){
            $email = escape($_POST['email']);
            $length = 50;
            $token = bin2hex(openssl_random_pseudo_bytes($length));
            
            if(email_exists($email)){
                if($stmt = mysqli_prepare($connection, "UPDATE users SET token = '{$token}' WHERE user_email = ?")){
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    /**
                    *
                    * configure PHPMailer
                    *
                    *
                    */

                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);
                    //Server settings
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'e8b8dfc05dae4f';                     //SMTP username
                    $mail->Password   = 'f116d7a93bb9d5';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 587;                                    
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->CharSet    = 'UTF-8';

                    //Content
                    //Recipients
                    $mail->setFrom('nosis@atlas.com', 'Mailer');
                    $mail->addAddress('support@cms.com', 'Admin');     //Add a recipient
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Here is the subject';
                    $mail->Body    = '<p>
                        Please click to reset password <b>Reset password!</b>
                        <a href="http://localhost/EgioWww/CMS_project/reset?email='. $email .'&token='. $token .' ">http://localhost/EgioWww/CMS_project/reset?email='.$email.'&token='.$token.'</a>
                        </p>';

                    if($mail->send()){
                        $emailSent = true;
                        echo "SENT";
                    } else{
                        echo "NOT SENT";
                    }
                }else{
                    echo mysqli_error($connection);
                }
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
                            <?php 
                                if(!isset($emailSent)):
                            ?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                                <?php 
                                    else:
                                ?>
                                <h2>Please check your email</h2>
                                <?php 
                                    endif;
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

