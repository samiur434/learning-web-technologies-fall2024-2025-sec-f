<?php
session_start();
require_once '../config/db.php';

$response = ['status' => 'error', 'message' => 'An error occurred'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    if ($conn->connect_error) {
        $response['message'] = 'Database connection failed: ' . $conn->connect_error;
        echo json_encode($response);
        exit();
    }

    $query = "SELECT user_id, 
                     course_id, 
                     rating, 
                     comment, 
                     created_at
              FROM course_ratings";

    $result = $conn->query($query);

    if ($result) {
        $ratings = [];
        while ($row = $result->fetch_assoc()) {
            $ratings[] = $row;
        }
        $response['status'] = 'success';
        $response['ratings'] = $ratings;
    } else {
        $response['message'] = 'Error fetching ratings: ' . $conn->error;
    }
}

echo json_encode($response);
?>