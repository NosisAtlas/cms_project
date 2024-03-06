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
                                    <th>Role Admin</th>   
                                    <th>Role User</th>   
                                    <th>Update</th>
                                    <th>Actions</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php findAllUsers(); ?>
                                <?php 
                                // Deleting comments
                                deleteUser();  
                                // Change role to admin
                                changeRoleToAdmin();              
                                // Change role to user 
                                changeRoleToUser();
                                ?>
                            </tbody>
    </table>
</div>