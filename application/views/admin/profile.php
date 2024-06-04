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
			<h1 class="mb-3"><?= $header ?></h1>
			<form class="row g-3 mb-5" method="post" action="<?= base_url('admin/profile/update')?>">
            <input type="hidden" value="<?= $profile->id_profile?>" name="id_profile">
				<div class="col-md-12">
					<label for="inputName5" class="form-label">Nama</label>
					<input type="text" class="form-control" name="nama" value="<?= $profile->nama?>" id="inputName5">
				</div>
				<div class="col-md-12">
					<label for="inputEmail5" class="form-label">alamat</label>
					<input type="text" name="alamat" class="form-control" value="<?= $profile->alamat?>" id="inputEmail5">
				</div>
                <div class="col-md-12">
					<label for="inputEmail5" class="form-label">email</label>
					<input type="email" name="email" class="form-control" value="<?= $profile->email?>" id="inputEmail5">
				</div>
                <div class="col-md-12">
					<label for="inputEmail5" class="form-label">telephone</label>
					<input type="text" name="telp" class="form-control" value="<?= $profile->telp?>" id="inputEmail5">
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</main>
</body>

</html>