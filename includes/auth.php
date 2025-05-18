<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../index.php"); // Adjust path if needed
    exit;
}
?>
