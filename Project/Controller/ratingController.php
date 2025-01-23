<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $course_id = $_POST['course_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    if (empty($course_id) || empty($rating) || empty($comment)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
        exit();
    }

    $query = "INSERT INTO course_ratings (user_id, course_id, rating, comment) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiis", $user_id, $course_id, $rating, $comment);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Rating submitted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error submitting rating']);
    }
    exit();
}
?>