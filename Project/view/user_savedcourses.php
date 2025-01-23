<?php
session_start();
require_once '../config/database.php';

$user_id = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $course_id = $_POST['course_id'];
    $query = "DELETE FROM saved_courses WHERE user_id = ? AND course_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $course_id);
    $stmt->execute();
}

$query = "SELECT courses.* FROM courses 
          JOIN saved_courses ON courses.id = saved_courses.course_id 
          WHERE saved_courses.user_id = ?";
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
    <title>Saved Courses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #e8f5e9;
        }
        h1 {
            color: #388e3c;
        }
        .course-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .course-card img {
            max-width: 100px;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }
        .back-button, .delete-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4caf50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }
        .back-button:hover, .delete-button:hover {
            background-color: #388e3c;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".deleteForm").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "../Controller/userSavedCoursesController.php",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function() {
                        alert("Error deleting course.");
                    }
                });
            });
        });
    </script>
</head>
<body>
    <a class="back-button" href="user_dashboard.php">Back to Dashboard</a>
    <h1>Saved Courses</h1>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='course-card'>";
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>Category: " . htmlspecialchars($row['category']) . "</p>";
            echo "<p>Description: " . htmlspecialchars($row['description']) . "</p>";
            if (!empty($row['image'])) {
                echo "<p><img src='../assets/" . htmlspecialchars($row['image']) . "' alt='Course Image'></p>";
            }
            echo "<form class='deleteForm' method='POST'>";
            echo "<input type='hidden' name='course_id' value='" . $row['id'] . "'>";
            echo "<button type='submit' name='delete' class='delete-button'>Delete</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p>No saved courses found.</p>";
    }
    ?>
</body>
</html>