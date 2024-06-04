<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Page of Dashboard</title>
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
			<section class="invoice">
				<div class="card">
					<div class="card-body">
						<!-- title row -->
						<div class="row">
							<div class="col-xs-12">
								<h2 class="page-header">
									<i class="fa fa-openchat"></i> <?= $penjualan->nama ?> <small></small>
								</h2>
							</div>
						</div>
						<div class="row invoice-info">
							<div class="col-md-4">
								from
								<address>
									<strong><?= $profile->nama?></strong> <br>
									<?= $profile->alamat?> <br>
									<?= $profile->telp?> <br>
									<?= $profile->email ?> <br>
								</address>
							</div>
							<div class="col-md-4">
								to
								<address>
									<strong> <?= $penjualan->nama ?> </strong> <br>
									contact : <?= $penjualan->telp ?> <br>
									alamat  : <?= $penjualan->alamat ?><br>
								</address>
							</div>
							<div class="col-md-4">
								<b> #<?= $penjualan->kode_penjualan ?> </b> <br>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<table class="table table-bordered border-primary">
										<thead>
											<tr>
												<th>no</th>
												<th>kode produk</th>
												<th>produk</th>
												<th>jumlah</th>
												<th>harga</th>
												<th>total</th>
											</tr>
										</thead>
										<tbody>
											<?php $total = 0; $no = 1; foreach($detail as $dtl) { ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $dtl['kode_produk']?></td>
												<td><?= $dtl['nama']?></td>
												<td><?= $dtl['jumlah']?></td>
												<td><?= number_format($dtl['harga'], 0, ',', '.') ?></td>
												<td><?= number_format($dtl['sub_total'], 0, ',', '.') ?></td>
											</tr>
											<?php $total=$total+$dtl['jumlah']*$dtl['harga']; } ?>
											<tr>
												<td colspan="5">Total Harga</td>
												<td><?= number_format($total, 0, ',', '.') ?></td>
											</tr>

										</tbody>
									</table>
								</div>
							</div>
                            <div class="row no-print">
                                <div class="col-xs-12">
                                    <a class="btn btn-warning" href="<?= base_url('invoice/'.$penjualan->kode_penjualan)?>"><i class="bi bi-sd-card-fill"></i> Print HTML</a>
                                    <a class="btn btn-danger" href="<?= base_url('admin/laporanpdf/nota/'.$penjualan->kode_penjualan)?>"><i class="bi bi-sd-card-fill"></i> Print PDF</a>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main><!-- End #main -->

	<!-- ======= Footer ======= -->
	<?php require_once('layout-dashboard/_footer.php') ?>
	<!-- End Footer -->
	<!-- Vendor JS Files -->
	<?php require_once('layout-dashboard/_js.php') ?>

</body>

</html>