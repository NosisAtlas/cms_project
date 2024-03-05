<?php 
    // Insertin categs
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
                if(!$create_category_query){
                    die('QUERY FAILED !' . mysqli_error($connection));
                }
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
?>