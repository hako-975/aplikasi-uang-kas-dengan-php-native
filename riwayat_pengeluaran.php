<?php 
  require 'connection.php';
  checkLogin();
  $riwayat_pengeluaran = mysqli_query($conn, "SELECT * FROM riwayat_pengeluaran INNER JOIN user ON riwayat_pengeluaran.id_user = user.id_user ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <?php include 'include/css.php'; ?>
  <title>Riwayat_pengeluaran Uang Kas</title>
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
        <div class="row mb-2">
          <div class="col-sm">
            <h1 class="m-0 text-dark">Riwayat Pengeluaran Uang Kas</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="table-responsive">
          <table class="table table-striped table-hover" id="table_id">
            <thead>
              <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Pesan</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($riwayat_pengeluaran as $dr): ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $dr['username']; ?></td>
                  <td><?= $dr['aksi']; ?></td>
                  <td><?= date('d-m-Y, H:i:s', $dr['tanggal']); ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
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
