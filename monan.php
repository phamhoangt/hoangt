<!DOCTYPE html>  
<html lang="vi">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    
    <link rel="stylesheet" type="text/css" href="css/css.css"> <!-- Liên kết đến CSS -->  
    
</head> 
<body> 

<?php
// Display list of dishes
include 'connect/connet.php';

$sql = "SELECT MonAn.MonAnID, MonAn.TenMon, MonAn.MoTa, LoaiMonAn.TenLoai, MonAn.VungMien
        FROM MonAn
        JOIN LoaiMonAn ON MonAn.LoaiID = LoaiMonAn.LoaiID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Danh sách món ăn</h1>";
    echo "<table border='1'>
            <tr>
                <th>Tên món</th>
                <th>Mô tả</th>
                <th>Loại món</th>
                <th>Vùng miền</th>
                <th>Chi tiết</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>";
    echo "<a href='them.php?LoaiID' class='add-button'>Thêm</a>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['TenMon'] . "</td>
                <td>" . $row['MoTa'] . "</td>
                <td>" . $row['TenLoai'] . "</td>
                <td>" . $row['VungMien'] . "</td>
                <td><a href='chitiet.php?MonAnID=" . $row['MonAnID']  . "'>Xem chi tiết</a></td>
                <td><a href='sua.php?MonAnID=" . $row['MonAnID'] . "'>Sửa</a></td>   
                <td><a href='xoa.php?MonAnID=" . $row['MonAnID'] . "' onclick=\"return confirm('Bạn có chắc chắn muốn xóa món ăn này?');\">Xóa</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Không có món ăn nào.";
}

$conn->close();
?>
<body>
</html> 
    
    
