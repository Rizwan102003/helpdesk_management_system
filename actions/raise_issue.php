<?php
require_once '../config/db.php';
require_once '../includes/session.php';

$employee_id = $_SESSION['employee_id'];
$description = $_POST['issue'];

$stmt = $conn->prepare("SELECT senior_id FROM users WHERE employee_id = ?");
$stmt->bind_param("s", $employee_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$senior_id = $row['senior_id'] ?? null;

if ($senior_id) {
    $stmt = $conn->prepare("INSERT INTO issues (raised_by, description, status, senior_id) VALUES (?, ?, 'unseen', ?)");
    $stmt->bind_param("sss", $employee_id, $description, $senior_id);
    $stmt->execute();
}

header("Location: ../dashboard/employee.php");
exit();
?>
