<?php
// Kết nối cơ sở dữ liệu
include_once("connect.php");

// Kiểm tra xem mã lớp có được truyền qua URL không
if (isset($_GET['ma'])) {
    $maLop = $_GET['ma'];

    // Kiểm tra xem lớp có sinh viên nào đang thuộc lớp này không
    $sqlCheckSinhVien = "SELECT COUNT(*) AS total FROM sinhvien WHERE maLop = '$maLop'";
    $result = $conn->query($sqlCheckSinhVien);
    $row = $result->fetch_assoc();

    if ($row['total'] > 0) {
        // Nếu có sinh viên trong lớp, không cho phép xóa
        echo "Không thể xóa lớp vì vẫn còn sinh viên đang học lớp này!";
    } else {
        // Câu lệnh SQL để xóa lớp dựa trên mã lớp
        $sql = "DELETE FROM lophoc WHERE maLop = '$maLop'";

        // Kiểm tra và thực thi câu lệnh
        if ($conn->query($sql) === TRUE) {
            // Xóa thành công, chuyển hướng về trang quản lý lớp học
            header("Location: lophoc.php");
            exit(); // Ngừng thực thi sau khi chuyển hướng
        } else {
            // Thông báo lỗi nếu việc xóa thất bại
            echo "Lỗi khi xóa lớp học: " . $conn->error;
        }
    }
} else {
    // Thông báo nếu không có mã lớp được truyền
    echo "Không có mã lớp được truyền!";
}

// Đóng kết nối
$conn->close();
?>