<?php
require_once 'dbConfig.php';

function insertIntoUsersTable ($pdo, $first_name, $last_name, $gender, $password, $email, $role, $contact_no) {

    $insert_sql = "INSERT INTO users (first_name, last_name, gender, password, email, role, contact_no) VALUES (?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($insert_sql);

    try {
        $stmt = $pdo->prepare($insert_sql);                                // prepare statement for safety
        $stmt->execute([$first_name, $last_name, $gender, $password, $email, $role, $contact_no]); // Execute with user data
        echo "New user created successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function deleteUserInfo ($pdo, $delete_Key) {
    $delete_Sql = "DELETE FROM users WHERE $delete_Key = ?";
    $recordId = $_POST['record_id'] ?? null;
    try {
        $stmt = $pdo->prepare($delete_Sql);  // Prepare the delete query
        $stmt->execute([$recordId]);  // Execute the query with the record ID
        echo "Record deleted successfully from users";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function updateUserinfo($pdo, $user_id, $first_name, $last_name, $gender, $password, $email, $role, $contact_no ) {
    $update_sql = "UPDATE users
                        SET first_name = ?,
                            last_name = ?,
                            gender = ?, 
                            password = ?,
                            email = ?,
                            role = ?,
                            contact_no = ?,
                    WHERE   user_id = ?";
    try {
        $stmt = $pdo->prepare($update_sql);
        $stmt->execute([$first_name, $last_name, $gender, $password, $email, $role, $contact_no, $user_id]);
        echo "User $user_id is updated";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
                            
}
