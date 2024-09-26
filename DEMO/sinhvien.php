<!DOCTYPE html>
<html lang="en">

<head>
    <title>QUẢN LÝ THÔNG TIN SINH VIÊN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>QUẢN LÝ THÔNG TIN SINH VIÊN</h2>

        <a class="btn btn-primary mb-3" href="form_sinhvien.php">Thêm mới sinh viên</a>
        <a class="btn btn-primary mb-3" href="form_lop.php">Thêm mới lớp</a>

        <?php
        include_once("connect.php");

        // Viết câu truy vấn
        $sql = "SELECT * FROM sinhvien";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Tạo bảng để hiển thị dữ liệu
            echo "<table class='table table-hover mt-3'>";
            echo "
            <tr>
            <th>Mã Sinh Viên</th>
            <th>Họ Lót</th>
            <th>Tên Sinh Viên</th>
            <th>Ngày Sinh</th>
            <th>Giới Tính</th>
            <th>Mã Lớp</th>
            <th>Sửa</th>
            <th>Xóa</th>
            </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["maSV"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["hoLot"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["tenSV"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["ngaySinh"]) . "</td>"; // Hiển thị ngày sinh
                echo "<td>" . htmlspecialchars($row["gioiTinh"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["maLop"]) . "</td>";
                echo "<td><a class='btn btn-sm' href='sua_sinhvien.php?ma=" . htmlspecialchars($row['maSV']) . "'>Sửa</a></td>";
                echo "<td><a class='btn btn-sm' onclick='return confirm(\"Có thực sự muốn xóa không?\")' href='xoa_sinhvien.php?ma=" . htmlspecialchars($row['maSV']) . "'>Xóa</a></td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-info'>Không có sinh viên nào được tìm thấy.</div>";
        }

        // Đóng kết nối
        $conn->close();
        ?>
    </div>

</body>

</html>