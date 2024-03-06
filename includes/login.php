<?php
    include 'db.php';

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare statement
        $query = $connection->prepare("SELECT * FROM users WHERE username = ?");
        // Bind parameter
        $query->bind_param("s", $username);

        // Execute query
        if (!$query->execute()) {
            die("Execution failed: (" . $query->errno . ") " . $query->error);
        }

        // Get result
        $result = $query->get_result();
        if (!$result) {
            die("Get result failed: (" . $query->errno . ") " . $query->error);
        }

        if($result->num_rows > 0) {
            // Fetch user data
            $row = $result->fetch_assoc();
            $hashed_password = $row['user_password'];

            // Verify password
            if(password_verify($password, $hashed_password)) {
                // Password is correct
                $user_id = $row['user_id'];
                $user_role = $row['user_role'];
                if($user_role == 'admin'){
                    header('Location: ../admin/index.php');
                    exit(); // It's good practice to include an exit after redirection
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            } else {
                // Password is incorrect
                echo "Invalid password";
            }
        } else {
            echo "No user found with the provided credentials.";
            // You might want to redirect here instead of showing an error message
        }
    }
?>
