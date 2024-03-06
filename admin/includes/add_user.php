
<?php insertUsers(); ?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control" type="text" name="username">
    </div>
    <!-- Password -->
    <div class="form-group">
        <label for="user_password">Password</label>
        <input class="form-control" type="password" name="user_password">
    </div>
    <!-- Firstname -->
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input class="form-control" type="text" name="user_firstname">
    </div>
    <!-- Lastname -->
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input class="form-control" type="text" name="user_lastname">
    </div>
    <!-- User email -->
    <div class="form-group">
        <label for="user_email">Email</label>
        <input class="form-control" type="email" name="user_email">
    </div>
    <!-- User image -->
    <div class="form-group">
        <label for="user_image">Profile image</label>
        <input class="form-control" type="file" name="image">
    </div>
    <!-- User role -->
    <div class="form-group">
        <label for="user_role">User role</label>
        <select class="form-select form-control" name="user_role" id="user_role">
            <option value="user" selected>Select role</option>
            <option value="admin">admin</option>
            <option value="user">user</option>
        </select>
    </div>

    <!-- Submit btn -->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Add user" name="create_user">
    </div>
</form>