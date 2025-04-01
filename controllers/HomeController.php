<?php
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
        $this->modelDonHang = new DonHang();
    }

    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once('./views/home.php');
    }
    // sản phẩm

    public function chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        // $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        if (isset($_SESSION['user_client'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
        }
        //binhluan
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['id_dm']);

        if ($sanPham) {
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
        require_once './views/products.php';
    }

    public function danhSachSanPhamTheoDanhMuc()
    {

        $id_dm = isset($_GET['id_dm']) ? $_GET['id_dm'] : null;




        if ($id_dm) {
            $listSanPham = $this->modelSanPham->getSanPhamByCategory($id_dm);
        } else {

            $listSanPham = $this->modelSanPham->getAllSanPham();
        }

        // Truyền danh sách sản phẩm và danh mục vào view
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/products_category.php';
    }


    //login
    public function formLogin()
    {
        require_once './views/auth/formLogin.php';

        exit();
    }


    public function postlogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy email và pass gửi lên từ form 

            $email = $_POST['email'];
            $password = $_POST['password'];

            // xử lý kiểm tra thông tin đăng nhập 
            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if ($user == $email) { // TRường hợp đăng nhập thành công
                // Lưu thông tin vào session 
                $_SESSION['user_client'] = $user;
                header("Location: " . BASE_URL);
                exit();
            } else {
                // Lỗi thì lưu vào session
                $_SESSION['error'] = $user;
                // var_dump($_SESSION['error']);die;

                $_SESSION['flash'] == true;

                header('Location: ' . BASE_URL . '?act=login');
                exit();
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user_client'])) {
            unset($_SESSION['user_client']);
            header('Location: ' . BASE_URL . '?act=/');
        }
    }

    public function formRegister()
    {
        require_once './views/auth/formRegister.php';

        exit();
    }

    public function postRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $mat_khau = $_POST['mat_khau'] ?? '';
            $mat_khau_confirm = $_POST['mat_khau_confirm'] ?? '';
            $so_dien_thoai = '';
            $dia_chi = '';
            $chuc_vu_id = 0;

            
            $errors = []; 
            if (empty($ho_ten)) {
                $errors['ho_ten'] = "Tên không được để trống.";
            }
            if (empty($email)) {
                $errors['email'] = "Email không được để trống.";
            }
            if (empty($mat_khau)) {
                $errors['mat_khau'] = "Mật khẩu không được để trống.";
            }
            if (empty($mat_khau_confirm)) {
                $errors['mat_khau_confirm'] = "Xác nhận mật khẩu không được để trống.";
            }

            // Kiểm tra xem mật khẩu và xác nhận mật khẩu có trùng khớp không
            if (!empty($mat_khau) && !empty($mat_khau_confirm) && $mat_khau !== $mat_khau_confirm) {
                $errors['mat_khau_confirm'] = "Mật khẩu và xác nhận mật khẩu không khớp.";
            }

            
            if (!empty($errors)) {
                $_SESSION['error'] = $errors;
            } else {
                unset($_SESSION['error']);
            }



            if (empty($errors)) {
                $password = password_hash($mat_khau, PASSWORD_BCRYPT);

                $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $so_dien_thoai, $dia_chi, $chuc_vu_id);
                header('Location: ' . BASE_URL . '?act=login');
                exit();
            } else {

                require_once './views/auth/formRegister.php';
            }
        }
    }


    //thong tin người dùng
    public function formUser()
    {
        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);


        $tai_khoan_id = $user['id'];


        $don_hang_list = $this->modelDonHang->getDonHangByTaiKhoanId($tai_khoan_id);
        require_once './views/taikhoan/formUser.php';
        exit();
    }

    public function postUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tai_khoan_id = $_POST['tai_khoan_id'];
            $avtOld = $this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);
            $old_file = $avtOld['anh_dai_dien'] ?? '';
            $ho_ten = $_POST['ho_ten'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $chuc_vu_id = 2;

            $anh_dai_dien = $_FILES['anh_dai_dien'] ?? null;



            // $user = $this->modelTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_client']);

            // var_dump($_POST,$_FILES);die;


            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = "Tên ko được để trống";
            }
            if (empty($email)) {
                $errors['email'] = "Email ko được để trống";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Địa chỉ email không hợp lệ. Vui lòng nhập đúng định dạng email.";
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại ko được để trống";
            }

            if (empty($dia_chi)) {
                $errors['dia_chi'] = "Địa chỉ ko được để trống";
            }

            if (isset($anh_dai_dien) && $anh_dai_dien['error'] == UPLOAD_ERR_OK) {

                $new_file = uploadFile($anh_dai_dien, './uploads/');
                if (!empty($old_file)) {
                    deleteFile($old_file);
                }
            } else {

                $new_file = $old_file;
            }

            $_SESSION['error'] = $errors;

            // var_dump($_POST,$_FILES);die;

            if (empty($errors)) {
                $status = $this->modelTaiKhoan->updateTaiKhoan(
                    $tai_khoan_id,
                    $ho_ten,
                    $new_file,
                    $email,
                    $so_dien_thoai,
                    $dia_chi,
                    $ngay_sinh,
                    $gioi_tinh,
                    $chuc_vu_id,

                );
                if ($status) {
                    $_SESSION['complete'] = "Thay đổi thông tin thành công";
                    $_SESSION['flash'] = true;

                    header('Location: ' . BASE_URL . '?act=form-chinh-sua');
                }
            } else {

                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL . '?act=form-chinh-sua');
                exit();
            }
        }
    }

    public function postEditMatKhauCaNhan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass'];



            // Lấy thông tin user từ SESSION
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

            $checkPass = password_verify($old_pass, $user['mat_khau']);

            $errors = [];

            if (!$checkPass) {
                $errors['old_pass'] = "Mật khẩu người dùng không đúng";
            }
            if ($new_pass !== $confirm_pass) {
                $errors['confirm_pass'] = "Mật khẩu nhập lại không trùng khớp";
            }
            if (empty($old_pass)) {
                $errors['old_pass'] = "Pass ko được để trống";
            }
            if (empty($new_pass)) {
                $errors['new_pass'] = "Pass ko được để trống";
            }
            if (empty($confirm_pass)) {
                $errors['confirm_pass'] = "Pass ko được để trống";
            }


            $_SESSION['error'] = $errors;

            if (!$errors) {
                $hashPass = password_hash($new_pass, PASSWORD_BCRYPT);
                $status = $this->modelTaiKhoan->resetPassword($user['id'], $hashPass);
                if ($status) {
                    $_SESSION['success'] = "Đã đổi mật khẩu thành công";
                    $_SESSION['flash'] = true;

                    header("Location: " . BASE_URL . '?act=form-chinh-sua');
                }
            } else {
                // Lỗi thì lưu vào session


                $_SESSION['flash'] = true;

                header("Location: " . BASE_URL . '?act=form-chinh-sua');
                exit();
            }
        }
    }

    //bình luận
    public function postBinhLuan()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $san_pham_id = $_POST['san_pham_id'];
            $tai_khoan_id = $_POST['tai_khoan_id'];
            $noi_dung = $_POST['noi_dung'];
            $ngay_dang = date('Y-m-d H:i:s');
            $trang_thai = 1;

            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

            $errors = [];
            if (empty($noi_dung)) {
                $errors['noi_dung'] = "Bạn chưa bình luận";
            }

            $_SESSION['error'] = $errors;

            // nếu ko lỗi tiến hành thêm danh mục
            if (empty($errors)) {

                //Nếu ko lỗi tiến hành thêm danh mục
                $this->modelBinhLuan->inserBinhLuan(
                    $san_pham_id,
                    $tai_khoan_id,
                    $noi_dung,
                    $ngay_dang,
                    $trang_thai
                );


                header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);

                exit();
            } else {
                //trả về form và lỗi
                header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
                exit();
            }
        }
    }



    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                $mail  = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

                $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
                if (!$gioHang) {
                    $gioHangId = $this->modelGioHang->addGiohang($mail['id']);
                    $gioHang = ['id' => $gioHangId];
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                } else {
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                }




                $san_pham_id =  $_POST['san_pham_id'];
                $so_luong =  $_POST['so_luong'];
                $checkSanPham = false;

                foreach ($chiTietGioHang as $detail) {
                    if ($detail['san_pham_id'] == $san_pham_id) {
                        $newSoLuong = $detail['so_luong'] + $so_luong;
                        $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);
                        $checkSanPham = true;
                        break;
                    }
                }
                if (!$checkSanPham) {
                    $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
                }
                header('Location: ' . BASE_URL . '?act=gio-hang');
            } else {
                var_dump('Chưa đăng nhập');
                die;
            }
        }
    }

    public function gioHang()
    {
        if (isset($_SESSION['user_client'])) {
            $mail  = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            //   var_dump($mail['id']);die; 
            // Lấy dữ liệu giỏ hàng người dùng
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGiohang($mail['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }

            require_once './views/gioHang.php';



            header('Location: ' . BASE_URL . '?act=gio-hang');
            exit();
        } else {
            var_dump('Chưa đăng nhập');
            die;
        }
    }


    public function thanhToan()
    {
        if (isset($_SESSION['user_client'])) {
            $user  = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            //   var_dump($mail['id']);die; 
            // Lấy dữ liệu giỏ hàng người dùng
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGiohang($user['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }

            require_once './views/thanhToan.php';


            header('Location: ' . BASE_URL . '?act=gio-hang');
        } else {
            var_dump('Chưa đăng nhập');
            die;
        }
        require_once './views/thanhToan.php';
    }

    public function deleteSpGioHang()
    {
        $id = $_GET['id_chi_tiet_gio_hang'];
        // var_dump($id); // Kiểm tra giá trị ID

        // $gioHang = $this->modelGioHang->getDetailGioHang($id);
        // var_dump($gioHang);die;

        // if($gioHang){
        $this->modelGioHang->deleteSanPhamGioHang($id);
        // }
        header('Location: ' . BASE_URL . '?act=gio-hang');
        exit();
    }

    public function postThanhToan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];

            $ngay_dat =  date('Y-m-d');
            $trang_thai_id = 1;

            $user  = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            $ma_don_hang = 'DH' . rand(1000, 9999);

            //Theem 

            $don_hang_id = $this->modelDonHang->addDonHang(
                $tai_khoan_id,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ghi_chu,
                $tong_tien,
                $phuong_thuc_thanh_toan_id,
                $ngay_dat,
                $ma_don_hang,
                $trang_thai_id


            );



            $gio_hang = $this->modelGioHang->getGioHangByTaiKhoanId($tai_khoan_id);

            foreach ($gio_hang as $item) {
                $san_pham_id = $item['san_pham_id'];
                $so_luong = $item['so_luong'];


                if (!empty($item['gia_khuyen_mai']) && $item['gia_khuyen_mai'] > 0) {
                    $don_gia = $item['gia_khuyen_mai'];
                } else {
                    $don_gia = $item['gia_san_pham'];
                }


                $thanh_tien = $so_luong * $don_gia;


                $this->modelDonHang->addChiTietDonHang(
                    $don_hang_id,
                    $san_pham_id,
                    $don_gia,
                    $so_luong,
                    $thanh_tien
                );
            }




            $this->modelGioHang->xoaChiTietGioHang($tai_khoan_id);

            $this->modelGioHang->xoaGioHang($tai_khoan_id);

            header('Location: ' . BASE_URL);
            exit();
        }
    }

    public function showDanhSachDonHang()
    {
        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
        $tai_khoan_id = $user['id'];


        $don_hang_list = $this->modelDonHang->getDonHangByTaiKhoanId($tai_khoan_id);

        require_once './views/taikhoan/formUser.php';
        exit();
    }

    public function show()
    {
        $don_hang_id = $_GET['id_don_hang'];



        $chi_tiet_don_hang = $this->modelDonHang->getChiTietDonHangByDonHangId($don_hang_id);


        if (empty($chi_tiet_don_hang)) {

            echo "Chi tiết đơn hàng không tồn tại.";
            return;
        }
        require_once 'views/chi_tiet_don_hang.php';
    }

    public function huyDon()
    {
        if (isset($_GET['id'])) {
            $don_hang_id = $_GET['id'];

            $trang_thai = $this->modelDonHang->getTrangThaiDonHang($don_hang_id);


            if ($trang_thai >= 6) {
                $_SESSION['error1'] = 'Đơn hàng đã hoặc đang giao đến bạn không thể hủy đơn.';

                header("Location: " . BASE_URL . '?act=form-chinh-sua');
                exit;
            }


            $this->modelDonHang->huyDonHang($don_hang_id);

            $this->modelDonHang->huyDonHang($don_hang_id);
            $_SESSION['message'] = 'Hủy đơn hàng thành công.';

            header("Location: " . BASE_URL . '?act=form-chinh-sua');
            exit;
        }
        require_once './views/taikhoan/formUser.php';
    }

    public function hoanDon()
    {
        if (isset($_GET['id'])) {
            $don_hang_id = $_GET['id'];

            $trang_thai = $this->modelDonHang->getTrangThaiDonHang($don_hang_id);


            if ($trang_thai < 9) {
                $_SESSION['error1'] = 'Đơn hàng chưa giao đến bạn không thể hoàn.';

                header("Location: " . BASE_URL . '?act=form-chinh-sua');
                exit;
            }

            if ($trang_thai == 11) {
                $_SESSION['error1'] = 'Đơn hàng đã hủy không thể hoàn .';

                header("Location: " . BASE_URL . '?act=form-chinh-sua');
                exit;
            }

            
            $this->modelDonHang->hoanDonHang($don_hang_id);

            $this->modelDonHang->hoanDonHang($don_hang_id);
            $_SESSION['message'] = 'Yêu cầu của bạn được chấp nhận vui lòng đợi admin phê duyệt';

            header("Location: " . BASE_URL . '?act=form-chinh-sua');
            exit;
        }
        require_once './views/taikhoan/formUser.php';
    }
}
