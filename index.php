<?php
$roles = ["Admin", "Editor", "Viewer", "Moderator", "Data engineer"]; // for the foreach loop in dropdown input for roles
require_once __DIR__ . '/../main/handleForms.php';
require_once __DIR__ . '/../main/dbConfig.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>ヾ(＠⌒ー⌒＠)ノWelcome to the user registration for data administrators!</h1>
        <hr>
        <h2>Input your data below</h2>

        <form action="http://localhost/mycodes/dream_job_registration/main/handleForms.php" method="POST">

            <p><label for="first_name">First Name</label> <input type="text" name="first_name" required></p>

            <p><label for="last_name">Last Name</label> <input type="text" name="last_name" required></p>

            <p><label for="gender">Gender</label> <input type="text" name="gender" required></p>

            <p><label for="password">Password</label> <input type="password" name="password" required></p>

            <p><label for="email">Email</label> <input type="email" name="email" required></p>

            <p><label for="role">Role</label></p>
            <select name="role" required>
                <option value="">--Select Role--</option>
                <?php
                    foreach ($roles as $role) {
                        echo "<option value='$role'>$role</option>";
                    }
                ?>
            </select>
            <p><label for="contact_no">Contact number</label> <input type="text" name="contact_no" required>
                <input type="submit" name="insertNewUserBtn" value="Register">
            </p>
        </form>

        <table style="width:50%; margin-top: 50px;">
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Role</th>
                <th>Contact No</th>
                <th>Date Added</th>
                <th>Action</th>
            </tr>

            <?php $seeAllUserRecords = seeAllUserRecords($pdo); ?>
            <?php foreach ($seeAllUserRecords as $row) { ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td><?php echo $row['contact_no']; ?></td>
                <td><?php echo $row['date_added']; ?></td>
                <td>
                    <a href="editUser.php?user_id=<?php echo $row['user_id'];?>">Edit</a>
                    <a href="deleteUser.php?user_id=<?php echo $row['user_id'];?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
