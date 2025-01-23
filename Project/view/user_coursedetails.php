<?php
session_start();
require_once '../config/database.php';

$id = $_GET['id'] ?? 0;

$query = "SELECT * FROM courses WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();
if (!$course) {
    echo "<p>Course not found.</p>";
    exit();
}

$enrollmentMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enroll'])) {
    
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $user_id = 1;
    $course_id = $course['id'];
    $query = "INSERT INTO saved_courses (user_id, course_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $course_id);
    if ($stmt->execute()) {
        $enrollmentMessage = 'Course saved successfully.';
    } else {
        $enrollmentMessage = 'Error saving course: ' . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #e8f5e9;
        }
        h1, h2 {
            color: #388e3c;
        }
        .course-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .course-details img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-top: 10px;
        }
        .back-button, .save-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4caf50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }
        .back-button:hover, .save-button:hover {
            background-color: #388e3c;
        }
    </style>
</head>
<body>
    <a class="back-button" href="user_courselist.php">Back to Course List</a>

    <div class="course-details">
        <h1><?php echo htmlspecialchars($course['title']); ?></h1>
        <p>Category: <?php echo htmlspecialchars($course['category']); ?></p>
        <p>Description: <?php echo htmlspecialchars($course['description']); ?></p>
        <?php if (!empty($course['image'])) { ?>
            <p><img src="../assets/<?php echo htmlspecialchars($course['image']); ?>" alt="Course Image"></p>
        <?php } ?>
        <form method="POST">
            <button type="submit" name="enroll">Enroll</button>
            <button type="submit" name="save">Save Course</button>
        </form>
        <?php if ($enrollmentMessage) { ?>
            <p><?php echo htmlspecialchars($enrollmentMessage); ?></p>
        <?php } ?>
    </div>
</body>
</html>