<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    

    <?php             
        // Checking the submit
        if(isset($_POST['submit'])){
            $to = "fz.farhane109@gmail.com";
            $contact_subject = $_POST['subject'];
            $contact_email = $_POST['email'];
            // use wordwrap() if lines are longer than 70 characters
            $contact_body = wordwrap($_POST['body'], 70);

            $contact_subject = mysqli_real_escape_string($connection, $contact_subject);
            $contact_email = mysqli_real_escape_string($connection, $contact_email);
            $contact_body = mysqli_real_escape_string($connection, $contact_body);

            // Validating data
            if($contact_subject == "" || empty($contact_subject) ||
                $contact_email == "" || empty($contact_email) ||
                $contact_body == "" || empty($contact_body) 
                ){
                echo "<div class='container alert alert-danger' role='alert'>
                        The fields should not be empty! Subject, email and body should be assigned.
                    </div>";
            }else{
                // send email
                mail($to, $contact_subject,$contact_body, $contact_email);
                // echo success message
                echo "<div class='container alert alert-success' role='alert'>
                        Your contact request has been submitted.
                    </div>";
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
