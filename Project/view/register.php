<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .register-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #388e3c;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            display: block;
            margin-top: 10px;
            color: #fff;
            background-color: #4CAF50;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
   
</head>
<body>
    <div class="register-container">
        <h1>Register</h1>
        <p id="error_message" class="error"></p>
        <form id="registerForm" method="POST">
            <input type="hidden" name="action" value="register">
            <label>Name:</label>
            <input type="text" name="name" required><br>
            <label>Email:</label>
            <input type="email" name="email" required><br>
            <label>Password:</label>
            <input type="password" name="password" required><br>
            <button type="submit">Register</button>
        </form>
        <br>
        <a href="login_form.php">Back to Login</a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('registerForm').addEventListener('submit', function(e) {
                e.preventDefault();
                var form = this;
                var formData = new FormData(form);
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../Controller/UserController.php', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            window.location.href = 'login_form.php?success=Registration successful';
                        } else {
                            document.getElementById('error_message').innerText = response.message;
                        }
                    } else {
                        document.getElementById('error_message').innerText = 'An error occurred during registration.';
                    }
                };
                xhr.send(formData);
            });
        });
    </script>
</body>
</html>