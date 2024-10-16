<?php
require_once 'dbConfig.php';

function insertIntoUsersTable($pdo, $first_name, $last_name, $gender, $password, $email, $role, $contact_no) {
    // Check for existing email
    $checkEmailSql = "SELECT COUNT(*) FROM users WHERE email = ?";
    $stmt = $pdo->prepare($checkEmailSql);
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        echo "Error: Email already exists.";
        return;
    }

    $insert_sql = "INSERT INTO users (first_name, last_name, gender, password, email, role, contact_no) VALUES (?,?,?,?,?,?,?)";
    try {
        $stmt = $pdo->prepare($insert_sql); // prepare statement for safety
        $stmt->execute([$first_name, $last_name, $gender, $password, $email, $role, $contact_no]); // Execute with user data
        echo "New user created successfully";
        header("Location: http://localhost/mycodes/dream_job_registration/pages_sql/");
        exit(); // Stop further execution after the redirect

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function seeAllUserRecords($pdo) {
    $sql = "SELECT * FROM users";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        return $stmt->fetchAll();
    }
}

function getUserByID($pdo, $user_id) {
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$user_id])) {
        return $stmt->fetch(PDO::FETCH_ASSOC); // Use FETCH_ASSOC for associative array
    }
    
    return false; // Return false if the execution fails
}

function deleteUserInfo($pdo, $user_id) {
    $delete_sql = "DELETE FROM users WHERE user_id = ?";
    try {
        $stmt = $pdo->prepare($delete_sql); // Prepare the delete query
        $stmt->execute([$user_id]); // Execute the query with the user ID
        echo "Record deleted successfully from users";
        return true; // Return true for successful deletion
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false; // Return false if deletion fails
    }
}

function updateUserinfo($pdo, $user_id, $first_name, $last_name, $gender, $password, $email, $role, $contact_no) {
    $update_sql = "UPDATE users
                   SET first_name = ?,
                       last_name = ?,
                       gender = ?, 
                       password = ?,
                       email = ?,
                       role = ?,
                       contact_no = ?
                   WHERE user_id = ?";
    try {
        $stmt = $pdo->prepare($update_sql);
        $stmt->execute([$first_name, $last_name, $gender, $password, $email, $role, $contact_no, $user_id]);
        echo "User $user_id is updated";
        return true; // Return true for successful update
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false; // Return false if update fails
    }
}
?>
