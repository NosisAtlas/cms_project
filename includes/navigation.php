 <!-- Navigation -->
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">CMS Front</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <?php 
                        $pageName = basename($_SERVER['PHP_SELF']);

                        $query = "SELECT * FROM categories LIMIT 5";
                        $select_all_categs_query = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($select_all_categs_query)){
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            $category_class = "";
                            
                            if(isset($_GET['category']) && $_GET['category'] == $cat_id){
                                $category_class = "active";
                            }
                            echo "<li class='$category_class'><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                        }
                    ?>           
                    <?php 
                        $registration_class = "";
                        $registration = 'registration.php';
                        $loggin_class = "";
                        $loggin = 'loggin.php';
                        $contact_class = "";
                        $contact = 'contact.php';
                        $admin = "admin";
                        $admin_class = "";
                        if($pageName == $registration){
                            $registration_class = "active";
                        }else if($pageName == $contact){
                            $contact_class = "active";
                        }else if($pageName == $admin){
                            $admin_class = "active";
                        }else if($pageName == $loggin){
                            $loggin_class = "active";
                        }
                        
                        if(isset($_SESSION['user_role'])){
                            if($_SESSION['user_role'] == 'admin'){
                                echo "<li class='$admin_class'><a href='admin'>Admin</a></li>";                         
                            }else{
                                echo "<li class=''><a href='./admin/dashboard.php'>Dashboard</a></li>";    
                            }
                        }else{
                            echo "<li class='$contact_class'><a href='./contact'>Contact</a></li>";
                            echo "<li class='$loggin_class'><a href='./loggin'>Login</a></li>";
                            echo "<li class='$registration_class'><a href='./registration'>Registration</a></li>";
                                     
                        }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>