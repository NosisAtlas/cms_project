<div class="table-responsive">
    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <td>Email</td>
                                    <th>Status</th>
                                    <th>In Response to</th>   
                                    <th>Date</th>   
                                    <th>Approve</th>
                                    <th>Unapprove</th>
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