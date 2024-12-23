<?php
require_once('userModel.php'); // Include your user model

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Handle Insert Operation
    if ($action === 'insert') {
        if (isset($_POST['username'], $_POST['password'], $_POST['email'])) {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $email = trim($_POST['email']);

            if (empty($username) || empty($password) || empty($email)) {
                echo "All fields are required for insertion.";
            } else {
                if (addUser($username, $password, $email)) {
                    echo "User inserted successfully!";
                } else {
                    echo "Failed to insert user.";
                }
            }
        }

    // Handle Update Operation
    } elseif ($action === 'update') {
        if (isset($_POST['id'], $_POST['username'], $_POST['password'], $_POST['email'])) {
            $id = trim($_POST['id']);
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $email = trim($_POST['email']);

            if (empty($id)) {
                echo "User ID is required for updating.";
            } else {
                // Prepare the user array
                $user = [
                    'id' => $id,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                ];

                if (updateUser($user)) {
                    echo "User updated successfully!";
                } else {
                    echo "Failed to update user.";
                }
            }
        }

    // Handle Delete Operation
    } elseif ($action === 'delete') {
        if (isset($_POST['id'])) {
            $id = trim($_POST['id']);

            if (empty($id)) {
                echo "User ID is required for deletion.";
            } else {
                if (deleteUser($id)) {
                    echo "User deleted successfully!";
                } else {
                    echo "Failed to delete user.";
                }
            }
        }
    } else {
        echo "Invalid action!";
    }
} else {
    echo "No action specified!";
}
?>
