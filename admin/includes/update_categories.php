<form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Edit Category</label>

                                    <?php
                                        if(isset($_GET["edit"])){
                                            $edit_id = $_GET["edit"];
                                            $query = "SELECT * FROM categories WHERE cat_id = $edit_id";
                                            $select_categs_edit = mysqli_query($connection, $query);
                                            // Displaying categ data
                                            while($row = mysqli_fetch_assoc($select_categs_edit)){
                                                $cat_id = $row['cat_id'];
                                                $cat_title = $row['cat_title'];
                                        
                                    ?>
                                    <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" class="form-control" type="text" name="cat_title">
                                    <?php 
                                            }
                                        }
                                    ?>

                                    <?php 
                                        // Updating categs query
                                        if(isset($_POST['update_category'])){
                                            $update_cat_title =  $_POST['cat_title'];
                                            if($update_cat_title == "" || empty($update_cat_title)){
                                                echo "This field should not be empty";
                                            }else{
                                                $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id = {$cat_id}";
                                                $update_categ_query = mysqli_query($connection, $query);
                                                checkQuery($update_categ_query);

                                            }
                                        }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                                </div>
                            </form>