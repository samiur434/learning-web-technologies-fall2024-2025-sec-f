<?php
session_start();
require_once "../../config/db.php";
require_once "../../model/profileModel.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login_form.php");
    exit();
}

$user = getUserById($conn, $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
        input[type="email"],
        input[type="password"] {
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
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            if (name == "" || email == "") {
                alert("Name and Email must be filled out");
                return false;
            }
            return true;
        }

        function submitForm(event) {
            event.preventDefault();
            if (!validateForm()) {
                return;
            }

            var formData = new FormData(document.getElementById("profileForm"));
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../../Controller/profileController.php", true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    alert(response.message);
                } else {
                    alert("An error occurred while updating the profile");
                }
            };
            xhr.send(formData);
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <form id="profileForm" onsubmit="submitForm(event)">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <label for="password">Password (leave blank to keep current password):</label>
            <input type="password" id="password" name="password">
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>