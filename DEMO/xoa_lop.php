<?php
// Kết nối tới cơ sở dữ liệu
include_once("connect.php");

// Kiểm tra nếu có mã lớp được truyền qua URL
if (isset($_GET["ma"])) {
    $maLop = $_GET["ma"];
    
    // Lấy thông tin lớp học từ cơ sở dữ liệu để hiển thị tên lớp
    $sql = "SELECT tenLop FROM lophoc WHERE maLop = '$maLop'";
    $result = $conn->query($sql);
    
    // Kiểm tra xem có lớp nào được tìm thấy không
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Lấy thông tin lớp học
        $tenLop = $row['tenLop']; // Lưu tên lớp vào biến
    } else {
        echo "Không tìm thấy lớp."; // Thông báo nếu không tìm thấy lớp
        exit; // Dừng thực thi nếu không tìm thấy lớp
    }
} else {
    echo "Không có mã lớp được truyền."; // Thông báo nếu không có mã lớp
    exit; // Dừng thực thi nếu không có mã
}

// Khi người dùng xác nhận xóa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Xóa các sinh viên liên quan đến mã lớp trước
    $sqlDeleteSinhVien = "DELETE FROM sinhvien WHERE maLop = '$maLop'";
    $conn->query($sqlDeleteSinhVien); // Thực thi câu lệnh xóa sinh viên

    // Câu truy vấn xóa lớp học
    $sql = "DELETE FROM lophoc WHERE maLop = '$maLop'";
    
    // Kiểm tra xem việc xóa có thành công không
    if ($conn->query($sql) === TRUE) {
        echo "Xóa thành công!"; // Thông báo xóa thành công
        header("Location: lophoc.php"); // Chuyển hướng về trang lophoc.php sau khi xóa
        exit(); // Dừng thực thi sau khi chuyển hướng
    } else {
        echo "Lỗi khi xóa: " . $conn->error; // Thông báo lỗi nếu có
    }
}

$conn->close(); // Đóng kết nối tới cơ sở dữ liệu
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Xóa Lớp Học</title>
    <meta charset="utf-8">
</head>

<body>
    <div class="container">
        <h2>Xác Nhận Xóa Lớp Học</h2>
        <p>-> Xóa lớp <strong>
                <?php echo $tenLop; ?>
            </strong><br>-> Mã lớp:

            <strong>
                <?php echo $maLop; ?>
            </strong>
        </p>
        <form method="post" action="">
            <!-- Nút xác nhận xóa lớp học -->
            <button type="submit" class="btn btn-danger">Xóa</button>&nbsp;&nbsp;&nbsp;
            <!-- Nút hủy và quay lại trang lophoc.php -->
            <a href="lophoc.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>

</html>