<?php
require_once '../config/db.php';
require_once '../includes/session.php';

$issue_id = $_POST['issue_id'];
$action = $_POST['action'];

if ($action === 'accept') {
    $status = 'accepted';
} else {
    $status = 'rejected';
}

$stmt = $conn->prepare("UPDATE issues SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $issue_id);
$stmt->execute();

header("Location: ../dashboard/senior.php");
exit();
?>
