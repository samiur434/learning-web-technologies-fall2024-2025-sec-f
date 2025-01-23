<?php
require_once "../config/db.php";


function addTicket($title, $message) {
    global $conn;

    session_start();
    if (!isset($_SESSION['user_id'])) {
        return false;
    }

    $user_id = $_SESSION['user_id'];

    if (!empty($title) && !empty($message)) {
        $query = "INSERT INTO support_tickets (user_id, title, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iss", $user_id, $title, $message);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    addTicket($_POST['title'], $_POST['message']);
}
?>