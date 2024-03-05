<?php 
    // Checking if the query had been executed
    function checkQuery($result){
        global $connection;
        if(!$result){
            die('QUERY FAILED !' . mysqli_error($connection));
        }
    }
    
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
            $cat_id = $_GET["edit"];
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

    // Displaying Categs
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
                    <td>{$post_category_id}</td>
                    <td>{$post_content}</td>
                    <td>{$post_date}</td>
                    <td>{$post_tags}</td>
                    <td>{$post_status}</td>
                    <td>{$post_comment_count}</td>
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
            $post_comment_count = 7;
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
                $post_comment_count == "" || empty($post_comment_count) ||
                $post_category_id == "" || empty($post_category_id)
            ){
                echo "The fields should not be empty";
            }else{
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_comment_count, post_status)";
                $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_img}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}')";

                $create_post_query = mysqli_query($connection, $query);
                checkQuery($create_post_query);
            }
        }
    }
?>