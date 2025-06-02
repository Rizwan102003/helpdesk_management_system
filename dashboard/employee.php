<?php
require_once '../includes/session.php';
require_once '../config/db.php';
$employee_id = $_SESSION['employee_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
</head>
<body>
    <h2>Welcome, Employee: <?php echo $employee_id; ?></h2>
    <form method="POST" action="../scripts/raise_issue.php">
        <label for="issue">Describe your issue:</label><br>
        <textarea name="issue" required></textarea><br>
        <button type="submit">Raise Issue</button>
    </form>
    <hr>
    <h3>Your Issues:</h3>
    <ul>
        <?php
        $sql = "SELECT * FROM issues WHERE raised_by = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $employee_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $message = isset($row['admin_message']) ? $row['admin_message'] : 'No message';
            echo "<li><strong>Issue:</strong> {$row['description']}<br>
                <strong>Status:</strong> {$row['status']}<br>
                <strong>Message:</strong> {$message}</li><br>";
        }
        ?>
    </ul>
</body>
</html>