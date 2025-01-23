<?php
session_start();
require_once "../Controller/feedbackController.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$feedback = getUserFeedback($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Feedback List</title>
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
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .message {
            color: green;
            margin-bottom: 15px;
        }
    </style>
    <script>
        function validateForm() {
            var feedback = document.getElementById("feedback_text").value;
            if (feedback.trim() === "") {
                alert("Feedback cannot be empty");
                return false;
            }
            return true;
        }

        function submitForm(event) {
            event.preventDefault();
            if (!validateForm()) {
                return;
            }

            var formData = new FormData(document.getElementById("feedbackForm"));
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../Controller/feedbackController.php", true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === "success") {
                        window.location.reload();
                    } else {
                        document.getElementById("error_message").innerText = response.message;
                    }
                } else {
                    alert("An error occurred while submitting the feedback");
                }
            };
            xhr.send(formData);
        }
    </script>
</head>
<body>
    <h1>My Feedback List</h1>
    <?php if (isset($_GET['message'])) { ?>
        <p class="message"><?php echo htmlspecialchars($_GET['message']); ?></p>
    <?php } ?>
    <div class="message" id="error_message"></div>
    <form id="feedbackForm" onsubmit="submitForm(event)">
        <label for="feedback_text">Feedback:</label>
        <textarea id="feedback_text" name="feedback_text" rows="5" required></textarea>
        <button type="submit">Submit Feedback</button>
    </form>
    <?php if (!empty($feedback)) { ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Feedback</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedback as $item) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['id']); ?></td>
                        <td><?php echo htmlspecialchars($item['feedback_text']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No feedback available.</p>
    <?php } ?>
</body>
</html>