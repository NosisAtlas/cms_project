<?php 
    // Checking if the query had been executed
    function checkQuery($result){
        global $connection;
        if(!$result){
            die('QUERY FAILED !' . mysqli_error($connection));
        }
    }

    // Finding specific category
    function findCategory($categ_id){
        global $connection;
        $query = "SELECT * FROM categories WHERE cat_id = $categ_id";
        $select_categ = mysqli_query($connection, $query);

        // Checking if category is found
        if(mysqli_num_rows($select_categ) > 0) {
            $row = mysqli_fetch_assoc($select_categ);
            return $categ_title = $row['cat_title'];
        } else {
            return "Category Not Found";
        }
    }

    // Finding specific post from comment
    function findPost($post_id){
        global $connection;
        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        $select_post = mysqli_query($connection, $query);

        // Checking if post is found
        if(mysqli_num_rows($select_post) > 0) {
            $row = mysqli_fetch_assoc($select_post);
            return array('id' => $post_id, 'title' => $row['post_title']);
        }else {
            return array('id' => 0, 'title' => "Post Not Found");
        }
    }

    //////////////////////////////////////////////////////////////////
    
    // Adding categs
    function insertCategories(){
        global $connection;
        // Adding categ data to db
        if(isset($_POST['submit'])){
            $cat_title = $_POST['cat_title'];
            if($cat_title == "" || empty($cat_title)){
                echo "This field should not be empty";
            }else{
                $query = "INSERT INTO categories(cat_title)";
                $query .= "VALUES('{$cat_title}')";

                $create_category_query = mysqli_query($connection, $query);
                checkQuery($create_category_query);
            }
        }
    }

    // Displaying Categs
    function findAllCategories(){
        global $connection;
        $query = "SELECT * FROM categories";
        $select_categs_admin = mysqli_query($connection, $query);
        // Displaying categ data
        while($row = mysqli_fetch_assoc($select_categs_admin)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "
            <tr>
                <td>{$cat_id}</td>
                <td>{$cat_title}</td>
                <td><a href='categories.php?edit={$cat_id}'>Edit</a></td>
                <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
            </tr>";
        }
    }

    // Updating categs
    function updateCategory(){
        global $connection;
        if(isset($_GET["edit"])){
            include "includes/update_categories.php";
        }
    }

    // Deleting categs
    function deleteCategory(){
        global $connection;
        if(isset($_GET['delete'])){
            $delete_id =  $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = {$delete_id}";
            $delete_categ_query = mysqli_query($connection, $query);
            // Refresh the page
            header("Location: categories.php");
        }   
    }

    ////////////////////////////////////////////////////////////////////////

    // Displaying Posts
    function findAllPosts(){
        global $connection;
        $query = "SELECT * FROM posts";
        $select_posts_admin = mysqli_query($connection, $query);
        // Displaying categ data
        while($row = mysqli_fetch_assoc($select_posts_admin)){
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_date = $row['post_date'];
            $post_img = $row['post_img'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_status = $row['post_status'];
            $post_comment_count = $row['post_comment_count'];
            $post_category_id = $row['post_category_id'];
        
            echo "<tr>
                    <td>{$post_id}</td>
                    <td><img class='img-fluid img-thumbnail' width='100' src='../imgs/{$post_img}' alt='post img'></td>
                    <td>{$post_title}</td>
                    <td>{$post_author}</td>
                    <td>" . findCategory($post_category_id) . "</td>
                    <td>{$post_content}</td>
                    <td>{$post_date}</td>
                    <td>{$post_tags}</td>
                    <td>{$post_status}</td>
                    <td>{$post_comment_count}</td>
                    <td><a href='posts.php?source=edit_post&post_id={$post_id}'>Edit</a></td>
                    <td><a href='posts.php?delete={$post_id}'>Delete</a></td>
                </tr>";
        }
    }

    // Adding posts
    function insertPosts(){
        global $connection;
        // Adding categ data to db
        if(isset($_POST['create_post'])){
            $post_author = $_POST['post_author'];
            $post_title = $_POST['post_title'];
            $post_date = date('d-m-y');

            // Getting image
            $post_img = $_FILES['image']['name'];
            $post_img_temp = $_FILES['image']['tmp_name'];

            $post_content = $_POST['post_content'];
            $post_tags = $_POST['post_tags'];
            $post_status = $_POST['post_status'];
            // $post_comment_count = 7;
            $post_category_id = $_POST['post_category_id'];

            // Processing img
            move_uploaded_file($post_img_temp, "../imgs/$post_img");

            if($post_title == "" || empty($post_title) ||
                $post_author == "" || empty($post_author) ||
                $post_date == "" || empty($post_date) ||
                $post_img == "" || empty($post_img) ||
                $post_content == "" || empty($post_content) ||
                $post_tags == "" || empty($post_tags) ||
                $post_status == "" || empty($post_status) ||
                $post_category_id == "" || empty($post_category_id)
            ){
                echo "The fields should not be empty";
            }else{
                $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_comment_count, post_status) ";
                $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_img}', '{$post_content}', '{$post_tags}', 0, '{$post_status}')";


                $create_post_query = mysqli_query($connection, $query);
                checkQuery($create_post_query);
                echo    "<div class='alert alert-success' role='alert'>
                                User created successfully !  <a href='posts.php' class='btn btn-success'>View posts</a>
                            </div>"; 
            }
        }
    }

    // Editing Posts
    function updatePost(){
        global $connection;
        if(isset($_GET['post_id'])){
            $post_id = $_GET['post_id'];
            include "includes/update_posts.php";
        }
    }

    // Deleting posts
    function deletePost(){
        global $connection;
        if(isset($_GET['delete'])){
            $delete_id =  $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = {$delete_id}";
            $delete_post_query = mysqli_query($connection, $query);
            checkQuery($delete_post_query);
            // Refresh the page
            header("Location: posts.php");
        }  
    }


    ///////////////////////////////////////////////////////////////////////

    // Displaying All Comments in admin
    function findAllCommentsAndDisplayInAdmin(){
        global $connection;
        $query = "SELECT * FROM comments";
        $select_comments_admin = mysqli_query($connection, $query);
        // Checking if there are comments
        if(mysqli_num_rows($select_comments_admin) > 0) {
            // Displaying comment data
            while($row = mysqli_fetch_assoc($select_comments_admin)){
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];
                $comment_post = findPost($comment_post_id);

        
            
                echo "<tr>
                        <td>{$comment_id}</td>
                        <td>{$comment_author}</td>
                        <td>{$comment_content}</td>
                        <td>{$comment_email}</td>
                        <td>{$comment_status}</td>
                        <td><a href='../post.php?post_id={$comment_post['id']}'>{$comment_post['title']}</a></td>
                        <td>{$comment_date}</td>
                        <td><a href='comments.php?approve_comment={$comment_id}'>Approve</a></td>
                        <td><a href='comments.php?unapprove_comment={$comment_id}'>Unapprove</a></td>
                        <td><a href='comments.php?source=edit_comment&comment_id={$comment_id}'>Edit</a></td>
                        <td><a href='comments.php?delete={$comment_id}'>Delete</a></td>
                    </tr>";

            }
        }else {
            // Displaying message if no comments found
            echo "<tr><td colspan='11'>No comments found.</td></tr>"; 
        }
    }

    // Displaying All Comments in post page related to the specific post
    function displayAllCommentsPost(){
        global $connection;
        $post_id_url = $_GET['post_id'];
        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id_url AND comment_status = 'approved'";
        $select_comments_home = mysqli_query($connection, $query);
        
        // Checking if there are comments
        if(mysqli_num_rows($select_comments_home) > 0) {
            // Displaying comment data
            while($row = mysqli_fetch_assoc($select_comments_home)){
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

                echo "<div class='media'>
                        <a class='pull-left' href='#'>
                            <img class='media-object img-fluid image-thumbnail' width='70' src='imgs/avatar_1.webp' alt=''>
                        </a>
                        <div class='media-body'>
                            <h4 class='media-heading'>{$comment_author}
                                <small>{$comment_date}</small>
                            </h4>
                            {$comment_content}
                        </div>
                    </div>";
            }
        } else {
            // Displaying a message if no comments are found
            echo "<h4>No comments found. Be the first to comment above!</h4>";
        }
    }


    // Inserting comments
    function insertComments(){
        global $connection;
        $post_id_url = $_GET['post_id'];
        // Adding comments data to db
        if(isset($_POST['create_comment'])){
            $comment_author = $_POST['comment_author'];
            $comment_post_id = $post_id_url;
            $comment_author = $_POST['comment_author'];
            $comment_content = $_POST['comment_content'];
            $comment_email = $_POST['comment_email'];
            $comment_status = "unapproved";
            $comment_date = date('d-m-y');

            // Validating data
            if($comment_author == "" || empty($comment_author) ||
                $comment_content == "" || empty($comment_content) ||
                $comment_email == "" || empty($comment_email)
            ){
                echo "The fields should not be empty";
            }else{
                $query = "INSERT INTO comments(comment_post_id, comment_author, comment_content, comment_email, comment_status, comment_date)";
                $query .= "VALUES({$comment_post_id},'{$comment_author}','{$comment_content}','{$comment_email}','{$comment_status}',now())";
                $create_comment_query = mysqli_query($connection, $query);
                checkQuery($create_comment_query);
                // Update comments count
                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                $query .= "WHERE post_id = $comment_post_id";
                $update_comment_count_query = mysqli_query($connection, $query);
                checkQuery($update_comment_count_query);
                header("Location: post.php?post_id={$post_id_url}");
                // exit();
            }
        }
    }

    // Deleting posts
    function deleteComment(){
        global $connection;
        if(isset($_GET['delete'])){
            $delete_id =  $_GET['delete'];
            $query = "DELETE FROM comments WHERE comment_id = {$delete_id}";
            $delete_comment_query = mysqli_query($connection, $query);
            checkQuery($delete_comment_query);
            // Refresh the page
            header("Location: comments.php");
        }  
    }

    // Unapproving comments
    function approveComment(){
        global $connection;
        if(isset($_GET['approve_comment'])){
            $approve_comment_id =  $_GET['approve_comment'];
            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approve_comment_id";
            $approve_comment_query = mysqli_query($connection, $query);
            checkQuery($approve_comment_query);
            header("Location: comments.php");
        }
    }

    // Unapproving comments
    function unapproveComment(){
        global $connection;
        if(isset($_GET['unapprove_comment'])){
            $unapprove_comment_id =  $_GET['unapprove_comment'];
            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $unapprove_comment_id";
            $unapprove_comment_query = mysqli_query($connection, $query);
            checkQuery($unapprove_comment_query);
            header("Location: comments.php");
        }
    }


    ///////////////////////////////////////////////////////////////////////////////////////

    // Displaying All Users in admin
    function findAllUsers(){
        global $connection;
        $query = "SELECT * FROM users";
        $select_comments_admin = mysqli_query($connection, $query);
        // Checking if there are comments
        if(mysqli_num_rows($select_comments_admin) > 0) {
            // Displaying comment data
            while($row = mysqli_fetch_assoc($select_comments_admin)){
                $user_id = $row['user_id'];
                $user_img = $row['user_img'];
                $username = $row['username'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_role = $row['user_role'];
            
                // Displaying the table
                echo "<tr>
                    <td>{$user_id}</td>
                    <td><img class='img-fluid img-thumbnail' width='100' src='../imgs/{$user_img}' alt='post img'>
                    </td>
                    <td>{$username}</td>
                    <td>{$user_firstname}</td>
                    <td>{$user_lastname}</td>
                    <td>{$user_email}</td>
                    <td>{$user_role}</td>
                    <td><a href='users.php?assign_admin={$user_id}'>Make admin</a></td>
                    <td><a href='users.php?assign_user={$user_id}'>Make user</a></td>
                    <td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>
                    <td><a href='users.php?delete={$user_id}'>Delete</a></td>
                </tr>";


            }
        }else {
            // Displaying message if no comments found
            echo "<tr><td colspan='11'>No users found.</td></tr>"; 
        }
    }

    // Inserting comments
    function insertUsers(){
        global $connection;

        // Adding users data to db
        if(isset($_POST['create_user'])){
            $username = $_POST['username'];
            $user_password = $_POST['user_password'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_email = $_POST['user_email'];
            // Getting image
            $user_img = $_FILES['image']['name'];
            $user_img_temp = $_FILES['image']['tmp_name'];
            $user_role = $_POST['user_role'];
            $user_randSalt = '';

            // Check if user selected an image
            if(empty($user_img) || $user_img == '') {
                // If no image selected, set default image
                $user_img = "default_image.webp";
            } else {
                // move image to
                move_uploaded_file($user_img_temp, "../admin/imgs/$user_img");
            }

            // Validating data
            if($username == "" || empty($username) ||
                $user_password == "" || empty($user_password) ||
                $user_email == "" || empty($user_email) 
                ){
                echo "The fields should not be empty. You must at least insert username, password and email!";
            }else{
                // Validating pass
                if(strlen($user_password)<= 6 || strlen($user_password) > 15){
                    echo "<p>Password must not be less than 6 or more than 15</p>";
                }else{
                    $hashFormat = "$2y$10$";
	                $salt = "iusesomeordinarypasss24";
                    $hashFandSalt = $hashFormat . $salt;
                    $encriptPassword = crypt($user_password, $hashFandSalt);

                    //Query for insert users
                    $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_img, user_role, randSalt)";
                    $query .= "VALUES('{$username}','{$encriptPassword}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_img}','{$user_role}','{$user_randSalt}')";
                    $create_user_query = mysqli_query($connection, $query);
                    checkQuery($create_user_query);        
                    echo    "<div class='alert alert-success' role='alert'>
                                User created successfully !  <a href='users.php' class='btn btn-success'>View users</a>
                            </div>";     
                }
            }
        }
    }

     // Editing Posts
     function updateUser(){
        global $connection;
        if(isset($_GET['user_id'])){
            $user_id = $_GET['user_id'];
            include "includes/update_users.php";
        }
    }

    // Deleting users
    function deleteUser(){
        global $connection;
        if(isset($_GET['delete'])){
            $delete_id =  $_GET['delete'];
            $query = "DELETE FROM users WHERE user_id = {$delete_id}";
            $delete_user_query = mysqli_query($connection, $query);
            checkQuery($delete_user_query);
            // Refresh the page
            header("Location: users.php");
        }  
    }

    // Change role to admin
    function changeRoleToAdmin(){
        global $connection;
        if(isset($_GET['assign_admin'])){
            $assign_admin_id =  $_GET['assign_admin'];
            $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $assign_admin_id ";
            $assign_admin_query = mysqli_query($connection, $query);
            checkQuery($assign_admin_query);
            header("Location: users.php");
        }
    }

    // Change role to admin
    function changeRoleToUser(){
        global $connection;
        if(isset($_GET['assign_user'])){
            $assign_user_id =  $_GET['assign_user'];
            $query = "UPDATE users SET user_role = 'user' WHERE user_id = $assign_user_id ";
            $assign_user_query = mysqli_query($connection, $query);
            checkQuery($assign_user_query);
            if($_SESSION['user_id'] == $assign_user_id){
                // Destroy the session
                session_destroy();
                // Redirect the user to the index page
                header("Location: ../index.php");
                exit(); // Stop further execution
            }else{
                header("Location: users.php");
            }
        }        
    }

?>