<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tabel Data Jenis Benang</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
        <?= form_error('namakategori', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
        <?= form_error('nama', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newkatModal"> Tambah Jenis Benang </a>
        <table id="datatable" class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
          <thead>
            <tr style="text-align:center">
              <th>N0</th>
              <th>Jenis benang</th>
              <th>Ubah</th>
              <th>Hapus</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($kategori as $kat) : ?>
              <tr>
                <th scope="row"><?= $i; ?></td>
                <td><?= $kat['kategori_nama']; ?></td>
                <td style="text-align:center">
                  <a href="" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#neweditModal<?= $kat['kategori_id']; ?>">
                    <span class="icon text-white-0">
                      <i class="far fa-edit"></i>
                    </span>
                  </a>
                </td>
                <td style="text-align:center">
                  <a href="<?= base_url() . 'jenisbenang/hapuskategori/' . $kat['kategori_id']; ?>" class="btn btn-danger btn-icon-split tombol-hapus">
                    <span class="icon text-white-0">
                      <i class="fas fa-trash"></i>
                    </span>
                  </a>
                </td>
              </tr>
              <?php $i++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal tambah data -->
<div class="modal fade" id="newkatModal" tabindex="-1" role="dialog" aria-labelledby="newkatModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newkatModalLabel">Tambah Jenis Benang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('jenisbenang/index'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="namakategori" name="namakategori" placeholder="Nama Jenis Benang" onkeypress="return hanyahuruf(event)">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal edit data -->
<?php
foreach ($kategori as $kat) :
  ?>
  <div class="modal fade" id="neweditModal<?= $kat['kategori_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="neweditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="neweditModalLabel">Ubah Jenis Benang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('jenisbenang/ubahkategori'); ?>" method="post">
          <div class="modal-body">
            <input type="hidden" name="id" value="<?= $kat['kategori_id']; ?>">
            <div class="form-group">
              <label>Nama Jenis </label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?= $kat['kategori_nama']; ?>" onkeypress="return hanyahuruf(event)">
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
<?php endforeach; ?>