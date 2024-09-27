<!DOCTYPE html>
<html lang="en">

<head>
    <title>SỬA THÔNG TIN SINH VIÊN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>SỬA THÔNG TIN SINH VIÊN</h2>

        <?php
        include_once("connect.php");

        // Kiểm tra xem mã sinh viên đã được truyền qua URL chưa
        if (isset($_GET["ma"])) {
            $maSV = $_GET["ma"];

            // Lấy thông tin sinh viên từ cơ sở dữ liệu
            $sql = "SELECT * FROM sinhvien WHERE maSV = '$maSV'";
            $result = $conn->query($sql);

            // Kiểm tra xem sinh viên có tồn tại không
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc(); // Lấy thông tin sinh viên
            } else {
                echo "<div class='alert alert-danger'>Không tìm thấy sinh viên.</div>";
                exit();
            }
        } else {
            echo "<div class='alert alert-danger'>Không có mã sinh viên.</div>";
            exit();
        }

        // Xử lý khi người dùng gửi thông tin chỉnh sửa
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hoLot = $_POST["hoLot"];
            $tenSV = $_POST["tenSV"];
            $ngaySinh = $_POST["ngaySinh"];
            $gioiTinh = $_POST["gioiTinh"];
            $maLop = $_POST["maLop"];

            // Cập nhật thông tin sinh viên
            $sqlUpdate = "UPDATE sinhvien SET hoLot='$hoLot', tenSV='$tenSV', ngaySinh='$ngaySinh', gioiTinh='$gioiTinh', maLop='$maLop' WHERE maSV='$maSV'";
            
            if ($conn->query($sqlUpdate) === TRUE) {
                echo "<div class='alert alert-success'>Cập nhật thành công!</div>";
                header("Location: sinhvien.php"); // Chuyển hướng về trang sinh viên
                exit();
            } else {
                echo "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
            }
        }

        ?>

        <form method="post" action="">
            <div class="form-group">
                <label for="hoLot">Họ Lót:</label>
                <input type="text" class="form-control" id="hoLot" name="hoLot"
                    value="<?php echo htmlspecialchars($row['hoLot']); ?>" required>
            </div>
            <div class="form-group">
                <label for="tenSV">Tên Sinh Viên:</label>
                <input type="text" class="form-control" id="tenSV" name="tenSV"
                    value="<?php echo htmlspecialchars($row['tenSV']); ?>" required>
            </div>
            <div class="form-group">
                <label for="ngaySinh">Ngày Sinh:</label>
                <input type="text" class="form-control" id="ngaySinh" name="ngaySinh"
                    value="<?php echo htmlspecialchars($row['ngaySinh']); ?>" required>
            </div>
            <div class="form-group">
                <label for="gioiTinh">Giới Tính:</label>
                <select class="form-control" id="gioiTinh" name="gioiTinh" required>
                    <option value="Nam" <?php if ($row['gioiTinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                    <option value="Nữ" <?php if ($row['gioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="maLop">Mã Lớp:</label>
                <input type="text" class="form-control" id="maLop" name="maLop"
                    value="<?php echo htmlspecialchars($row['maLop']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="sinhvien.php" class="btn btn-secondary">Hủy</a>
        </form>

    </div>

</body>

</html>