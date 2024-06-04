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
					<!-- <h1 class="mb-3"><?= $h2?></h1> -->
					<h3 class="card-title">Suara</h3>
					<form class="row g-3 mb-5" method="post" action="<?= base_url('admin/suara/tambah')?>">
						<div class="col-md-12">
							<label for="inputName5" class="form-label">Total Suara</label>
							<input type="text" class="form-control" name="total_suara_2" id="inputName5">
						</div>
						<div class="col-md-12">
							<label for="inputEmail5" class="form-label">Suara Sah</label>
							<input type="text" name="total_suara_sah_2" class="form-control" id="inputEmail5">
						</div>
						<div class="col-md-12">
							<label for="inputEmail5" class="form-label">Suara Tidak Sah</label>
							<input type="text" name="total_suara_tidaksah_2" class="form-control" id="inputEmail5">
						</div>
						<div class="col-md-12">
							<label for="inputEmail5" class="form-label">No 1</label>
							<input type="number" name="suara_no1_2" class="form-control" id="inputEmail5">
						</div>
						<div class="col-md-12">
							<label for="inputEmail5" class="form-label">No 2</label>
							<input type="number" name="suara_no2_2" class="form-control" id="inputEmail5">
						</div><div class="col-md-12">
							<label for="inputEmail5" class="form-label">No 3</label>
							<input type="number" name="suara_no3_2" class="form-control" id="inputEmail5">
						</div><div class="col-md-12">
							<label for="inputEmail5" class="form-label">Nama TPS</label>
							<input type="text" name="nama_tps" class="form-control" id="inputEmail5">
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary">Submit</button>
							<button type="reset" class="btn btn-secondary">Reset</button>
						</div>
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
