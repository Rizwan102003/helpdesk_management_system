<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE employee_id = ?");
    $stmt->bind_param('s', $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
            $_SESSION['employee_id'] = $user['employee_id'];
            if (isset($user['role'])) {
                $_SESSION['role'] = $user['role'];
                switch ($user['role']) {
                    case 'employee':
                        header('Location: ../dashboard/employee.php');
                        break;
                    case 'senior':
                        header('Location: ../dashboard/senior.php');
                        break;
                    case 'admin':
                        header('Location: ../dashboard/admin.php');
                        break;
                }
                exit();
            } else {
                echo "<script>alert('Role not found for this user.'); window.location.href = '../public/index.html';</script>";
                exit();
            }
        }
    }
    echo "<script>alert('Invalid credentials'); window.location.href = '../public/index.html';</script>";
    exit();
}
?>