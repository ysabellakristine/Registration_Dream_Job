<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

function handleError($errorMessage) {
    echo "<p>Error: $errorMessage</p>";
}

if (isset($_POST['insertNewUserBtn'])) {
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $gender = trim($_POST['gender']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);
    $contact_no = trim($_POST['contact_no']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        handleError("Invalid email format.");
        exit;
    }

    if (!empty($firstName) && !empty($lastName) && !empty($gender) && !empty($password) && !empty($email) && !empty($role) && !empty($contact_no)) {
        // hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        if (insertIntoUsersTable($pdo, $firstName, $lastName, $gender, $hashedPassword, $email, $role, $contact_no)) {
            header("Location: ../index.php");
            exit();
        } else {
            handleError("Insertion failed: " . $pdo->errorInfo()[2]);
        }
    } else {
        handleError("Make sure that all fields are filled.");
    }
}

if (isset($_POST['editUserBtn'])) {
    $user_id = trim($_POST['user_id']);
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $gender = trim($_POST['gender']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);
    $contact_no = trim($_POST['contact_no']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        handleError("Invalid email format.");
        exit;
    }

    if (!empty($user_id) && 
        (!empty($firstName) || 
         !empty($lastName) || 
         !empty($gender) || 
         !empty($password) || 
         !empty($email) || 
         !empty($role) || 
         !empty($contact_no))) {

        // Hash password pag may nilagay
        $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

        try {
            if (updateUserinfo($pdo, $user_id, $firstName, $lastName, $gender, $hashedPassword, $email, $role, $contact_no)) {
                header("Location: http://localhost/mycodes/dream_job_registration/pages_sql/");
                exit();
            } else {
                handleError("Update failed.");
            }
        } catch (PDOException $e) {
            handleError("Update failed: " . $e->getMessage());
        }
    } else {
        handleError("Make sure that no fields are empty.");
    }
}

if (isset($_POST['deleteUserBtn'])) {
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

    if ($user_id === false) {
        handleError("Invalid user ID.");
        exit;
    }
    
    if (deleteUserInfo($pdo, $user_id)) {
        header("Location: http://localhost/mycodes/dream_job_registration/pages_sql/");
        exit();
    } else {
        handleError("Deletion failed.");
    }
}
