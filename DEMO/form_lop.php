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
        <h2 align="center">QUẢN LÝ THÔNG TIN LỚP HỌC</h2>
        <form action="xuly_themlop.php" method="post">

            <div class="form-group">
                <label for="malop">Mã lớp:</label>
                <input type="text" class="form-control" id="malop" placeholder="Nhập mã lớp" name="txtMa">
            </div>

            <div class="form-group">
                <label for="tenlop">Tên lớp:</label>
                <input type="text" class="form-control" id="tenlop" placeholder="Nhập tên lớp" name="txtTen">
            </div>


            <div class="d-flex mb-3">
                <button type="submit" class="btn btn-primary">Thêm mới</button>
        </form>&nbsp;&nbsp;&nbsp;&nbsp;

        <form action="lophoc.php" method="post">
            <button type="submit" class="btn btn-primary">Xem thông tin lớp</button>
        </form>
    </div>
    </div>

</body>

</html>