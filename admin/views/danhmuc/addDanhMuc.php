<?php
include './views/layouts/header.php';
include './views/layouts/navbar.php';
include './views/layouts/slidebar.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm danh mục</h1>
            </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form </h3>
                        </div>

                        <form action="<?= BASE_URL_ADMIN . 'addDanhMuc' ?>" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label>Tên danh mục</label>
                    <input type="text" class="form-control" name="ten_danh_muc"  placeholder="Mời nhập tên danh mục">
                    <?php if(isset($_SESSION['error']['ten_danh_muc'])){ ?>
                        <p class="text-danger"><?= $_SESSION['error']['ten_danh_muc'] ?></p>  
                        
                    <?php } ?>
                  </div>

                  <div class="form-group">
                    <label>Mô tả</label>
                    <textarea name="mo_ta" class="form-control" id="" placeholder="Nhập mô tả"></textarea>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php
include './views/layouts/footer.php';
?>

</div>

