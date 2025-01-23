<?php
session_start();
require_once '../config/database.php';

$response = ['status' => 'error', 'message' => 'An error occurred'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_id'])) {
    $user_id = $_SESSION['user_id'];
    $course_id = $_POST['course_id'];

    $query = "INSERT INTO saved_courses (user_id, course_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $course_id);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Course saved successfully.';
    } else {
        $response['message'] = 'Error saving course.';
    }
}

echo json_encode($response);
?>