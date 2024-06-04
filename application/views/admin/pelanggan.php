<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title><?= $title;?></title>
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
			<h1><?= $h2;?></h1>
      <?php if($this->session->userdata('level')=='Admin') { ?> 
            <h3 class="card-title">Pelanggan</h3>
      <form class="row g-3 mb-5" method="post" action="<?= base_url('admin/pelanggan/tambah')?>">
                <div class="col-md-12">
                  <label for="inputName5" class="form-label">Nama</label>
                  <input type="text" class="form-control" name="nama" id="inputName5">
                </div>
                <div class="col-md-12">
                  <label for="inputEmail5" class="form-label">Alamat</label>
                  <input type="text" name="alamat" class="form-control" id="inputEmail5">
                </div>
                <div class="col-md-12">
                  <label for="inputEmail5" class="form-label">Telephone</label>
                  <input type="text" name="telp" class="form-control" id="inputEmail5">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
       </form>
       </div> 
       </div>
       <?php } ?>
        <!-- table -->
        <h2 class="card-title">Table Pelanggan</h2>
       <table class="table datatable">
                <thead>
                  <tr>
                    
                    <th scope="col">Name</th>
                    <th scope="col">alamat</th>
                    <th scope="col">Telephone</th>
                    <?php if($this->session->userdata('level')=='Admin') { ?> 
                    <th scope="col">Action</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($pelanggan as $pelanggan){ ?>
                  <tr>
                    <td><?= $pelanggan['nama']?></td>
                    <td><?= $pelanggan['alamat']?></td>
                    <td><?= $pelanggan['telp']?></td>
                    <?php if($this->session->userdata('level')=='Admin') { ?> 
                    <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $pelanggan['id_pelanggan']?>">
                        edit <i class="bi-pencil-square"></i>
                    </button>
                      <a class="btn btn-primary" href="<?= base_url('admin/pelanggan/transaksi/'.$pelanggan['id_pelanggan'])?>"><i class="bi bi-cart"></i>Transaksi</a>
                      <a onClick="return confirm('apakah yakin untuk hapus data pelanggan')" class="btn btn-danger" href="<?= base_url('admin/pelanggan/delete/'.$pelanggan['id_pelanggan']) ?>"><i class="ri-delete-bin-6-fill"></i> delete</a>
                    </td>
                  </tr>
                  <div class="modal fade" id="edit<?= $pelanggan['id_pelanggan']?>" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Update Pelanggan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form class="row g-3" method="post" action="<?= base_url('admin/pelanggan/update')?>">
                    <input type="hidden" name="id_pelanggan" value="<?= $pelanggan['id_pelanggan']?>">
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Nama</label>
                  <input type="text" name="nama" class="form-control" id="inputNanme4" value="<?= $pelanggan['nama']?>">
                </div>
                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Alamat</label>
                  <input type="text" name="alamat" class="form-control" id="inputEmail4" value="<?= $pelanggan['alamat']?>">
                </div>
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Telephone</label>
                  <input type="text" name="telp" class="form-control" id="inputEmail4" value="<?= $pelanggan['telp']?>">
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
                  <?php } ?>
                </tbody>
        </table>

		</div>
	</main><!-- End #main -->

	<!-- ======= Footer ======= -->
	<?php require_once('layout-dashboard/_footer.php') ?>
	<!-- End Footer -->
	<!-- Vendor JS Files -->
	<?php require_once('layout-dashboard/_js.php') ?>

</body>

</html>