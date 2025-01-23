<?php
require_once "../config/db.php";

// Function to create a support ticket
function createSupportTicket($user_id, $subject, $message) {
    global $conn;

    $query = "INSERT INTO support_tickets (user_id, subject, message) VALUES ($user_id, '$subject', '$message')";
    return $conn->query($query);
}

// Function to get all support tickets
function getAllTickets() {
    global $conn;

    $query = "SELECT * FROM support_tickets";
    $result = $conn->query($query);

    // Debugging: Check query success
    if (!$result) {
        die("Query Failed: " . $conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get a supp
