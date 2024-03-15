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
?>

    

    <?php             
        // Checking the submit
        if(isset($_POST['submit'])){
            $to = "nosis@atlas.com";
            $contact_subject = $_POST['subject'];
            // use wordwrap() if lines are longer than 70 characters
            $contact_body = wordwrap($_POST['body'], 70);
            $header = $_POST['email'];

            $contact_subject = mysqli_real_escape_string($connection, $contact_subject);
            $header = mysqli_real_escape_string($connection, $header);
            $contact_body = mysqli_real_escape_string($connection, $contact_body);
            //Recipients
            $mail->setFrom($header, 'Mailer');
            $mail->addAddress('support@cms.com', 'Admin');     //Add a recipient
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $contact_subject;
            //Content
            $mail->Body    = $contact_body . "<br> From: " . $header;

            // Validating data
            if($contact_subject == "" || empty($contact_subject) ||
                $header == "" || empty($header) ||
                $contact_body == "" || empty($contact_body) 
                ){
                echo "<div class='container alert alert-danger' role='alert'>
                        The fields should not be empty! Subject, email and body should be assigned.
                    </div>";
            }else{
                // send email
                // mail($to, $contact_subject,$contact_body, $header);
                if($mail->send()){
                    $emailSent = true;
                    // echo success message
                    echo "<div class='container alert alert-success' role='alert'>
                        Your contact request has been submitted.
                        </div>";
                }else{
                    // echo error message
                    echo "<div class='container alert alert-danger' role='alert'>
                        Your contact request failed submition.
                        </div>";
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
                <h1>Contact</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="on">
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject...">
                        </div>
                         <div class="form-group">
                            <label for="body" class="sr-only">Body</label>
                            <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
