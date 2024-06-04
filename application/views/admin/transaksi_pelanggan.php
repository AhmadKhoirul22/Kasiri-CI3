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
       <!-- table -->
       <div class="card">
       <div class="card-body">
       <h2 class="card-title">Table User</h2>
       <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scaope="col">Nama</th>
                    <th scope="col">Kode Penjualan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach($transaksi as $user){ ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $user['nama']?></td>
                    <td><?= $user['kode_penjualan']?></td>
                    <td><?= $user['tanggal']?></td>
                    <td><?= number_format($user['total_harga'])?></td>
                    <td>
                      <a href="<?= base_url('admin/penjualan/invoice/'.$user['kode_penjualan'])?>"><i class="bi bi-sd-card-fill"></i>invoice</a>
                    </td>
                  </tr>
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