<?php
$host = "sql301.infinityfree.com";
$user = "if0_39012557";
$pass = "e0wrIPwFVftE";
$dbname = "if0_39012557_yumrush";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
