<!DOCTYPE html>  
<html lang="vi">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    
    <link rel="stylesheet" type="text/css" href="css/csschitiet.css"> <!-- Liên kết đến CSS -->  
    
</head> 
<body> 
<?php
include 'connect/connet.php';

if (isset($_GET['MonAnID'])) {
    $MonAnID = $_GET['MonAnID'];

    // Truy vấn chi tiết món ăn
    $sql = "SELECT MonAn.TenMon, MonAn.MoTa, MonAn.VungMien, LoaiMonAn.TenLoai
            FROM MonAn
            JOIN LoaiMonAn ON MonAn.LoaiID = LoaiMonAn.LoaiID
            WHERE MonAn.MonAnID = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $MonAnID);
    $stmt->execute();
    $result = $stmt->get_result();
    $monAn = $result->fetch_assoc();

    if ($monAn) {
        echo "<h1>Chi tiết món ăn: " . $monAn['TenMon'] . "</h1>";
        echo "<p><strong>Mô tả:</strong> " . $monAn['MoTa'] . "</p>";
        echo "<p><strong>Loại món:</strong> " . $monAn['TenLoai'] . "</p>";
        echo "<p><strong>Vùng miền:</strong> " . $monAn['VungMien'] . "</p>";

        // Truy vấn công thức món ăn
        $sql2 = "SELECT NguyenLieu.TenNguyenLieu, CongThuc.SoLuong, CongThuc.CachSuDung
                 FROM CongThuc
                 JOIN NguyenLieu ON CongThuc.NguyenLieuID = NguyenLieu.NguyenLieuID
                 WHERE CongThuc.MonAnID = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $MonAnID);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result2->num_rows > 0) {
            echo "<h2>Công thức:</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>Nguyên liệu</th>
                        <th>Số lượng</th>
                        <th>Cách sử dụng</th>
                    </tr>";
            while ($row = $result2->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['TenNguyenLieu'] . "</td>
                        <td>" . $row['SoLuong'] . "</td>
                        <td>" . $row['CachSuDung'] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Không có công thức cho món ăn này.</p>";
        }
    } else {
        echo "<p>Món ăn không tồn tại.</p>";
    }

    $stmt->close();
    $stmt2->close();
}

$conn->close();
?>
<body> 
<html>    
    
