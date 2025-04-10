<!-- Start Header Area -->
<header class="header-area header-wide">
    <!-- main header start -->
    <div class="main-header d-none d-lg-block">
        <!-- header middle area start -->
        <div class="header-main-area sticky">
            <div class="container">
                <div class="row align-items-center position-relative">
                    <!-- start logo area -->
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="<?= BASE_URL ?>">
                                <img src="assets/img/logo/logo1.png" style="height:150px;width: 150px;" alt="Brand Logo">
                            </a>
                        </div>
                    </div>
                    <!-- start logo area -->

                    <!-- main menu area start -->
                    <div class="col-lg-6 position-static">
                        <div class="main-menu-area">
                            <div class="main-menu">
                                <!-- main menu navbar start -->
                                <nav class="desktop-menu">
                                    <ul>
                                        <li>
                                            <a href="<?= BASE_URL ?>">Trang chủ</a>
                                        </li>
                                        <li>
                                            <a href="<?= BASE_URL . '?act=allsanpham' ?>">Sản phẩm</a>
                                        </li>
                                        <li><a href="#">Giới thiệu</a></li>
                                        <li><a href="#">Liên hệ</a></li>
                                    </ul>

                                </nav>
                                <!-- main menu navbar end -->
                            </div>
                        </div>
                    </div>
                    <!-- main menu area end -->

                    <!-- mini cart area start -->
                    <div class="col-lg-4">
                        <div
                            class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                            <div class="header-search-container">
                                <button class="search-trigger d-xl-none d-lg-block"><i
                                        class="pe-7s-search"></i></button>
                                <form class="header-search-box d-lg-none d-xl-block" role="search" method="post">
                                    <input type="search" name="search" value="<?= $_POST['search'] ?? "" ?>" placeholder="Tìm kiếm sản phẩm" class="header-search-field">
                                    <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                                </form>
                            </div>
                            <div class="header-configure-area">
                                <ul class="nav justify-content-end">
                                    <li class="user-hover">
                                        <a href="">
                                            <i class="pe-7s-user"></i>
                                        </a>
                                        <ul class="dropdown-list">
                                            <div>
                                                <?php if (isset($_SESSION['tai_khoan'])) { ?>
                                                    <p><span style="font-weight: 400;">Acc:</span>
                                                        </span><a href="<?= BASE_URL . '?act=formchinhsua&id=' . $_SESSION['tai_khoan'] ?>" style="font-size: 11px;"><?= $_SESSION['tai_khoan'] ?></a>
                                                    </p>
                                                    <br>
                                                    <p><a style="font-size: 12px;"
                                                            href="<?= BASE_URL . '?act=dangxuat' ?>"
                                                            onclick="return confirm('Bạn muốn đăng xuất?')">Đăng xuất</a>
                                                    </p>

                                                <?php } elseif (isset($_SESSION['tai_khoan_admin'])) { ?>

                                                    <p><span style="font-weight: 600;">Acc:
                                                        </span><a
                                                            style="font-size: 9px;"> <?= $_SESSION['tai_khoan_admin'] ?></a>
                                                    </p>
                                                    <br>
                                                    <span><a style="font-size: 15px;" href="<?= BASE_URL . '?act=dangxuat' ?>" onclick="return confirm('Bạn muốn đăng xuất?')">Đăng xuất</a></span> <br> <br>
                                                    <span><a style="font-size: 13px;" href="<?= BASE_URL_ADMIN ?>">Đăng nhập Admin</a></span>
                                                <?php } else { ?>
                                                    <li><a href="<?= BASE_URL . '?act=dangnhap' ?>">Đăng nhập</a></li>
                                                    <li><a href="<?= BASE_URL . '?act=dangky' ?>">Đăng ký</a></li>
                                                <?php } ?>
                                            </div>
                                        </ul>
                                    </li>

                                    <li class="user-hover">
                                        <a href="<?= BASE_URL . '?act=gio-hang' ?>">
                                            <i class="pe-7s-shopbag"></i>
                                        </a>
                                        <ul class="dropdown-list">
                                            <a href="<?= BASE_URL . '?act=lich-su' ?>" class="minicart-btn">Lịch sử </a>
                                        </ul>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- mini cart area end -->

                </div>
            </div>
        </div>
        <!-- header middle area end -->
    </div>
    <!-- main header start -->
</header>
<!-- end Header Area -->