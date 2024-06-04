<header id="header" class="header fixed-top d-flex align-items-center">
<?php 
$this->db->from('profile');
$profile = $this->db->get()->row();
?>
<div class="d-flex align-items-center justify-content-between">
  <a href="<?= base_url('home')?>" class="logo d-flex align-items-center">
    <img src="<?= base_url('assets/backend/')?>assets/img/logo.png" alt="">
    <span class="d-none d-lg-block"><?= $profile->nama?></span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<!-- <div class="search-bar">
  <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div> -->
<!-- End Search Bar -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon-->

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="<?= base_url('assets/backend/')?>assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $this->session->userdata('username')?></span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6><?= $this->session->userdata('nama')?></h6>
          <span><?= $this->session->userdata('level')?></span>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <!-- <a class="dropdown-item d-flex align-items-center" href="<?= base_url('auth/profile')?>">
            <i class="ri-map-pin-user-line"></i>
            <span>Detail Profile</span>
          </a> -->
          <a class="dropdown-item d-flex align-items-center" href="<?= base_url('auth/logout')?>">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
          </a>
        </li>
      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->
  </ul>
</nav><!-- End Icons Navigation -->
</header>