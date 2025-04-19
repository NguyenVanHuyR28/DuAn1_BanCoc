<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<body>
    <div class="container py-5">
        <h2 class="text-center mb-5 fw-bold text-danger">Xác Nhận Thanh Toán</h2>

        <form action="<?= BASE_URL . '?act=dat-hang' ?>" method="POST">
            <?php
            // Kiểm tra session của người dùng hoặc admin
            if (isset($_SESSION['tai_khoan'])) {
                $email = $_SESSION['tai_khoan'];
            } elseif (isset($_SESSION['tai_khoan_admin'])) {
                $email = $_SESSION['tai_khoan_admin'];
            } else {
                $_SESSION['error'] = "Vui lòng đăng nhập để thanh toán!";
                header('location:' . BASE_URL . '?act=dangnhap');
                exit();
            }

            // Lấy thông tin tài khoản
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);
            $tai_khoan_id = $user['id'];
            ?>
            <div class="row g-4">
                <!-- Cột trái: Thông tin giao hàng -->
                <div class="col-md-7">
                    <div class="card p-4">
                        <h4 class="mb-4 text-warning">Thông Tin Giao Hàng</h4>

                        <div class="mb-3">
                            <label for="ten_nguoi_nhan" class="form-label">Họ và Tên</label>
                            <input type="text" class="form-control" id="ten_nguoi_nhan" name="ten_nguoi_nhan" required value="<?= $user['ho_ten'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email_nguoi_nhan" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_nguoi_nhan" name="email_nguoi_nhan" value="<?= $user['email'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="sdt_nguoi_nhan" class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" id="sdt_nguoi_nhan" name="sdt_nguoi_nhan" value="<?= $user['so_dien_thoai'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="dia_chi_nguoi_nhan" class="form-label">Địa chỉ giao hàng</label>
                            <textarea class="form-control" id="dia_chi_nguoi_nhan" name="dia_chi_nguoi_nhan" rows="3" required><?= $user['dia_chi'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="ghi_chu" class="form-label">Ghi chú (nếu có)</label>
                            <textarea class="form-control" id="ghi_chu" name="ghi_chu" rows="2"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Phương thức thanh toán</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="phuong_thuc_thanh_toan_id" id="cod" value="1" checked>
                                <label class="form-check-label" for="cod">Thanh toán khi nhận hàng (COD)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="phuong_thuc_thanh_toan_id" id="bank" value="2">
                                <label class="form-check-label" for="bank">Chuyển khoản ngân hàng</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="phuong_thuc_thanh_toan_id" id="wallet" value="3">
                                <label class="form-check-label" for="wallet">Ví điện tử (Momo, ZaloPay...)</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cột phải: Tóm tắt đơn hàng -->
                <div class="col-md-5">
                    <div class="card p-4 bg-light">
                        <h4 class="mb-3 text-secondary">Tóm Tắt Đơn Hàng</h4>
                        <ul class="list-group mb-3">
                            <?php $tongTien = 0 ?>
                            <?php foreach ($sanPham as $item): ?>
                                <?php
                                $gia_ap_dung = (!empty($item['gia_khuyen_mai']) && $item['gia_khuyen_mai'] > 0)
                                    ? $item['gia_khuyen_mai']
                                    : $item['gia'];
                                $thanhTien = $gia_ap_dung * $item['so_luong'];
                                $tongTien += $thanhTien;
                                ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <div>
                                        <strong><?= $item['ten_san_pham'] ?></strong><br>
                                        <small class="text-muted">Số lượng: <?= $item['so_luong'] ?></small>
                                    </div>
                                    <span><?= number_format($thanhTien, 0, ',', '.') ?>₫</span>
                                </li>
                                <input type="hidden" name="select-product[]" value="<?= $item['id'] ?>">
                                <input type="hidden" name="product-price[<?= $item['id'] ?>]" value="<?= $gia_ap_dung ?>">
                            <?php endforeach; ?>

                            <li class="list-group-item d-flex justify-content-between">
                                <span>Tạm tính</span>
                                <strong><?= number_format($tongTien, 0, ',', '.') ?>₫</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Phí vận chuyển</span>
                                <strong>30.000₫</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Tổng cộng</span>
                                <strong class="text-danger"><?= number_format($tongTien + 30000, 0, ',', '.') ?>₫</strong>
                            </li>
                        </ul>
                        <input type="hidden" name="tong_tien" value="<?= $tongTien + 30000 ?>">

                        <button type="submit" class="btn btn-cart2" id="add-to-cart-btn">Xác nhận thanh toán</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php require_once 'layout/footer.php'; ?>
    <?php require_once 'layout/miniCart.php'; ?>

</body>

</html>