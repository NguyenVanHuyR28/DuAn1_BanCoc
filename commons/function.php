<?php

// Kết nối CSDL qua PDO
function connectDB()
{
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}
function uploadFile($file, $folderUpload)
{
    // Kiểm tra lỗi tải lên tệp
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null; // Trả về null nếu có lỗi trong quá trình tải lên
    }

    // Kiểm tra loại tệp và kích thước (bạn có thể thêm điều kiện tùy theo yêu cầu)
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        return null; // Trả về null nếu loại tệp không hợp lệ
    }

    if ($file['size'] > 5 * 1024 * 1024) { // Giới hạn kích thước tệp tối đa là 5MB
        return null; // Trả về null nếu kích thước tệp quá lớn
    }

    // Đường dẫn lưu trữ tệp
    $pathStorage = $folderUpload . time() . '_' . basename($file['name']);
    $from = $file['tmp_name']; // Đường dẫn tạm thời của tệp
    $to = PATH_ROOT . $pathStorage; // Đường dẫn đích để lưu trữ tệp

    // Di chuyển tệp từ đường dẫn tạm thời đến đích
    if (move_uploaded_file($from, $to)) {
        return $pathStorage; // Trả về đường dẫn lưu trữ tệp
    }

    return null; // Trả về null nếu tải lên thất bại
}
//Xóa file

function deleteFile($file)
{
    $pathDelete = PATH_ROOT . $file;
    if (file_exists($pathDelete)) {
        unlink($pathDelete);
    }
}

// xóa session sau khi load trang 
function deleteSessionError()
{
    if (isset($_SESSION['flash'])) {
        //Hủy session sau khi đã tải trang
        unset($_SESSION['flash']);
        unset($_SESSION['error']);
        unset($_SESSION['success']);
        // session_unset();


    }
}
// upload - update album ảnh

function uploadFileAlbum($file, $folderUpload, $key)
{
    $pathStorage = $folderUpload . time() . $file['name'][$key];

    $from = $file['tmp_name'][$key];
    $to = PATH_ROOT . $pathStorage;

    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    }
    return null;
}
function formatDate($date)
{
    return date("d-m-Y", strtotime($date));
}

function checkLoginAdmin()
{
    if (!isset($_SESSION['user_admin'])) {
        // header("Location: ".BASE_URL_ADMIN.'login-admin');
        exit();
    }
}

function formatPrice($price)
{
    return number_format($price, 0, ',', '.');
}
