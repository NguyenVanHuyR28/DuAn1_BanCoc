<?php
include './views/layouts/header.php';
include './views/layouts/navbar.php';
include './views/layouts/slidebar.php';
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sửa tài khoản</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form </h3>
                        </div>
                        <form action="<?= BASE_URL_ADMIN . '?act=postEditTaiKhoan'  ?>" method="POST"
                            enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $taiKhoan['id'] ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Họ tên</label>
                                    <input type="text" class="form-control" name="ho_ten"
                                        value="<?= $taiKhoan['ho_ten'] ?>" placeholder="Mời nhập tên">
                                    <?php if (isset($_SESSION['error']['ho_ten'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>

                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email"
                                        value="<?= $taiKhoan['email'] ?>" placeholder="Mời nhập email">
                                    <?php if (isset($_SESSION['error']['email'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>

                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" name="so_dien_thoai"
                                        value="<?= $taiKhoan['so_dien_thoai'] ?>" readonly>
                                    <?php if (isset($_SESSION['error']['so_dien_thoai'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>

                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="dia_chi"
                                        value="<?= $taiKhoan['dia_chi'] ?>" placeholder="Mời nhập địa chỉ">
                                    <?php if (isset($_SESSION['error']['dia_chi'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['dia_chi'] ?></p>

                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Chức vụ</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="admin" value="1"
                                            <?php echo $taiKhoan['role'] == 1 ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="admin">Admin</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="khach" value="0"
                                            <?php echo $taiKhoan['role'] == 0 ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="khach">Khách hàng</label>
                                    </div>
                                    <?php if (isset($_SESSION['error']['role'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['role'] ?></p>
                                    <?php } ?>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php
// include './views/layouts/footer.php';
?>
</body>

</html>