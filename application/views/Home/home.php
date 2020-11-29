 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
     </div>
     <div class="row">
         <!-- Area Chart -->
   
         <div class="col-xl-5 col-lg-6">
             <div class="card shadow mb-4">
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                 </div>
                 <div>
                     <div class="row no-gutters">
                         <div class="col-md-4">
                             <img src="<?= base_url('assets/upload/profile/defaulth.jpg'); ?>" class="card-img" alt="...">
                         </div>
                         <div class="col-md-8">
                             <div class="card-body">
                                 <h6 class="card-title"> <?= $user['name']; ?></h6>
                                 <p class="card-text"> <i class="far fa-envelope"></i> <?= $user['email']; ?></p>
                                 <p class="card-text"> <i class="fas fa-map-marker-alt"></i> <?= $user['alamat']; ?></p>
                                 <p class="card-text"> <i class="fas fa-mobile-alt"></i> 0<?= $user['no_tlp']; ?></p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>            
         </div>
     </div>
 </div>
 <!-- /.container-fluid -->
 </div>
 <!-- End of Main Content -->