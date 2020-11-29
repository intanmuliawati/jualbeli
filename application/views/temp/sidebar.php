<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-industry"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Jual - Beli</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <?php if ($role_id == 1) { ?>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('admin'); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Home</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('admin/pengaturan_user'); ?>">
        <i class="fas fa-users-cog"></i>
        <span>Pengaturan User</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="far fa-clone"></i>
        <span>Kategori Benang</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Komponen : </h6>
          <a class="collapse-item" href="<?= base_url('jenisbenang'); ?>">Jenis Benang</a>
          <a class="collapse-item" href="<?= base_url('jenisbenang/nobenang'); ?>">No Benang</a>
        </div>
      </div>
    </li>
  <?php } ?>
  <?php if ($role_id == 2) { ?>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('dashboard'); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>    
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('penawaran'); ?>">
        <i class="fas fa-cart-arrow-down"></i>
        <span>Penawaran </span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('keranjang'); ?>">
      <i class="fas fa-shopping-basket"></i>
        <span>Keranjang </span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('pembelian'); ?>">
        <i class="fas fa-history"></i>
        <span>Riwayat Pembelian </span></a>
    </li>
  <?php } ?>
  <?php if ($role_id == 3) { ?>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('gudang'); ?>">
        <i class="fas fa-home"></i>
        <span>Home</span></a>
    </li>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseit" aria-expanded="true" aria-controls="collapseit">
        <i class="fas fa-clipboard-list"></i>
        <span>Perngajuan Pengadaan</span>
      </a>
      <div id="collapseit" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Komponen : </h6>
          <a class="collapse-item" href="<?= base_url('pengajuanpengadaan'); ?>">Pengajuan Pengadaan</a>
          <a class="collapse-item" href="<?= base_url('riwayatpengajuanpengadaan'); ?>">Riwayat Pengajuan</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('informasipengadaan'); ?>">
        <i class="fas fa-info-circle"></i>
        <span>Informasi Pengadaan</span></a>
    </li>
  <?php } ?>
  <?php if ($role_id == 4) { ?>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('pemasok'); ?>">
        <i class="fas fa-home"></i>
        <span>Home</span></a>
    </li>
    <!-- Nav Item - Dashboard -->
    <!-- <li class="nav-item">
      <a class="nav-link" href="<?= base_url('permintaanpenawaran'); ?>">
        <i class="fas fa-tasks"></i>
        <span>Permintaan Penawaran</span></a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('riwayatpenawaran'); ?>">
        <i class="fas fa-history"></i>
        <span>Riwayat Penawaran</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('pemesanan'); ?>">
        <i class="fas fa-shopping-bag"></i>
        <span>Pemesanan</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('informasipenjualan'); ?>">
        <i class="fas fa-info-circle"></i>
        <span>Informasi Penjualan</span></a>
    </li>
  <?php } ?>
  <?php if ($role_id == 5) { ?>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('administrasi'); ?>">
        <i class="fas fa-home"></i>
        <span>Home</span></a>
    </li>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('laporanpembelian'); ?>">
        <i class="fas fa-shopping-cart"></i>
        <span>Laporan Pembelian</span></a>
    </li>
  <?php } ?>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('editprofile'); ?>">
      <i class="fas fa-cogs "></i>
      <span>Edit Profile</span></a>
  </li>


</ul>
<!-- End of Sidebar -->