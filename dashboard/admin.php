<?php
require_once '../includes/session.php';
require_once '../config/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome, Admin</h2>
    <h3>Issues Accepted by Seniors:</h3>
    <ul>
        <?php
        $sql = "SELECT * FROM issues WHERE status = 'accepted'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<li><strong>Employee:</strong> {$row['raised_by']}<br>
                <strong>Description:</strong> {$row['description']}<br>
                <form method='POST' action='../scripts/admin_action.php'>
                    <input type='hidden' name='issue_id' value='{$row['id']}'>
                    <label for='message'>Message:</label>
                    <input type='text' name='message' required><br>
                    <label for='status'>Set Status:</label>
                    <select name='status'>
                        <option value='working'>Working</option>
                        <option value='solved'>Solved</option>
                    </select>
                    <button type='submit'>Submit</button>
                </form></li><br>";
        }
        ?>
    </ul>
</body>
</html>
