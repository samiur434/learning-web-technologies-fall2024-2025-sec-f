<?php
session_start();
require_once '../config/database.php';

$category = isset($_GET['category']) ? $_GET['category'] : '';

$query = "SELECT * FROM courses";
if (!empty($category)) {
    $query .= " WHERE category = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $category);
} else {
    $stmt = $conn->prepare($query);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - View Courses</title>
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
        form {
            margin-bottom: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        select, button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #388e3c;
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
        .details-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4caf50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .details-button:hover {
            background-color: #388e3c;
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

    <h2>Filter Courses by Category</h2>
    <form method="GET" action="user_courselist.php">
        <label for="category">Category:</label>
        <select name="category" id="category">
            <option value="">All</option>
            <option value="technology" <?php echo ($category == 'technology') ? 'selected' : ''; ?>>Technology</option>
            <option value="crop" <?php echo ($category == 'crop') ? 'selected' : ''; ?>>Crop</option>
            <option value="livestock" <?php echo ($category == 'livestock') ? 'selected' : ''; ?>>Livestock</option>
            <option value="marketing" <?php echo ($category == 'marketing') ? 'selected' : ''; ?>>Marketing</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <h2>Available Courses</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='course-card'>";
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>Category: " . htmlspecialchars($row['category']) . "</p>";
            if (!empty($row['image'])) {
                echo "<p><img src='../assets/" . htmlspecialchars($row['image']) . "' alt='Course Image'></p>";
            }
            echo "<a class='details-button' href='user_coursedetails.php?id=" . $row['id'] . "'>Details</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No courses found.</p>";
    }
    $conn->close();
    ?>
</body>
</html>