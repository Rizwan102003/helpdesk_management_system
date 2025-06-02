<?php
require_once '../includes/session.php';
require_once '../config/db.php';
$senior_id = $_SESSION['employee_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Senior Dashboard</title>
</head>
<body>
    <h2>Welcome, Senior: <?php echo $senior_id; ?></h2>
    <h3>Issues from Employees under you:</h3>
    <ul>
        <?php
        $sql = "SELECT * FROM issues WHERE senior_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $senior_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $message = isset($row['admin_message']) ? $row['admin_message'] : 'No message';
            echo "<li><strong>Employee:</strong> {$row['raised_by']}<br>
                <strong>Description:</strong> {$row['description']}<br>
                <strong>Status:</strong> {$row['status']}<br>
                <strong>Admin Message:</strong> {$message}<br>
                <form method='POST' action='../scripts/senior_action.php'>
                    <input type='hidden' name='issue_id' value='{$row['id']}'>
                    <button name='action' value='accept'>Accept</button>
                    <button name='action' value='reject'>Reject</button>
                </form></li><br>";
        }
        ?>
    </ul>
</body>
</html>