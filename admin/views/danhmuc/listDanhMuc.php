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
                    <h1>Quản lí danh mục sản phẩm</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <a href="<?= BASE_URL_ADMIN . 'form-them-danh-muc'?>">
                            <button class="btn btn-primary">Thêm danh mục</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên danh mục</th>
                                    <th>Mô tả</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($listDanhMuc as $key => $danhMuc) :?>
                                    <tr>
                                        <td><?=$key+1?></td>
                                        <td><?=$danhMuc ['ten_danh_muc'] ?></td>
                                        <td><?=$danhMuc ['mo_ta'] ?></td>
                                        <td>
                                            <a href="<?= BASE_URL_ADMIN . 'formEditDanhMuc&id=' . $danhMuc['id'] ?>">
                                                <button class="btn btn-warning">Sửa</button>
                                            </a>
                                            <a href="<?= BASE_URL_ADMIN . 'deleteDanhMuc&id=' . $danhMuc ['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                <button class="btn btn-danger">Xóa</button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?> 
                            </tbody>
                            <tfoot>
                  </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include './views/layouts/footer.php';
?>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>