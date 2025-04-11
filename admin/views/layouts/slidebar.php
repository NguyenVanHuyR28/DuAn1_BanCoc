<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <!-- <img src="" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?= BASE_URL_ADMIN ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Thống kê</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= BASE_URL_ADMIN . '?act=listDanhMuc' ?>" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>Danh mục</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= BASE_URL_ADMIN . '?act=listSanPham' ?>" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Sản phẩm</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= BASE_URL_ADMIN . '?act=listDonHang' ?>" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>Đơn hàng</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= BASE_URL_ADMIN . '?act=listTaiKhoan' ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Tài khoản</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= BASE_URL_ADMIN . '?act=listBinhLuan' ?>" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>Bình luận</p>
                    </a>
                </li>

            </ul>
        </nav>

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>