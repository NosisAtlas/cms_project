<div class="table-responsive">
    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <td>Content</td>
                                    <th>Date</th>
                                    <th>Tags</th>
                                    <th>Status</th>
                                    <th>Comments</th>   
                                    <th>Update</th>                                    
                                    <th>Actions</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php findAllPosts(); ?>
                                <?php 
                                // Deleting posts
                                deletePost();                 
                            ?>
                            </tbody>
    </table>
</div>