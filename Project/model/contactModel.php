<?php
require_once "../config/db.php";

function createContactRequest($user_id, $subject, $message) {
    global $conn;
    $query = "INSERT INTO contact_requests (user_id, subject, message) VALUES ($user_id, '$subject', '$message')";
    return $conn->query($query);
}
?>
