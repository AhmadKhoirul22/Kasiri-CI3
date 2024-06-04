<?php $menu = $this->uri->segment(2); ?>
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item <?php if($menu=='home'){ echo 'active'; }?>">
        <a class="nav-link collapsed" href="<?= base_url('admin/home')?>">
          <i class="bi bi-house-door-fill"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->   
      <?php if($this->session->userdata('level')=='Admin') { ?> 
      <li class="nav-item <?php if($menu=='user'){ echo 'active'; }?>">
        <a class="nav-link collapsed" href="<?= base_url('admin/user') ?>">
          <i class="ri-map-pin-user-line"></i><span>User</span>
        </a>
      </li>
      <?php } ?>
      <li class="nav-item <?php if($menu=='pelanggan'){ echo 'active'; }?>">
        <a class="nav-link collapsed" href="<?= base_url('admin/pelanggan') ?>">
          <i class="bi bi-person-fill"></i><span>Pelanggan</span>
        </a>
      </li>
      <li class="nav-item <?php if($menu=='produk'){ echo 'active'; }?>">
        <a class="nav-link collapsed" href="<?= base_url('admin/produk') ?>">
          <i class="bi bi-basket-fill"></i><span>Produk</span>
        </a>
      </li>
      <li class="nav-item <?php if($menu=='penjualan'){ echo 'active'; }?>">
        <a class="nav-link collapsed" href="<?= base_url('admin/penjualan') ?>">
          <i class="bi bi-bag-check-fill"></i><span>penjualan</span>
        </a>
      </li>
      <?php if($this->session->userdata('level')=='Admin') { ?> 
      <li class="nav-item <?php if($menu=='profile'){ echo 'active'; }?>">
        <a class="nav-link collapsed" href="<?= base_url('admin/profile') ?>">
          <i class="bi bi-controller"></i><span>profile</span>
        </a>
      </li>
      <?php } ?>
			<li class="nav-item <?php if($menu=='suara'){ echo 'active'; }?>">
        <a class="nav-link collapsed" href="<?= base_url('admin/suara') ?>">
          <i class="bi bi-bag-check-fill"></i><span>suara</span>
        </a>
      </li>
    </ul>
  </aside>
