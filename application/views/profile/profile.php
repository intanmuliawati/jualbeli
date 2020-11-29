<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <div class="flash-data mb-3" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
  <?= form_error('passwordlama', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
  <?= form_error('password1', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
  <?= form_error('password2', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
  <?= form_error('name', '<div class="alert alert-danger pl-2" role="alert">', '</div>'); ?>
  <?= form_error('alamat', '<div class="alert alert-danger pl-2" role="alert">', '</div>'); ?>
  <?= form_error('no', '<div class="alert alert-danger pl-2" role="alert">', '</div>'); ?>
  <div class="card mb-3" style="max-width: 540px;">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img src="<?= base_url('assets/upload/profile/defaulth.jpg'); ?>" class="card-img" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title"><?= $user['name']; ?></h5>
          <p class="card-text"><i class="far fa-envelope"></i> <?= $user['email']; ?></p>
          <p class="card-text"><i class="fas fa-map-marker-alt"></i> <?= $user['alamat']; ?></p>
          <p class="card-text"><i class="fas fa-mobile-alt"></i> 0<?= $user['no_tlp']; ?></p>
          <div>
            <a class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#editModal">
              <span class="icon text-white">
                <i class="far fa-edit"> Edit Profile</i>
              </span>
            </a>
            <a href="" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#editpModal">
              <span class="icon text-white-0">
                <i class="far fa-edit"> Ubah Password</i>
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal edit data -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('editprofile/edit'); ?>" method="post">
        <div class="modal-body">
          <input type="hidden" name="id" value="<?= $user['id']; ?>">
          <div class="form-group">
            <label>Nama user </label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" onkeypress="return hanyahuruf(event)">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $user['alamat']; ?>">
          </div>
          <div class="form-group">
            <label>No Tlp</label>
            <input type="text" class="form-control" id="no" name="no" value="<?= $user['no_tlp']; ?>" onkeypress="return hanyaAngka(event)">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary tombol-ubah"> Edit </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Ubah password -->
<div class="modal fade" id="editpModal" tabindex="-1" role="dialog" aria-labelledby="editpModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editpModalLabel">Ganti Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('editprofile'); ?>" method="post">
        <div class="modal-body">
          <input type="hidden" name="id" value="<?= $user['id']; ?>">
          <div class="form-group">
            <input type="password" class="form-control" id="passwordlama" name="passwordlama" placeholder=" Password Lama">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password1" name="password1" placeholder=" Password Baru">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password2" name="password2" placeholder=" Ulangi Password">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary tombol-ubah"> Ubah </button>
        </div>
      </form>
    </div>
  </div>
</div>