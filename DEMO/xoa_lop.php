<?php
// Kết nối cơ sở dữ liệu
include_once("connect.php");

// Kiểm tra mã lớp từ URL
if (isset($_GET['ma'])) {
    $maLop = $_GET['ma'];

    // Xóa các sinh viên liên quan đến mã lớp trước
    $sqlDeleteSinhVien = "DELETE FROM sinhvien WHERE maLop = '$maLop'";
    $conn->query($sqlDeleteSinhVien);

    // Xóa lớp học
    $sqlDeleteLop = "DELETE FROM lophoc WHERE maLop = '$maLop'";
    
    if ($conn->query($sqlDeleteLop) === TRUE) {
        // Chuyển hướng sau khi xóa thành công
        header("Location: lophoc.php");
        exit();
    } else {
        echo "Lỗi khi xóa lớp: " . $conn->error;
    }
} else {
    echo "Không có mã lớp được truyền.";
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>