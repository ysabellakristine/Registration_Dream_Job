<?php 
require_once '../main/dbConfig.php'; 
require_once '../main/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
<div class="container">
    <h1>Are you sure you want to delete this user?</h1>
    <?php 
    $user_id = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);
    if ($user_id === false) {
        die("Invalid user ID");
    }
    
    $getUserByID = getUserByID($pdo, $user_id); 
	if (!$getUserByID) {
        die("User not found.");
    }
    ?>
    <form action="http://localhost/mycodes/dream_job_registration/main/handleForms.php?user_id=<?php echo $user_id; ?>" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
		<p>First Name: <?php echo $getUserByID['first_name']; ?></p>
        <p>Last Name: <?php echo $getUserByID['last_name']; ?></p>
        <p>Gender: <?php echo $getUserByID['gender']; ?></p>
        <p>Password (hashed): <?php echo $getUserByID['password']; ?></p> <!-- shows hashed password -->
        <p>Email: <?php echo $getUserByID['email']; ?></p>
        <p>Role: <?php echo $getUserByID['role']; ?></p>
        <p>Contact number: <?php echo $getUserByID['contact_no']; ?></p>
        <input type="submit" name="deleteUserBtn" value="Delete">
    </form>
</div>
</body>
</html>
