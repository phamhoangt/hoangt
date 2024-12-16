<!DOCTYPE html>  
<html lang="vi">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    
    <link rel="stylesheet" type="text/css" href="css/cssthem.css"> <!-- Liên kết đến CSS -->  
    
</head> 
<body> 
<?php
include 'connect/connet.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $TenMon = $_POST['TenMon'];
    $MoTa = $_POST['MoTa'];
    $LoaiID = $_POST['LoaiID'];
    $VungMien = $_POST['VungMien'];

    $sql = "INSERT INTO MonAn (TenMon, MoTa, LoaiID, VungMien) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $TenMon, $MoTa, $LoaiID, $VungMien);

    if ($stmt->execute()) {
        echo "Thêm món ăn thành công!";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<form method="post">
    <label for="TenMon">Tên món:</label>
    <input type="text" name="TenMon" required><br>

    <label for="MoTa">Mô tả:</label>
    <textarea name="MoTa" required></textarea><br>

    <label for="LoaiID">Loại món:</label>
    <select name="LoaiID">
        <option value="1">Món chính</option>
        <option value="2">Món khai vị</option>
        <option value="3">Món tráng miệng</option>
        <option value="4">Món ăn vặt</option>
    </select><br>

    <label for="VungMien">Vùng miền:</label>
    <select name="VungMien">
        <option value="Bắc">Bắc</option>
        <option value="Trung">Trung</option>
        <option value="Nam">Nam</option>
    </select><br>

    <button type="submit">Thêm món ăn</button>
</form>
<body>    
</html>     
