<?php 
  require 'connection.php';
  checkLogin();
  $riwayat = mysqli_query($conn, "SELECT * FROM riwayat INNER JOIN user ON riwayat.id_user = user.id_user INNER JOIN uang_kas ON riwayat.id_uang_kas = uang_kas.id_uang_kas INNER JOIN siswa ON uang_kas.id_siswa = siswa.id_siswa INNER JOIN bulan_pembayaran ON uang_kas.id_bulan_pembayaran = bulan_pembayaran.id_bulan_pembayaran ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <?php include 'include/css.php'; ?>
  <title>Riwayat Uang Kas</title>
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
            <h1 class="m-0 text-dark">Riwayat Uang Kas</h1>
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
                <th>Nama Siswa</th>
                <th>Nama Bulan & Tahun</th>
                <th>Username</th>
                <th>Pesan</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($riwayat as $dr): ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= ucwords($dr['nama_siswa']); ?></td>
                  <td><?= ucwords($dr['nama_bulan']); ?> | <?= $dr['tahun']; ?></td>
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
