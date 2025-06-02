<?php
require_once '../config/db.php';

function getUserNameById($employee_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT name FROM users WHERE employee_id = ?");
    $stmt->bind_param("s", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row['name'];
    }
    return "Unknown";
}

function getRole($employee_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT role FROM users WHERE employee_id = ?");
    $stmt->bind_param("s", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row['role'];
    }
    return null;
}

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}
?>
