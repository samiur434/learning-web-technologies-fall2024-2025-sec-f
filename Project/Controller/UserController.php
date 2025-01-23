<?php
session_start();
require_once '../model/UserModel.php';
require_once '../config/db.php';

$userModel = new UserModel($conn);

$response = ['status' => 'error', 'message' => 'An error occurred'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($userModel->getUserByUsername($email)) {
        $response['message'] = 'Email already exists';
    } else {
        if ($userModel->createUser($name, $email, $password)) {
            $response['status'] = 'success';
            $response['message'] = 'Registration successful';
        } else {
            $response['message'] = 'Registration failed';
        }
    }
}

echo json_encode($response);
?>