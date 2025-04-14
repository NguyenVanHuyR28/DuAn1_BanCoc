<?php
require_once './models/BinhLuan.php';

class HomeController
{

    public $modelDanhMuc;
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelBinhLuan;
    public $modelGioHang;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelDanhMuc = new DanhMuc();
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelBinhLuan = new BinhLuan();
        $this->modelGioHang = new GioHang();
        // $this->modelDonHang = new DonHang();
    }

    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once('./views/home.php');
    }
    // sản phẩm

    public function detailSanPham()
{
    $id = $_GET['id_san_pham'];
    $sanPham = $this->modelSanPham->getDetailSanPham($id);
    $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($sanPham['danh_muc_id']);

    if (isset($_SESSION['tai_khoan'])) {
        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['tai_khoan']);
    }

    // Lấy danh sách bình luận hiển thị
    $listBinhLuan = $this->modelBinhLuan->getBinhLuanBySanPhamId($id);

    $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);

    if ($sanPham && isset($sanPham['danh_muc_id'])) {
        require_once './views/detailSanPham.php';
    } else {
        header('Location: ' . BASE_URL);
        exit();
    }
}


    public function allSanPham()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/sanpham.php';
    }

    public function danhSachSanPhamTheoDanhMuc()
    {

        $danh_muc_id = isset($_GET['danh_muc_id']) ? $_GET['danh_muc_id'] : null;




        if ($danh_muc_id) {
            $listSanPham = $this->modelSanPham->getSanPhamByCategory($danh_muc_id);
        } else {

            $listSanPham = $this->modelSanPham->getAllSanPham();
        }

        // Truyền danh sách sản phẩm và danh mục vào view
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/sanphamdanhmuc.php';
    }


    // Đăng ký, đăng nhập, đăng xuất
    public function formDangNhap()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();    
        require_once './views/auth/dangnhap.php';
        deleteSessionError();
    }
    public function dangNhap()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy email và pass gửi lên form
            $email = $_POST['email'];
            $mat_khau = $_POST['mat_khau'];
            // var_dump($email);die;
            // Ghi nhớ tài khoản
            if (isset($_POST['rememberMe'])) {
                setcookie("email", $email, time() + 86400 * 7);
                setcookie("mat_khau", $mat_khau, time() + 86400 * 7);
            }

            // Kiểm tra thông tin đăng nhập
            $tai_khoan = $this->modelTaiKhoan->checkLogin($email, $mat_khau);
            // var_dump($email, $mat_khau);die;
            // var_dump($taikhoan);
            // die;
            if ($tai_khoan === $email) { // đăng nhập thành công
                // Lưu thông tin vào session
                $_SESSION['tai_khoan_admin'] = $tai_khoan;
                // var_dump($_SESSION['taikhoan_admin']);die;
                header('location:'.BASE_URL_ADMIN );
                exit();
            } elseif ($tai_khoan == 'Trang client') {
                $_SESSION['tai_khoan'] = $email;
                header('location:'. BASE_URL);
                exit();
            } else {
                // Lỗi thì lưu vào session
                $_SESSION['error'] = $tai_khoan;

                $_SESSION['flash'] = true;
                header('location:'.BASE_URL . '?act=dangnhap');
                exit();
            }
        }
        deleteSessionError();
    }

    public function formDangKy()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/auth/dangky.php';
        deleteSessionError();
    }

    public function dangKy() 
    {
        $listTaiKhoan = $this->modelTaiKhoan->getAllTaiKhoan();
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $mat_khau = $_POST['mat_khau'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $dia_chi = $_POST['dia_chi'];
            $remat_khau = $_POST['remat_khau'];
            $role = 0; 

            $errors = [];

            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Vui lòng nhập họ tên';
            }
            if (empty($email)) {
                $errors['email'] = 'Vui lòng nhập email';
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Vui lòng nhập số điện thoại';
            }
            if (empty($dia_chi)) {
                $errors['dia_chi'] = 'Vui lòng nhập địa chỉ';
            }
            if (empty($mat_khau)) {
                $errors['mat_khau'] = 'Vui lòng nhập mật khẩu';
            }
            if (empty($remat_khau)) {
                $errors['remat_khau'] = 'Vui lòng nhập lại mật khẩu';
            }
            if ($mat_khau !== $remat_khau) {
                $errors['remat_khau'] = 'Mật khẩu nhập lại không đúng';
            }

            $_SESSION['ho_ten'] = $ho_ten;
            $_SESSION['email'] = $email;
            $_SESSION['so_dien_thoai'] = $so_dien_thoai;
            $_SESSION['dia_chi'] = $dia_chi;
            $_SESSION['mat_khau'] = $mat_khau;
            $_SESSION['remat_khau'] = $remat_khau;

            foreach ($listTaiKhoan as $tai_khoan) {
                $tai_khoan['email'];
                $tai_khoan['so_dien_thoai'];
                if ($email === $tai_khoan['email']) {
                    $errors['email'] = 'Email đã được đăng ký!';
                }
                if ($so_dien_thoai === $tai_khoan['so_dien_thoai']) {
                    $errors['so_dien_thoai'] = 'Số điện thoại đã được đăng ký!';
                }
            }
            $_SESSION['error'] = $errors; // Lưu biến lỗi
            // Nếu không lỗi thì tiến hành thêm sản phẩm
            if (empty($errors)) { //nếu erros rỗng thì tiến hành thêm tài khoản
                $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $mat_khau, $so_dien_thoai, $dia_chi, $role);
                session_unset();
                session_destroy();
                echo '<script language="javascript">alert("Đăng ký thành công!"); window.location="?act=dangnhap";</script>';
                exit();
            } else {
                // Trả về form và lỗi

                // Đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL . '?act=dangky');
                exit();
            }
        }
    }
    public function logout()
    {
        if (isset($_SESSION['tai_khoan']) || isset($_SESSION['tai_khoan_admin'])) {
            session_unset();
            session_destroy();
            header('location:'.BASE_URL.'?act=dangnhap');
        } else {
            header('location:'.BASE_URL);
            }
    }
    public function xoaCookie() 
    {
        if (isset($_COOKIE['email']) || isset($_COOKIE['mat_khau'])) {
            setcookie("email", "", time() - (86400 * 7));
            setcookie("mat_khau", "", time() - (86400 * 7));
            echo '<script language="javascript">alert("Xóa thành công"); window.location="?act=dangnhap";</script>';
        } else {
            echo '<script language="javascript">alert("Không có tài khoản nào được lưu!");window.location="?act=dangnhap";</script>';
        }
    }

    // Chỉnh sửa thông tin cá nhân
    public function infoAcc()
    {
        $id = $_GET['id'];
        $listCategory = $this->modelDanhMuc->getAllDanhMuc();
        $TKById = $this->modelTaiKhoan->getTKById($id);
        require_once './views/infoAcc.php';
    }
    public function formUser() 
    {
        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['tai_khoan']);
        $tai_khoan_id = $user['id'];
        $TKById = $this->modelTaiKhoan->getTKById($tai_khoan_id); // THÊM DÒNG NÀY
        require_once './views/infoacc.php';
        exit();
    }

    public function editInfo()
    {
        $id = $_POST['id'];
        $ho_ten = $_POST['ho_ten'];
        $so_dien_thoai = $_POST['so_dien_thoai'];
        $email = $_POST['email'];
        $dia_chi = $_POST['dia_chi'];
        $mat_khau = $_POST['mat_khau'];
        $checkEdit = $this->modelTaiKhoan-> editInfo($id, $ho_ten, $email, $mat_khau,$so_dien_thoai,$dia_chi);
        if ($checkEdit) {
            echo "<script>
                alert('Sửa thông tin thành công!');
                window.location.href='" . BASE_URL . "?act=info-Acc&id=" . $id . "';
                </script>";
            exit;
        } else {
            echo "<script>
                alert('Sửa thông tin thất bại!');
                window.location.href='" . BASE_URL . "?act=info-Acc&id=" . $id . "';
                </script>";
            exit;
        }
    }
    public function postBinhLuan()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $san_pham_id = $_POST['san_pham_id'];
        $tai_khoan_id = $_POST['tai_khoan_id'];
        $noi_dung = $_POST['noi_dung'];
        $ngay_tao = date('Y-m-d H:i:s');
        $trang_thai = 1; // Mặc định ẩn bình luận

        $errors = [];
        if (empty($noi_dung)) {
            $errors['noi_dung'] = "Bạn chưa bình luận";
        }

        $_SESSION['error'] = $errors;

        if (empty($errors)) {
            $this->modelBinhLuan->insertBinhLuan(
                $san_pham_id,
                $tai_khoan_id,
                $noi_dung,
                $ngay_tao,
                $trang_thai
            );

            header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
            exit();
        } else {
            header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
            exit();
        }
    }
}
}

