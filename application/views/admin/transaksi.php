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
			<h2 class="card-title">Tambah Penjualan</h2>
			<div id="autohide">
         		<?= $this->session->flashdata('alert') ?> 
   			</div>
			<div class="row">
				<div class="col-md-4">
					<form class="row g-3 mb-5" method="post"
						action="<?= base_url('admin/penjualan/tambah_temp')?>">
						<input type="hidden" name="kode_penjualan" value="<?= $nota;?>">
						<input type="hidden" name="id_pelanggan" value="<?= $id_pelanggan?>">
						<!-- <div class="col-md-12">
							<label for="inputName5" class="form-label">Nota</label>
							<input type="text" class="form-control" value="<?= $nota;?>" readonly>
						</div> -->
						<div class="col-md-12">
							<label for="inputEmail5" class="form-label">Nama Pelangan</label>
							<input type="text" name="nama" value="<?= $nama_pelanggan?>" class="form-control" id="inputEmail5" readonly>
						</div>
						<div class="col-md-12">
							<label for="inputName5" class="form-label">Produk</label>
							<select name="id_produk" select2 class="form-control select2" aria-label="multiple select example">//multiple aria-label="multiple select example"
								<?php foreach($produk as $produk){?>
								<option value="<?= $produk['id_produk']?>"><?= $produk['nama']?> | <?= $produk['kode_produk']?>(<?= $produk['stok']?>)</option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-12">
							<label for="inputEmail5" class="form-label">Jumlah</label>
							<input type="text" name="jumlah" class="form-control" id="inputEmail5">
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>

				<div class="col-md-8">
					<!-- < class="row g-3 mb-5" method="post"
						action="<?= base_url('admin/penjualan/tambah_keranjang')?>"> -->
						<table class="table datatable">
					<thead>
						<tr>
							<th>no</th>
							<th>kode produk</th>
							<th>produk</th>
							<th>jumlah</th>
							<th>harga</th>
							<th>total</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $total = 0; $cek=0; $no = 1; foreach($temp as $detail) { ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $detail['kode_produk']?></td>
							<td><?= $detail['nama']?></td>
							<td><?= $detail['jumlah']?>
								<?php 
								if($detail['jumlah']>$detail['stok']){
									echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<i class="bi bi-exclamation-octagon me-1"></i>
									Stok Produk Tidak Mencukupii
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>';
									$cek = 1;
								}
								?>
							</td>
							<td><?= number_format($detail['harga'], 0, ',', '.') ?></td>
							<td><?= number_format($detail['jumlah']*$detail['harga'], 0, ',', '.') ?></td>
							<td>
							<a onClick="return confirm('apakah yakin untuk hapus data keranjang')" class="btn btn-danger" href="<?= base_url('admin/penjualan/delete_temp/'.$detail['id_temp'].'/'.$detail['id_produk']) ?>"><i class="ri-delete-bin-6-fill"></i> delete</a>
							</td>
						</tr>
						<?php $total=$total+$detail['jumlah']*$detail['harga']; } ?>
						<tr>
							<td colspan="6">Total Harga</td>
							<td><?= number_format($total, 0, ',', '.') ?></td>
						</tr>
						
					</tbody>
				</table>
					<form action="<?= base_url('admin/penjualan/bayar_temp')?>" method="post">
					<input type="hidden" name="id_pelanggan" value="<?= $id_pelanggan?>">
					<?php if(($temp<>null) and ($cek==0)){?>
						<div class="text-center">
                  			<button type="submit" class="btn btn-primary">Bayar</button>
                		</div>
					<?php } ?>	
					</form>	
				</div>


			</div>



		</div>
	</main><!-- End #main -->

	<!-- ======= Footer ======= -->
	<?php require_once('layout-dashboard/_footer.php') ?>
	<!-- End Footer -->
	<!-- Vendor JS Files -->
	<?php require_once('layout-dashboard/_js.php') ?>

</body>

</html>