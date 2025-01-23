<?php
session_start();

class UserDashboardController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function renderDashboard() {
        // Check if the user is logged in and is not an admin
        if (!isset($_SESSION['username']) || isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
            header("Location: ../view/login_form.php");
            exit();
        }

        // Fetch data for the dashboard
        $data = $this->fetchDashboardData();
        
        // Include the view file to render the dashboard
        include '../view/user_dashboard.php';
    }

    private function fetchDashboardData() {
        // Example query to fetch relevant data for the user dashboard
        $query = "SELECT COUNT(*) as course_count FROM courses";
        $result = $this->conn->query($query);
        $data = $result->fetch_assoc();
        return $data;
    }
}
?>