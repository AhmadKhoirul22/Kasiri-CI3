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
			<h1 class="mb-3">Dashboard</h1>
			<div class="row">
				<div class="col-xxl-4 col-md-3">
					<div class="card info-card sales-card">
						<div class="card-body">
							<h5 class="card-title">Penjualan <small>| hari ini</small> </h5>

							<div class="d-flex align-items-center">
								<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
									<i class="bi bi-bag-dash-fill"></i>
								</div>
								<div class="ps-3">
									<h6>Rp <?= number_format($this->Penjualan_model->penjualan_today())?></h6>
									<!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="col-xxl-4 col-md-3">
					<div class="card info-card sales-card">
						<div class="card-body">
							<h5 class="card-title">Penjualan <small>| bulan ini</small> </h5>

							<div class="d-flex align-items-center">
								<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
									<i class="bi bi-currency-exchange"></i>
								</div>
								<div class="ps-3">
									<h6>Rp <?= number_format($this->Penjualan_model->penjualan_bulan_ini())?></h6>
									<!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="col-xxl-4 col-md-3">
					<div class="card info-card sales-card">
						<div class="card-body">
							<h5 class="card-title">Transaksi <small>| Hari ini</small> </h5>

							<div class="d-flex align-items-center">
								<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
									<i class="bi bi-bag-check"></i>
								</div>
								<div class="ps-3">
									<h6> <?= $transaksi ?> Penjualan</h6>
									<!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="col-xxl-4 col-md-3">
					<div class="card info-card sales-card">
						<div class="card-body">
							<h5 class="card-title">Produk <small></small> </h5>

							<div class="d-flex align-items-center">
								<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
									<i class="bi bi-cart"></i>
								</div>
								<div class="ps-3">
									<h6><?= count($produk) ?> Proudk </h6>
									<!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

								</div>
							</div>
						</div>

					</div>
				</div>


				<div class="col-xxl-4 col-xl-12">

					<div class="card info-card customers-card">



						<div class="card-body">
							<h5 class="card-title">Pelanggan <span></span></h5>

							<div class="d-flex align-items-center">
								<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
									<i class="bi bi-people"></i>
								</div>
								<div class="ps-3">
									<h6><?= count($pelanggan)?></h6>
									<!-- <span class="text-danger small pt-1 fw-bold">12%</span> <span
										class="text-muted small pt-2 ps-1">decrease</span> -->

								</div>
							</div>

						</div>
					</div>

				</div>

			<div class="col-xxl-4 col-xl-6">
				<div class="card">
					<h5 class="card-title text-center">Grafik Penjualan 5 Bulan Terakhir</h5>
					<div class="card-body">
						<?php
							date_default_timezone_set("Asia/Jakarta");
							$nama_now = date('M');
							$nama_1 = date('M', strtotime("-1 Months"));
							$nama_2 = date('M', strtotime("-2 Months"));
							$nama_3 = date('M', strtotime("-3 Months"));
							$nama_4 = date('M', strtotime("-4 Months"));
							$nama_5 = date('M', strtotime("-5 Months"));

							$tanggal = date('Y-m', strtotime("-1 Months"));
							$this->db->select('sum(total_harga) as total');
							$this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
							$bulan_1 = $this->db->get()->row()->total;

							$tanggal = date('Y-m', strtotime("-2 Months"));
							$this->db->select('sum(total_harga) as total');
							$this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
							$bulan_2 = $this->db->get()->row()->total;

							$tanggal = date('Y-m', strtotime("-3 Months"));
							$this->db->select('sum(total_harga) as total');
							$this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
							$bulan_3 = $this->db->get()->row()->total;

							$tanggal = date('Y-m', strtotime("-4 Months"));
							$this->db->select('sum(total_harga) as total');
							$this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
							$bulan_4 = $this->db->get()->row()->total;

							$tanggal = date('Y-m', strtotime("-5 Months"));
							$this->db->select('sum(total_harga) as total');
							$this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
							$bulan_5 = $this->db->get()->row()->total;

							if($bulan_1==null){ $bulan_1=0; }
							if($bulan_2==null){ $bulan_2=0; }
							if($bulan_3==null){ $bulan_3=0; }
							if($bulan_4==null){ $bulan_4=0; }
							if($bulan_5==null){ $bulan_5=0; }

							?>
						<canvas id="barChart"
							style="max-height: 400px; display: block; box-sizing: border-box; height: 133px; width: 266px;"
							width="532" height="266"></canvas>
						<script>
							document.addEventListener("DOMContentLoaded", () => {
								new Chart(document.querySelector('#barChart'), {
									type: 'bar',
									data: {
										labels: ['<?= $nama_5; ?>', '<?= $nama_4; ?>', '<?= $nama_3; ?>', '<?= $nama_2; ?>',
											'<?= $nama_1; ?>', '<?= $nama_now; ?>'
										],
										datasets: [{
											label: 'Grafik Penjualan',
											data: [<?= $bulan_5; ?>,<?= $bulan_4; ?>,<?= $bulan_3; ?>,<?= $bulan_2; ?>,<?= $bulan_1; ?>,<?= $this->Penjualan_model->penjualan_bulan_ini();?>],
											backgroundColor: [
												'rgba(255, 99, 132, 0.2)',
												'rgba(255, 159, 64, 0.2)',
												'rgba(255, 205, 86, 0.2)',
												'rgba(75, 192, 192, 0.2)',
												'rgba(54, 162, 235, 0.2)',
												'rgba(153, 102, 255, 0.2)',
												'rgba(201, 203, 207, 0.2)'
											],
											borderColor: [
												'rgb(255, 99, 132)',
												'rgb(255, 159, 64)',
												'rgb(255, 205, 86)',
												'rgb(75, 192, 192)',
												'rgb(54, 162, 235)',
												'rgb(153, 102, 255)',
												'rgb(201, 203, 207)'
											],
											borderWidth: 1
										}]
									},
									options: {
										scales: {
											y: {
												beginAtZero: true
											}
										}
									}
								});
							});
						</script>
					</div>
				</div>
			</div>

		<div class="col-lg-5">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Aktivitas Belanja <span>| Terbaru</span></h5>
              <div class="activity">
				<?php foreach($activity as $aktivitas) { ?>
                <div class="activity-item d-flex">
                  <div class="activite-label"><?= $aktivitas['tanggal']?></div>
                  <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
                  <div class="activity-content">
                    <a href="<?= base_url('admin/penjualan/invoice/'.$aktivitas['kode_penjualan'])?>"><?= $aktivitas['nama']?> </a>
                  </div>
                </div><!-- End activity item-->
				<?php } ?>
              </div>
            </div>
          </div><!-- End Recent Activity -->
        </div>

		<div class="col-lg-6">
		<div class="card">
            <div class="card-body">
              <h5 class="card-title">Penjualan <span>| produk terbanyak</span></h5>
			  <?php foreach($penjualan_terbanyak as $ter){?>
              <div class="activity">
                <div class="activity-item d-flex">
                  <div class="activite-label">(<?= $ter['kode_produk']?>) | </div>
                  <!-- <i class="bi bi-circle-fill activity-badge text-primary align-self-start"></i> -->
                  <div class="activity-content">
                    <?= $ter['nama']?> <?= $ter['total_penjualan']?> Penjualan <br>
                  </div>
                </div><!-- End activity item-->
              </div>
			  <?php } ?>
            </div>
          </div>
		</div>
		<!-- praktik -->
		<div class="col-lg-6">
			<?php
			$this->db->from('suara');
			$nama = $this->db->get()->row();
			$no1 = $nama->suara_no1_2;
			$no2 = $nama->suara_no2_2;
			$no3 = $nama->suara_no3_2;
			?>
			<div class="card">
				<div class="card-body">
				<canvas id="suara" style="max-height: 400px; display: block; box-sizing: border-box; height: 133px; width: 266px;" width="532" height="266"></canvas>
				</div>
				<script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#suara'), {
                    type: 'bar',
                    data: {
                      labels: ['suara no 1', 'suara no 2', 'suara no 3'],
                      datasets: [{
                        label: 'Suara Pemilihan',
                        data: [<?= $no1?>, <?= $no2?>, <?= $no3?>],
                        backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(255, 159, 64, 0.2)',
                          'rgba(255, 205, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                          'rgb(255, 99, 132)',
                          'rgb(255, 159, 64)',
                          'rgb(255, 205, 86)',
                          'rgb(75, 192, 192)',
                          'rgb(54, 162, 235)',
                          'rgb(153, 102, 255)',
                          'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>
			</div>
		</div>
		<!-- end praktik -->

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
