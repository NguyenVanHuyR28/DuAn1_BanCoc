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
                                <!-- <img src="assets/img/logo/petshop.jpg" style="height:150px;width: 150px;" alt="Brand Logo"> -->
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
                                            <a href="<?= BASE_URL . '?act=all-san-pham' ?>">Sản phẩm</a>
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
                        <div class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                            <div class="header-search-container">
                                <button class="search-trigger d-xl-none d-lg-block"><i class="pe-7s-search"></i></button>
                                <form class="header-search-box d-lg-none d-xl-block">
                                    <input type="text" placeholder="Nhập tên sản phẩn bạn cần" class="header-search-field">
                                    <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                                </form>
                            </div>
                            <div class="header-configure-area">
                                <ul class="nav justify-content-end">
                                    <li>
                                        <label for="">
                                            <?php
                                            if (isset($_SESSION['user_client'])) {
                                                echo $_SESSION['user_client'];
                                            }
                                            ?>
                                        </label>
                                        <?php
                                        if (isset($_SESSION['user_client'])) { ?>
                                            <a href="#" class="minicart-btn">
                                                <i class="pe-7s-shopbag"></i>
                                                <div class="notification">2</div>
                                            </a>
                                        <?php  }  ?>
                                        
                                    </li>
                                    <li class="user-hover">
                                        <a href="#">
                                            <i class="pe-7s-user"></i>
                                        </a>
                                        <ul class="dropdown-list">
                                            <?php
                                            if (isset($_SESSION['user_client'])) { ?>
                                                <li><a href="<?= BASE_URL . '?act=form-chinh-sua' ?>">Tài khoản</a></li>
                                                <li><a href="<?= BASE_URL . '?act=logout' ?>" class="nav-link" onclick="return confirm('Đăng xuất tài khoản')">
                                                        Đăng xuất
                                                    </a></li>
                                            <?php  } else { ?>
                                                <li><a href="<?= BASE_URL . '?act=login' ?>">Đăng nhập</a></li>
                                            <?php } ?>
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