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
			<h1 class="mb-3"><?= $judul_halaman ?></h1>
			<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambah">
				Tambah <i class="bi-pencil-square"></i>
			</button>
			<div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Pilih Pelanggan</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form class="row g-3" method="post" action="<?= base_url('admin/pelanggan/update')?>">
								<input type="hidden" name="id_pelanggan">
								<div class="col-12">
									<label for="inputNanme4" class="form-label">Nama Produk</label>
									<table class="table datatable">
										<thead>
											<tr>
												<th scope="col">Name</th>
												<th scope="col">alamat</th>
												<th scope="col">Telephone</th>
												<th scope="col">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($pelanggan as $pelanggan){ ?>
											<tr>
												<td><?= $pelanggan['nama']?></td>
												<td><?= $pelanggan['alamat']?></td>
												<td><?= $pelanggan['telp']?></td>
												<td>
													<a class="btn btn-primary"
														href="<?= base_url('admin/penjualan/transaksi/'.$pelanggan['id_pelanggan']) ?>">
														<i class="ri-account-pin-circle-fill"></i> Pilih</a>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary"
										data-bs-dismiss="modal">Close</button>
									<!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
								</div>
						</div>
						</form>
					</div>
				</div>
			</div>
			<table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nota</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">AKsi</th>
                  </tr>
                </thead>
                <tbody>
					
					<?php $no = 1; foreach($penjualan as $p){?>
					<tr>
						<td><?= $no++;?></td>
						<td><?= $p['kode_penjualan']?></td>
						<td><?= $p['nama']?></td>
						<td><?= $p['tanggal']?></td>
						<td><?= number_format($p['total_harga']) ?></td>
						<td>
						<a class="btn btn-primary"
						href="<?= base_url('admin/penjualan/invoice/'.$p['kode_penjualan']) ?>">
						<i class="ri-account-pin-circle-fill"></i> Pilih</a>
						<a onClick="return confirm('apakah yakin untuk hapus data user')" class="btn btn-danger" href="<?= base_url('admin/penjualan/delete_penjualan/'.$p['id_penjualan']) ?>"><i class="ri-delete-bin-6-fill"></i> delete</a>
						</td>
					</tr>
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

