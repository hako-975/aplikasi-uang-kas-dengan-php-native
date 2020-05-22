<?php 
  require 'connection.php';
  checkLogin();
  $jabatan = mysqli_query($conn, "SELECT * FROM jabatan");

  if (isset($_POST['btnEditProfile'])) {
  	if (editUser($_POST) > 0) {
  		setAlert("Your Profile has been changed", "Successfully changed", "success");
		header("Location: profile.php");
  	} else {
  		setAlert("Your Profile failed to change!", "Failed changed!", "error");
		header("Location: profile.php");
  	}
  }
?>

<!DOCTYPE html>
<html>
<head>
  <?php include 'include/css.php'; ?>
  <title>Profile</title>
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
            <h1 class="m-0 text-dark">Profile</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
		  <ul class="list-group list-group-flush">
		    <li class="list-group-item">Nama Lengkap: <?= $dataUser['nama_lengkap']; ?></li>
		    <li class="list-group-item">Username: <?= $dataUser['username']; ?></li>
		    <li class="list-group-item">Jabatan: <?= $dataUser['nama_jabatan']; ?></li>
		  </ul>
		</div>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">
		  <i class="fas fa-fw fa-edit"></i> Edit
		</button>

		<!-- Modal -->
		<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <form method="post">
		    	<div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="form-group">
			        	<label for="nama_lengkap">Nama Lengkap</label>
			        	<input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required value="<?= $dataUser['nama_lengkap']; ?>">
			        </div>
			        <div class="form-group">
			        	<label for="username">Username</label>
	        			<input type="hidden" name="username" id="username" value="<?= $dataUser['username']; ?>">
			        	<input style="cursor: not-allowed;" disabled type="text" name="username" id="username" class="form-control" required value="<?= $dataUser['username']; ?>">
			        </div>
			        <div class="form-group">
			        	<label for="id_jabatan">Jabatan</label>
		        		<?php if ($dataUser['id_jabatan'] == '1'): ?>
		        			<input type="hidden" name="id_jabatan" id="id_jabatan" value="<?= $dataUser['id_jabatan']; ?>">
				        	<input style="cursor: not-allowed;" disabled type="text" class="form-control" required value="<?= $dataUser['nama_jabatan']; ?>">
	        			<?php else: ?>
				        	<select name="id_jabatan" id="id_jabatan" class="form-control">
			        			<?php foreach ($jabatan as $dj): ?>
					        		<option value="<?= $dj['id_jabatan']; ?>"><?= $dj['nama_jabatan']; ?></option>
				        		<?php endforeach ?>
				        	</select>
		        		<?php endif ?>
			        </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
			        <button type="submit" name="btnEditProfile" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
			      </div>
			    </div>
		    </form>
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
