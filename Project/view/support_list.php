<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Tickets</title>
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
            fetch('../controller/supportController.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const tableBody = document.getElementById('ticketsTableBody');
                        data.tickets.forEach(ticket => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${ticket.id}</td>
                                <td>${ticket.title}</td>
                                <td>${ticket.message}</td>
                            `;
                            tableBody.appendChild(row);
                        });
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error fetching tickets:', error));
        });
    </script>
</head>
<body>
    <h1>Support Tickets</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody id="ticketsTableBody">
        </tbody>
    </table>
</body>
</html>