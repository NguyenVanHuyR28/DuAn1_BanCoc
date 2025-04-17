<?php
require_once './models/AdminDonHang.php';
require_once './models/AdminTaiKhoan.php';
class AdminTaiKhoanController
{
    public $modelTaiKhoan;
    public $modelSanPham;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
        $this->modelSanPham = new AdminSanPham();
        $this->modelDonHang = new AdminDonHang();
    }

    public function listTaiKhoan()
    {
        $listTaiKhoan = $this->modelTaiKhoan->getAllTaiKhoan();
        require_once './views/taikhoan/listTaiKhoan.php';
    }
    public function formEditTaiKhoan()
    {
        $id = $_GET['id'];

        $taiKhoan = $this->modelTaiKhoan->getDetailTaiKhoan($id);

        require_once './views/taikhoan/editTaiKhoan.php';
        deleteSessionError();
    }
    public function formAddTaiKhoan()
    {
        require_once './views/taikhoan/addTaiKhoan.php';

        deleteSessionError();
    }
    public function postEditTaiKhoan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $role = $_POST['role'] ?? 0;

            $errors = [];

            if (empty($ho_ten)) {
                $errors['ho_ten'] = "Tên không được để trống";
            }

            if (empty($email)) {
                $errors['email'] = "Email không được để trống";
            }

            if (empty($dia_chi)) {
                $errors['dia_chi'] = "Địa chỉ không được để trống";
            }

            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại không được để trống";
            }

            $_SESSION['error'] = $errors;

            if (empty($errors)) {
                $this->modelTaiKhoan->updateTaiKhoan(
                    $id,
                    $ho_ten,
                    $email,
                    $so_dien_thoai,
                    $dia_chi,
                    $role
                );
                $_SESSION['flash'] = 'Cập nhật tài khoản thành công!';
                header("Location: " . BASE_URL_ADMIN . '?act=listTaiKhoan');
                exit();
            } else {
                $_SESSION['flash'] = true;
                $taiKhoan = $_POST;
                require_once('views/taikhoan/editTaiKhoan.php');
            }
        }
    }


    public function postAddTaiKhoan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $mat_khau = $_POST['mat_khau'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $role = $_POST['role'] ?? 0;
            $errors = [];

            // Validate
            if (empty($ho_ten)) $errors['ho_ten'] = "Tên không được để trống";
            if (empty($email)) $errors['email'] = "Email không được để trống";
            if (empty($mat_khau)) $errors['mat_khau'] = "Mật khẩu không được để trống";
            if (empty($so_dien_thoai)) $errors['so_dien_thoai'] = "Số điện thoại không được để trống";
            if (empty($dia_chi)) $errors['dia_chi'] = "Địa chỉ không được để trống";

            // Nếu có lỗi
            if (!empty($errors)) {
                $_SESSION['error'] = $errors;
                // Hiển thị lại form với các lỗi
                require_once('views/taikhoan/addTaiKhoan.php');
                return; // Dừng lại ở đây, không cần tiếp tục nữa
            }

            // Hash mật khẩu
            $mat_khau = password_hash($mat_khau, PASSWORD_DEFAULT);

            // Thêm tài khoản vào cơ sở dữ liệu
            $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $mat_khau, $so_dien_thoai, $dia_chi, $role);

            // Thiết lập thông báo thành công
            $_SESSION['flash'] = 'Thêm tài khoản thành công!';

            // Chuyển hướng về danh sách tài khoản
            header('Location: ' . BASE_URL_ADMIN . '?act=listTaiKhoan');
            exit();
        }
    }

    public function deleteTaiKhoan()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $taiKhoan = $this->modelTaiKhoan->getDetailTaiKhoan($id);


            if (!$taiKhoan) {
                $_SESSION['flash'] = 'Tài khoản không tồn tại!';
                header('Location: ' . BASE_URL_ADMIN . '?act=listTaiKhoan');
                exit();
            }

            // Kiểm tra nếu tài khoản là quản trị viên
            if ($taiKhoan['role'] == 1) {
                $this->modelTaiKhoan->deleteTaiKhoan($id);
                $_SESSION['flash'] = 'Xóa tài khoản thành công!';
                header('Location: ' . BASE_URL_ADMIN . '?act=listTaiKhoan');
                exit();
            }

            // Kiểm tra nếu tài khoản là khách hàng
            if ($taiKhoan['role'] != 1) {

                $this->modelTaiKhoan->deleteTaiKhoan($id);
                $_SESSION['flash'] = 'Xóa tài khoản khách hàng thành công!';
                header('Location: ' . BASE_URL_ADMIN . '?act=listTaiKhoan');
                exit();
            }
        }
    }



    public function detailTaiKhoan()
    {
        $id = $_GET['id'];
        $taikhoan = $this->modelTaiKhoan->getDetailTaiKhoan($id);
        require_once './views/taikhoan/detailTaiKhoan.php';
    }

    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        exit();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if ($user) {
                $_SESSION['user_admin'] = $user;
                $_SESSION['flash'] = 'Đăng nhập thành công!';
                header("Location: " . BASE_URL_ADMIN);
                exit();
            } else {
                $_SESSION['error'] = 'Sai thông tin đăng nhập';
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . 'login-admin');
                exit();
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user_admin'])) {
            unset($_SESSION['user_admin']);
            $_SESSION['flash'] = 'Đăng xuất thành công!';
            header('Location: ' . BASE_URL_ADMIN . 'login-admin');
        }
    }



    private function clearSessionError()
    {
        if (isset($_SESSION['error'])) {
            unset($_SESSION['error']);
        }
    }
}
