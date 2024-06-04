<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title><?= $title?></title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<!-- css -->
	<?php require_once('layout-dashboard/_css.php') ?>
	<!-- /css  -->
</head>

<body>
	<!-- ======= Header ======= -->
	<?php require_once('layout-dashboard/_header.php') ?>
	<!-- End Header -->
	<!-- ======= Sidebar ======= -->
	<?php require_once('layout-dashboard/_sidebar.php') ?>
	<!-- End Sidebar-->
	<!-- main -->
	<main id="main" class="main">
		<div class="pagetitle">
    <div id="autohide">
         <?= $this->session->flashdata('alert') ?> 
    </div>
    <div class="card">
      <div class="card-body">
			<h1 class="mb-3"><?= $h2?></h1>  
        <h3 class="card-title">User</h3>
      <form class="row g-3 mb-5" method="post" action="<?= base_url('admin/user/tambah')?>">
                <div class="col-md-12">
                  <label for="inputName5" class="form-label">Nama</label>
                  <input type="text" class="form-control" name="nama" id="inputName5">
                </div>
                <div class="col-md-12">
                  <label for="inputEmail5" class="form-label">Username</label>
                  <input type="text" name="username" class="form-control" id="inputEmail5">
                </div>
                <div class="col-12">
                  <label for="inputAddress5" class="form-label">Level</label>
                  <select name="level" class="form-control" id="">
                    <option value="Admin">Admin</option>
                    <!-- <option value="Pelanggan">Pelanggan</option> -->
                    <option value="Kasir">Kasir</option>
                  </select>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
       </form>
       </div>
       </div>
       <!-- table -->
       <div class="card">
       <div class="card-body">
       <h2 class="card-title">Table User</h2>
       <table class="table datatable">
                <thead>
                  <tr>
                    
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Level</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($user as $user){ ?>
                  <tr>
                    
                    <td><?= $user['nama']?></td>
                    <td><?= $user['username']?></td>
                    <td><?= $user['level']?></td>
                    <td>
                    <a href="<?= base_url('admin/user/reset/'.$user['id_user'])?>" class="btn btn-warning"><i class="ri-donut-chart-line"></i> Reset Password</a>  
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $user['id_user']?>">
                        edit <i class="bi-pencil-square"></i>
                    </button>
                      <a onClick="return confirm('apakah yakin untuk hapus data user')" class="btn btn-danger" href="<?= base_url('admin/user/delete/'.$user['id_user']) ?>"><i class="ri-delete-bin-6-fill"></i> delete</a>
                    </td>
                  </tr>
                  <div class="modal fade" id="edit<?= $user['id_user']?>" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Update User</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form class="row g-3" method="post" action="<?= base_url('admin/user/update')?>">
                    <input type="hidden" name="id_user" value="<?= $user['id_user']?>">
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Username</label>
                  <input type="text" name="username" class="form-control" id="inputNanme4" value="<?= $user['username']?>">
                </div>
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="inputNanme4">
                </div>
                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Nama</label>
                  <input type="text" name="nama" class="form-control" id="inputEmail4" value="<?= $user['nama']?>">
                </div>
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Level</label>
                  <select name="level" class="form-control">
                     <option value="Admin"<?php if($user['level']=='Admin'){echo "selected";}?>>Admin</option>
                     <!-- <option value="Pelanggan"<?php if($user['level']=='Pelanggan'){echo "selected";}?>>Pelanggan</option> -->
                     <option value="Kasir"<?php if($user['level']=='Kasir'){echo "selected";}?>>Kasir</option>
                  </select>
                </div>
              
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
                  <?php } ?>
                </tbody>
              </table>
              </div>
              </div>
       <!-- table -->
		</div>
	</main><!-- End #main -->

	<!-- ======= Footer ======= -->
	<?php require_once('layout-dashboard/_footer.php') ?>
	<!-- End Footer -->
	<!-- Vendor JS Files -->
	<?php require_once('layout-dashboard/_js.php') ?>

</body>

</html>