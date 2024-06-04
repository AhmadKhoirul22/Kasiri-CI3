<html>
    <head>
    <?= require_once('admin/layout-dashboard/_css.php')?>
    </head>
    <body>
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
											<?php $total = 0; $no = 1; foreach($detail as $detail) { ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $detail['kode_produk']?></td>
												<td><?= $detail['nama']?></td>
												<td><?= $detail['jumlah']?></td>
												<td><?= number_format($detail['harga'], 0, ',', '.') ?></td>
												<td><?= number_format($detail['sub_total'], 0, ',', '.') ?></td>
											</tr>
											<?php $total=$total+$detail['jumlah']*$detail['harga']; } ?>
											<tr>
												<td colspan="5">Total Harga</td>
												<td><?= number_format($total, 0, ',', '.') ?></td>
											</tr>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main><!-- End #main -->
    </body>
</html>

