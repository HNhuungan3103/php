<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form LỚP HỌC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container">
        <h2 align="center">QUẢN LÝ THÔNG TIN SINH VIÊN</h2>
        <form action="xuly_themsinhvien.php" method="post">

            <div class="form-group">
                <label for="masv">Mã Sinh Viên:</label>
                <input type="text" class="form-control" id="masv" placeholder="Nhập mã sinh viên" name="txtsv" required>
            </div>

            <div class="form-group">
                <label for="holot">Họ lót:</label>
                <input type="text" class="form-control" id="holot" placeholder="Nhập họ lót" name="txtholot" required>
            </div>

            <div class="form-group">
                <label for="tensv">Tên sinh viên:</label>
                <input type="text" class="form-control" id="tensv" placeholder="Nhập tên sinh viên" name="txtten"
                    required>
            </div>

            <div class="form-group">
                <label for="ngaysinh">Ngày sinh:</label>
                <input type="text" class="form-control" id="ngaysinh" name="txtns" required>
            </div>

            <div class="form-group">
                <label for="gioitinh">Giới tính:</label>
                <select class="form-control" id="gioitinh" name="txtgt" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>

            <div class="form-group">
                <label for="malop">Mã lớp:</label>
                <select class="form-control" id="malop" name="txtmalop" required>
                    <option value="">Chọn mã lớp</option>
                    <?php
                include_once("connect.php");

                // Lấy danh sách lớp học từ cơ sở dữ liệu
                $sql = "SELECT maLop FROM lophoc";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Xuất danh sách mã lớp
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['maLop']) . "'>" . htmlspecialchars($row['maLop']) . "</option>";
                    }
                } else {
                    echo "<option value=''>Không có lớp học nào. Vui lòng thêm lớp học trước.</option>";
                }

                // Đóng kết nối
                $conn->close();
                ?>
                </select>
            </div>
            <div class="d-flex mb-3">
                <button type="submit" class="btn btn-primary">Thêm mới</button> &nbsp;&nbsp;&nbsp;&nbsp;
        </form>


        <form action="form_lop.php" method="get">
            <button type="submit" class="btn btn-primary">Thêm lớp mới</button>
        </form>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <form action="sinhvien.php" method="get">
            <button type="submit" class="btn btn-primary">Xem thông tin sinh viên</button>
        </form>
    </div>
    </div>

</body>

</html>