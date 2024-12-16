<?php
include 'connect/connet.php';

if (isset($_GET['MonAnID'])) {
    $MonAnID = intval($_GET['MonAnID']); // Đảm bảo ID hợp lệ

    // Lấy thông tin món ăn từ cơ sở dữ liệu
    $sql = "SELECT * FROM MonAn WHERE MonAnID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $MonAnID);
    $stmt->execute();
    $result = $stmt->get_result();
    $monAn = $result->fetch_assoc();

    if ($monAn) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $TenMon = $_POST['TenMon'];
            $MoTa = $_POST['MoTa'];
            $LoaiID = intval($_POST['LoaiID']);
            $VungMien = $_POST['VungMien'];

            // Cập nhật thông tin món ăn
            $updateSQL = "UPDATE MonAn SET TenMon = ?, MoTa = ?, LoaiID = ?, VungMien = ? WHERE MonAnID = ?";
            $updateStmt = $conn->prepare($updateSQL);
            $updateStmt->bind_param("ssisi", $TenMon, $MoTa, $LoaiID, $VungMien, $MonAnID);

            if ($updateStmt->execute()) {
                echo "<p>Món ăn đã được cập nhật thành công.</p>";
                echo "<a href='list.php'>Quay lại danh sách món ăn</a>";
            } else {
                echo "<p>Lỗi khi cập nhật: " . $conn->error . "</p>";
            }

            $updateStmt->close();
        } else {
            // Hiển thị form chỉnh sửa
            echo "<h1>Sửa món ăn</h1>";
            echo "<form method='POST'>
                    <label for='TenMon'>Tên món:</label><br>
                    <input type='text' id='TenMon' name='TenMon' value='" . htmlspecialchars($monAn['TenMon']) . "' required><br><br>

                    <label for='MoTa'>Mô tả:</label><br>
                    <textarea id='MoTa' name='MoTa' required>" . htmlspecialchars($monAn['MoTa']) . "</textarea><br><br>

                    <label for='LoaiID'>Loại món:</label><br>
                    <select id='LoaiID' name='LoaiID' required>
                        <option value='1' " . ($monAn['LoaiID'] == 1 ? "selected" : "") . ">Loại 1</option>
                        <option value='2' " . ($monAn['LoaiID'] == 2 ? "selected" : "") . ">Loại 2</option>
                        <option value='3' " . ($monAn['LoaiID'] == 3 ? "selected" : "") . ">Loại 3</option>
                    </select><br><br>

                    <label for='VungMien'>Vùng miền:</label><br>
                    <input type='text' id='VungMien' name='VungMien' value='" . htmlspecialchars($monAn['VungMien']) . "' required><br><br>

                    <button type='submit'>Cập nhật</button>
                </form>";
        }
    } else {
        echo "<p>Món ăn không tồn tại.</p>";
        echo "<a href='monan.php'>Quay lại danh sách món ăn</a>";
    }

    $stmt->close();
} else {
    echo "<p>ID món ăn không hợp lệ.</p>";
    echo "<a href='monan.php'>Quay lại danh sách món ăn</a>";
}

$conn->close();
?>
