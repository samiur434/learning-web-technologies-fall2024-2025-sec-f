<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Feedback</title>
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
        }
        h1 {
            text-align: center;
            color: #388e3c;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #388e3c;
        }
    </style>
    <script>
        function validateForm() {
            var feedback = document.getElementById("feedback").value;
            if (feedback == "") {
                alert("Feedback must be filled out");
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
                    alert(response.message);
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
        <h1>Give Feedback</h1>
        <form id="feedbackForm" onsubmit="submitForm(event)">
            <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" required></textarea>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>