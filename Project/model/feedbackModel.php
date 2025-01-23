<?php
require_once "../config/db.php";

function addFeedback($feedback_text) {
    global $conn;

    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../view/login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    if (!empty($feedback_text)) {
        $query = "INSERT INTO feedback (user_id, feedback_text) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $user_id, $feedback_text);
        if ($stmt->execute()) {
            header("Location: ../view/feedback_list.php?message=Feedback added successfully");
        } else {
            header("Location: ../view/add_feedback.php?error=" . urlencode("Error adding feedback: " . $stmt->error));
        }
    } else {
        header("Location: ../view/add_feedback.php?error=Feedback cannot be empty");
    }
    exit();
}

function getUserFeedback($user_id) {
    global $conn;

    $query = "SELECT * FROM feedback WHERE user_id = ?";
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

if (isset($_POST['action']) && $_POST['action'] === 'add') {
    addFeedback($_POST['feedback_text']); // Pass the feedback_text from the form
}
?>