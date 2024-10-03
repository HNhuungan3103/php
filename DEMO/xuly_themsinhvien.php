<?php
// Kết nối cơ sở dữ liệu
include_once("connect.php");

// Kiểm tra xem form đã được submit chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $maSV = isset($_POST['txtsv']) ? $_POST['txtsv'] : '';
    $hoLot = isset($_POST['txtholot']) ? $_POST['txtholot'] : '';
    $tenSV = isset($_POST['txtten']) ? $_POST['txtten'] : '';
    $ngaySinh = isset($_POST['txtns']) ? $_POST['txtns'] : '';
    $gioiTinh = isset($_POST['txtgt']) ? $_POST['txtgt'] : '';
    $maLop = isset($_POST['txtmalop']) ? $_POST['txtmalop'] : '';

    // Kiểm tra dữ liệu không được bỏ trống
    if (empty($maSV) || empty($hoLot) || empty($tenSV) || empty($ngaySinh) || empty($gioiTinh) || empty($maLop)) {
        echo "<div class='alert alert-danger'>Vui lòng điền đầy đủ thông tin!</div>";
        exit;
    }

    // Câu lệnh SQL để thêm sinh viên
    $sql = "INSERT INTO sinhvien (maSV, hoLot, tenSV, ngaySinh, gioiTinh, maLop) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Chuẩn bị câu truy vấn
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Liên kết các tham số với câu truy vấn
        $stmt->bind_param("ssssss", $maSV, $hoLot, $tenSV, $ngaySinh, $gioiTinh, $maLop);

        // Thực thi câu truy vấn
        if ($stmt->execute()) {
            // Chuyển hướng ngay tới trang sinhvien.php sau khi thêm thành công
            header("Location: sinhvien.php");
            exit; // Ngăn chặn việc thực thi tiếp mã sau khi chuyển hướng
        } else {
            //echo "<div class='alert alert-danger'>Lỗi: " . $stmt->error . "</div>";
            echo "<h2>Lỗi rồi trùng khóa quay lại ngây đi CHỊU!!</h2>";
        }

        // Đóng statement
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Lỗi chuẩn bị truy vấn: " . $conn->error . "</div>";

    
    }

    // Đóng kết nối
    $conn->close();
}
?>
<html>

<body>
    <button><a href="form_sinhvien.php"> Quay lại</a></button>
</body>

</html>