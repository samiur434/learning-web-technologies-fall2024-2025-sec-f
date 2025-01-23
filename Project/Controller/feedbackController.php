<?php
require_once "../config/db.php";

function addFeedback($feedback_text) {
    global $conn;

    session_start();
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        exit();
    }

    $user_id = $_SESSION['user_id'];

    if (!empty($feedback_text)) {
        $query = "INSERT INTO feedback (user_id, feedback_text) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $user_id, $feedback_text);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Feedback added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error adding feedback: ' . $stmt->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Feedback cannot be empty']);
    }
    exit();
}

function getUserFeedback($user_id) {
    global $conn;

    $query = "SELECT id, feedback_text FROM feedback WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $feedback = [];
    while ($row = $result->fetch_assoc()) {
        $feedback[] = $row;
    }
    return $feedback;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    addFeedback($_POST['feedback_text']);
}
?>