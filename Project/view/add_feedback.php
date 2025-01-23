<?php
session_start();
require_once "../Controller/feedbackController.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h1 {
            color: #388e3c;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            margin-bottom: 5px;
            color: #555;
        }
        textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }
        button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #388e3c;
        }
        .message {
            color: red;
            margin-bottom: 15px;
        }
        a {
            color: #4caf50;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
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
                        window.location.href = "../view/feedback_list.php?message=" + encodeURIComponent(response.message);
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
    <div class="container">
        <h1>Add Feedback</h1>
        <?php if (isset($_GET['error'])) { ?>
            <p class="message" id="error_message"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php } ?>
        <form id="feedbackForm" onsubmit="submitForm(event)">
            <label for="feedback_text">Feedback:</label><br>
            <textarea id="feedback_text" name="feedback_text" rows="5" cols="40" required></textarea><br><br>
            <input type="hidden" name="action" value="add">
            <button type="submit">Submit Feedback</button>
        </form>
        <br>
        <a href="../view/feedback_list.php">Back to Feedback List</a>
    </div>
</body>
</html>