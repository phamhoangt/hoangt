<?php
include 'connect/connet.php';

if (isset($_GET['MonAnID'])) {
    $MonAnID = intval($_GET['MonAnID']); // Đảm bảo ID là số nguyên

    // Xóa món ăn dựa trên ID
    $sql = "DELETE FROM MonAn WHERE MonAnID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $MonAnID);

    if ($stmt->execute()) {
        echo "<p>Món ăn đã được xóa thành công.</p>";
        echo "<a href='monan.php'>Quay lại danh sách món ăn</a>";
    } else {
        echo "<p>Lỗi khi xóa món ăn: " . $conn->error . "</p>";
        echo "<a href='monan.php'>Quay lại danh sách món ăn</a>";
    }

    $stmt->close();
} else {
    echo "<p>ID món ăn không hợp lệ.</p>";
    echo "<a href='monan.php'>Quay lại danh sách món ăn</a>";
}

$conn->close();
?>
