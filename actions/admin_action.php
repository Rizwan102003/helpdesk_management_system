<?php
require_once '../config/db.php';
require_once '../includes/session.php';

$issue_id = $_POST['issue_id'];
$message = $_POST['message'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE issues SET status = ?, admin_message = ? WHERE id = ?");
$stmt->bind_param("ssi", $status, $message, $issue_id);
$stmt->execute();

header("Location: ../dashboard/admin.php");
exit();
?>
