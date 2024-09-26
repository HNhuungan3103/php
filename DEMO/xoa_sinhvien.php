<?php
// Kết nối cơ sở dữ liệu
include_once("connect.php");

// Kiểm tra xem mã sinh viên có được truyền qua URL không
if (isset($_GET['ma'])) {
    $maSV = $_GET['ma'];

    // Câu lệnh SQL để xóa sinh viên dựa trên mã sinh viên
    $sql = "DELETE FROM sinhvien WHERE maSV = '$maSV'";

    // Kiểm tra và thực thi câu lệnh
    if ($conn->query($sql) === TRUE) {
        // Xóa thành công, chuyển hướng về trang quản lý sinh viên
        header("Location: sinhvien.php");
        exit(); // Ngừng thực thi sau khi chuyển hướng
    } else {
        // Thông báo lỗi nếu việc xóa thất bại
        echo "Lỗi khi xóa sinh viên: " . $conn->error;
    }
} else {
    // Thông báo nếu không có mã sinh viên được truyền
    echo "Không có mã sinh viên được truyền!";
}

// Đóng kết nối
$conn->close();
?>