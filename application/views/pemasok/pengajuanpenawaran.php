<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <!-- DataTales Example -->

  <div class="card shadow mb-4">
    <div class="card-header py-3 mb-3">
      <h6 class="m-0 font-weight-bold text-primary">List Riwayat Penawaran</h6>
    </div>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

    <!-- <div class="album py-5 bg-light"> -->
    <div class="container">
      <?= form_error('subkategori', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
      <?= form_error('warna', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
      <?= form_error('jumlahtersedia', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
      <?= form_error('hargasatuan', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
      <!-- <?= form_error('contoh', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?> -->
      <?= form_error('warna2', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
      <?= form_error('jtersedia2', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
      <?= form_error('harga2', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>

      <div class="row">
        <div class="col-auto">
          <a href="" class="btn btn-primary col-auto mb-3 sm-5 " data-toggle="modal" data-target="#newpenawaranModal"> Tambah Penawaran </a>
        </div>
        <!-- <div class="col-auto ">
          <?= form_open('riwayatpenawaran/search') ?>
          <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Search">
            <div class="input-group-append md-4">
              <button class="btn btn-info" type="submit">
                <i class="fas fa-search fa-sm"></i>
              </button>
              <a href="<?= base_url('penawaran'); ?> " class="btn btn-warning mr-6 ">
                <i class="fas fa-undo"></i> </a>
            </div>
          </div>
          <?= form_close() ?>
        </div> -->
      </div>
      <div class="row">
        <?php foreach ($penawaran as $p) : ?>
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <div class="panel-body" style="text-align: center; overflow: hidden; padding: 0;">
                  <img style="height: 170px;" src="<?= base_url('assets/upload/contohbenang/') . $p['contoh'] ?>" class="img-thumbnail rounded mx-auto d-block">
                </div>
                <br>
                <small> Benang = <?= $p['subkategori_nama']; ?></small>
                <br>
                <small> Jumlah Tersedia = <?php
                                            $angka = $p['jumlah_tersedia'];
                                            $angka_format = number_format($angka, 2, ",", ".");
                                            echo $angka_format . ' kg';
                                            ?></small>
                <br>
                <small> Warna = <?= $p['warna']; ?></small>
                <br>
                <small> Harga Satuan = <?php
                                          $angka = $p['harga_satuan'];
                                          $angka_format = number_format($angka, 0, ",", ".");
                                          echo 'Rp ' . $angka_format;
                                          ?></small>
                <br>
                <small> Biaya Kirim = <?php
                                        $angka = $p['biaya_kirim'];
                                        $angka_format = number_format($angka, 0, ",", ".");
                                        echo 'Rp ' . $angka_format;
                                        ?></small>
                <br>
                <small> Catatan = <?= $p['catatan']; ?></small>
                <br>
                <div class="d-flex justify-content-between align-items-center">
                  <div class=" align-items-right">
                    <a href="" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#myModal<?= $p['id_penawaran']; ?>">
                      <span class="icon text-white-0">
                        <i class="far fa-images"> </i>
                      </span>
                    </a>
                    <a href="" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#neweditModal<?= $p['id_penawaran']; ?>">
                      <span class="icon text-white-0">
                        <i class="far fa-edit"> Ubah</i>
                      </span>
                    </a>
                    <a href="<?= base_url() . 'riwayatpenawaran/hapuspenawaran/' . $p['id_penawaran']; ?>" class="btn btn-danger btn-icon-split tombol-hapus">
                      <span class="icon text-white-0">
                        <i class="fas fa-trash"></i>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
    <!-- </div> -->


  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal untuk tambah-->
<div class="modal fade" id="newpenawaranModal" tabindex="-1" role="dialog" aria-labelledby="newpenawaranModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newpenawaranModalLabel">Masukan Penawaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('riwayatpenawaran'); ?>
      <div class="modal-body">
        <input type="hidden" id="id_pemasok" name="id_pemasok" value="<?= $user['id']; ?>">
        <div class="input-group mb-3">
          <select name="kategori_jenis" id="kategori_jenis" class="form-control">
            <option value="0">-Pilih Jenis Benang-</option>
            <?php foreach ($kategori->result() as $row) : ?>
              <option value="<?= $row->kategori_id; ?>"><?= $row->kategori_nama; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="input-group mb-3">
          <select name="subkategori" class="subkategori form-control">
            <option value="">-Pilih No Benang-</option>
          </select>
        </div>
        <div class="form-group">
          <div class="input-group">
            <input placeholder="Warna" type="text" class="form-control" id="warna" name="warna" onkeypress="return hanyahuruf(event)">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <input placeholder="Jumlah Tesedia/Kg" type="text" class="form-control" id="jumlahtersedia" name="jumlahtersedia" onkeypress="return hanyadecimal(event)">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group ">
            <input placeholder="Harga Satuan/Kg" type="text" class="form-control" id="hargasatuan" name="hargasatuan" onkeypress="return hanyaAngka(event)">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group ">
            <input placeholder="Biaya Kirim" type="text" class="form-control" id="biayakirim" name="biayakirim" onkeypress="return hanyaAngka(event)">
          </div>
        </div>
        <div class="form-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="contoh" name="contoh">
            <label class="custom-file-label" for="contoh">Masukan Contoh Benang</label>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group ">
            <input placeholder="Catatan" type="text" class="form-control" id="catatan" name="catatan">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary tombol-ubah"> Tambah </button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>

<!-- Modal Untuk Edit -->
<?php
foreach ($penawaran as $p) :
  ?>
  <div class="modal fade" id="neweditModal<?= $p['id_penawaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="neweditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="neweditModalLabel">Ubah Penawaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?= form_open_multipart('riwayatpenawaran/ubahpenawaran'); ?>
        <div class="modal-body">
          <input type="hidden" name="id_penawaran" value="<?= $p['id_penawaran']; ?>">
          <input type="hidden" name="fotolama" value="<?= $p['contoh'] ?>">
          <div class="form-group">
            <label>Benang</label>
            <input type="text" class="form-control" id="benang" name="benang" value="<?= $p['subkategori_nama']; ?> " readonly>
          </div>
          <div class="form-group">
            <label>Warna</label>
            <input type="text" class="form-control" id="warna2" name="warna2" value="<?= $p['warna']; ?>" onkeypress="return hanyahuruf(event)">
          </div>
          <div class="form-group">
            <label>Jumlah Tersedia</label>
            <input type="text" class="form-control" id="jtersedia2" name="jtersedia2" value="<?= $p['jumlah_tersedia']; ?>" onkeypress="return hanyadecimal(event)">
          </div>
          <div class="form-group">
            <label>Harga Satuan/Kg</label>
            <input type="text" class="form-control" id="harga2" name="harga2" value="<?= $p['harga_satuan']; ?> " onkeypress="return hanyaAngka(event)">
          </div>
          <div class="form-group">
            <label>Biaya Kirim</label>
            <input type="text" class="form-control" id="biaya2" name="biaya2" value="<?= $p['biaya_kirim']; ?> " onkeypress="return hanyaAngka(event)">
          </div>
          <div class="form-group">
            <label> Contoh Benang </label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="contoh" name="contoh">
              <label class="custom-file-label" for="contoh"><?= $p['contoh'] ?></label>
            </div>
          </div>
          <div class="form-group">
            <label>Catatan</label>
            <input type="text" class="form-control" id="catatan" name="catatan" value="<?= $p['catatan']; ?> ">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary tombol-ubah"> Ubah </button>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- Modal untuk view -->
<?php
foreach ($penawaran as $p) :
  ?>
  <div class="modal fade" id="myModal<?= $p['id_penawaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="neweditModalLabel">Contoh Benang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <center>
            <img src="<?= base_url('assets/upload/contohbenang/') . $p['contoh'] ?>" alt="" class="img-thumbnail col-md-10 rounded mx-auto d-block">
          </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>


<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-2.2.3.min.js' ?>"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#kategori_jenis').change(function() {
      var id = $(this).val();
      $.ajax({
        url: "<?= base_url(); ?>riwayatpenawaran/get_subkategori",
        method: "POST",
        data: {
          id: id
        },
        async: false,
        dataType: 'json',
        success: function(data) {
          var html = '';
          var i;
          html += '<option>-Pilih No Benang-</option>';
          for (i = 0; i < data.length; i++) {
            html += '<option value="' + data[i].subkategori_id + '">' + data[i].subkategori_nama + '</option>';
          }

          $('.subkategori').html(html);
        }
      });
    });
  });
</script>