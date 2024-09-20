<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        text-align: center;
    }

    .center {
        border: 4px solid rgb(0, 0, 0);
        background-color: aliceblue;
        text-align: center;

    }
    </style>
</head>

<body>
    <div class="center">
        <form action="xulyAnh.php" method="post" enctype="multipart/form-data">
            <h2>Thông Tin Sản Phẩm</h2>
            <b>ID sản phẩm:</b>
            <div class="id">
                <input type="number" name="id">
            </div>

            <b>Tên sản phẩm:</b>
            <div class="name">
                <input type="text" name="name">
            </div>


            <b>Chọn hình ảnh để upload lên:</b>
            <div class="khung2">
                <input type="file" name="fileanh[]" id="fileanh" multiple required><br><br>

            </div><br>
            <input type="submit" value="Upload File" name="submit">

        </form>
    </div>
</body>

</html>