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
                                    <?php
                                        if(is_admin()){
                                            echo "<th>Approve</th>
                                            <th>Unapprove</th>";
                                        }else{
                                            echo "";
                                        }
                                    ?> 
                                    
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