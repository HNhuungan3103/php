<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form LỚP HỌC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 50%;
        margin: 50px auto;
        background-color: #fff;
        padding: 50px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
        color: #333;
    }

    input[type="text"] {
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

    }

    .btn:hover {
        background-color: #0056b3;
    }

    .d-flex {
        display: flex;
        justify-content: space-between;
    }

    .mb-3 {
        margin-bottom: 15px;
    }
    </style>
</head>

<body>

    <div class="container">
        <h2>QUẢN LÝ THÔNG TIN LỚP HỌC</h2>
        <form action="xuly_themlop.php" method="post">

            <div class="form-group">
                <label for="malop">Mã lớp:</label>
                <input type="text" id="malop" placeholder="Nhập mã lớp" name="txtMa">
            </div>

            <div class="form-group">
                <label for="tenlop">Tên lớp:</label>
                <input type="text" id="tenlop" placeholder="Nhập tên lớp" name="txtTen">
            </div>
            <div class="d-flex mb-3">
                <button type="submit" class="btn">Thêm mới</button>
        </form>&nbsp;&nbsp;&nbsp;&nbsp;

        <form action="lophoc.php" method="post">
            <button type="submit" class="btn">Xem thông tin lớp</button>
        </form>
    </div>
    </div>

</body>

</html>