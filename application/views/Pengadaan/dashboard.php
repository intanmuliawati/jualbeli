 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
     </div>

     <!-- Content Row -->
     <!-- <div class="row">

         
         <div class="col-xl-3 col-md-4 mb-5">
             <div class="card border-left-primary shadow h-100 py-2">
                 <div class="card-body">
                     <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                             <a href="<?= base_url('jenisbenang'); ?>" class="h6 mb-0 font-weight-bold text-primary text-gray-800">Kategori Benang</a>
                         </div>
                         <div class="col-auto">
                             <i class="far fa-clone fa-2x text-gray-300"></i>
 </div>
 </div>
 </div>
 </div>
 </div>


 <div class="col-xl-3 col-md-4 mb-5">
     <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
             <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                     <a href="<?= base_url('prioritaspengadaan'); ?>" class="h6 mb-0 font-weight-bold text-primary text-gray-800">Prioritas Pengadaan</a>
                 </div>
                 <div class="col-auto">
                     <i class="fas fa-award fa-2x text-gray-300"></i>
 </div>
 </div>
 </div>
 </div>
 </div>


 <div class="col-xl-3 col-md-4 mb-5">
     <div class="card border-left-warning shadow h-100 py-2">
         <div class="card-body">
             <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                     <a href="<?= base_url('permintaanpengadaan'); ?>" class="h6 mb-0 font-weight-bold text-primary text-gray-800">Permintaan Pengadaan</a>
                 </div>
                 <div class="col-auto">
                     <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                 </div>
             </div>
         </div>
     </div>
 </div>



 <div class="col-xl-3 col-md-4 mb-5">
     <div class="card border-left-primary shadow h-100 py-2">
         <div class="card-body">
             <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                     <a href="<?= base_url('rekomendasipemasok'); ?>" class="h6 mb-0 font-weight-bold text-primary text-gray-800">Rekomendasi Pemasok</a>
                 </div>
                 <div class="col-auto">
                     <i class="fab fa-searchengin fa-2x text-gray-300"></i>
                 </div>
             </div>
         </div>
     </div>
 </div>


 <div class="col-xl-3 col-md-4 mb-5">
     <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
             <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                     <a href="<?= base_url('penawaran'); ?>" class="h6 mb-0 font-weight-bold text-primary text-gray-800">Penawaran</a>
                 </div>
                 <div class="col-auto">
                     <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
                 </div>
             </div>
         </div>
     </div>
 </div>


 <div class="col-xl-3 col-md-4 mb-5">
     <div class="card border-left-warning shadow h-100 py-2">
         <div class="card-body">
             <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                     <a href="<?= base_url('pembelian'); ?>" class="h6 mb-0 font-weight-bold text-primary text-gray-800">Riwayat Pembelian</a>
                 </div>
                 <div class="col-auto">
                     <i class="fas fa-history fa-2x text-gray-300"></i>
                 </div>
             </div>
         </div>
     </div>
 </div>
 </div> -->
     <div class="row">

         <!-- Area Chart -->
         <div class="col-xl-7 col-lg-6">
             <div class="card shadow mb-4">
                 <img src="<?= base_url('assets/upload/desain/home.jpg'); ?>" class="img-thumbnail" alt="...">
             </div>
             <div class="card shadow mb-4  ">
                 <!-- Card Header - Dropdown -->
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary">Rekomendasi Pemasok</h6>
                 </div>
                 <!-- Card Body -->
                 <div class="card-body">
                     <!-- Grafik Rangking -->
                     <div id="grafik">
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-xl-5 col-lg-6">
             <div class="card shadow mb-4">
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary">Profile Pengadaan</h6>
                 </div>
                 <div>
                     <div class="row no-gutters">
                         <div class="col-md-4">
                             <img src="<?= base_url('assets/upload/profile/defaulth.jpg'); ?>" class="card-img" alt="...">
                         </div>
                         <div class="col-md-8">
                             <div class="card-body">
                                 <h5 class="card-title"> <?= $user['name']; ?></h5>
                                 <p class="card-text"> <i class="far fa-envelope"></i> <?= $user['email']; ?></p>
                                 <p class="card-text"> <i class="fas fa-map-marker-alt"></i> <?= $user['alamat']; ?></p>
                                 <p class="card-text"> <i class="fas fa-mobile-alt"></i> 0<?= $user['no_tlp']; ?></p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="card shadow mb-4">
                 <!-- Card Header - Dropdown -->
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary">Prioritas Pengadaan</h6>
                 </div>
                 <!-- Card Body -->
                 <div class="card-body">
                     <?php $i = 0;
                        foreach ($penjualan as $pn) :  ?>
                         <?php if ($pn['niks'] == 3) { ?>
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fab fa-periscope"></i></div>
                                 </div>
                                 <input type="text" class="form-control" value="<?= $pn['subkategori_nama']; ?>" readonly>
                             </div>
                             <br>
                         <?php } ?>
                     <?php endforeach; ?>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- /.container-fluid -->
 </div>
 <!-- End of Main Content -->
 <script>
     $(document).ready(function() {
         Morris.Bar({
             element: 'grafik',
             data: <?= $nilai; ?>,
             xkey: 'name',
             ykeys: ['nilai_preferensi'],
             labels: ['Nilai Preferensi']
         });
     });
 </script>