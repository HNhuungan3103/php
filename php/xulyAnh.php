<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tải Lên Nhiều Ảnh</title>
    <style>
    body {
        text-align: center;
    }

    .image-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .image-container img {
        width: 300px;
        height: auto;
    }
    </style>
</head>

<body>
    <?php
    // Kết nối với cơ sở dữ liệu
    $servername = "localhost";  
    $username = "root";  
    $password = "";  
    $dbname = "upanh";  // Cơ sở dữ liệu tương ứng với bảng 'products'

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Kiểm tra xem có dữ liệu được gửi từ form không
    if (isset($_POST["submit"])) {
        $target_dir = "uploads/";  // Thư mục lưu trữ ảnh tải lên
        $uploadOk = 1;  // Biến để xác định trạng thái tải lên
        $allowedTypes = array("jpg", "png", "jpeg", "gif", "pdf");  // Các định dạng file được phép

        // Lấy thông tin từ form
        $product_name = $_POST['name'];  // Tên sản phẩm

        echo "Tên sản phẩm: " . htmlspecialchars($product_name) . "<br>";

        echo "<div class='image-container'>";  // Bắt đầu container ảnh

        // Lặp qua từng file người dùng tải lên
        foreach ($_FILES["fileanh"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {  // Kiểm tra xem không có lỗi khi tải lên
                $file_tmp_name = $_FILES["fileanh"]["tmp_name"][$key];  // Tên file tạm
                $file_basename = basename($_FILES["fileanh"]["name"][$key]);  // Tên file gốc
                $target_file = $target_dir . uniqid() . "_" . $file_basename;  // Tạo tên file duy nhất

                // Lấy định dạng file và kiểm tra
                $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Kiểm tra định dạng file
                if (!in_array($fileType, $allowedTypes)) {
                    echo "Chỉ cho phép các định dạng JPG, JPEG, PNG, GIF, PDF.<br>";
                    $uploadOk = 0;  // Đánh dấu là không hợp lệ
                }

                // Kiểm tra kích thước file (giới hạn 5MB)
                if ($_FILES["fileanh"]["size"][$key] > 5000000) { 
                    echo "Kích thước file quá lớn.<br>";
                    $uploadOk = 0;  // Đánh dấu là không hợp lệ
                }

                // Nếu tất cả các kiểm tra đều ổn, tiến hành upload
                if ($uploadOk == 1) {
                    if (move_uploaded_file($file_tmp_name, $target_file)) { 
                        // Lưu thông tin vào cơ sở dữ liệu
                        $sql = "INSERT INTO products (name, image) 
                                VALUES ('$product_name', '$target_file')";
                        
                        if ($conn->query($sql) === TRUE) {
                            echo "Dữ liệu đã được lưu thành công.<br> <br>";
                        } else {
                            echo "Lỗi: " . $sql . "<br>" . $conn->error;
                        }

                        // Hiển thị hình ảnh đã tải lên cùng nút sửa
                        echo "<div>";
                        echo "<img src='" . $target_file . "' alt='Uploaded image'>";  // Hiển thị ảnh
                        // Nút sửa, gửi id qua URL để xác định sản phẩm nào cần chỉnh sửa
                        echo "<a href='edit.php?id=" . $conn->insert_id . "'>Sửa</a>";  // Sử dụng ID sản phẩm vừa được chèn
                        echo "</div>";
                    } else {
                        echo "Có lỗi xảy ra khi tải file.<br>";
                    }
                }
            } else {
                echo "Vui lòng chọn một file hợp lệ.<br>";
            }
        }

        echo "</div>";  // Kết thúc container ảnh
    }

    // Đóng kết nối
    $conn->close();
    ?>
</body>

</html>