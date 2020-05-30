<?php 
  require 'connection.php';
  checkLogin();
  $jml_siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(id_siswa) as jml_siswa FROM siswa"));
  $jml_siswa = $jml_siswa['jml_siswa'];

  $jml_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(id_user) as jml_user FROM user"));
  $jml_user = $jml_user['jml_user'];

  $jml_jabatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(id_jabatan) as jml_jabatan FROM jabatan"));
  $jml_jabatan = $jml_jabatan['jml_jabatan'];

  $jml_pengeluaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sum(jumlah_pengeluaran) as jml_pengeluaran FROM pengeluaran"));
  $jml_pengeluaran = $jml_pengeluaran['jml_pengeluaran'];

  $jml_uang_kas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sum(minggu_ke_1 + minggu_ke_2 + minggu_ke_3 + minggu_ke_4) as jml_uang_kas FROM uang_kas"));
  $jml_uang_kas = $jml_uang_kas['jml_uang_kas'];
?>

<!DOCTYPE html>
<html>
<head>
  <?php include 'include/css.php'; ?>
  <title>Dashboard</title>
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
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <?php if ($_SESSION['id_jabatan'] == '1'): ?>
            <div class="col-lg-3">
              <div class="card shadow">
                <div class="card-body">
                  <h5><i class="fas fa-fw fa-cog"></i> Jabatan</h5>
                  <h6 class="text-muted">Jumlah Jabatan: <?= $jml_jabatan; ?></h6>
                  <a href="jabatan.php" class="btn btn-info"><i class="fas fa-fw fa-align-justify"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="card shadow">
                <div class="card-body">
                  <h5><i class="fas fa-fw fa-users"></i> User</h5>
                  <h6 class="text-muted">Jumlah User: <?= $jml_user; ?></h6>
                  <a href="user.php" class="btn btn-info"><i class="fas fa-fw fa-align-justify"></i></a>
                </div>
              </div>
            </div>
          <?php endif ?>
          <div class="col-lg-3">
            <div class="card shadow">
              <div class="card-body">
                <h5><i class="fas fa-fw fa-user-tie"></i> Siswa</h5>
                <h6 class="text-muted">Jumlah Siswa: <?= $jml_siswa; ?></h6>
                <a href="siswa.php" class="btn btn-info"><i class="fas fa-fw fa-align-justify"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card shadow">
              <div class="card-body">
                <h5><i class="text-danger fas fa-fw fa-caret-down"></i><i class="text-danger fas fa-fw fa-dollar-sign"></i> Pengeluaran</h5>
                <h6 class="text-muted">Jumlah Pengeluaran: Rp. <?= number_format($jml_pengeluaran); ?></h6>
                <a href="pengeluaran.php" class="btn btn-info"><i class="fas fa-fw fa-align-justify"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card shadow">
              <div class="card-body">
                <h5><i class="text-success fas fa-fw fa-caret-up"></i> <i class="text-success fas fa-fw fa-dollar-sign"></i> Uang Kas</h5>
                <h6 class="text-muted">Jumlah Uang Kas: Rp. <?= number_format($jml_uang_kas - $jml_pengeluaran); ?></h6>
                <a href="uang_kas.php" class="btn btn-info"><i class="fas fa-fw fa-align-justify"></i></a>
              </div>
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
