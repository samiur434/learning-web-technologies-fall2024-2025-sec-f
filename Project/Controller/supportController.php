<?php
require_once "../config/db.php";

$response = ['status' => 'error', 'message' => 'An error occurred'];

function addTicket($title, $message) {
    global $conn;

    session_start();
    if (!isset($_SESSION['user_id'])) {
        return ['status' => 'error', 'message' => 'User not logged in'];
    }

    $user_id = $_SESSION['user_id'];

    if (!empty($title) && !empty($message)) {
        $query = "INSERT INTO support_tickets (user_id, title, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iss", $user_id, $title, $message);
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Ticket created successfully'];
        } else {
            return ['status' => 'error', 'message' => 'Failed to create ticket'];
        }
    } else {
        return ['status' => 'error', 'message' => 'Title and message cannot be empty'];
    }
}

function getUserTickets($user_id) {
    global $conn;

    $query = "SELECT id, title, message FROM support_tickets WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $tickets = [];
    while ($row = $result->fetch_assoc()) {
        $tickets[] = $row;
    }
    return $tickets;
}

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = addTicket($_POST['title'], $_POST['message']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['user_id'])) {
    $response = ['status' => 'success', 'tickets' => getUserTickets($_SESSION['user_id'])];
}

echo json_encode($response);
?>