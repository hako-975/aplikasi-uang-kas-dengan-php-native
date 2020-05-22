<?php 
  require 'connection.php';
  checkLogin();
  $jabatan = mysqli_query($conn, "SELECT * FROM jabatan");
  if (isset($_POST['btnEditJabatan'])) {
    if (editJabatan($_POST) > 0) {
      setAlert("Jabatan has been changed", "Successfully changed", "success");
      header("Location: jabatan.php");
    }
  }

  if (isset($_POST['btnTambahJabatan'])) {
    if (addJabatan($_POST) > 0) {
      setAlert("Jabatan has been added", "Successfully added", "success");
      header("Location: jabatan.php");
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <?php include 'include/css.php'; ?>
  <title>Jabatan</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  
  <?php include 'include/navbar.php'; ?>

  <?php include 'include/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row justify-content-center mb-2">
          <div class="col-sm text-left">
            <h1 class="m-0 text-dark">Jabatan</h1>
          </div><!-- /.col -->
          <div class="col-sm text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahJabatanModal"><i class="fas fa-fw fa-plus"></i> Tambah Jabatan</button>
            <!-- Modal -->
            <div class="modal fade text-left" id="tambahJabatanModal" tabindex="-1" role="dialog" aria-labelledby="tambahJabatanModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="post">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="tambahJabatanModalLabel">Tambah Jabatan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                      <button type="submit" class="btn btn-primary" name="btnTambahJabatan"><i class="fas fa-fw fa-save"></i> Save</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg">
            <div class="table-responsive">
              <table class="table table-striped table-hover table-bordered" id="table_id">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($jabatan as $dj): ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $dj['nama_jabatan']; ?></td>
                      <td>
                        <?php if ($dj['id_jabatan'] !== '1'): ?>
                          <!-- Button trigger modal -->
                          <a href="ubah_jabatan.php?id_jabatan=<?= $dj['id_jabatan']; ?>" class="badge badge-success" data-toggle="modal" data-target="#editJabatanModal<?= $dj['id_jabatan']; ?>">
                            <i class="fas fa-fw fa-edit"></i> Ubah
                          </a>
                          <!-- Modal -->
                          <div class="modal fade" id="editJabatanModal<?= $dj['id_jabatan']; ?>" tabindex="-1" role="dialog" aria-labelledby="editJabatanModalLabel<?= $dj['id_jabatan']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form method="post">
                                <input type="hidden" name="id_jabatan" value="<?= $dj['id_jabatan']; ?>">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editJabatanModalLabel<?= $dj['id_jabatan']; ?>">Ubah Jabatan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label for="nama_jabatan<?= $dj['id_jabatan']; ?>">Nama Jabatan</label>
                                      <input type="text" name="nama_jabatan" id="nama_jabatan<?= $dj['id_jabatan']; ?>" class="form-control" value="<?= $dj['nama_jabatan']; ?>">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                                    <button type="submit" name="btnEditJabatan" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          <a data-nama="<?= $dj['nama_jabatan']; ?>" class="btn-delete badge badge-danger" href="hapus_jabatan.php?id_jabatan=<?= $dj['id_jabatan']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                        <?php endif ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 By Andri Firman Saputra.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

</div>
</body>
</html>
