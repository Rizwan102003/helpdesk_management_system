<?php
session_start();

if (!isset($_SESSION['employee_id'])) {
    header('Location: /it-helpdesk-system/public/index.html');
    exit();
}
?>
