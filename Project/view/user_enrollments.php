<?php
session_start();
require_once '../config/database.php';

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM enrollments WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Enrollments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #e8f5e9;
        }
        h1 {
            color: #388e3c;
        }
        .enrollment-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .enrollment-card img {
            max-width: 100px;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }
        .back-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4caf50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }
        .back-button:hover {
            background-color: #388e3c;
        }
    </style>
</head>
<body>
    <a class="back-button" href="user_dashboard.php">Back to Dashboard</a>
    <h1>My Enrollments</h1>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $course_id = $row['course_id'];
            $course_query = "SELECT * FROM courses WHERE id = ?";
            $course_stmt = $conn->prepare($course_query);
            $course_stmt->bind_param("i", $course_id);
            $course_stmt->execute();
            $course_result = $course_stmt->get_result();
            $course = $course_result->fetch_assoc();

            echo "<div class='enrollment-card'>";
            echo "<h3>" . htmlspecialchars($course['title']) . "</h3>";
            echo "<p>Category: " . htmlspecialchars($course['category']) . "</p>";
            echo "<p>Module: " . htmlspecialchars($course['module']) . "</p>";
            echo "<p>Duration: " . htmlspecialchars($course['duration']) . " hours</p>";
            echo "<p>Price: $" . htmlspecialchars($course['price']) . "</p>";
            if (!empty($course['image'])) {
                echo "<p><img src='../assets/" . htmlspecialchars($course['image']) . "' alt='Course Image'></p>";
            }
            echo "<form class='rating-form' method='POST'>";
            echo "<input type='hidden' name='course_id' value='" . $course['id'] . "'>";
            echo "<label for='rating'>Rating:</label>";
            echo "<select name='rating' id='rating'>";
            echo "<option value='1'>1</option>";
            echo "<option value='2'>2</option>";
            echo "<option value='3'>3</option>";
            echo "<option value='4'>4</option>";
            echo "<option value='5'>5</option>";
            echo "</select>";
            echo "<label for='comment'>Comment:</label>";
            echo "<textarea name='comment' id='comment'></textarea>";
            echo "<button type='submit'>Submit</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p>No enrollments found.</p>";
    }
    ?>
</body>
</html>