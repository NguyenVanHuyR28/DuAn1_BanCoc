<!-- offcanvas mini cart start -->
<div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <div class="minicart-close">
                <i class="pe-7s-close"></i>
            </div>
            <div class="minicart-content-box">
                <?php if (isset($_SESSION['tai_khoan']) || isset($_SESSION['tai_khoan_admin'])): ?>
                    <div class="minicart-button">
                        <a href="<?= BASE_URL . '?act=gio-hang' ?>"><i class="fa fa-shopping-cart"></i> Xem giỏ hàng</a>
                        <a href="<?= BASE_URL . '?act=lich-su' ?>"><i class="fa fa-share"></i> Đơn hàng đã đặt</a>
                    </div>
                <?php else: ?>
                    <div class="minicart-button">
                        <p class="text-danger">Vui lòng đăng nhập để xem giỏ hàng và đơn hàng.</p>
                        <a href="<?= BASE_URL . '?act=dangnhap' ?>"><i class="fa fa-sign-in"></i> Đăng nhập</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas mini cart end -->