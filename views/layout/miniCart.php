<?php

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
}
?>
<!-- offcanvas mini cart start -->
<div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <div class="minicart-close">
                <i class="pe-7s-close"></i>
            </div>
            <div class="minicart-content-box">

                <div class="minicart-item-wrapper">
                    <ul>
                        <?php $tongGioHang = 0;  foreach ($chiTietGioHang as $key => $sanPham): ?>
                            <li class="minicart-item">
                                <div class="minicart-thumb">
                                    <a href="#">
                                        <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                    </a>
                                </div>
                                <div class="minicart-content">
                                    <h3 class="product-name">
                                        <a href="product-details.html"><?= $sanPham['ten_san_pham'] ?></a>
                                    </h3>
                                    <p>
                                        <span class="cart-quantity"><?= $sanPham['so_luong'] ?> <strong>&times;</strong></span>
                                        <span class="cart-price">
                                            <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                <?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ' ?>
                                            <?php } else { ?>
                                                <?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?>
                                            <?php } ?>
                                        </span>
                                    </p>
                                </div>
                                <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                            </li>
                        <?php endforeach ?>

                    </ul>
                </div>

                

                <div class="minicart-button">
                    <a href="<?= BASE_URL . '?act=gio-hang' ?>"><i class="fa fa-shopping-cart"></i> View Cart</a>
                    <a href="<?= BASE_URL . '?act=thanh-toan' ?>"><i class="fa fa-share"></i> Đặt hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas mini cart end -->