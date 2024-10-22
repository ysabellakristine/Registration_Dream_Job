<?php 
require_once '../main/dbConfig.php'; 
require_once '../main/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editing User</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
<div class="container">
    <?php 
    $getUserByID = getUserByID($pdo, $_GET['user_id']); 
    
    // Check if the user was found
    if ($getUserByID === false) {
        echo "<p>Error: User not found.</p>";
        exit; // Stop further execution if the user is not found
    }
    ?>
    <form action="http://localhost/mycodes/dream_job_registration/main/handleForms.php?user_id=" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
        
        <p>
            <label for="first_name">First Name</label> 
            <input type="text" name="first_name" value="<?php echo $getUserByID['first_name']; ?>" required>
        </p>
        <p>
            <label for="last_name">Last Name</label> 
            <input type="text" name="last_name" value="<?php echo $getUserByID['last_name']; ?>" required>
        </p>
        <p>
            <label for="gender">Gender</label>
            <input type="text" name="gender" value="<?php echo $getUserByID['gender']; ?>" required>
        </p>
        <p>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Leave blank to keep current password">
        </p>
        <p>
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $getUserByID['email']; ?>" required>
        </p>
        <p>
            <label for="role">Role</label>
            <select name="role" required>
                <option value="" disabled selected>--Select Role--</option> <!-- Default selection -->
                <?php
                $roles = ["Admin", "Editor", "Viewer", "Moderator", "Data engineer"];
                foreach ($roles as $role) {
                    echo "<option value='$role'>$role</option>"; // List all roles
                }
                ?>
            </select>
        </p>
        <p>
            <label for="contact_no">Contact Number</label>
            <input type="text" name="contact_no" value="<?php echo $getUserByID['contact_no']; ?>" required>
        </p>
        <p>
            <input type="submit" name="editUserBtn" value="Update User">
        </p>
    </form>
</div>
</body>
</html>
