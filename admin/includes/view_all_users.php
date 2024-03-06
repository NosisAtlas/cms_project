<div class="table-responsive">
    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <td>Last Name</td>
                                    <th>Email</th>
                                    <th>Role</th>   
                                    <th>Update</th>
                                    <th>Actions</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php findAllCommentsAndDisplayInAdmin(); ?>
                                <?php 
                                // Deleting comments
                                deleteComment();  
                                // Approving comments
                                approveComment();              
                                // Unapproving comments 
                                unapproveComment();
                                ?>
                            </tbody>
    </table>
</div>