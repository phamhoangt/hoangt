<?php
// db_connect.php: Kết nối cơ sở dữ liệu
$host = "localhost";
$username = "root";
$password = "";
$database = "monan";

$conn = new mysqli($host, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
