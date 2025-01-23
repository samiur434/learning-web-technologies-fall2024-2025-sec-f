<?php
require_once '../controller/EnrollmentController.php';
require_once '../config/database.php';

$db = new mysqli($host, $username, $password, $dbname);
$enrollmentController = new EnrollmentController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_id']) && isset($_POST['course_id'])) {
        $user_id = $_POST['user_id'];
        $course_id = $_POST['course_id'];
        if ($enrollmentController->addEnrollment($user_id, $course_id)) {
            echo "<p>Enrollment added successfully.</p>";
        } else {
            echo "<p>Failed to add enrollment.</p>";
        }
        header("Location: admin_enrollments.php");
        exit();
    }
}

// Fetch all enrollments
$enrollments = $enrollmentController->getAllEnrollments();

// Fetch all users and courses for the add enrollment form
$users = $enrollmentController->getAllUsers();
$courses = $enrollmentController->getAllCourses();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Enrollments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9;
            margin: 0;
            padding: 20px;
        }
        h1, h2 {
            color: #388e3c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #4caf50;
            color: #fff;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #4caf50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Manage Enrollments</h1>
    <a href="admin_dashboard.php" class="back-button">Back to Dashboard</a>
    <h2>Add Enrollment</h2>
    <form method="POST" action="admin_enrollments.php">
        <label for="user_id">User:</label>
        <select name="user_id" id="user_id">
            <?php while ($user = $users->fetch_assoc()): ?>
                <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
            <?php endwhile; ?>
        </select>
        <label for="course_id">Course:</label>
        <select name="course_id" id="course_id">
            <?php while ($course = $courses->fetch_assoc()): ?>
                <option value="<?= $course['id'] ?>"><?= $course['title'] ?></option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Add Enrollment</button>
    </form>

    <h2>All Enrollments</h2>
    <table>
        <thead>
            <tr>
                <th>Enrollment ID</th>
                <th>Username</th>
                <th>Course Title</th>
                <th>Enrollment Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($enrollment = $enrollments->fetch_assoc()): ?>
                <tr>
                    <td><?= $enrollment['enrollment_id'] ?></td>
                    <td><?= $enrollment['username'] ?></td>
                    <td><?= $enrollment['title'] ?></td>
                    <td><?= $enrollment['enrollment_date'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>