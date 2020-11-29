<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tabel Data No Benang</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
        <?= form_error('kategori_jenis', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
        <?= form_error('namasubkategori', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
        <?= form_error('nama', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newsubkatModal"> Tambah No Benang </a>
        <table id="datatable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr style="text-align:center">
              <th>N0</th>
              <th>Jenis benang</th>
              <th>No benang</th>
              <th>Ubah</th>
              <th>Hapus</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($subkategori as $sub) : ?>
              <tr>
                <th scope="row"><?= $i; ?></td>
                <td><?= $sub['kategori_nama']; ?></td>
                <td><?= $sub['subkategori_nama']; ?></td>
                <td style="text-align:center">
                  <a href="" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#neweditModal<?= $sub['subkategori_id']; ?>">
                    <span class="icon text-white-0">
                      <i class="far fa-edit"></i>
                    </span>
                  </a>
                </td>
                <td style="text-align:center">
                  <a href="<?= base_url() . 'jenisbenang/hapussubkategori/' . $sub['subkategori_id']; ?>" class="btn btn-danger btn-icon-split tombol-hapus">
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
<div class="modal fade" id="newsubkatModal" tabindex="-1" role="dialog" aria-labelledby="newsubkatModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newsubkatModalLabel">Tambah No Benang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('jenisbenang/nobenang'); ?>" method="post">
        <div class="modal-body">
          <div class="input-group mb-3">
            <select id="kategori_jenis" name="kategori_jenis" class="form-control">
              <option value="">-Pilih Jenis Benang-</option>
              <?php foreach ($kategori as $kat) : ?>
                <option value="<?= $kat['kategori_id']; ?>"><?= $kat['kategori_nama']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="namasubkategori" name="namasubkategori" placeholder="No Benang">
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
foreach ($subkategori as $sub) :
  ?>
  <div class="modal fade" id="neweditModal<?= $sub['subkategori_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="neweditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="neweditModalLabel">Ubah No Benang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('jenisbenang/ubahsubkategori'); ?>" method="post">
          <div class="modal-body">
            <input type="hidden" name="id" value="<?= $sub['subkategori_id']; ?>">
            <input type="hidden" name="kategori_jenis" value="<?= $sub['kategori_id']; ?>">
            <div class="form-group">
              <label>Jenis Benang </label>
              <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $sub['kategori_nama']; ?>" readonly>
            </div>
            <div class="form-group">
              <label>No Benang </label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?= $sub['subkategori_nama']; ?>" onkeypress="return hanya(event)">
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