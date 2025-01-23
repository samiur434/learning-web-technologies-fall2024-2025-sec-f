<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../view/login_form.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Ratings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9;
            margin: 0;
            padding: 20px;
        }
        h1 {
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
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('../controller/courseRatingsController.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const tableBody = document.getElementById('ratingsTableBody');
                        data.ratings.forEach(rating => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${rating.user_id}</td>
                                <td>${rating.course_id}</td>
                                <td>${rating.rating}</td>
                                <td>${rating.comment}</td>
                                <td>${rating.created_at}</td>
                            `;
                            tableBody.appendChild(row);
                        });
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error fetching ratings:', error));
        });
    </script>
</head>
<body>
    <h1>Course Ratings</h1>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Course ID</th>
                <th>Rating</th>
                <th>Comment</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody id="ratingsTableBody">
            <!-- Ratings will be populated here by JavaScript -->
        </tbody>
    </table>
</body>
</html>