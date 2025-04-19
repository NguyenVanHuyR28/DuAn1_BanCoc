<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>
<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = null; // hoặc redirect người dùng về trang login
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<main>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Thông tin tài khoản</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-account-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="myaccount-page-wrapper">
                            <div class="row">
                                <div class="col-lg-3 col-mb-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <?php if (isset($user) && $user['role'] == 1) { ?>
                                            <a href="<?= BASE_URL_ADMIN ?>" class="nav-link">
                                                <i class="fa fa-sign-out"></i> Đăng nhập admin
                                            </a>
                                        <?php } else { ?>
                                            <a href="#orders" data-bs-toggle="tab" class="<?= isset($_GET['tab']) && $_GET['tab'] == 'orders' ? 'active' : '' ?>">
                                                <i class="fa fa-cart-arrow-down"></i> Orders
                                            </a>
                                            <a href="#account-info" data-bs-toggle="tab" class="<?= isset($_GET['tab']) && $_GET['tab'] == 'account-info' ? 'active' : '' ?>">
                                                <i class="fa fa-user"></i> Account Details
                                            </a>
                                        <?php } ?>


                                        <a href="<?= BASE_URL . '?act=dangxuat' ?>" class="nav-link" onclick="return confirm('Đăng xuất tài khoản')"><i class="fa fa-sign-out"></i> Logout</a>
                                    </div>
                                </div>
                                <div class="col-lg-9-col-mb-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <div class="tab-pane fade <?= isset($_GET['tab']) && $_GET['tab'] == 'orders' ? 'show active' : '' ?>" id="orders" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5 class="mb-4">Đơn hàng của bạn</h5>
                                                <?php if (!empty($don_hang_list)) : ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered align-middle">
                                                            <thead class="table-dark">
                                                                <tr>
                                                                    <th>STT</th>
                                                                    <th>Mã Đơn</th>
                                                                    <th>Người Nhận</th>
                                                                    <th>Số điện thoại</th>
                                                                    <th>Tổng Tiền</th>
                                                                    <th>Ngày Mua</th>
                                                                    <th>Trạng Thái</th>
                                                                    <th>Chi Tiết</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($don_hang_list as $key => $don_hang) : ?>
                                                                    <tr>
                                                                        <td><?= $key + 1 ?></td>
                                                                        <td><?= $don_hang['ma_don_hang'] ?></td>
                                                                        <td><?= $don_hang['ten_nguoi_nhan'] ?></td>
                                                                        <td><?= $don_hang['sdt_nguoi_nhan'] ?></td>
                                                                        <td><?= number_format($don_hang['tong_tien'], 0, ',', '.') ?>đ</td>
                                                                        <td><?= date('d/m/Y H:i', strtotime($don_hang['ngay_tao'])) ?></td>
                                                                        <td>
                                                                            <?php
                                                                            switch ($don_hang['trang_thai_don_hang']) {
                                                                                case 'pending':
                                                                                    echo '<span class="badge bg-warning">Chờ xác nhận</span>';
                                                                                    break;
                                                                                case 'processing':
                                                                                    echo '<span class="badge bg-primary">Đang xử lý</span>';
                                                                                    break;
                                                                                case 'shipped':
                                                                                    echo '<span class="badge bg-info">Đang giao</span>';
                                                                                    break;
                                                                                case 'delivered':
                                                                                    echo '<span class="badge bg-success">Hoàn thành</span>';
                                                                                    break;
                                                                                case 'canceled':
                                                                                    echo '<span class="badge bg-danger">Đã hủy</span>';
                                                                                    break;
                                                                                default:
                                                                                    echo '<span class="badge bg-secondary">Không rõ</span>';
                                                                                    break;
                                                                            }

                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <a href="<?= BASE_URL . '?act=chi-tiet-don-hang&id=' . $don_hang['id'] ?>" class="btn btn-sm btn-primary">
                                                                                <i class="fas fa-eye"></i> Xem
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="alert alert-warning" role="alert">
                                                        <i class="fas fa-exclamation-triangle"></i> Bạn chưa có đơn hàng nào.
                                                    </div>
                                                    <a href="<?= BASE_URL . '?act=allsanpham' ?>" class="btn btn-outline-primary">
                                                        <i class="fas fa-shopping-bag"></i> Mua sắm ngay
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade <?= isset($_GET['tab']) && $_GET['tab'] == 'account-info' ? 'show active' : '' ?>" id="account-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <div class="account-details-form">
                                                    <form action="<?= BASE_URL . '?act=thaydoithongtintaikhoan' ?>" method="POST" enctype="multipart/form-data">
                                                        <?php if (isset($_SESSION['complete'])) { ?>
                                                            <div class="alert alert-success alert-dismissable">
                                                                <a class="panel-close close" data-dismiss="alert">×</a>
                                                                <i class="fa fa-coffee"></i>
                                                                <?= $_SESSION['complete'] ?>
                                                            </div>
                                                        <?php } ?>
                                                        <?php unset($_SESSION['complete']); ?>

                                                        <div class="container">
                                                            <div class="col-lg-12">
                                                                <div class="checkout-billing-details-wrap">
                                                                    <div class="billing-form-wrap mt-3">
                                                                        <div class="single-input-item">
                                                                            <label for="ho_ten">Họ và tên</label>
                                                                            <input type="text" placeholder="Tên đăng nhập" name="ho_ten"
                                                                                value="<?= $TKById['ho_ten'] ?>"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="single-input-item">
                                                                            <label for="email">Email</label>
                                                                            <input type="email" placeholder="email@gmail.com" name="email"
                                                                                value="<?= $TKById['email'] ?>"
                                                                                readonly>

                                                                        </div>
                                                                        <div class="single-input-item">
                                                                            <label for="mat_khau">Mật khẩu</label>
                                                                            <input type="password" placeholder="Mật khẩu" name="mat_khau"
                                                                                value="<?= $TKById['mat_khau'] ?>"
                                                                                readonly>

                                                                        </div>
                                                                        <div class="single-input-item">
                                                                            <label for="sdt">Số điện thoại</label>
                                                                            <input type="text" placeholder="Số điện thoại" name="so_dien_thoai"
                                                                                value="<?= $TKById['so_dien_thoai'] ?>"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="single-input-item">
                                                                            <label for="dia_chi">Địa chỉ nơi trốn</label>
                                                                            <input type="text" placeholder="Địa chỉ nơi trốn" name="dia_chi"
                                                                                value="<?= $TKById['dia_chi'] ?>"
                                                                                readonly>
                                                                        </div>


                                                                        <div class="checkout-box-wrap">
                                                                            <div class="single-input-item">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="ship_to_different">
                                                                                    <label class="custom-control-label" for="ship_to_different">Sửa thông tin?</label>
                                                                                </div>
                                                                            </div>
                                                                            <form action="<?= BASE_URL . '?act=thaydoithongtintaikhoan&tab=account-info' ?>" method="POST" enctype="multipart/form-data">
                                                                                <div class="ship-to-different single-form-row">
                                                                                    <div class="billing-form-wrap mt-3">
                                                                                        <div class="single-input-item">
                                                                                            <label for="ho_ten">Họ và tên</label>
                                                                                            <input type="text" placeholder="Tên đăng nhập" name="ho_ten"
                                                                                                value="<?= $TKById['ho_ten'] ?>">
                                                                                            <input type="hidden" name="id" value="<?= $TKById['id'] ?>">
                                                                                        </div>
                                                                                        <div class="single-input-item">
                                                                                            <label for="email">Email</label>
                                                                                            <input type="email" placeholder="email@gmail.com" name="email"
                                                                                                value="<?= $TKById['email'] ?>">

                                                                                        </div>
                                                                                        <div class="single-input-item">
                                                                                            <label for="mat_khau">Mật khẩu</label>
                                                                                            <input type="text" placeholder="email@gmail.com" name="mat_khau"
                                                                                                value="<?= $TKById['mat_khau'] ?>">

                                                                                        </div>
                                                                                        <div class="single-input-item">
                                                                                            <label for="sdt">Số điện thoại</label>
                                                                                            <input type="text" placeholder="Số điện thoại" name="so_dien_thoai"
                                                                                                value="<?= $TKById['so_dien_thoai'] ?>">
                                                                                        </div>
                                                                                        <div class="single-input-item">
                                                                                            <label for="dia_chi">Địa chỉ nơi trốn</label>
                                                                                            <input type="text" placeholder="Địa chỉ nơi trốn" name="dia_chi"
                                                                                                value="<?= $TKById['dia_chi'] ?>">
                                                                                        </div>
                                                                                        <div class="single-input-item">
                                                                                            <input type="hidden" name="role" value="<?= $TKById['role'] ?>">
                                                                                            <button type="submit" class="btn btn-sqr">Lưu thay đổi</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once 'views/layout/footer.php'; ?>
<?php require_once 'layout/miniCart.php'; ?>