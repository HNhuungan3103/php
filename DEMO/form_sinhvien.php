<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form LỚP HỌC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;

        margin: 0;
        padding: 0;
    }

    .container {
        width: 60%;

        margin: 50px auto;

        background-color: #fff;

        padding: 20px;

        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        border-radius: 8px;

    }

    h2 {
        text-align: center;

        color: #333;

    }

    .form-group {
        margin-bottom: 15px;
        /* Khoảng cách giữa các nhóm form */
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
        color: #333;

    }

    input[type="text"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;

    }

    .btn {
        padding: 10px 15px;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        color: #fff;
        cursor: pointer;

    }

    .btn:hover {
        background-color: #0056b3;

    }

    .d-flex {
        display: flex;
        /* Dùng flexbox để canh các nút */
    }

    .mb-3 {
        margin-bottom: 15px;
        /* Khoảng cách dưới các nút */
    }
    </style>
</head>

<body>

    <!-- Container chính chứa form -->
    <div class="container">
        <h2>QUẢN LÝ THÔNG TIN SINH VIÊN</h2>

        <!-- Form thêm sinh viên -->
        <form action="xuly_themsinhvien.php" method="post">
            <!-- Nhập mã sinh viên -->
            <div class="form-group">
                <label for="masv">Mã Sinh Viên:</label>
                <input type="text" id="masv" placeholder="Nhập mã sinh viên" name="txtsv" required>
            </div>

            <!-- Nhập họ lót -->
            <div class="form-group">
                <label for="holot">Họ lót:</label>
                <input type="text" id="holot" placeholder="Nhập họ lót" name="txtholot" required>
            </div>

            <!-- Nhập tên sinh viên -->
            <div class="form-group">
                <label for="tensv">Tên sinh viên:</label>
                <input type="text" id="tensv" placeholder="Nhập tên sinh viên" name="txtten" required>
            </div>

            <!-- Nhập ngày sinh -->
            <div class="form-group">
                <label for="ngaysinh">Ngày sinh:</label>
                <input type="text" id="ngaysinh" name="txtns" required>
            </div>

            <!-- Chọn giới tính -->
            <div class="form-group">
                <label for="gioitinh">Giới tính:</label>
                <select id="gioitinh" name="txtgt" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>

            <!-- Chọn mã lớp từ danh sách lớp học trong cơ sở dữ liệu -->
            <div class="form-group">
                <label for="malop">Mã lớp:</label>
                <select id="malop" name="txtmalop" required>
                    <option value="">Chọn mã lớp</option>
                    <?php
                    include_once("connect.php");

                    // Truy vấn danh sách lớp học
                    $sql = "SELECT maLop FROM lophoc";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Duyệt qua các kết quả và tạo các option
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlentities($row['maLop']) . "'>" . htmlentities($row['maLop']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>Không có lớp học nào. Vui lòng thêm lớp học trước.</option>";
                    }

                    $conn->close();
                    ?>
                </select>
            </div>

            <!-- Nút gửi form -->
            <div class="d-flex mb-3">
                <button type="submit" class="btn">Thêm mới</button> &nbsp;&nbsp;&nbsp;&nbsp;
        </form>

        <!-- Form thêm lớp mới -->
        <form action="form_lop.php" method="get">
            <button type="submit" class="btn">Thêm lớp mới</button>
        </form>

        &nbsp;&nbsp;&nbsp;&nbsp;

        <!-- Form xem thông tin sinh viên -->
        <form action="sinhvien.php" method="get">
            <button type="submit" class="btn">Xem thông tin sinh viên</button>
        </form>
    </div>
    </div>

</body>

</html>