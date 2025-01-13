
<?php
include_once "../model/empmodel.php";

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'signup' || $action == 'add') { 
        $user_name = $_POST['user_name'];
        $emp_name = $_POST['emp_name'];
        $contact_no = $_POST['contact_no'];
        $password = $_POST['password'];

        if (add_user($user_name, $emp_name, $contact_no, $password)) {
            $redirectPage = ($action == 'signup') ? "../view/login.php" : "../view/empList.php";
            header("Location: $redirectPage");
        } else {
            echo "Failed to perform operation. Try again.";
        }
    } 
    elseif ($action == 'login') {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        //$emp_name = $_POST('emp_name');
        if (user_login($user_name, $password)) {
            $_SESSION['user_name'] = $user_name;
            header("Location: ../view/home.php");
        } else {
            echo "Invalid username or password.";
        }
    } elseif ($action == 'delete') {
        $user_name = $_SESSION['user_name'];
        if (delete_user($user_name)) {
            session_destroy();
            header("Location: ../view/login.php");
        } else {
            echo "Failed to delete account.";
        }
        
    } elseif ($action == 'logout') {
        session_destroy();
        header("Location: ../view/login.php");
    }

    if ($action == 'update') {
        $old_user_name = $_POST['old_user_name'];
        $new_user_name = $_POST['user_name'];
        $new_emp_name = $_POST['emp_name'];
        $new_contact_no = $_POST['contact_no'];
        $new_password = $_POST['password'];

        $conn = get_connection();
        $sql = "UPDATE employee SET 
                    user_name = '$new_user_name', 
                    emp_name = '$new_emp_name', 
                    contact_no = '$new_contact_no', 
                    password = '$new_password' 
                WHERE user_name = '$old_user_name'";
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            header("Location: ../view/empList.php?message=updated");
        } else {
            mysqli_close($conn);
            echo "Failed to update author information.";
        }
    }
}
?>
