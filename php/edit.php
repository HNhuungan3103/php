<?php
// Kết nối với cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "image_uploads_db";
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý cập nhật sản phẩm khi form được submit
if (isset($_POST['update'])) {
    $file_id = $_POST['file_id'];  // ID của sản phẩm cần cập nhật
    $new_name = $_POST['name'];  // Tên sản phẩm mới
    $new_file = $_FILES['fileanh'];  // File ảnh mới

    // Xử lý ảnh mới
    $target_dir = "uploads/";  // Thư mục lưu trữ ảnh
    $uploadOk = 1;  // Biến để xác định trạng thái tải lên
    $allowedTypes = array("jpg", "png", "jpeg", "gif", "pdf");  // Các định dạng file được phép
    $file_basename = basename($new_file["name"]);
    $target_file = $target_dir . uniqid() . "_" . $file_basename;  // Tạo tên file duy nhất

    if ($new_file["error"] == UPLOAD_ERR_OK) {  // Kiểm tra xem không có lỗi khi tải lên
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));  // Lấy định dạng file

        // Kiểm tra định dạng file
        if (!in_array($fileType, $allowedTypes)) {
            echo "Chỉ cho phép các định dạng JPG, JPEG, PNG, GIF, PDF.<br>";
            $uploadOk = 0;  // Đánh dấu là không hợp lệ
        }

        // Kiểm tra kích thước file (giới hạn 5MB)
        if ($new_file["size"] > 5000000) {
            echo "Kích thước file quá lớn.<br>";
            $uploadOk = 0;  // Đánh dấu là không hợp lệ
        }

        // Nếu tất cả các kiểm tra đều ổn, tiến hành upload
        if ($uploadOk == 1) {
            if (move_uploaded_file($new_file["tmp_name"], $target_file)) {
                // Xóa ảnh cũ nếu có
                $sql = "SELECT file_path FROM images WHERE file_id = '$file_id'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $file_path = $row['file_path'];
                    if (file_exists($file_path)) {
                        unlink($file_path);  // Xóa file cũ trên server
                    }
                }

                // Cập nhật thông tin sản phẩm và đường dẫn mới
                $sql = "UPDATE images SET file_name='$new_name', file_path='$target_file' WHERE file_id='$file_id'";
                if ($conn->query($sql) === TRUE) {
                    echo "Cập nhật thành công!<br>";
                } else {
                    echo "Lỗi: " . $conn->error;  // Hiển thị lỗi nếu có
                }
            } else {
                echo "Có lỗi xảy ra khi tải file.<br>";
            }
        }
    } else {
        // Nếu không có ảnh mới, chỉ cập nhật tên sản phẩm
        $sql = "UPDATE images SET file_name='$new_name' WHERE file_id='$file_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Cập nhật thành công!<br>";
        } else {
            echo "Lỗi: " . $conn->error;  // Hiển thị lỗi nếu có
        }
    }
}

// Xử lý xóa ảnh
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];  // ID của ảnh cần xóa
    
    // Lấy thông tin ảnh trước khi xóa
    $sql = "SELECT file_path FROM images WHERE file_id = '$delete_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = $row['file_path'];
        if (file_exists($file_path)) {
            unlink($file_path);  // Xóa file trên server
        }

        // Xóa thông tin ảnh trong cơ sở dữ liệu
        $sql = "DELETE FROM images WHERE file_id = '$delete_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Xóa ảnh thành công!<br>";
        } else {
            echo "Lỗi: " . $conn->error;  // Hiển thị lỗi nếu có
        }
    } else {
        echo "Không tìm thấy ảnh để xóa.";  // Thông báo nếu không tìm thấy ảnh
    }
}

// Xử lý thêm ảnh mới
if (isset($_POST['add'])) {
    $new_name = $_POST['name'];  // Tên sản phẩm mới
    $new_file = $_FILES['fileanh'];  // File ảnh mới

    // Xử lý ảnh mới
    $target_dir = "uploads/";  // Thư mục lưu trữ ảnh
    $uploadOk = 1;  // Biến để xác định trạng thái tải lên
    $allowedTypes = array("jpg", "png", "jpeg", "gif", "pdf");  // Các định dạng file được phép
    $file_basename = basename($new_file["name"]);
    $target_file = $target_dir . uniqid() . "_" . $file_basename;  // Tạo tên file duy nhất

    if ($new_file["error"] == UPLOAD_ERR_OK) {  // Kiểm tra xem không có lỗi khi tải lên
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));  // Lấy định dạng file

        // Kiểm tra định dạng file
        if (!in_array($fileType, $allowedTypes)) {
            echo "Chỉ cho phép các định dạng JPG, JPEG, PNG, GIF, PDF.<br>";
            $uploadOk = 0;  // Đánh dấu là không hợp lệ
        }

        // Kiểm tra kích thước file (giới hạn 5MB)
        if ($new_file["size"] > 5000000) {
            echo "Kích thước file quá lớn.<br>";
            $uploadOk = 0;  // Đánh dấu là không hợp lệ
        }

        // Nếu tất cả các kiểm tra đều ổn, tiến hành upload
        if ($uploadOk == 1) {
            if (move_uploaded_file($new_file["tmp_name"], $target_file)) {
                // Thêm thông tin sản phẩm và đường dẫn mới vào cơ sở dữ liệu
                $sql = "INSERT INTO images (file_name, file_path) VALUES ('$new_name', '$target_file')";
                if ($conn->query($sql) === TRUE) {
                    echo "Thêm ảnh thành công!<br>";
                } else {
                    echo "Lỗi: " . $conn->error;  // Hiển thị lỗi nếu có
                }
            } else {
                echo "Có lỗi xảy ra khi tải file.<br>";
            }
        }
    }
}

// Lấy thông tin sản phẩm cần chỉnh sửa
if (isset($_GET['file_id'])) {
    $file_id = $_GET['file_id'];  // ID của sản phẩm
    $sql = "SELECT * FROM images WHERE file_id = '$file_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();  // Lấy thông tin sản phẩm
        $file_name = $row['file_name'];  // Tên sản phẩm
        $file_path = $row['file_path'];  // Đường dẫn ảnh
    } else {
        echo "Không tìm thấy sản phẩm.";  // Thông báo nếu không tìm thấy
        exit;
    }
}

// Lấy 4 ảnh gần nhất đã tải lên
$sql = "SELECT * FROM images ORDER BY file_id DESC LIMIT 4";  // Lấy 4 ảnh mới nhất
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
    <style>
    .image-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        /* Khoảng cách giữa các ảnh */
    }

    .image-container div {
        flex: 1 1 calc(25% - 20px);
        /* Mỗi ảnh chiếm 25% chiều rộng của container, trừ khoảng cách */
        box-sizing: border-box;
    }

    .image-container img {
        width: 100%;
        /* Đảm bảo ảnh chiếm toàn bộ chiều rộng của div */
        height: auto;
        display: block;
    }

    .image-info {
        text-align: center;
        margin-top: 10px;
    }

    .image-actions {
        margin-top: 10px;
        text-align: center;
    }
    </style>
</head>

<body>

    <!-- Form thêm ảnh mới -->
    <h2>Thêm ảnh mới</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        Tên sản phẩm: <input type="text" name="name" required><br><br>
        Chọn ảnh: <input type="file" name="fileanh" required><br><br>
        <input type="submit" name="add" value="Thêm">
    </form>

    <!-- Form chỉnh sửa ảnh -->
    <?php if (isset($_GET['file_id'])): ?>
    <h2>Chỉnh sửa sản phẩm</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="file_id" value="<?php echo htmlspecialchars($file_id); ?>"> <!-- Ẩn ID sản phẩm -->
        Tên sản phẩm: <input type="text" name="name" value="<?php echo htmlspecialchars($file_name); ?>"><br><br>
        Chọn ảnh mới: <input type="file" name="fileanh"><br><br>
        <input type="submit" name="update" value="Lưu">
    </form>
    <?php endif; ?>

    <!-- Hiển thị ảnh gần nhất đã tải lên -->
    <div class="image-container">
        <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <div>
            <img src="<?php echo $row['file_path']; ?>" alt="<?php echo htmlspecialchars($row['file_name']); ?>">
            <div class="image-info">
                Tên sản phẩm: <?php echo htmlspecialchars($row['file_name']); ?><br>
                <a href="?file_id=<?php echo $row['file_id']; ?>">Chỉnh sửa</a>
            </div>
            <div class="image-actions">
                <a href="?delete_id=<?php echo $row['file_id']; ?>"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa ảnh này?');">Xóa</a>
            </div>
        </div>
        <?php endwhile; ?>
        <?php else: ?>
        <p>Không có ảnh nào được tải lên.</p>
        <?php endif; ?>
    </div>
</body>

</html>

<?php $conn->close(); ?> // Đóng kết nối cơ sở dữ liệu