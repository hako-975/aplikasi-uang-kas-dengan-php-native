<?php 
  $dataUser = dataUser();
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="assets/img/img_properties/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">UANG KAS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
          <a href="profile.php" class="nav-link"><i class="nav-icon fas fa-fw fa-user"></i> <p><?= $dataUser['username']; ?></p></a>
        </li>
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="index.php" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <?php if ($dataUser['id_jabatan'] == '1'): ?>
          <li class="nav-item">
            <a href="jabatan.php" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Jabatan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="user.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User
              </p>
            </a>
          </li>
        <?php endif ?>
        <li class="nav-item">
          <a href="siswa.php" class="nav-link">
            <i class="fas fa-user-tie nav-icon"></i>
            <p>Siswa</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="uang_kas.php" class="nav-link">
            <i class="fas fa-dollar-sign nav-icon"></i>
            <p>Uang Kas</p>
          </a>
        </li>
        <div class="dropdown-divider"></div>
        <li class="nav-item">
          <a href="riwayat.php" class="nav-link">
            <i class="fas fa-stopwatch nav-icon"></i>
            <p>Riwayat Uang Kas</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>