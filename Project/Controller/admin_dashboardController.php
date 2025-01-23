<?php
session_start();

class AdminDashboardController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function renderDashboard() {
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
            header("Location: ../view/login_form.php");
            exit();
        }

        $data = $this->fetchDashboardData();

        include '../view/admin_dashboard.php';
    }

    private function fetchDashboardData() {
        $query = "SELECT COUNT(*) as user_count FROM users";
        $result = $this->conn->query($query);
        $data = $result->fetch_assoc();
        return $data;
    }
}
?>