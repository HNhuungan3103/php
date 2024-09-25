<?php
    // Kết nối tới cơ sở dữ liệu
    include_once("connect.php");
    
    // Kiểm tra xem có tham số "ma" trong URL không
    if (isset($_GET["ma"])) {
        $maLop = $_GET["ma"];
        
        // Lấy thông tin lớp học từ cơ sở dữ liệu
        $sql = "SELECT * FROM lophoc WHERE maLop = '$maLop'";
        $result = $conn->query($sql);
        
        // Kiểm tra xem có kết quả nào được trả về không
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

    // Khi người dùng gửi form (POST request)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $maLopMoi = $_POST["maLop"]; // Lấy mã lớp mới từ form
        $tenLopMoi = $_POST["tenLop"]; // Lấy tên lớp mới từ form
        
        // Cập nhật thông tin lớp học trong cơ sở dữ liệu
        $sql = "UPDATE lophoc SET maLop='$maLopMoi', tenLop='$tenLopMoi' WHERE maLop='$maLop'";
        
        // Kiểm tra xem việc cập nhật có thành công không
        if ($conn->query($sql) === TRUE) {
            echo "Cập nhật thành công!"; // Thông báo cập nhật thành công
            header("Location: lophoc.php"); // Chuyển hướng về trang lophoc.php sau khi cập nhật
            exit(); // Dừng thực thi sau khi chuyển hướng
        } else {
            echo "Lỗi khi cập nhật: " . $conn->error; // Thông báo lỗi nếu có
        }
    }

    $conn->close(); // Đóng kết nối tới cơ sở dữ liệu
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sửa Lớp Học</title>
    <meta charset="utf-8">
</head>

<body>
    <div class="container">
        <h2>Sửa Thông Tin Lớp Học</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="maLop">Mã Lớp:</label>
                <!-- Trường nhập cho mã lớp, sử dụng giá trị hiện tại -->
                <input type="text" class="form-control" id="maLop" name="maLop" value="<?php echo $maLop; ?>">
            </div>
            <div class="form-group">
                <label for="tenLop">Tên Lớp:</label>
                <!-- Trường nhập cho tên lớp, sử dụng giá trị hiện tại -->
                <input type="text" class="form-control" id="tenLop" name="tenLop" value="<?php echo $tenLop; ?>">
            </div>
            <!-- Nút gửi form -->
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
</body>

</html>