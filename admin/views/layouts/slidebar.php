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
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN .'/'  ?>" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Thống kê
            </p>
          </a>
        </li>

        

        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN . 'danh-muc' ?>" class="nav-link">
          <i class="fas fa-folder"></i>

            <p>
              Danh mục
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN . 'san-pham' ?>" class="nav-link">
          <i class="fas fa-box"></i>


            <p>
              Sản phẩm
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN . 'don-hang' ?>" class="nav-link">
            <i class="nav-icon fas fa-file-invoice-dollar"></i>
            <p>
              Đơn hàng
            </p>
          </a>
        </li>

        

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Tài khoản
            </p>
            <i class="fas fa-angle-left right"></i>
          </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN . 'list-tai-khoan-quan-tri' ?>" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Tài khoản quản trị</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN . 'list-tai-khoan-khach-hang' ?>" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Tài khoản Khách hàng</p>
                </a>
              </li>
            </ul>
          
        </li>

        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>