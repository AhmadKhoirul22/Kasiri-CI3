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
			<h1 class="mb-3"><?= $card_title ?></h1>
			<?php if($this->session->userdata('level')=='Admin') { ?>
			<h3 class="card-title"><?= $head?></h3>
			<form class="row g-3 mb-5" method="post" action="<?= base_url('admin/produk/tambah')?>">
				<div class="col-md-12">
					<label for="inputEmail5" class="form-label">Nama</label>
					<input type="text" name="nama" class="form-control" id="inputEmail5">
				</div>
				<div class="col-12">
					<label for="inputAddress5" class="form-label">Stok</label>
					<input type="number" class="form-control" name="stok">
				</div>
				<div class="col-12">
					<label for="inputAddress5" class="form-label">Harga</label>
					<input type="number" class="form-control" name="harga">
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-secondary">Reset</button>
				</div>
			</form>
			<?php } ?>
			<!-- table -->
			<h2 class="card-title">Table Produk</h2>
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                Excel Import
            </button>
			<a href="<?= base_url('admin/produk/cetak_excel')?>" class="btn btn-warning">Excel Export</a>
			<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Excel</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
					<form action="<?= base_url('admin/produk/excel')?>" enctype="multipart/form-data" method="post">
					<div class="col-12">
						<label for="inputNanme4" class="form-label">File Excel</label>
						<input type="file" name="upload_excel" class="form-control" id="inputNanme4">
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
		</div>
		<div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
			<div class="datatable-top">
			</div>
			<div class="datatable-container">
				<table class="table datatable">
					<thead>
						<tr>
							<th data-sortable="true"><button>#</button></th>
							<th data-sortable="true"><button>Nama Produk</button></th>
							<th data-sortable="true"><button>Kode Produk</button></th>
             				<th data-sortable="true"><button>Stok</button></th>    
							<th data-sortable="true"><button>Harga</button></th>
							<th data-sortable="true"><button>Jumlah Penjualan</button></th>
              				<th ><button>Aksi</button></th>
            </tr>
					</thead>
					<tbody>
            <?php $no=1; foreach($produk as $produk){?>
						<tr data-index="0">
              <td><?= $no++;?></td>
              <td><?= $produk['nama']?></td>
              <td><?= $produk['kode_produk']?></td>
              <td><?= $produk['stok']?></td>
              <td><?= $produk['harga']?></td>
              <td>
              <?php
                          $found = false;
                          foreach ($penjualan_terbanyak as $penjualan) {
                              if ($penjualan['kode_produk'] == $produk['kode_produk']) {
                                  echo $penjualan['total_penjualan'];
                                  $found = true;
                                  break;
                              }
                          }
                          if (!$found) {
                              echo '0';
                          }
                    ?>
                    Terjual
              </td>
              <td>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal"
								data-bs-target="#edit<?= $produk['id_produk']?>">
								edit <i class="bi-pencil-square"></i>
							</button>
							<a onClick="return confirm('apakah yakin untuk hapus data pemasukan')" class="btn btn-danger"
								href="<?= base_url('admin/produk/delete/'.$produk['id_produk']) ?>"><i class="ri-delete-bin-6-fill"></i>
								delete</a>
							<div class="modal fade" id="edit<?= $produk['id_produk']?>" tabindex="-1" aria-hidden="true"
								style="display: none;">
								<div class="modal-dialog">
								<form class="row g-3" method="post" action="<?= base_url('admin/produk/update')?>">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Update Data Produk</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											
												<input type="hidden" name="id_produk" value="<?= $produk['id_produk']?>">
												<div class="col-12">
													<label for="inputNanme4" class="form-label">Nama Produk</label>
													<input type="text" name="nama" class="form-control" id="inputNanme4"
														value="<?= $produk['nama']?>">
												</div>
												<div class="col-12">
													<label for="inputEmail4" class="form-label">Kode Produk</label>
													<input type="text" name="kode_produk" class="form-control" id="inputEmail4"
														value="<?= $produk['kode_produk']?>" readonly>
												</div>
												<div class="col-12">
													<label for="inputEmail4" class="form-label">Stok</label>
													<input type="text" name="stok" class="form-control" id="inputEmail4"
														value="<?= $produk['stok']?>">
												</div>
												<div class="col-12">
													<label for="inputEmail4" class="form-label">Harga</label>
													<input type="text" name="harga" class="form-control" id="inputEmail4"
														value="<?= $produk['harga']?>">
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
              </td>
						</tr> 
            <?php } ?>
					</tbody>
				</table>
			</div>
			<!-- <div class="datatable-bottom">
				<div class="datatable-info">Showing 1 to 5 of 5 entries</div>
				<nav class="datatable-pagination">
					<ul class="datatable-pagination-list"></ul>
				</nav>
			</div> -->
		</div>
    <!-- end -->
	</main><!-- End #main -->

	<!-- ======= Footer ======= -->
	<?php require_once('layout-dashboard/_footer.php') ?>
	<!-- End Footer -->
	<!-- Vendor JS Files -->
	<?php require_once('layout-dashboard/_js.php') ?>

</body>

</html>
<!-- <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            new DataTable('#myDataTable');
        });
</script> -->
