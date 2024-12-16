
-- Tạo bảng LoaiMonAn
CREATE TABLE LoaiMonAn (
    LoaiID INT AUTO_INCREMENT PRIMARY KEY,
    TenLoai VARCHAR(100) NOT NULL
);

-- Tạo bảng MonAn
CREATE TABLE MonAn (
    MonAnID INT AUTO_INCREMENT PRIMARY KEY,
    TenMon VARCHAR(200) NOT NULL,
    MoTa TEXT,
    LoaiID INT,
    VungMien ENUM('Bắc', 'Trung', 'Nam'),
    FOREIGN KEY (LoaiID) REFERENCES LoaiMonAn(LoaiID)
);

-- Tạo bảng NguyenLieu
CREATE TABLE NguyenLieu (
    NguyenLieuID INT AUTO_INCREMENT PRIMARY KEY,
    TenNguyenLieu VARCHAR(200) NOT NULL
);

-- Tạo bảng CongThuc
CREATE TABLE CongThuc (
    CongThucID INT AUTO_INCREMENT PRIMARY KEY,
    MonAnID INT,
    NguyenLieuID INT,
    SoLuong VARCHAR(100),
    CachSuDung TEXT,
    FOREIGN KEY (MonAnID) REFERENCES MonAn(MonAnID),
    FOREIGN KEY (NguyenLieuID) REFERENCES NguyenLieu(NguyenLieuID)
);

-- Thêm dữ liệu mẫu cho bảng LoaiMonAn
INSERT INTO LoaiMonAn (TenLoai) VALUES 
('Món chính'),
('Món khai vị'),
('Món tráng miệng'),
('Món ăn vặt');

-- Thêm dữ liệu mẫu cho bảng MonAn
INSERT INTO MonAn (TenMon, MoTa, LoaiID, VungMien) VALUES 
('Phở bò', 'Món phở truyền thống của Hà Nội', 1, 'Bắc'),
('Bánh xèo', 'Bánh chiên giòn, ăn kèm rau sống và nước chấm', 1, 'Nam'),
('Chè đậu xanh', 'Món tráng miệng ngọt, thanh mát', 3, 'Nam'),
('Nem rán', 'Món nem truyền thống, nhân thịt và rau củ', 2, 'Bắc');

-- Thêm dữ liệu mẫu cho bảng NguyenLieu
INSERT INTO NguyenLieu (TenNguyenLieu) VALUES 
('Thịt bò'),
('Bánh phở'),
('Hành lá'),
('Tôm'),
('Bột gạo'),
('Giá đỗ'),
('Đậu xanh'),
('Nước cốt dừa');

-- Thêm dữ liệu mẫu cho bảng CongThuc
INSERT INTO CongThuc (MonAnID, NguyenLieuID, SoLuong, CachSuDung) VALUES 
(1, 1, '300g', 'Thái lát, nấu trong nước dùng'),
(1, 2, '500g', 'Trụng chín'),
(1, 3, '50g', 'Thái nhỏ, rắc lên trên'),
(2, 4, '200g', 'Xào làm nhân'),
(2, 5, '400g', 'Pha bột làm bánh'),
(3, 7, '200g', 'Nấu chín mềm'),
(3, 8, '100ml', 'Rưới lên chè khi ăn');
